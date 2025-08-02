@extends('layout')

@section('conteudo')
<h1>Editar Empresa</h1>
<form method="POST" action="{{ route('empresas.update', $empresa->cnpj) }}">
    @csrf
    @method('PUT')
    @include('empresas.form', ['empresa' => $empresa])
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
@endsection
