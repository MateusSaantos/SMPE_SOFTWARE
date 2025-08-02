@extends('layout')

@section('conteudo')
<h1>Nova Empresa</h1>
<form method="POST" action="{{ route('empresas.store') }}">
    @csrf
    @include('empresas.form')
    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection
