<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h3>Relatório de Estoque</h3>

<table>
    <thead>
        <tr>
            <th>Produto</th>
            <th>Categoria</th>
            <th>Unidade</th>
            <th>Estoque</th>
            <th>Mínimo</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto)
            @php
                if ($produto->estoque == 0) {
                    $status = 'Sem estoque';
                } elseif ($produto->estoque <= $produto->estoque_minimo) {
                    $status = 'Estoque baixo';
                } else {
                    $status = 'OK';
                }
            @endphp
            <tr>
                <td>{{ $produto->descricao }}</td>
                <td>{{ $produto->categoria->descricao ?? '-' }}</td>
                <td>{{ $produto->unidade_medida }}</td>
                <td>{{ $produto->estoque }}</td>
                <td>{{ $produto->estoque_minimo }}</td>
                <td>{{ $status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
