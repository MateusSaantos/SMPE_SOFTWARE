<?php

namespace App\Http\Controllers;

use App\Models\Empresa; // Modelo que representa a tabela 'empresas'
use App\Models\Endereco; // Modelo que representa a tabela 'enderecos'
use Illuminate\Http\Request; // Classe que gerencia requisições HTTP

class EmpresaController extends Controller
{
    /**
     * Lista todas as empresas com seus endereços relacionados.
     */
    public function index()
    {
        // Busca todas as empresas já carregando o relacionamento 'endereco'
        $empresas = Empresa::with('endereco')->get();

        // Retorna a view 'empresas.index' passando os dados
        return view('empresas.index', compact('empresas'));
    }

    /**
     * Exibe o formulário para criar uma nova empresa.
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Salva uma nova empresa e seu endereço no banco.
     */
    public function store(Request $request)
    {
        // Validação dos campos recebidos na requisição
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

        // Cria o endereço associado usando apenas os campos de endereço
        $endereco = Endereco::create($request->only([
            'cep', 'uf', 'cidade', 'bairro', 'numero', 'logradouro', 'complemento'
        ]));

        // Cria a empresa vinculando ao endereço recém-criado
        $empresa = Empresa::create(array_merge(
            $request->only([
                'cnpj', 'razao_social', 'nome_fantasia', 'telefone', 'inscricao_estadual',
                'data_abertura', 'porte', 'email', 'regime_tributario', 'cnae', 'optante_mei', 'status'
            ]),
            ['endereco_id' => $endereco->id] // FK do endereço
        ));

        // Redireciona para a tela de criação de login com o CNPJ preenchido
        return redirect()->route('logins.create', ['cnpj' => $empresa->cnpj]);
    }

    /**
     * Exibe o formulário para editar uma empresa pelo CNPJ.
     */
    public function edit($cnpj)
    {
        // Busca a empresa pelo CNPJ, carregando também o endereço
        $empresa = Empresa::with('endereco')->findOrFail($cnpj);

        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Atualiza os dados da empresa e do endereço no banco.
     */
    public function update(Request $request, $cnpj)
    {
        // Busca a empresa pelo CNPJ
        $empresa = Empresa::findOrFail($cnpj);

        // Valida os campos recebidos
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

        // Atualiza os dados da empresa
        $empresa->update($request->only([
            'razao_social', 'nome_fantasia', 'telefone', 'inscricao_estadual',
            'data_abertura', 'porte', 'email', 'regime_tributario', 'cnae', 'optante_mei', 'status'
        ]));

        // Atualiza os dados do endereço relacionado
        $empresa->endereco->update($request->only([
            'cep', 'uf', 'cidade', 'bairro', 'numero', 'logradouro', 'complemento'
        ]));

        return redirect()->route('empresas.index')->with('success', 'Empresa atualizada com sucesso.');
    }

    /**
     * Remove a empresa do banco (soft delete ou hard delete dependendo do modelo).
     */
    public function destroy($cnpj)
    {
        $empresa = Empresa::findOrFail($cnpj);

        $empresa->delete();

        return redirect()->route('empresas.index')->with('success', 'Empresa excluída.');
    }
}
