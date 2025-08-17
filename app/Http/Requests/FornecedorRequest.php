<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT','PATCH']);

        return [
            'cnpj' => [
                $isUpdate ? 'sometimes' : 'required',
                'string','regex:/^\d{14}$/','size:14',
                $isUpdate ? '' : 'unique:fornecedores,cnpj',
            ],
            'razao_social'       => ['required','string','max:160'],
            'nome_fantasia'      => ['nullable','string','max:160'],
            'inscricao_estadual' => ['nullable','string','max:30'],
            'telefone'           => ['nullable','string','max:20'],

            // Endereço embutido
            'cep'         => ['required','string','max:9'],
            'uf'          => ['required','string','size:2'],
            'cidade'      => ['required','string','max:120'],
            'bairro'      => ['required','string','max:120'],
            'logradouro'  => ['required','string','max:160'],
            'numero'      => ['required','string','max:20'],
            'complemento' => ['nullable','string','max:160'],
        ];
    }

    public function messages(): array
    {
        return [
            'cnpj.required' => 'Informe o CNPJ.',
            'cnpj.regex'    => 'O CNPJ deve conter apenas números.',
            'cnpj.size'     => 'O CNPJ deve conter 14 dígitos.',
            'cnpj.unique'   => 'Já existe um fornecedor com este CNPJ.',
            'razao_social.required' => 'Informe a razão social.',
            'cep.required'  => 'Informe o CEP.',
            'uf.required'   => 'Informe a UF.',
            'cidade.required'=> 'Informe a cidade.',
            'bairro.required'=> 'Informe o bairro.',
            'logradouro.required'=> 'Informe o logradouro.',
            'numero.required'=> 'Informe o número.',
        ];
    }
}
