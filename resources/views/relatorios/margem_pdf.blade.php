<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Margem</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        p {
            text-align: center;
            font-size: 11px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

<h1>Relatório de Margem</h1>
<p>Gerado em {{ now()->format('d/m/Y H:i') }}</p>

<table>
    <thead>
        <tr>
            <th>Produto</th>
            <th>Categoria</th>
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
                <td>{{ $produto->categoria->descricao ?? '-' }}</td>
                <td class="text-right">
                    R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}
                </td>
                <td class="text-right">
                    R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
                </td>
                <td class="text-right">
                    R$ {{ number_format($lucro, 2, ',', '.') }}
                </td>
                <td class="text-right">
                    {{ number_format($margem, 2, ',', '.') }}%
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
