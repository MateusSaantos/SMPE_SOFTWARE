@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Relatório de Preços</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Custo</th>
                <th>Venda</th>
                <th>Diferença</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{ $produto->descricao }}</td>
                    <td>R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                    <td>
                        R$ {{ number_format($produto->preco_venda - $produto->preco_custo, 2, ',', '.') }}
                    </td>
                    <td>{{ $produto->ativo ? 'Ativo' : 'Inativo' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
