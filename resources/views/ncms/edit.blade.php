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
        <h1 class="page-head__title">Editar NCM</h1>
        <p class="page-head__subtitle">Altere o código (8 dígitos) e a descrição, se necessário.</p>
      </div>
    </div>

    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="Dica rápida"
            data-bs-content="Mantenha o código com 8 dígitos. A descrição deve ser objetiva."
            aria-label="Ajuda sobre edição de NCM">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Coachmark --}}
  <div class="hint-bubble" id="hint-editar-ncm" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Você está editando um NCM</strong><br>
        O <em>código</em> deve conter 8 dígitos.
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
        action="{{ route('ncms.update', $ncm->id) }}"
        class="needs-validation mt-3"
        novalidate>
    @method('PUT')
    @include('ncms.form', ['ncm' => $ncm])
  </form>
</div>

@push('scripts')
<script>
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });
  (function(){ document.getElementById('hint-editar-ncm')?.classList.remove('d-none'); })();
  (function () {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        const codigo = form.querySelector('.js-codigo-ncm');
        if (codigo) codigo.value = (codigo.value || '').replace(/\D/g, '').slice(0,8);
        if (!form.checkValidity()) { event.preventDefault(); event.stopPropagation(); }
        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>
@endpush
@endsection
