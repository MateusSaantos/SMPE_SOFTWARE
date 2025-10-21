@extends('layouts.app')

@section('title', 'Educativos')

@push('styles')
  <link href="{{ asset('css/pages/educativos_index.css') }}" rel="stylesheet">
  <link href="{{ asset('css/base/variables.css') }}" rel="stylesheet">
  <link href="{{ asset('css/base/backgrounds.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="edc-page">
  <section class="edc-hero">
    <div class="edc-hero__bg"></div>
    <div class="edc-hero__container">
      <div class="edc-hero__copy">
        <h1 class="edc-hero__title">Centro Educativo</h1>
        <p class="edc-hero__subtitle">CNPJ, tributação, formação de preços e importação de notas — do básico ao avançado.</p>

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
