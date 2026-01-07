<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioPrecoController extends Controller
{
    public function index(Request $request)
    {
        $query = Produto::with('categoria')
            ->select(
                'id',
                'descricao',
                'categoria_produto',
                'preco_custo',
                'preco_venda',
                'ativo'
            );

        // 🔹 filtro por produto (descrição)
        if ($request->filled('produto')) {
            $query->where('descricao', 'like', '%' . $request->produto . '%');
        }

        // 🔹 filtro por categoria
        if ($request->filled('categoria')) {
            $query->where('categoria_produto', $request->categoria);
        }

        // 🔹 filtro por status
        if ($request->filled('ativo')) {
            $query->where('ativo', $request->ativo);
        }

        $produtos = $query
            ->orderBy('preco_venda', 'desc')
            ->get();

        $categorias = Categoria::orderBy('descricao')->get();

        return view('relatorios.precos', compact('produtos', 'categorias'));
    }

    public function pdf(Request $request)
    {
        // reaproveita a mesma lógica de filtro
        $query = Produto::with('categoria')
            ->select(
                'id',
                'descricao',
                'categoria_produto',
                'preco_custo',
                'preco_venda',
                'ativo'
            );

        if ($request->filled('produto')) {
            $query->where('descricao', 'like', '%' . $request->produto . '%');
        }

        if ($request->filled('categoria')) {
            $query->where('categoria_produto', $request->categoria);
        }

        if ($request->filled('ativo')) {
            $query->where('ativo', $request->ativo);
        }

        $produtos = $query
            ->orderBy('preco_venda', 'desc')
            ->get();

        $pdf = Pdf::loadView('relatorios.precos_pdf', compact('produtos'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('relatorio_precos.pdf');
    }
}
