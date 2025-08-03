@extends('layout')

@section('conteudo')
<h2>Bem-vindo ao Painel</h2>
<a href="{{ route('logout') }}" class="btn btn-danger">Sair</a>
@endsection
