<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class NotaFiscalController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q', ''));
        $perPage = (int) $request->get('per_page', 10);
        if (!in_array($perPage, [10,25,50,100])) $perPage = 10;

        $notas = NotaFiscal::query()
            ->with('fornecedor')
            ->when($q !== '', function ($query) use ($q) {
                $digits = preg_replace('/\D+/', '', $q);
                $query->where(function($qq) use ($q, $digits) {
                    $qq->where('numero', 'like', "%{$q}%")
                       ->orWhere('serie', 'like', "%{$q}%")
                       ->orWhere('chave_acesso', 'like', "%{$digits}%");
                })
                ->orWhereHas('fornecedor', function($f) use ($q) {
                    $f->where('razao_social','like',"%{$q}%");
                });
            })
            ->orderByDesc('id')
            ->paginate($perPage);

        return view('notas.index', compact('notas','q'));
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

        return redirect()->route('notas.itens', $nota->id)
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
        $nota->recalcularTotais();

        return redirect()->route('notas.show', $nota->id)->with('success', 'Capa da nota atualizada.');
    }

    public function destroy(NotaFiscal $nota)
    {
        $nota->delete();
        return redirect()->route('notas.index')->with('success', 'Nota removida.');
    }
}
