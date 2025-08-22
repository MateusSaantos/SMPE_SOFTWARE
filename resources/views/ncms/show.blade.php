@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  {{-- Cabeçalho --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-barcode page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Detalhes do NCM</h1>
        <p class="page-head__subtitle">Veja as informações cadastradas deste código NCM.</p>
      </div>
    </div>

    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="O que posso fazer aqui?"
            data-bs-content="Tela de visualização: revise o código e a descrição. Use Editar para alterar ou Voltar para retornar à lista."
            aria-label="Ajuda sobre a visualização de NCM">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Coachmark --}}
  <div class="hint-bubble" id="hint-visualizar-ncm" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Você está visualizando um NCM</strong><br>
        Confira o <em>código</em> (8 dígitos) e a <em>descrição</em>.
      </div>
    </div>
    <span class="hint-bubble__arrow"></span>
  </div>

  {{-- Ações --}}
  <div class="mb-3 d-flex gap-2">
    <a class="btn btn-primary" href="{{ route('ncms.edit', $ncm->id) }}">
      <i class="fa-regular fa-pen-to-square me-2"></i> Editar
    </a>
    <a class="btn btn-light" href="{{ route('ncms.index') }}">Voltar</a>
  </div>

  {{-- Detalhes --}}
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-2">
          <strong>Código:</strong><br>
          <span class="text-monospace">{{ $ncm->id }}</span>
        </div>

        <div class="col-md-3">
          <strong>NCM:</strong><br>
          <span class="text-monospace">{{ $ncm->codigo }}</span>
        </div>

        <div class="col-md-7">
          <strong>Descrição:</strong><br>
          {{ $ncm->descricao }}
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });
</script>
@endpush
@endsection
