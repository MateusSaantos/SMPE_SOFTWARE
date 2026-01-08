<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Ncm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q', ''));
        $perPage = (int) $request->get('per_page', 10);
        if (!in_array($perPage, [10,25,50,100])) $perPage = 10;

        $produtos = Produto::query()
            ->with(['categoria', 'ncmItem'])
            ->when($q !== '', function ($query) use ($q) {
                $digits = preg_replace('/\D+/', '', $q);
                $query->where(function($qq) use ($q, $digits) {
                    $qq->where('descricao', 'like', "%{$q}%");
                    if ($digits !== '') {
                        $qq->orWhere('codigo_barras', 'like', "%{$digits}%");
                        $qq->orWhere('cest', 'like', "%{$digits}%");
                    }
                });
            })
            ->orderBy('descricao')
            ->paginate($perPage);

        return view('produtos.index', [
            'produtos' => $produtos,
            'q' => $q,
        ]);
    }

    public function create()
    {
        $categorias = Categoria::orderBy('descricao')->get(['id','descricao']);
        $ncms = Ncm::orderBy('codigo')->get(['id','codigo','descricao']);

        return view('produtos.create', compact('categorias', 'ncms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'descricao'         => 'required|string|max:255',
            'codigo_barras'     => 'nullable|regex:/^\d{8,14}$/|unique:produtos,codigo_barras',
            'categoria_produto' => 'required|exists:categorias,id',
            'margem_lucro'      => 'nullable|numeric|min:0|max:999.99',
            'cest'              => 'nullable|regex:/^\d{7}$/',
            'ncm'               => 'required|exists:ncms,id',
            'unidade_medida'    => 'required|string|max:10',
            'preco_custo'       => 'required|numeric|min:0|max:9999999999.99',
            'preco_venda'       => 'required|numeric|min:0|max:9999999999.99',
            'estoque'           => 'required|integer|min:0',
            'icms'              => 'nullable|numeric|min:0|max:999.99',
            'pis'               => 'nullable|numeric|min:0|max:999.99',
            'cofins'            => 'nullable|numeric|min:0|max:999.99',
            'ativo'             => 'nullable|boolean',

            // novos campos
            'origem_mercadoria' => 'required|integer|between:0,8',
            'aliquota_ipi'      => 'nullable|numeric|min:0|max:100',
            'ipi_enquadramento' => 'nullable|regex:/^\d{1,3}$/',
            'estoque_minimo'    => 'nullable|integer|min:0',

            // imagem
            'imagem'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['ativo'] = (bool) $request->boolean('ativo');

        // upload da imagem
        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')
                ->store('produtos', 'public');
        }

        Produto::create($data);

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto criado com sucesso.');
    }

    public function show(Produto $produto)
    {
        $produto->load(['categoria', 'ncmItem']);
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::orderBy('descricao')->get(['id','descricao']);
        $ncms = Ncm::orderBy('codigo')->get(['id','codigo','descricao']);

        $produto->load(['categoria', 'ncmItem']);

        return view('produtos.edit', compact('produto', 'categorias', 'ncms'));
    }

    public function update(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'descricao'         => 'required|string|max:255',
            'codigo_barras'     => 'nullable|regex:/^\d{8,14}$/|unique:produtos,codigo_barras,' . $produto->id,
            'categoria_produto' => 'required|exists:categorias,id',
            'margem_lucro'      => 'nullable|numeric|min:0|max:999.99',
            'cest'              => 'nullable|regex:/^\d{7}$/',
            'ncm'               => 'required|exists:ncms,id',
            'unidade_medida'    => 'required|string|max:10',
            'preco_custo'       => 'required|numeric|min:0|max:9999999999.99',
            'preco_venda'       => 'required|numeric|min:0|max:9999999999.99',
            'estoque'           => 'required|integer|min:0',
            'icms'              => 'nullable|numeric|min:0|max:999.99',
            'pis'               => 'nullable|numeric|min:0|max:999.99',
            'cofins'            => 'nullable|numeric|min:0|max:999.99',
            'ativo'             => 'nullable|boolean',

            // novos campos
            'origem_mercadoria' => 'required|integer|between:0,8',
            'aliquota_ipi'      => 'nullable|numeric|min:0|max:100',
            'ipi_enquadramento' => 'nullable|regex:/^\d{1,3}$/',
            'estoque_minimo'    => 'nullable|integer|min:0',

            // imagem
            'imagem'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['ativo'] = (bool) $request->boolean('ativo');

        // troca da imagem
        if ($request->hasFile('imagem')) {
            if ($produto->imagem) {
                Storage::disk('public')->delete($produto->imagem);
            }

            $data['imagem'] = $request->file('imagem')
                ->store('produtos', 'public');
        }

        $produto->update($data);

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto)
    {
        if ($produto->imagem) {
            Storage::disk('public')->delete($produto->imagem);
        }

        $produto->delete();

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto removido.');
    }
}
