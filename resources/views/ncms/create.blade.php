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
        <h1 class="page-head__title">Novo NCM</h1>
        <p class="page-head__subtitle">Cadastre um código NCM (8 dígitos) com sua descrição.</p>
      </div>
    </div>

    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="O que é este cadastro?"
            data-bs-content="Informe o código NCM com 8 dígitos e a descrição correspondente."
            aria-label="Ajuda sobre o cadastro de NCM">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Coachmark --}}
  <div class="hint-bubble" id="hint-cadastro-ncm" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Você está cadastrando um NCM</strong><br>
        O <em>código</em> deve conter 8 dígitos. A <em>descrição</em> deve ser clara.
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
        action="{{ route('ncms.store') }}"
        class="needs-validation mt-3"
        novalidate>
    @include('ncms.form')
  </form>
</div>

@push('scripts')
<script>
  // Popover
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });

  // Coachmark fixo
  (function(){
    document.getElementById('hint-cadastro-ncm')?.classList.remove('d-none');
  })();

  // Validação Bootstrap
  (function () {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        // força dígitos no código
        const codigo = form.querySelector('.js-codigo-ncm');
        if (codigo) codigo.value = (codigo.value || '').replace(/\D/g, '').slice(0,8);

        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>
@endpush
@endsection
