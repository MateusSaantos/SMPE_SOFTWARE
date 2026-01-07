<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioMargemController extends Controller
{
    public function index(Request $request)
    {
        $query = Produto::with('categoria')
            ->select(
                'id',
                'descricao',
                'categoria_produto',
                'preco_custo',
                'preco_venda'
            );

        // 🔹 filtro por produto
        if ($request->filled('produto')) {
            $query->where('descricao', 'like', '%' . $request->produto . '%');
        }

        // 🔹 filtro por categoria
        if ($request->filled('categoria')) {
            $query->where('categoria_produto', $request->categoria);
        }

        // 🔹 filtro por margem mínima
        if ($request->filled('margem_min')) {
            $query->whereRaw(
                '(preco_venda - preco_custo) / NULLIF(preco_venda,0) * 100 >= ?',
                [$request->margem_min]
            );
        }

        $produtos = $query
            ->orderBy('descricao')
            ->get();

        $categorias = Categoria::orderBy('descricao')->get();

        return view('relatorios.margem', compact('produtos', 'categorias'));
    }

    public function pdf(Request $request)
    {
        $query = Produto::with('categoria')
            ->select(
                'id',
                'descricao',
                'categoria_produto',
                'preco_custo',
                'preco_venda'
            );

        if ($request->filled('produto')) {
            $query->where('descricao', 'like', '%' . $request->produto . '%');
        }

        if ($request->filled('categoria')) {
            $query->where('categoria_produto', $request->categoria);
        }

        if ($request->filled('margem_min')) {
            $query->whereRaw(
                '(preco_venda - preco_custo) / NULLIF(preco_venda,0) * 100 >= ?',
                [$request->margem_min]
            );
        }

        $produtos = $query
            ->orderBy('descricao')
            ->get();

        $pdf = Pdf::loadView('relatorios.margem_pdf', compact('produtos'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('relatorio_margem.pdf');
    }
}
