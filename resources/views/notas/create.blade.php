@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  {{-- Cabeçalho --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-file-invoice page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Nova Nota Fiscal (Manual)</h1>
        <p class="page-head__subtitle">Preencha a capa da nota. Depois você adicionará os itens.</p>
      </div>
    </div>

    {{-- Ajuda --}}
    <button type="button" class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="Dica"
            data-bs-content="Número e fornecedor são obrigatórios. A chave de acesso tem 44 dígitos (opcional nesta etapa).">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Coachmark --}}
  <div class="hint-bubble" id="hint-capa-nota" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Capa da nota</strong><br>
        Após salvar, você será direcionado para inserir os <em>itens</em> da nota.
      </div>
    </div>
    <span class="hint-bubble__arrow"></span>
  </div>

  {{-- Erros --}}
  @if ($errors->any())
    <div class="alert alert-danger mt-2">{{ $errors->first() }}</div>
  @endif

  {{-- Form --}}
  <form method="POST" action="{{ route('notas.store') }}" class="needs-validation mt-3" novalidate>
    @include('notas.form')
  </form>
</div>

@push('scripts')
<script>
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => new bootstrap.Popover(el, { trigger: 'focus' }));
</script>
@endpush
@endsection
