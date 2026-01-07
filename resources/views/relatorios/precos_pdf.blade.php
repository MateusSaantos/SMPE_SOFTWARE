<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Preços</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #f2f2f2; }
        .negativo { color: #b30000; font-weight: bold; }
        .positivo { color: #006600; font-weight: bold; }
    </style>
</head>
<body>

<h1>Relatório de Preços</h1>

<table>
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
            @php
                $dif = $produto->preco_venda - $produto->preco_custo;
            @endphp
            <tr>
                <td>{{ $produto->descricao }}</td>
                <td>R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                <td class="{{ $dif < 0 ? 'negativo' : 'positivo' }}">
                    R$ {{ number_format($dif, 2, ',', '.') }}
                </td>
                <td>{{ $produto->ativo ? 'Ativo' : 'Inativo' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
