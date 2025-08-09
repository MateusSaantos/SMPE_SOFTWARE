@extends('layout')

@section('conteudo')

<!-- Importa o CSS separado -->
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="">

    <!-- Botões no topo direito -->
    <div class="top-buttons">
        <a href="#">Site da Empresa</a>
        <a href="#">Painel do Contador</a>
        <a href="#">Portal do Cliente</a>
    </div>

    <!-- Corpo principal -->
    <div class="fullscreen-box">
        <div class="login-box">

            <!-- Lado esquerdo: formulário -->
            <div class="login-form">
                <h2>SeuSistema | Gestão</h2>
                <p class="text-muted text-center mb-4">Entre com a sua conta</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first('erro') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text" id="cnpj" name="cnpj" class="form-control" placeholder="Digite seu CNPJ" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="exemplo@email.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('empresas.create') }}" class="btn btn-outline-secondary w-100">Criar Conta</a>
                </div>
            </div>

            <!-- Lado direito: mensagem -->
            <div class="login-message">
                <h2 class="fw-bold">Bem-vindo!</h2>
                <p class="fs-4">Mais um dia incrível <br>para as suas vendas! :)</p>
            </div>

        </div>
    </div>
</div>
@endsection
