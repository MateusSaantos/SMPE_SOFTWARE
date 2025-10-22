<?php

namespace App\Http\Controllers;

use App\Models\Educativo;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class EducativosController extends Controller
{
    /**
     * Tela 1 — Index de categorias (retângulos)
     */
    public function index(Request $request)
    {
        // Carrega itens visíveis/publicados só com os campos necessários
        $all = Educativo::query()
            ->where('status', 'publicado')
            ->where('visivel', true)
            ->select(['id', 'titulo', 'slug', 'descricao', 'categorias', 'visitado'])
            ->get();

        // Monta bucket de categorias => [slug => [name, slug, count]]
        $bucket = [];
        foreach ($all as $e) {
            $cats = method_exists($e, 'categoriasArray') ? $e->categoriasArray() : $this->splitCats($e->categorias);
            foreach ($cats as $c) {
                $key = Str::slug($c);
                if (!isset($bucket[$key])) {
                    $bucket[$key] = ['name' => $c, 'slug' => $key, 'count' => 0];
                }
                $bucket[$key]['count']++;
            }
        }

        // Ordena alfabeticamente e envia para a view
        $categorias = collect($bucket)
            ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
            ->values();

        return view('educativos.categories_index', [
            'categorias' => $categorias,
        ]);
    }

    /**
     * Tela 2 — Listagem dos itens de uma categoria (cards)
     */
    public function categoryList(Request $request, string $catSlug)
    {
        $perPage = (int) $request->get('per_page', 12);
        if (!in_array($perPage, [6, 12, 15, 24, 30], true)) {
            $perPage = 12;
        }

        // Carrega todos os visíveis/publicados (campos necessários)
        $all = Educativo::query()
            ->where('status', 'publicado')
            ->where('visivel', true)
            ->select(['id', 'titulo', 'slug', 'descricao', 'categorias', 'visitado'])
            ->latest('id')
            ->get();

        // Filtra por categoria (comparando o slug da categoria)
        $catName = null;
        $filtered = $all->filter(function ($e) use ($catSlug, &$catName) {
            $cats = method_exists($e, 'categoriasArray') ? $e->categoriasArray() : $this->splitCats($e->categorias);
            foreach ($cats as $c) {
                if (Str::slug($c) === $catSlug) {
                    $catName = $catName ?: $c;
                    return true;
                }
            }
            return false;
        });

        // Paginação manual
        $page = (int) $request->get('page', 1);
        $items = $filtered->forPage($page, $perPage)->values();
        $paginator = new LengthAwarePaginator(
            $items,
            $filtered->count(),
            $perPage,
            $page,
            ['path' => route('educativos.category', $catSlug)]
        );

        return view('educativos.category_list', [
            'catSlug' => $catSlug,
            'catName' => $catName ?? ucwords(str_replace('-', ' ', $catSlug)),
            'items'   => $paginator,
        ]);
    }

    /**
     * Tela 3 — Página do conteúdo (mantida)
     */
    public function show(string $slug)
    {
        $item = Educativo::where('slug', $slug)->firstOrFail();
        abort_unless($item->status === 'publicado' && $item->visivel, 404);

        return view('educativos.show', ['item' => $item]);
    }

    /**
     * Marca/desmarca visitado (mantida)
     */
    public function toggleVisited(int $id)
    {
        $item = Educativo::findOrFail($id);
        $item->visitado = !$item->visitado;
        $item->save();

        return back()->with('ok', 'Status de visitado atualizado.');
    }

    /**
     * Helper para dividir categorias quando não houver categoriasArray() no Model.
     * Aceita CSV simples (ex.: "ICMS, NCM, Preços").
     */
    private function splitCats($raw): array
    {
        if (is_array($raw)) return $raw;
        if (blank($raw)) return [];

        // Se vier JSON válido, decodifica (opcional; comente se não usa JSON)
        if (is_string($raw) && str_starts_with(trim($raw), '[')) {
            $decoded = json_decode($raw, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return collect($decoded)->map(fn ($s) => trim((string) $s))->filter()->values()->all();
            }
        }

        // Padrão CSV
        return collect(explode(',', (string) $raw))
            ->map(fn ($s) => trim($s))
            ->filter()
            ->values()
            ->all();
    }
}
