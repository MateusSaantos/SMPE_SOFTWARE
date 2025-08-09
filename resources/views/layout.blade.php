<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SMPE Software</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS do menu lateral -->
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
    <!-- CSS login -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    @if (session()->has('usuario'))
        <!-- Menu horizontal superior -->
        @include('components.header')

        <div class="d-flex">
            <!-- Menu lateral fixo -->
            @include('components.menu')

            <!-- Conteúdo principal -->
            <div class="container-fluid p-4 main-content">
                @yield('conteudo')
            </div>
        </div>
    @else
        <!-- Tela sem menus (ex: login) -->
        <div class="container mt-5">
            @yield('conteudo')
        </div>
    @endif

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
</body>
</html>
