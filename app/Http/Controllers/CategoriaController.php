<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q', ''));
        $perPage = (int) $request->get('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $categorias = Categoria::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('descricao', 'like', "%{$q}%");
            })
            ->orderBy('descricao')
            ->paginate($perPage);

        return view('categorias.index', [
            'categorias' => $categorias,
            'q' => $q,
        ]);
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'descricao'  => 'required|string|max:255',
            'observacao' => 'nullable|string',
        ]);

        Categoria::create($data);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria criada com sucesso.');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'descricao'  => 'required|string|max:255',
            'observacao' => 'nullable|string',
        ]);

        $categoria->update($data);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria removida.');
    }
}
