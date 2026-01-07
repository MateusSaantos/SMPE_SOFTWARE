<?php

namespace App\Http\Controllers;

use App\Models\Produto;

class RelatorioMargemController extends Controller
{
    public function index()
    {
        $produtos = Produto::where('ativo', true)->get();

        return view('relatorios.margem', compact('produtos'));
    }
}
