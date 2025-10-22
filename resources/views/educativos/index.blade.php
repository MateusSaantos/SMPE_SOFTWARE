@extends('layouts.app')

@section('title', 'Educativos')

@push('styles')
  <link href="{{ asset('css/pages/educativos_index.css') }}" rel="stylesheet">
  <link href="{{ asset('css/base/variables.css') }}" rel="stylesheet">
  <link href="{{ asset('css/base/backgrounds.css') }}" rel="stylesheet">
  <style>
    /* ===== Hint Bubble (coachmark) — reaproveitado ===== */
    .hint-bubble{
      position: relative;
      background: var(--bg-panel, #fff);
      border: 1px solid var(--line-soft, #e5e7eb);
      border-radius: 12px;
      padding: 12px 14px;
      box-shadow: 0 6px 18px rgba(17,24,39,.08);
      font-size: .95rem;
      margin-top: 8px;
    }
    .hint-bubble__icon{ color:#4f46e5; }
    .hint-bubble__close{ white-space: nowrap; }
    .hint-bubble__arrow{
      position:absolute; left:24px; bottom:-8px; width:16px; height:16px;
      background:#fff; border-left:1px solid var(--line-soft,#e5e7eb);
      border-bottom:1px solid var(--line-soft,#e5e7eb);
      transform: rotate(45deg);
    }

    /* ===== Hero refinado ===== */
    .edc-hero__container{
      position:relative; max-width:1040px; margin:0 auto; padding: 28px 14px;
      display:flex; gap:16px; align-items:flex-end; justify-content:space-between; flex-wrap:wrap;
    }
    .edc-hero__copy{
      background: var(--bg-panel,#fff);
      border:1px solid var(--line-soft,#e5e7eb);
      border-radius:16px;
      padding:16px 18px;
      box-shadow:0 8px 24px rgba(17,24,39,.08);
      max-width:720px; flex:1 1 560px;
    }
    .edc-hero__title{ margin:0 0 4px 0; }
    .edc-hero__subtitle{ margin:0 0 12px 0; color:#4b5563; }

    .edc-hero__actions{
      display:flex; gap:10px; align-items:center; flex-wrap:wrap;
    }

    /* Botão ajuda: segue padrão ghost/outline do projeto */
    .btn-help {
      display:inline-flex; align-items:center; gap:8px;
    }

    /* Ajustes nos filtros para caber bem sob o balão */
    .edc-filters{ margin-top:10px; }
  </style>
@endpush

@section('content')
<div class="edc-page">
  <section class="edc-hero">
    <div class="edc-hero__bg"></div>
    <div class="edc-hero__container">
      <div class="edc-hero__copy">
        <div class="d-flex align-items-start justify-content-between" style="gap:12px;">
          <div>
            <h1 class="edc-hero__title">Centro Educativo</h1>
            <p class="edc-hero__subtitle">CNPJ, tributação, formação de preços e importação de notas — do básico ao avançado.</p>
          </div>
          <div class="edc-hero__actions">
            {{-- Botão de ajuda (Popover Bootstrap) no cabeçalho --}}
            <button type="button"
                    class="btn btn-outline-primary btn-help"
                    data-bs-toggle="popover"
                    data-bs-title="Como usar o Centro Educativo?"
                    data-bs-content="Use a busca para encontrar termos (ex.: NCM, ICMS, XML) ou selecione uma categoria. Clique em um cartão para abrir o conteúdo."
                    aria-label="Ajuda sobre o Centro Educativo">
              <i class="fa-regular fa-circle-question"></i>
              Ajuda
            </button>
          </div>
        </div>

        {{-- Balão de dica rápida (coachmark) abaixo do cabeçalho --}}
        <div class="hint-bubble" id="hint-edc-index" role="status" aria-live="polite">
          <div class="d-flex align-items-start gap-2">
            <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
            <div class="flex-grow-1">
              <strong>Dica rápida</strong><br>
              Pesquise por termos como <em>ICMS</em>, <em>PIS/COFINS</em>, <em>XML</em>, <em>NCM</em> ou filtre por categoria.
              Depois, clique em um cartão para abrir o conteúdo.
            </div>
            {{-- Se quiser ocultar o botão: style="display:none;" --}}
            <button type="button" class="btn btn-sm btn-outline-secondary hint-bubble__close" id="hint-close" style="display:none;">
              Entendi
            </button>
          </div>
          <span class="hint-bubble__arrow" aria-hidden="true"></span>
        </div>

        {{-- Filtros --}}
        <form method="get" class="edc-filters">
          <div class="edc-input-icon">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Buscar por CNPJ, ICMS, PIS/COFINS, XML, NCM...">
          </div>

          <div class="edc-filters__row">
            <div class="edc-select">
              <label>Categoria</label>
              <select name="categoria">
                <option value="">Todas</option>
                @foreach(($todasCategorias ?? []) as $c)
                  <option value="{{ $c }}" @selected(($categoria ?? '') === $c)>{{ $c }}</option>
                @endforeach
              </select>
            </div>
            <div class="edc-actions">
              <button class="btn btn--primary" type="submit"><i class="fa-solid fa-filter"></i> Filtrar</button>
              <a class="btn btn--ghost" href="{{ route('educativos.index') }}">Limpar</a>
            </div>
          </div>
        </form>

        @if(!empty($todasCategorias))
          <div class="edc-chips">
            @foreach($todasCategorias as $c)
              <a href="{{ route('educativos.index', ['categoria' => $c]) }}"
                 class="chip {{ ($categoria ?? '') === $c ? 'is-active' : '' }}">
                # {{ $c }}
              </a>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </section>

  <section class="edc-container">
    @if(($items ?? collect())->count() === 0)
      <div class="edc-empty">
        <i class="fa-regular fa-circle-question"></i>
        <p>Nenhum conteúdo encontrado para os filtros atuais.</p>
      </div>
    @else
      <div class="edc-grid">
        @foreach($items as $e)
          <article class="edc-card">
            <header class="edc-card__head">
              <h3 class="edc-card__title">
                <a href="{{ route('educativos.show',$e->slug) }}">{{ $e->titulo }}</a>
              </h3>
              @if($e->visitado)
                <span class="badge badge--visited"><i class="fa-regular fa-eye"></i> Visitado</span>
              @endif
            </header>

            <p class="edc-card__desc">{{ $e->descricao }}</p>

            @if($e->categorias)
              <div class="edc-card__chips">
                @foreach($e->categoriasArray() as $c)
                  <span class="chip chip--sm">{{ $c }}</span>
                @endforeach
              </div>
            @endif

            <footer class="edc-card__foot">
              <a class="btn btn--ghost" href="{{ route('educativos.show',$e->slug) }}">Abrir <i class="fa-solid fa-arrow-right"></i></a>
              <form method="post" action="{{ route('educativos.toggleVisited',$e->id) }}">
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

  // Coachmark fixo (se quiser lembrar o fechamento, habilite sessionStorage)
  (function(){
    const bubble = document.getElementById('hint-edc-index');
    if (!bubble) return;
    // Se quiser manter sempre visível, nada a fazer. Para lembrar fechamento:
    // try {
    //   if (sessionStorage.getItem('edcIndexHintClosed') === '1') {
    //     bubble.classList.add('d-none');
    //   }
    // } catch(e){}
  })();

  // (Opcional) se ativar botão de fechar:
  // const closeBtn = document.getElementById('hint-close');
  // if (closeBtn) {
  //   closeBtn.addEventListener('click', () => {
  //     const bubble = document.getElementById('hint-edc-index');
  //     if (bubble) bubble.classList.add('d-none');
  //     try { sessionStorage.setItem('edcIndexHintClosed', '1'); } catch(e){}
  //   });
  // }
</script>
@endpush
