@extends('layout')

@section('conteudo')
<h2>Login</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first('erro') }}
    </div>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf
    <input type="text" name="cnpj" class="form-control mb-2" placeholder="CNPJ" required>
    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
    <input type="password" name="senha" class="form-control mb-2" placeholder="Senha" required>
    <button type="submit" class="btn btn-primary">Entrar</button>
</form>

<div class="mt-3">
    <a href="{{ route('empresas.create') }}" class="btn btn-outline-secondary">Criar Conta</a>
</div>
@endsection
