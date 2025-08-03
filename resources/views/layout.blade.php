<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SMPE Software</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- CSS do menu -->
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        @include('components.menu')

        <div class="container-fluid p-4" style="margin-left: 250px;">
            @yield('conteudo')
        </div>
    </div>

    <script src="{{ asset('js/menu.js') }}"></script>
    
</body>
</html>
