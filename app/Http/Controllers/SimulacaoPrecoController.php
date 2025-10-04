<?php

// app/Http/Controllers/SimulacaoPrecoController.php
namespace App\Http\Controllers;

use App\Models\SimulacaoPreco;
use App\Models\Produto;              // << importa Produto
use App\Services\CalculadoraPreco;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SimulacaoPrecoController extends Controller
{
    public function create(Request $request)
    {
        // Busca e paginação no mesmo padrão do ProdutoController
        $q = trim($request->get('q', ''));
        $perPage = (int) $request->get('per_page', 10);
        if (!in_array($perPage, [10,25,50,100])) $perPage = 10;

        $produtos = Produto::query()
            ->with(['categoria', 'ncmItem'])
            ->when($q !== '', function ($query) use ($q) {
                $digits = preg_replace('/\D+/', '', $q);
                $query->where(function($qq) use ($q, $digits) {
                    $qq->where('descricao', 'like', "%{$q}%");
                    if ($digits !== '') {
                        $qq->orWhere('codigo_barras', 'like', "%{$digits}%");
                        $qq->orWhere('cest', 'like', "%{$digits}%");
                    }
                });
            })
            ->orderBy('descricao')
            ->paginate($perPage);

        return view('simulacoes_precos.create', [
            'produtos' => $produtos,
            'q'        => $q,
        ]);
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            // torna obrigatório, já que a UI exige seleção
            'produto_id'      => ['required','exists:produtos,id'],
            'preco_custo'     => ['required','numeric','min:0'],
            'frete'           => ['nullable','numeric','min:0'],
            'outras_despesas' => ['nullable','numeric','min:0'],

            // As entradas da tela são em %, mas o service espera 0..1.
            // Validamos como número >=0 e convertimos depois.
            'icms'            => ['required','numeric','min:0'],
            'pis'             => ['required','numeric','min:0'],
            'cofins'          => ['required','numeric','min:0'],

            'margem_lucro'    => ['required','numeric','min:0'], // em %
            'margem_calculo'  => ['required', Rule::in(['markup','margin'])],
            'tipo_simulacao'  => ['nullable', Rule::in(['promocao','oferta','baixar_preco','aumentar_lucro'])],
            'observacoes'     => ['nullable','string'],
        ]);

        // normaliza campos numéricos opcionais
        $data['frete'] = $data['frete'] ?? 0;
        $data['outras_despesas'] = $data['outras_despesas'] ?? 0;

        // Conversão de percentuais (tela em % -> service em fator 0..1)
        $toFactor = function($v) {
            $v = (float)$v;
            return $v > 1 ? $v / 100 : $v; // se usuário digitar "18", vira 0.18
        };
        $data['icms']         = $toFactor($data['icms']);
        $data['pis']          = $toFactor($data['pis']);
        $data['cofins']       = $toFactor($data['cofins']);
        $data['margem_lucro'] = $toFactor($data['margem_lucro']);

        $calc = CalculadoraPreco::sugerirPreco($data);
        $data['preco_sugerido'] = $calc['preco_sugerido'];

        $sim = SimulacaoPreco::create($data);

        return back()->with([
            'ok'     => 'Simulação criada com sucesso.',
            'calc'   => $calc,
            'sim_id' => $sim->id,
        ]);
    }

        public function index(Request $request)
        {
            $q          = trim($request->get('q',''));                 // busca por produto
            $tipo       = $request->get('tipo_simulacao');             // promo/oferta/...
            $modo       = $request->get('margem_calculo');             // markup/margin
            $de         = $request->get('de');                         // yyyy-mm-dd
            $ate        = $request->get('ate');                        // yyyy-mm-dd
            $perPage    = (int) $request->get('per_page', 10);
            if (!in_array($perPage, [10,25,50,100])) $perPage = 10;

            $simulacoes = \App\Models\SimulacaoPreco::query()
                ->with(['produto:id,descricao']) // traz nome do produto
                ->when($q !== '', function($qb) use ($q) {
                    $qb->whereHas('produto', function($p) use ($q) {
                        $p->where('descricao','like',"%{$q}%");
                    });
                })
                ->when($tipo, fn($qb) => $qb->where('tipo_simulacao', $tipo))
                ->when($modo, fn($qb) => $qb->where('margem_calculo', $modo))
                ->when($de, function($qb) use ($de) {
                    $qb->whereDate('created_at', '>=', $de);
                })
                ->when($ate, function($qb) use ($ate) {
                    $qb->whereDate('created_at', '<=', $ate);
                })
                ->orderByDesc('created_at')
                ->paginate($perPage)
                ->withQueryString();

            return view('simulacoes_precos.index', compact('simulacoes','q','tipo','modo','de','ate','perPage'));
        }

    public function destroy(\App\Models\SimulacaoPreco $simulacao)
    {
        $simulacao->delete();
        return back()->with('ok', 'Simulação removida.');
    }
}
