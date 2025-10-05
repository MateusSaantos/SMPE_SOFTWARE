<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ncm;
use App\Models\Produto;
use App\Models\Endereco;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Categoria;

class NotaFiscalController extends Controller
{
    public function index(Request $request)
    {
        $q       = trim($request->get('q', ''));
        $tipo    = $request->get('tipo');     // 'entrada' | 'saida' | null
        $de      = $request->get('de');       // YYYY-MM-DD
        $ate     = $request->get('ate');      // YYYY-MM-DD
        $perPage = (int) $request->get('per_page', 10);
        if (!in_array($perPage, [10,25,50,100])) $perPage = 10;

        $notas = NotaFiscal::query()
            ->with(['fornecedor'])
            // ->withCount('itens') // mantenha se precisar desse dado
            ->when($q !== '', function ($query) use ($q) {
                $digits = preg_replace('/\D+/', '', $q);

                // AGRUPA toda a lógica de busca em um único bloco
                $query->where(function ($qq) use ($q, $digits) {
                    $qq->where('numero', 'like', "%{$q}%")
                       ->orWhere('serie',  'like', "%{$q}%");

                    if ($digits !== '') {
                        $qq->orWhere('chave_acesso', 'like', "%{$digits}%");
                    }

                    $qq->orWhereHas('fornecedor', function ($f) use ($q, $digits) {
                        $f->where('razao_social', 'like', "%{$q}%");
                        if ($digits !== '') {
                            $f->orWhere('cnpj', 'like', "%{$digits}%");
                        }
                    });
                });
            })
            ->when($tipo !== null && $tipo !== '', function ($query) use ($tipo) {
                // ajuste o nome da coluna se no seu schema for outro
                $query->where('tipo', $tipo);
            })
            ->when($de, function ($query) use ($de) {
                $query->whereDate('data_emissao', '>=', $de);
            })
            ->when($ate, function ($query) use ($ate) {
                $query->whereDate('data_emissao', '<=', $ate);
            })
            ->orderByDesc(DB::raw('COALESCE(data_emissao, created_at)'))
            ->orderByDesc('id')
            ->paginate($perPage);

        return view('notas.list', [
            'notas' => $notas,
            'q'     => $q,
            'tipo'  => $tipo,
            'de'    => $de,
            'ate'   => $ate,
        ]);
    }

    public function create()
    {
        $fornecedores = Fornecedor::orderBy('razao_social')->get(['cnpj','razao_social']);
        return view('notas.create', compact('fornecedores'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'numero'          => 'required|string|max:15',
            'serie'           => 'nullable|string|max:5',
            'data_emissao'    => 'nullable|date',
            'cnpj_dest'       => 'nullable|regex:/^\d{14}$/',
            'fornecedor_cnpj' => 'required|exists:fornecedores,cnpj',
            'frete'           => 'nullable|numeric|min:0|max:9999999999.99',
            'outras_despesas' => 'nullable|numeric|min:0|max:9999999999.99',
            'chave_acesso'    => 'nullable|regex:/^\d{44}$/|unique:notas_fiscais,chave_acesso',
            'status'          => 'required|in:rascunho,lancada,cancelada',
            'data_entrada'    => 'nullable|date',
            'tipo'            => 'required|in:entrada,saida',
            'observacao'      => 'nullable|string',
        ]);

        $nota = NotaFiscal::create($data);

        return redirect()
            ->route('notas.itens', $nota->id)
            ->with('success', 'Capa da nota criada. Agora insira os itens.');
    }

    public function show(NotaFiscal $nota)
    {
        $nota->load(['fornecedor','itens.ncmItem']);
        return view('notas.show', compact('nota'));
    }

    public function edit(NotaFiscal $nota)
    {
        $fornecedores = Fornecedor::orderBy('razao_social')->get(['cnpj','razao_social']);
        return view('notas.edit', compact('nota','fornecedores'));
    }

    public function update(Request $request, NotaFiscal $nota)
    {
        $data = $request->validate([
            'numero'          => 'required|string|max:15',
            'serie'           => 'nullable|string|max:5',
            'data_emissao'    => 'nullable|date',
            'cnpj_dest'       => 'nullable|regex:/^\d{14}$/',
            'fornecedor_cnpj' => 'required|exists:fornecedores,cnpj',
            'frete'           => 'nullable|numeric|min:0|max:9999999999.99',
            'outras_despesas' => 'nullable|numeric|min:0|max:9999999999.99',
            'chave_acesso'    => 'nullable|regex:/^\d{44}$/|unique:notas_fiscais,chave_acesso,' . $nota->id,
            'status'          => 'required|in:rascunho,lancada,cancelada',
            'data_entrada'    => 'nullable|date',
            'tipo'            => 'required|in:entrada,saida',
            'observacao'      => 'nullable|string',
        ]);

        $nota->update($data);
        if (method_exists($nota, 'recalcularTotais')) {
            $nota->recalcularTotais();
        }

        return redirect()
            ->route('notas.show', $nota->id)
            ->with('success', 'Capa da nota atualizada.');
    }

    public function destroy(NotaFiscal $nota)
    {
        $nota->delete();
        return redirect()
            ->route('notas.index')
            ->with('success', 'Nota removida.');
    }

    /** =========================
     *  IMPORTAÇÃO – PASSO 0: form
     *  ========================= */
    public function importForm()
    {
        return view('notas.import_xml');
    }

    /** =========================
     *  IMPORTAÇÃO – PASSO 1: preview
     *  ========================= */
    public function importPreview(Request $request)
    {
        $request->validate([
            'xml' => ['required','file','mimes:xml','max:5120'],
        ]);

        $xmlContent = file_get_contents($request->file('xml')->getRealPath());
        try {
            $sx = new \SimpleXMLElement($xmlContent);
        } catch (\Throwable $e) {
            return back()->withErrors(['xml' => 'XML inválido: '.$e->getMessage()])->withInput();
        }

        // Namespaces NF-e 4.0
        $namespaces = $sx->getDocNamespaces(true);
        $nfe = isset($namespaces['']) ? $sx->children($namespaces['']) : $sx;

        // Pode vir <nfeProc><NFe>... ou <NFe> direto
        $NFe    = isset($nfe->NFe) ? $nfe->NFe : $nfe;
        $infNFe = $NFe->infNFe ?? null;
        if (!$infNFe) {
            return back()->withErrors(['xml' => 'Não foi possível localizar <infNFe> no XML.'])->withInput();
        }

        $ide  = $infNFe->ide ?? null;
        $emit = $infNFe->emit ?? null;
        $dest = $infNFe->dest ?? null;

        // Cabeçalho da nota
        $draft = [
            'nota' => [
                'chave'        => preg_replace('/^NFe/i','', (string)($infNFe['Id'] ?? '')),
                'numero'       => (string)($ide->nNF ?? ''),
                'serie'        => (string)($ide->serie ?? ''),
                'data_emissao' => (string)($ide->dhEmi ?? ''),
                'cnpj_dest'    => preg_replace('/\D+/','', (string)($dest->CNPJ ?? '')),
            ],
            'fornecedor' => [
                'cnpj'  => preg_replace('/\D+/','', (string)($emit->CNPJ ?? '')),
                'razao' => trim((string)($emit->xNome ?? '')),
                'endereco' => ($e = $emit->enderEmit ?? null) ? [
                    'cep'         => preg_replace('/\D+/', '', (string)($e->CEP ?? '')),
                    'uf'          => strtoupper((string)($e->UF ?? '')),
                    'cidade'      => (string)($e->xMun ?? ''),
                    'bairro'      => (string)($e->xBairro ?? ''),
                    'logradouro'  => (string)($e->xLgr ?? ''),
                    'numero'      => (string)($e->nro ?? ''),
                    'complemento' => (string)($e->xCpl ?? null),
                ] : null,
            ],
            'itens' => [],
            'suggestions' => [
                'fornecedor_id' => null,
                'produtos'      => [],
            ],
        ];

        // Sugestão de fornecedor existente
        if ($draft['fornecedor']['cnpj']) {
            $exist = Fornecedor::where('cnpj', $draft['fornecedor']['cnpj'])->first();
            if ($exist) $draft['suggestions']['fornecedor_id'] = $exist->cnpj;
        }

        // Itens
        $idx = 0;
        foreach ($infNFe->det as $det) {
            $prod = $det->prod ?? null;
            if (!$prod) continue;

            $xProd   = trim((string)($prod->xProd ?? ''));
            $cProd   = (string)($prod->cProd ?? '');
            $ncmCode = preg_replace('/\D+/','', (string)($prod->NCM ?? ''));
            $cest    = preg_replace('/\D+/','', (string)($prod->CEST ?? ''));
            $uCom    = (string)($prod->uCom ?? 'UN');
            $qCom    = (float) str_replace(',','.', (string)($prod->qCom ?? '0'));
            $vUnCom  = (float) str_replace(',','.', (string)($prod->vUnCom ?? '0'));
            $cEAN    = preg_replace('/\D+/', '', (string)($prod->cEAN ?? ''));

            $draft['itens'][] = [
                'index'       => $idx,
                'descricao'   => $xProd ?: ($cProd ?: 'Produto sem descrição'),
                'ean'         => $cEAN ?: null,
                'ncm_code'    => $ncmCode ?: null,
                'cest'        => $cest ?: null,
                'unidade'     => $uCom ?: 'UN',
                'quantidade'  => $qCom,
                'valor_unit'  => $vUnCom,
            ];

            // sugestão de produto
            $suggestId = null;
            if ($cEAN && preg_match('/^\d{8,14}$/', $cEAN)) {
                $p = Produto::where('codigo_barras', $cEAN)->first();
                if ($p) $suggestId = $p->id;
            }
            if (!$suggestId && $xProd) {
                $p = Produto::where('descricao', $xProd)->first();
                if ($p) $suggestId = $p->id;
            }
            $draft['suggestions']['produtos'][$idx] = $suggestId;

            $idx++;
        }

        // Guarda na sessão e exibe revisão
        $token = (string) Str::uuid();
        $request->session()->put("import_nfe.$token", $draft);

        return redirect()->route('notas.import.form')->with([
            'preview_token' => $token
        ]);
    }

    /** =========================
     *  IMPORTAÇÃO – PASSO 2: commit
     *  ========================= */
    public function importCommit(Request $request)
    {
        $request->validate([
            'token'           => ['required','string'],
            'fornecedor_mode' => ['required','in:link,new'],
            'fornecedor_id'   => ['nullable','exists:fornecedores,cnpj'],
            // produtos[idx][mode] = link|new
            // quando link:  produtos[idx][product_id] exists:produtos,id
            // quando new :  produtos[idx][new][...]
        ]);

        $draft = $request->session()->get("import_nfe.".$request->token);
        if (!$draft) {
            return back()->withErrors(['token' => 'Sessão de importação expirada. Reenvie o XML.']);
        }

        DB::beginTransaction();
        try {
            // Fornecedor
            if ($request->fornecedor_mode === 'link' && $request->fornecedor_id) {
                $fornecedor = Fornecedor::where('cnpj', $request->fornecedor_id)->firstOrFail();
            } else {
                $ender = Arr::get($draft, 'fornecedor.endereco');
                $enderecoId = null;
                if ($ender) {
                    $endereco = Endereco::create([
                        'cep'        => $ender['cep'] ?? null,
                        'uf'         => $ender['uf'] ?? null,
                        'cidade'     => $ender['cidade'] ?? null,
                        'bairro'     => $ender['bairro'] ?? null,
                        'logradouro' => $ender['logradouro'] ?? null,
                        'numero'     => $ender['numero'] ?? null,
                        'complemento'=> $ender['complemento'] ?? null,
                    ]);
                    $enderecoId = $endereco->id;
                }
                $fornecedor = Fornecedor::firstOrCreate(
                    ['cnpj' => $draft['fornecedor']['cnpj']],
                    [
                        'razao_social'  => $draft['fornecedor']['razao'] ?: 'Fornecedor do XML',
                        'endereco_id'   => $enderecoId,
                        'telefone'      => null,
                        'nome_fantasia' => null,
                        'inscricao_estadual' => null,
                    ]
                );
                if (!$fornecedor->endereco_id && $enderecoId) {
                    $fornecedor->endereco_id = $enderecoId;
                    $fornecedor->save();
                }
            }

            // Capa da nota
            $nota = NotaFiscal::create([
                'numero'          => $draft['nota']['numero'] ?: null,
                'serie'           => $draft['nota']['serie'] ?: null,
                'data_emissao'    => $draft['nota']['data_emissao'] ? Carbon::parse($draft['nota']['data_emissao']) : null,
                'cnpj_dest'       => $draft['nota']['cnpj_dest'] ?: null,
                'fornecedor_cnpj' => $fornecedor->cnpj,
                'frete'           => 0,
                'outras_despesas' => 0,
                'chave_acesso'    => $draft['nota']['chave'] ?: null,
                'status'          => 'rascunho',
                'data_entrada'    => now(),
                'tipo'            => 'entrada',
                'observacao'      => 'Importada via XML (revisão)',
            ]);

            // Itens
            $fallbackNcm = Ncm::firstOrCreate(
                ['codigo' => '00000000'],
                ['descricao' => 'Não informado']
            );

            foreach ($draft['itens'] as $it) {
                $idx  = $it['index'];
                $mode = data_get($request->all(), "produtos.$idx.mode");

                // Resolve NCM
                $ncmId = $fallbackNcm->id;
                if (!empty($it['ncm_code'])) {
                    $ncm = Ncm::firstOrCreate(
                        ['codigo' => $it['ncm_code']],
                        ['descricao' => 'Importado do XML']
                    );
                    $ncmId = $ncm->id;
                }

                if ($mode === 'link') {
                    $productId = (int) data_get($request->all(), "produtos.$idx.product_id");
                    $produto = Produto::findOrFail($productId);
                } else {
                    $catId = Categoria::value('id') ?? 1;
                    $produto = Produto::create([
                        'descricao'         => data_get($request->all(), "produtos.$idx.new.descricao", $it['descricao']),
                        'codigo_barras'     => data_get($request->all(), "produtos.$idx.new.codigo_barras", $it['ean']),
                        'categoria_produto' => (int) data_get($request->all(), "produtos.$idx.new.categoria_produto", $catId),
                        'margem_lucro'      => (float) data_get($request->all(), "produtos.$idx.new.margem_lucro", 0),
                        'cest'              => data_get($request->all(), "produtos.$idx.new.cest", $it['cest']),
                        'ncm'               => $ncmId,
                        'unidade_medida'    => data_get($request->all(), "produtos.$idx.new.unidade_medida", $it['unidade']),
                        'preco_custo'       => (float) data_get($request->all(), "produtos.$idx.new.preco_custo", $it['valor_unit']),
                        'preco_venda'       => (float) data_get($request->all(), "produtos.$idx.new.preco_venda", $it['valor_unit']),
                        'estoque'           => (int) data_get($request->all(), "produtos.$idx.new.estoque", 0),
                        'icms'              => 0,
                        'pis'               => 0,
                        'cofins'            => 0,
                        'ativo'             => 1,
                        'origem_mercadoria' => 0,
                        'aliquota_ipi'      => 0,
                        'ipi_enquadramento' => null,
                        'estoque_minimo'    => 0,
                    ]);
                }

                $nota->itens()->create([
                    'produto_id'     => $produto->id,
                    'ncm'            => $ncmId,
                    'cest'           => $it['cest'],
                    'quantidade'     => $it['quantidade'],
                    'valor_unitario' => $it['valor_unit'],
                    'icms'           => 0,
                    'pis'            => 0,
                    'cofins'         => 0,
                ]);
            }

            if (method_exists($nota, 'recalcularTotais')) {
                $nota->recalcularTotais();
            }

            DB::commit();

            // Limpa o draft da sessão
            $request->session()->forget("import_nfe.".$request->token);

            return redirect()->route('notas.show', $nota->id)
                ->with('success', 'Nota importada com sucesso após revisão!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['commit' => 'Falha ao efetivar importação: '.$e->getMessage()]);
        }
    }
}
