<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use App\Models\NotaFiscalItem;
use App\Models\Ncm;
use Illuminate\Http\Request;

class NotaFiscalItemController extends Controller
{
    public function index(NotaFiscal $nota)
    {
        $nota->load(['fornecedor','itens.ncmItem']);
        $ncms = Ncm::orderBy('codigo')->get(['id','codigo','descricao']);
        return view('notas.itens', compact('nota','ncms'));
    }

    public function store(Request $request, NotaFiscal $nota)
    {
        $data = $request->validate([
            'quantidade'     => 'required|numeric|min:0.001|max:9999999999.999',
            'valor_unitario' => 'required|numeric|min:0|max:9999999999.99',
            'ncm'            => 'required|exists:ncms,id',
            'cest'           => 'nullable|regex:/^\d{7}$/',
            'icms'           => 'nullable|numeric|min:0|max:999.99',
            'pis'            => 'nullable|numeric|min:0|max:999.99',
            'cofins'         => 'nullable|numeric|min:0|max:999.99',
        ]);

        $item = NotaFiscalItem::create([
            'nota_fiscal_id' => $nota->id,
            'quantidade'     => $data['quantidade'],
            'valor_unitario' => $data['valor_unitario'],
            'ncm'            => $data['ncm'],
            'cest'           => $data['cest'] ?? null,
            'icms'           => $data['icms'] ?? 0,
            'pis'            => $data['pis'] ?? 0,
            'cofins'         => $data['cofins'] ?? 0,
        ]);

        $nota->recalcularTotais();

        return redirect()->route('notas.itens', $nota->id)->with('success', 'Item adicionado.');
    }

    public function update(Request $request, NotaFiscal $nota, NotaFiscalItem $item)
    {
        if ($item->nota_fiscal_id !== $nota->id) abort(404);

        $data = $request->validate([
            'quantidade'     => 'required|numeric|min:0.001|max:9999999999.999',
            'valor_unitario' => 'required|numeric|min:0|max:9999999999.99',
            'ncm'            => 'required|exists:ncms,id',
            'cest'           => 'nullable|regex:/^\d{7}$/',
            'icms'           => 'nullable|numeric|min:0|max:999.99',
            'pis'            => 'nullable|numeric|min:0|max:999.99',
            'cofins'         => 'nullable|numeric|min:0|max:999.99',
        ]);

        $item->update([
            'quantidade'     => $data['quantidade'],
            'valor_unitario' => $data['valor_unitario'],
            'ncm'            => $data['ncm'],
            'cest'           => $data['cest'] ?? null,
            'icms'           => $data['icms'] ?? 0,
            'pis'            => $data['pis'] ?? 0,
            'cofins'         => $data['cofins'] ?? 0,
        ]);

        $nota->recalcularTotais();

        return redirect()->route('notas.itens', $nota->id)->with('success', 'Item atualizado.');
    }

    public function destroy(NotaFiscal $nota, NotaFiscalItem $item)
    {
        if ($item->nota_fiscal_id !== $nota->id) abort(404);

        $item->delete();
        $nota->recalcularTotais();

        return redirect()->route('notas.itens', $nota->id)->with('success', 'Item removido.');
    }
}
