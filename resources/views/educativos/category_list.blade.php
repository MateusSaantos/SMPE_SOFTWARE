@extends('layouts.app')

@section('title', "Educativos — {$catName}")

@push('styles')
  <link href="{{ asset('css/base/variables.css') }}" rel="stylesheet">
  <link href="{{ asset('css/base/backgrounds.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pages/educativos_index.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pages/categorias_create.css') }}" rel="stylesheet">

  {{-- Fallback mínimo para .btn--ghost (caso a classe não esteja disponível aqui) --}}
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

  {{-- Cabeçalho da página (padrão) --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-folder-open page-head__icon"></i>
      <div>
        <h1 class="page-head__title">{{ $catName }}</h1>
        <p class="page-head__subtitle">Conteúdos desta categoria.</p>
      </div>
    </div>

    {{-- Botão de ajuda (Popover Bootstrap) --}}
    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="Como usar esta lista?"
            data-bs-content="Revise os cartões desta categoria e clique em “Abrir” para ver o conteúdo completo. Você pode marcar/desmarcar como visitado pelo botão do cartão."
            aria-label="Ajuda sobre a lista de conteúdos da categoria">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Balão fixo (coachmark) no padrão --}}
  <div class="hint-bubble" id="hint-educativos-category" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Dica rápida</strong><br>
        Esta página mostra apenas os conteúdos da categoria <em>{{ $catName }}</em>. Clique em um cartão para abrir o material.
        Se precisar, volte para a visão geral de categorias.
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary hint-bubble__close" id="hint-close" style="display:none;">Entendi</button>
    </div>
    <span class="hint-bubble__arrow"></span>
  </div>

  {{-- Botão “Todas as categorias” logo abaixo do balão --}}
  <div class="mt-3 mb-2">
    <a class="btn btn-primary" href="{{ route('educativos.index') }}">
      <i class="fa-solid fa-arrow-left me-1"></i> Todas as categorias
    </a>
  </div>

  {{-- Lista de cards --}}
  <section>
    @if(($items ?? collect())->count() === 0)
      <div class="edc-empty">
        <i class="fa-regular fa-circle-question"></i>
        <p>Nenhum conteúdo nesta categoria.</p>
      </div>
    @else
      <div class="edc-grid">
        @foreach($items as $e)
          <article class="edc-card">
            <header class="edc-card__head">
              <h3 class="edc-card__title">
                <a href="{{ route('educativos.show', $e->slug) }}">{{ $e->titulo }}</a>
              </h3>
              @if($e->visitado)
                <span class="badge badge--visited"><i class="fa-regular fa-eye"></i> Visitado</span>
              @endif
            </header>

            <p class="edc-card__desc">{{ $e->descricao }}</p>

            @if($e->categorias)
              <div class="edc-card__chips">
                @foreach(method_exists($e,'categoriasArray') ? $e->categoriasArray() : [] as $c)
                  <span class="chip chip--sm">{{ $c }}</span>
                @endforeach
              </div>
            @endif

            <footer class="edc-card__foot">
              <a class="btn btn--ghost" href="{{ route('educativos.show', $e->slug) }}">
                Abrir <i class="fa-solid fa-arrow-right"></i>
              </a>
              <form method="post" action="{{ route('educativos.toggleVisited', $e->id) }}">
                @csrf
                <button class="btn btn--soft" type="submit">
                  {{ $e->visitado ? 'Desmarcar' : 'Marcar como visitado' }}
                </button>
              </form>
            </footer>
          </article>
        @endforeach
      </div>

      <div class="edc-pagination">
        {{ $items->links() }}
      </div>
    @endif
  </section>

</div>
@endsection

@push('scripts')
<script>
  // Inicializa Popover do Bootstrap (botão Ajuda)
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });

  // Coachmark fixo (mantém visível, seguindo o padrão)
  (function(){
    const bubble = document.getElementById('hint-educativos-category');
    bubble?.classList.remove('d-none');
  })();
</script>
@endpush
