<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioEstoqueController extends Controller
{
    public function index(Request $request)
    {
        $query = Produto::with('categoria')
            ->select(
                'id',
                'descricao',
                'categoria_produto',
                'unidade_medida',
                'estoque',
                'estoque_minimo'
            );

        // 🔹 filtro por produto (descrição)
        if ($request->filled('produto')) {
            $query->where('descricao', 'like', '%' . $request->produto . '%');
        }

        // 🔹 filtro por categoria
        if ($request->filled('categoria')) {
            $query->where('categoria_produto', $request->categoria);
        }

        // 🔹 filtro estoque baixo
        if ($request->filled('estoque_baixo')) {
            $query->whereColumn('estoque', '<=', 'estoque_minimo');
        }

        $produtos = $query
            ->orderBy('descricao')
            ->get();

        // 🔹 categorias para o select do filtro
        $categorias = Categoria::orderBy('descricao')->get();

        return view('relatorios.estoque', compact('produtos', 'categorias'));
    }

    /**
     * Gera o PDF do relatório (abre em nova aba)
     */
    public function pdf(Request $request)
    {
        $query = Produto::with('categoria')
            ->select(
                'id',
                'descricao',
                'categoria_produto',
                'unidade_medida',
                'estoque',
                'estoque_minimo'
            );

        // 🔹 mesmos filtros do index
        if ($request->filled('produto')) {
            $query->where('descricao', 'like', '%' . $request->produto . '%');
        }

        if ($request->filled('categoria')) {
            $query->where('categoria_produto', $request->categoria);
        }

        if ($request->filled('estoque_baixo')) {
            $query->whereColumn('estoque', '<=', 'estoque_minimo');
        }

        $produtos = $query
            ->orderBy('descricao')
            ->get();

        $pdf = Pdf::loadView('relatorios.estoque_pdf', compact('produtos'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('relatorio_estoque.pdf');
    }
}
