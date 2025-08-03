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

    <div class="mb-2">
        <label for="cnpj">CNPJ</label>
        <input type="text" id="cnpj" name="cnpj" class="form-control" placeholder="CNPJ" required>
    </div>

    <div class="mb-2">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
    </div>

    <div class="mb-2">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
    </div>

    <button type="submit" class="btn btn-primary">Entrar</button>
    
</form>

<div class="mt-3">
    <a href="{{ route('empresas.create') }}" class="btn btn-outline-secondary">Criar Conta</a>
</div>
@endsection
