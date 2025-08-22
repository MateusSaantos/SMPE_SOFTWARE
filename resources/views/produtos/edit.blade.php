@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  {{-- Cabeçalho --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-box page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Editar Produto</h1>
        <p class="page-head__subtitle">Altere os dados do produto selecionado.</p>
      </div>
    </div>

    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="Dica rápida"
            data-bs-content="Mantenha os impostos e preços atualizados. Confira a categoria e o NCM."
            aria-label="Ajuda sobre edição de produto">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Coachmark --}}
  <div class="hint-bubble" id="hint-editar-produto" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Você está editando um produto</strong><br>
        Revise preços, estoque e impostos.
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary hint-bubble__close" id="hint-close" style="display:none;">Entendi</button>
    </div>
    <span class="hint-bubble__arrow"></span>
  </div>

  {{-- Erros --}}
  @if ($errors->any())
    <div class="alert alert-danger mt-2">
      {{ $errors->first() }}
    </div>
  @endif

  {{-- Form --}}
  <form method="POST"
        action="{{ route('produtos.update', $produto->id) }}"
        class="needs-validation mt-3"
        novalidate>
    @method('PUT')
    @include('produtos.form', ['produto' => $produto])
  </form>
</div>

@push('scripts')
<script>
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => new bootstrap.Popover(el, { trigger: 'focus' }));
  (function(){ document.getElementById('hint-editar-produto')?.classList.remove('d-none'); })();
</script>
@endpush
@endsection
