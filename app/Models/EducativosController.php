<?php

namespace App\Http\Controllers;

use App\Models\Educativo;
use Illuminate\Http\Request;

class EducativosController extends Controller
{
    // Listagem + filtro simples
    public function index(Request $request)
    {
        $q = trim((string)$request->get('q', ''));
        $cat = trim((string)$request->get('categoria',''));

        $items = Educativo::query()
            ->where('status','publicado')
            ->where('visivel', true)
            ->when($q !== '', function($qq) use ($q) {
                $qq->where(function($w) use ($q) {
                    $w->where('titulo','like',"%{$q}%")
                      ->orWhere('descricao','like',"%{$q}%")
                      ->orWhere('conteudo','like',"%{$q}%");
                });
            })
            ->when($cat !== '', function($qq) use ($cat) {
                $qq->where('categorias','like',"%{$cat}%");
            })
            ->orderBy('ordem')
            ->orderByDesc('id')
            ->paginate((int)request('per_page', 12))
            ->withQueryString();

        // gera lista de categorias (a partir dos próprios registros)
        $todasCategorias = Educativo::query()
            ->where('status','publicado')->where('visivel',true)
            ->pluck('categorias')->filter()->flatMap(function($csv){
                return array_map('trim', explode(',', $csv));
            })->filter()->unique()->sort()->values()->all();

        return view('educativos.index', [
            'items' => $items,
            'todasCategorias' => $todasCategorias,
            'q' => $q,
            'categoria' => $cat,
        ]);
    }

    // Página do conteúdo
    public function show(string $slug)
    {
        $item = Educativo::where('slug',$slug)->firstOrFail();
        abort_unless($item->status === 'publicado' && $item->visivel, 404);

        return view('educativos.show', ['item' => $item]);
    }

    // Marca/desmarca visitado (global)
    public function toggleVisited(int $id)
    {
        $item = Educativo::findOrFail($id);
        $item->visitado = !$item->visitado;
        $item->save();

        return back()->with('ok', 'Status de visitado atualizado.');
    }
}
