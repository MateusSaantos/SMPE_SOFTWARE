@extends('layout')

@section('conteudo')
<h1>Empresas</h1>

<a href="{{ route('empresas.create') }}" class="btn btn-primary mb-3">Nova Empresa</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>CNPJ</th>
            <th>Razão Social</th>
            <th>Email</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empresas as $empresa)
        <tr>
            <td>{{ $empresa->cnpj }}</td>
            <td>{{ $empresa->razao_social }}</td>
            <td>{{ $empresa->email }}</td>
            <td>{{ $empresa->status ? 'Ativa' : 'Inativa' }}</td>
            <td>
                <a href="{{ route('empresas.edit', $empresa->cnpj) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('empresas.destroy', $empresa->cnpj) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Confirmar exclusão?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
