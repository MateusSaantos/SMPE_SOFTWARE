<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SMPE Software</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap + ícones (CDN) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Base (tokens + utilitários) --}}
    <link href="{{ asset('css/base/variables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base/utilities.css') }}" rel="stylesheet">

    {{-- CSS de fundo global --}}
    <link href="{{ asset('css/base/backgrounds.css') }}" rel="stylesheet">

    @if (session()->has('usuario'))
        {{-- Componentes compartilhados (somente quando autenticado) --}}
        <link href="{{ asset('css/components/header.css') }}" rel="stylesheet">
        <link href="{{ asset('css/components/menu.css') }}" rel="stylesheet">
    @endif

    {{-- CSS específico de página --}}
    @stack('styles')
</head>

<body class="{{ session()->has('usuario') ? 'app-authenticated' : 'app-public' }}">
    @if (session()->has('usuario'))
        {{-- Header fixo --}}
        @include('components.header')

        {{-- Espaço para compensar o header fixo (altura controlada no CSS) --}}
        <div class="header-spacer"></div>

        <div class="d-flex">
            {{-- Menu lateral fixo --}}
            @include('components.menu')

            {{-- Conteúdo principal --}}
            <main id="app-main" class="app-main">
                @yield('conteudo')
            </main>

        </div>
    @else
        {{-- Tela pública (ex.: login) --}}
        <main class="container mt-5">
            @yield('conteudo')
        </main>
    @endif

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @if (session()->has('usuario'))
        <script src="{{ asset('js/menu.js') }}" defer></script>
    @endif

    @stack('scripts')
</body>
</html>
