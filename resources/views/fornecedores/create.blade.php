@extends('layout')

@section('conteudo')
@push('styles')
<link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  {{-- Cabeçalho da página --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-truck-field page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Novo Fornecedor</h1>
        <p class="page-head__subtitle">Cadastre os dados do fornecedor para utilizar em compras, notas e contratos.</p>
      </div>
    </div>

    {{-- Botão de ajuda (Popover Bootstrap) --}}
    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="O que é este cadastro?"
            data-bs-content="Você está cadastrando um fornecedor. Informe o CNPJ (14 dígitos), razão social, dados de contato e endereço. Esses dados serão usados nos lançamentos do sistema."
            aria-label="Ajuda sobre o cadastro de fornecedor">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Balão fixo (coachmark) que não pode ser fechado --}}
  <div class="hint-bubble" id="hint-cadastro-fornecedor" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Você está cadastrando um fornecedor</strong><br>
        Preencha os campos obrigatórios. O <em>CNPJ</em> identifica o fornecedor (use apenas números ou no formato 00.000.000/0000-00). O endereço é salvo junto ao cadastro.
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary hint-bubble__close" id="hint-close" style="display:none;">Entendi</button>
    </div>
    <span class="hint-bubble__arrow"></span>
  </div>

  {{-- Erros de validação --}}
  @if ($errors->any())
    <div class="alert alert-danger mt-2">
      {{ $errors->first() }}
    </div>
  @endif

  {{-- Formulário --}}
  <form method="POST"
        action="{{ route('fornecedores.store') }}"
        class="needs-validation mt-3"
        novalidate>
    @csrf
    @include('fornecedores.form')
  </form>
</div>

@push('scripts')
<script>
  // Inicializa Popover do Bootstrap
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });

  // Coachmark fixo (não pode ser fechado)
  (function(){
    const bubble = document.getElementById('hint-cadastro-fornecedor');
    bubble?.classList.remove('d-none');
  })();

  // Validação Bootstrap
  (function () {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
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
