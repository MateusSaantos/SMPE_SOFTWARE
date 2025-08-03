<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Endereco;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::with('endereco')->get();
        return view('empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cnpj' => 'required|unique:empresas',
            'razao_social' => 'required',
            'nome_fantasia' => 'required',
            'telefone' => 'required',
            'inscricao_estadual' => 'required',
            'data_abertura' => 'required|date',
            'porte' => 'required',
            'email' => 'required|email',
            'regime_tributario' => 'required',
            'cnae' => 'required',
            'optante_mei' => 'required|boolean',
            'status' => 'required|boolean',
            'cep' => 'required',
            'uf' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'numero' => 'required',
            'logradouro' => 'required',
            'complemento' => 'nullable',
        ]);

        $endereco = Endereco::create($request->only([
            'cep', 'uf', 'cidade', 'bairro', 'numero', 'logradouro', 'complemento'
        ]));

        $empresa = Empresa::create(array_merge(
            $request->only([
                'cnpj', 'razao_social', 'nome_fantasia', 'telefone', 'inscricao_estadual',
                'data_abertura', 'porte', 'email', 'regime_tributario', 'cnae', 'optante_mei', 'status'
            ]),
            ['endereco_id' => $endereco->id]
        ));

        // Redireciona para criação de login com o CNPJ já preenchido
        return redirect()->route('logins.create', ['cnpj' => $empresa->cnpj]);
    }

    public function edit($cnpj)
    {
        $empresa = Empresa::with('endereco')->findOrFail($cnpj);
        return view('empresas.edit', compact('empresa'));
    }

    public function update(Request $request, $cnpj)
    {
        $empresa = Empresa::findOrFail($cnpj);

        $data = $request->validate([
            'razao_social' => 'required',
            'nome_fantasia' => 'required',
            'telefone' => 'required',
            'inscricao_estadual' => 'required',
            'data_abertura' => 'required|date',
            'porte' => 'required',
            'email' => 'required|email',
            'regime_tributario' => 'required',
            'cnae' => 'required',
            'optante_mei' => 'required|boolean',
            'status' => 'required|boolean',
            'cep' => 'required',
            'uf' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'numero' => 'required',
            'logradouro' => 'required',
            'complemento' => 'nullable',
        ]);

        $empresa->update($request->only([
            'razao_social', 'nome_fantasia', 'telefone', 'inscricao_estadual',
            'data_abertura', 'porte', 'email', 'regime_tributario', 'cnae', 'optante_mei', 'status'
        ]));

        $empresa->endereco->update($request->only([
            'cep', 'uf', 'cidade', 'bairro', 'numero', 'logradouro', 'complemento'
        ]));

        return redirect()->route('empresas.index')->with('success', 'Empresa atualizada com sucesso.');
    }

    public function destroy($cnpj)
    {
        $empresa = Empresa::findOrFail($cnpj);
        $empresa->delete();
        return redirect()->route('empresas.index')->with('success', 'Empresa excluída.');
    }
}
