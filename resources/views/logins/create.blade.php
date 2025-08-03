@extends('layout')

@section('conteudo')
<h2>Criar Conta de Acesso</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('logins.store') }}" method="POST">
    @csrf
    <label for="cnpj">CNPJ</label>
    <input type="text" name="cnpj" id="cnpj" class="form-control mb-2" value="{{ old('cnpj', $cnpj) }}" readonly>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control mb-2" placeholder="Email" value="{{ old('email') }}" required>

    <label for="senha">Senha</label>
    <input type="password" name="senha" id="senha" class="form-control mb-2" placeholder="Senha" required>

    <button type="submit" class="btn btn-success">Criar Login</button>
</form>
@endsection
