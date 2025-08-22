{{-- resources/views/categorias/show.blade.php --}}
@extends('layout')

@section('conteudo')
@push('styles')
  {{-- Reaproveita os estilos comuns (page-head / hint-bubble) --}}
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  {{-- Cabeçalho da página --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-tags page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Detalhes da Categoria</h1>
        <p class="page-head__subtitle">Veja as informações cadastradas desta categoria.</p>
      </div>
    </div>

    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="O que posso fazer aqui?"
            data-bs-content="Esta é a tela de visualização. Revise os dados da categoria. Você pode clicar em Editar para alterar informações ou Voltar para retornar à lista."
            aria-label="Ajuda sobre a visualização de categoria">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Balão fixo (coachmark) --}}
  <div class="hint-bubble" id="hint-visualizar-categoria" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Você está visualizando uma categoria</strong><br>
        Confira a <em>Descrição</em> e a <em>Observação</em>. Se algo estiver incorreto, use o botão <strong>Editar</strong>.
      </div>
    </div>
    <span class="hint-bubble__arrow"></span>
  </div>

  {{-- Barra de ações --}}
  <div class="mb-3 d-flex gap-2">
    <a class="btn btn-primary" href="{{ route('categorias.edit', $categoria->id) }}">
      <i class="fa-regular fa-pen-to-square me-2"></i> Editar
    </a>
    <a class="btn btn-light" href="{{ route('categorias.index') }}">Voltar</a>
  </div>

  {{-- Detalhes --}}
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-2">
          <strong>Codigo:</strong><br>
          <span class="text-monospace">{{ $categoria->id }}</span>
        </div>

        <div class="col-md-5">
          <strong>Descrição:</strong><br>
          {{ $categoria->descricao }}
        </div>

        <div class="col-md-12">
          <strong>Observação:</strong><br>
          {{ $categoria->observacao ?: '—' }}
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  // Popover Bootstrap
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });
</script>
@endpush
@endsection
