@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Relatório de Margem</h1>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Custo</th>
                <th>Venda</th>
                <th>Lucro</th>
                <th>Margem (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
                @php
                    $lucro = $produto->preco_venda - $produto->preco_custo;
                    $margem = $produto->preco_venda > 0
                        ? ($lucro / $produto->preco_venda) * 100
                        : 0;
                @endphp
                <tr>
                    <td>{{ $produto->descricao }}</td>
                    <td>R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($lucro, 2, ',', '.') }}</td>
                    <td>{{ number_format($margem, 2, ',', '.') }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
