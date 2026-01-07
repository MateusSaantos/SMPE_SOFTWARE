<?php

namespace App\Http\Controllers;

use App\Models\Produto;

class RelatorioPrecoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')
            ->select(
                'id',
                'descricao',
                'categoria_produto',
                'preco_custo',
                'preco_venda',
                'ativo'
            )
            ->orderBy('preco_venda', 'desc')
            ->get();

        return view('relatorios.precos', compact('produtos'));
    }
}
