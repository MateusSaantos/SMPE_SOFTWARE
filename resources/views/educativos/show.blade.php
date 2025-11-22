@extends('layouts.app')

@section('title', $item->titulo ?? 'Educativo')

@push('styles')
  <link href="{{ asset('css/base/variables.css') }}" rel="stylesheet">
  <link href="{{ asset('css/base/backgrounds.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pages/educativos_show.css') }}?v={{ filemtime(public_path('css/pages/educativos_show.css')) }}" rel="stylesheet">
  <link href="{{ asset('css/pages/categorias_create.css') }}" rel="stylesheet">

  {{-- Fallback mínimo para .btn--ghost --}}
  <style>
    .btn--ghost{
      background: transparent;
      border: 1px solid var(--line-soft, #e5e7eb);
      color: var(--text, #111827);
    }
    .btn--ghost:hover{
      background: var(--bg-soft, #f9fafb);
      text-decoration: none;
    }
  </style>
@endpush

@section('content')
<div class="container py-3 py-md-4">

  {{-- Cabeçalho da página --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-book-open page-head__icon"></i>
      <div>
        <h1 class="page-head__title">{{ $item->titulo }}</h1>
        <p class="page-head__subtitle">Material educativo completo.</p>
      </div>
    </div>

    {{-- Botão de ajuda --}}
    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="Como funciona esta tela?"
            data-bs-content="Aqui você pode ler o conteúdo educativo completo, acessar links úteis e marcar como visitado para controle do seu progresso."
            aria-label="Ajuda sobre leitura de educativo">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Balão fixo de dica --}}
  <div class="hint-bubble" id="hint-educativo-show" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Dica rápida</strong><br>
        Você está visualizando o conteúdo <em>{{ $item->titulo }}</em>. Use o botão abaixo para voltar à lista e, se quiser, marque este material como <em>visitado</em>.
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary hint-bubble__close" id="hint-close" style="display:none;">Entendi</button>
    </div>
    <span class="hint-bubble__arrow"></span>
  </div>

  {{-- Botões de ação --}}
  <div class="mt-3 mb-3 d-flex flex-wrap gap-2">
    <a class="btn btn-primary" href="{{ route('educativos.index') }}">
      <i class="fa-solid fa-arrow-left me-1"></i> Voltar às categorias
    </a>

    <form method="post" action="{{ route('educativos.toggleVisited', $item->id) }}">
      @csrf
      <button class="btn btn--soft" type="submit">
        {{ $item->visitado ? 'Desmarcar como visitado' : 'Marcar como visitado' }}
      </button>
    </form>
  </div>

  {{-- Conteúdo principal --}}
  <div class="card shadow-sm p-3 p-md-4 mb-4">
    <article class="content">
      {!! $item->conteudo !!}
    </article>
  </div>

  @php
    $links = is_array($item->links) ? $item->links : [];
    $linkReferencia = $links[0] ?? null;
    $linksUteis = array_slice($links, 1);
  @endphp

  {{-- Link de Referência --}}
  @if($linkReferencia)
    <aside class="card shadow-sm p-3 p-md-4 mb-4">
      <h3><i class="fa-solid fa-bookmark me-2"></i>Link de referência</h3>
      <a href="{{ $linkReferencia['url'] ?? '#' }}" target="_blank" rel="noopener">
        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>
        {{ $linkReferencia['titulo'] ?? ($linkReferencia['url'] ?? 'Link') }}
      </a>
    </aside>
  @endif

  {{-- Links úteis (apenas os demais links) --}}
  @if(count($linksUteis))
    <aside class="card shadow-sm p-3 p-md-4">
      <h3><i class="fa-solid fa-link me-2"></i>Links úteis</h3>
      <ul class="mt-2">
        @foreach($linksUteis as $l)
          <li>
            <a href="{{ $l['url'] ?? '#' }}" target="_blank" rel="noopener">
              <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>
              {{ $l['titulo'] ?? ($l['url'] ?? 'Link') }}
            </a>
          </li>
        @endforeach
      </ul>
    </aside>
  @endif

</div>
@endsection

@push('scripts')
<script>
  // Inicializa Popover
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });

  // Mostra o coachmark
  (function(){
    const bubble = document.getElementById('hint-educativo-show');
    bubble?.classList.remove('d-none');
  })();
</script>
@endpush
