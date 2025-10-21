@extends('layouts.app')

@section('title', $item->titulo ?? 'Educativo')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/educativos_show.css') }}?v={{ filemtime(public_path('css/pages/educativos_show.css')) }}">
@endpush

@section('content')
<div class="edc-show">
  <header class="show-hero">
    <div class="show-hero__bg"></div>
    <div class="show-hero__container">
      <div class="show-hero__copy">
        <h1 class="show-hero__title">{{ $item->titulo }}</h1>

        @if(!empty($item->categorias))
          <div class="show-hero__chips">
            @foreach($item->categoriasArray() as $c)
              <span class="chip"># {{ $c }}</span>
            @endforeach
          </div>
        @endif
      </div>

      <div class="show-hero__actions">
        <form method="post" action="{{ route('educativos.toggleVisited', $item->id) }}">
          @csrf
          <button class="btn btn--soft" type="submit">
            {{ $item->visitado ? 'Desmarcar como visitado' : 'Marcar como visitado' }}
          </button>
        </form>
        <a class="btn btn--ghost" href="{{ route('educativos.index') }}">
          <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
      </div>
    </div>
  </header>

  <main class="show-body">
    <article class="content">
      {!! $item->conteudo !!}
    </article>

    @if(is_array($item->links) && count($item->links))
      <aside class="links">
        <h3>Links úteis</h3>
        <ul>
          @foreach($item->links as $l)
            <li>
              <a href="{{ $l['url'] ?? '#' }}" target="_blank" rel="noopener">
                <i class="fa-solid fa-link"></i> {{ $l['titulo'] ?? ($l['url'] ?? 'Link') }}
              </a>
            </li>
          @endforeach
        </ul>
      </aside>
    @endif
  </main>
</div>
@endsection
