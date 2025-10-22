@extends('layouts.app')

@section('title', 'Centro Educativo — Categorias')

@push('styles')
  <link href="{{ asset('css/base/variables.css') }}" rel="stylesheet">
  <link href="{{ asset('css/base/backgrounds.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pages/educativos_index.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pages/categorias_create.css') }}" rel="stylesheet">

  <style>
    /* ===== Cards de categoria (retângulos) ===== */
    .edc-cat-grid {
      display: grid;
      gap: 14px;
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    }

    .edc-cat-card {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 18px;
      border-radius: 14px;
      background: var(--bg-panel, #fff);
      border: 1px solid var(--line-soft, #e5e7eb);
      box-shadow: 0 6px 18px rgba(17, 24, 39, .06);
      transition: transform .15s ease, box-shadow .15s ease;
      text-decoration: none;
      color: inherit;
    }

    .edc-cat-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 24px rgba(17, 24, 39, .10);
    }

    .edc-cat-card__name {
      font-weight: 600;
    }

    .edc-cat-card__count {
      font-size: .85rem;
      color: #6b7280;
      display: flex;
      align-items: center;
      gap: 6px;
      white-space: nowrap;
    }
  </style>
@endpush

@section('content')
<div class="container py-3 py-md-4">

  {{-- Cabeçalho da página (padrão) --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-graduation-cap page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Centro Educativo</h1>
        <p class="page-head__subtitle">Escolha uma categoria para explorar os conteúdos.</p>
      </div>
    </div>

    {{-- Botão de ajuda (Popover Bootstrap) --}}
    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="Como navegar pelas categorias?"
            data-bs-content="Clique em um retângulo de categoria (ex.: Sua Empresa, PRODUTOS) para ver seus conteúdos. Depois, selecione um cartão para abrir o material."
            aria-label="Ajuda sobre categorias do Centro Educativo">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Balão fixo (coachmark) no padrão --}}
  <div class="hint-bubble" id="hint-educativos-categorias" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Dica rápida</strong><br>
        As categorias agrupam os temas de estudo (ex.: <em>Sua Empresa</em>, <em>Produtos</em>).
        Clique em uma delas para listar os conteúdos correspondentes.
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary hint-bubble__close"
              id="hint-close" style="display:none;">Entendi</button>
    </div>
    <span class="hint-bubble__arrow"></span>
  </div>

  {{-- Lista de categorias --}}
  <section class="mt-3">
    @if(($categorias ?? collect())->isEmpty())
      <div class="edc-empty">
        <i class="fa-regular fa-circle-question"></i>
        <p>Nenhuma categoria disponível.</p>
      </div>
    @else
      <div class="edc-cat-grid">
        @foreach($categorias as $cat)
          <a class="edc-cat-card" href="{{ route('educativos.category', $cat['slug']) }}">
            <span class="edc-cat-card__name">
              <i class="fa-solid fa-folder-open me-2"></i>{{ $cat['name'] }}
            </span>
            <span class="edc-cat-card__count">
              <i class="fa-regular fa-file-lines"></i>{{ $cat['count'] }}
            </span>
          </a>
        @endforeach
      </div>
    @endif
  </section>

</div>
@endsection

@push('scripts')
<script>
  // Inicializa Popover do Bootstrap
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });

  // Coachmark fixo (mantém visível; segue seu padrão)
  (function(){
    const bubble = document.getElementById('hint-educativos-categorias');
    bubble?.classList.remove('d-none');
  })();

  // (Opcional) Validação/fechar dica — mesmo padrão das outras telas
  // const closeBtn = document.getElementById('hint-close');
  // closeBtn?.addEventListener('click', () => {
  //   document.getElementById('hint-educativos-categorias')?.classList.add('d-none');
  // });
</script>
@endpush
