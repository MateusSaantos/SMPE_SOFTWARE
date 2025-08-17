<?php

namespace App\Http\Controllers;

use App\Http\Requests\FornecedorRequest;
use App\Models\Fornecedor;
use App\Models\Endereco;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string)$request->get('q'));
        $fornecedores = Fornecedor::with('endereco')
            ->when($q, fn($query) => $query->where(function($w) use ($q) {
                $w->where('cnpj','like',"%$q%")
                  ->orWhere('razao_social','like',"%$q%")
                  ->orWhere('nome_fantasia','like',"%$q%");
            }))
            ->orderBy('razao_social')
            ->paginate(15)
            ->withQueryString();

        return view('fornecedores.index', compact('fornecedores','q'));
    }

    public function create()
    {
        return view('fornecedores.create'); // sem lista de endereços
    }

    public function store(FornecedorRequest $request)
    {
        $data = $request->validated();

        // 1) Cria endereço
        $endereco = Endereco::create([
            'cep' => $data['cep'],
            'uf' => strtoupper($data['uf']),
            'cidade' => $data['cidade'],
            'bairro' => $data['bairro'],
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'] ?? null,
        ]);

        // 2) Cria fornecedor linkando endereço
        Fornecedor::create([
            'cnpj' => $data['cnpj'],
            'razao_social' => $data['razao_social'],
            'nome_fantasia' => $data['nome_fantasia'] ?? null,
            'inscricao_estadual' => $data['inscricao_estadual'] ?? null,
            'telefone' => $data['telefone'] ?? null,
            'endereco_id' => $endereco->id,
        ]);

        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor cadastrado com sucesso.');
    }

    public function show(Fornecedor $fornecedore)
    {
        $fornecedor = $fornecedore->load('endereco');
        return view('fornecedores.show', compact('fornecedor'));
    }

    public function edit(Fornecedor $fornecedore)
    {
        $fornecedor = $fornecedore->load('endereco');
        return view('fornecedores.edit', compact('fornecedor'));
    }

    public function update(FornecedorRequest $request, Fornecedor $fornecedore)
    {
        $data = $request->validated();

        // Atualiza dados básicos (CNPJ é PK: não mudamos)
        $fornecedore->update([
            'razao_social' => $data['razao_social'],
            'nome_fantasia' => $data['nome_fantasia'] ?? null,
            'inscricao_estadual' => $data['inscricao_estadual'] ?? null,
            'telefone' => $data['telefone'] ?? null,
        ]);

        // Atualiza endereço existente
        $fornecedore->endereco->update([
            'cep' => $data['cep'],
            'uf' => strtoupper($data['uf']),
            'cidade' => $data['cidade'],
            'bairro' => $data['bairro'],
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'] ?? null,
        ]);

        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor atualizado com sucesso.');
    }

    public function destroy(Fornecedor $fornecedore)
    {
        // Se quiser preservar endereço compartilhado, remova a linha abaixo.
        // Caso cada fornecedor tenha seu próprio endereço, você pode deletá-lo junto:
        // $fornecedore->endereco?->delete();

        $fornecedore->delete();
        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor removido com sucesso.');
    }
}
