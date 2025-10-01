<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use App\Models\NotaFiscalItem;
use App\Models\Produto;
use App\Models\Ncm;
use Illuminate\Http\Request;

class NotaFiscalItemController extends Controller
{
    public function index(NotaFiscal $nota, Request $request)
    {
        // Evita N+1 e garante dados para a tabela (produto + ncm)
        $nota->load(['fornecedor', 'itens.produto', 'itens.ncmItem']);

        // Padrão do sistema: controller injeta coleções usadas nos <select>
        $produtos = Produto::orderBy('descricao')->get(['id', 'descricao', 'codigo_barras']);
        $ncms     = Ncm::orderBy('codigo')->get(['id', 'codigo', 'descricao']);

        return view('notas.itens', compact('nota', 'produtos', 'ncms'));
    }

    public function store(Request $request, NotaFiscal $nota)
    {
        $data = $request->validate([
            'produto_id'     => ['required', 'exists:produtos,id'],
            'ncm'            => ['required', 'exists:ncms,id'],
            'cest'           => ['nullable', 'regex:/^\d{7}$/'],
            'quantidade'     => ['required', 'numeric', 'min:0.0001'],
            'valor_unitario' => ['required', 'numeric', 'min:0'],
            'icms'           => ['nullable', 'numeric', 'min:0'],
            'pis'            => ['nullable', 'numeric', 'min:0'],
            'cofins'         => ['nullable', 'numeric', 'min:0'],
        ]);

        $nota->itens()->create([
            'produto_id'     => $data['produto_id'],
            'ncm'            => $data['ncm'],
            'cest'           => $data['cest'] ?? null,
            'quantidade'     => $data['quantidade'],
            'valor_unitario' => $data['valor_unitario'],
            'icms'           => $data['icms']   ?? 0,
            'pis'            => $data['pis']    ?? 0,
            'cofins'         => $data['cofins'] ?? 0,
            // Não salva 'total' — é calculado pelo accessor getTotalAttribute()
        ]);

        if (method_exists($nota, 'recalcularTotais')) {
            $nota->recalcularTotais();
        }

        return redirect()->route('notas.itens', $nota->id)->with('success', 'Item adicionado.');
    }

    public function update(Request $request, NotaFiscal $nota, NotaFiscalItem $item)
    {
        if ($item->nota_fiscal_id !== $nota->id) {
            abort(404);
        }

        $data = $request->validate([
            'produto_id'     => ['required', 'exists:produtos,id'],
            'ncm'            => ['required', 'exists:ncms,id'],
            'cest'           => ['nullable', 'regex:/^\d{7}$/'],
            'quantidade'     => ['required', 'numeric', 'min:0.0001'],
            'valor_unitario' => ['required', 'numeric', 'min:0'],
            'icms'           => ['nullable', 'numeric', 'min:0'],
            'pis'            => ['nullable', 'numeric', 'min:0'],
            'cofins'         => ['nullable', 'numeric', 'min:0'],
        ]);

        $item->fill([
            'produto_id'     => $data['produto_id'],
            'ncm'            => $data['ncm'],
            'cest'           => $data['cest'] ?? null,
            'quantidade'     => $data['quantidade'],
            'valor_unitario' => $data['valor_unitario'],
            'icms'           => $data['icms']   ?? 0,
            'pis'            => $data['pis']    ?? 0,
            'cofins'         => $data['cofins'] ?? 0,
        ])->save();

        if (method_exists($nota, 'recalcularTotais')) {
            $nota->recalcularTotais();
        }

        return redirect()->route('notas.itens', $nota->id)->with('success', 'Item atualizado.');
    }

    public function destroy(NotaFiscal $nota, NotaFiscalItem $item)
    {
        if ($item->nota_fiscal_id !== $nota->id) {
            abort(404);
        }

        $item->delete();

        if (method_exists($nota, 'recalcularTotais')) {
            $nota->recalcularTotais();
        }

        return redirect()->route('notas.itens', $nota->id)->with('success', 'Item removido.');
    }
}
