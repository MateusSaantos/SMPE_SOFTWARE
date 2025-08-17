{{-- resources/views/fornecedores/show.blade.php --}}
@extends('layout')

@section('conteudo')
<div class="container py-3 py-md-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0"><i class="fa-regular fa-eye"></i> Detalhes do Fornecedor</h1>
    <div>
      <a class="btn btn-outline-primary" href="{{ route('fornecedores.edit', $fornecedor->cnpj) }}"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
      <a class="btn btn-light" href="{{ route('fornecedores.index') }}">Voltar</a>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-3"><strong>CNPJ:</strong><br>{{ $fornecedor->cnpj }}</div>
        <div class="col-md-5"><strong>Razão Social:</strong><br>{{ $fornecedor->razao_social }}</div>
        <div class="col-md-4"><strong>Nome Fantasia:</strong><br>{{ $fornecedor->nome_fantasia }}</div>
        <div class="col-md-4"><strong>Inscrição Estadual:</strong><br>{{ $fornecedor->inscricao_estadual }}</div>
        <div class="col-md-4"><strong>Telefone:</strong><br>{{ $fornecedor->telefone }}</div>
        <div class="col-md-12"><strong>Endereço:</strong><br>
          @if($fornecedor->endereco)
            {{ $fornecedor->endereco->logradouro }}, {{ $fornecedor->endereco->numero }}
            - {{ $fornecedor->endereco->bairro }} - {{ $fornecedor->endereco->cidade }}/{{ $fornecedor->endereco->uf }}
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
