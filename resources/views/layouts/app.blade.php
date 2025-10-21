<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>@yield('title','SMPE Software')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Bootstrap + ícones (CDN) --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  {{-- Base (tokens + utilitários + backgrounds) --}}
  <link href="{{ asset('css/base/variables.css') }}" rel="stylesheet">
  <link href="{{ asset('css/base/utilities.css') }}" rel="stylesheet">
  <link href="{{ asset('css/base/backgrounds.css') }}" rel="stylesheet">

  @if (session()->has('usuario'))
    {{-- Componentes compartilhados quando autenticado --}}
    <link href="{{ asset('css/components/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components/menu.css') }}" rel="stylesheet">
  @endif

  {{-- Estilos específicos de cada página --}}
  @stack('styles')

  {{-- Slot opcional para <head> extra de páginas --}}
  @yield('head')
</head>

<body class="{{ session()->has('usuario') ? 'app-authenticated' : 'app-public' }}">
  @if (session()->has('usuario'))
    {{-- Header fixo --}}
    @include('components.header')

    {{-- Espaço para compensar o header fixo (altura definida no CSS do header) --}}
    <div class="header-spacer"></div>

    <div class="d-flex">
      {{-- Menu lateral fixo --}}
      @include('components.menu')

      {{-- Área principal --}}
      <main id="app-main" class="app-main">
        {{-- Compatibilidade: aceita @section('conteudo') ou @section('content') --}}
        @hasSection('conteudo')
          @yield('conteudo')
        @else
          @yield('content')
        @endif
      </main>
    </div>
  @else
    {{-- Layout público (ex.: login) --}}
    <main class="container py-4">
      @hasSection('conteudo')
        @yield('conteudo')
      @else
        @yield('content')
      @endif
    </main>
  @endif

  {{-- JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  @if (session()->has('usuario'))
    <script src="{{ asset('js/menu.js') }}" defer></script>
  @endif

  {{-- Scripts específicos de cada página --}}
  @stack('scripts')
</body>
</html>
