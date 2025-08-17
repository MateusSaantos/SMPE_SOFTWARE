{{-- edit --}}
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
        <h1 class="page-head__title">Editar Fornecedor</h1>
        <p class="page-head__subtitle">Atualize os dados do fornecedor. O CNPJ não pode ser alterado.</p>
      </div>
    </div>

    {{-- Botão de ajuda (Popover Bootstrap) --}}
    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="Como funciona a edição?"
            data-bs-content="O CNPJ é a chave do cadastro e não pode ser alterado. Você pode atualizar razão social, nome fantasia, inscrição estadual, telefone e endereço."
            aria-label="Ajuda sobre edição de fornecedor">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Balão fixo (coachmark) --}}
  <div class="hint-bubble" id="hint-editar-fornecedor" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Você está editando um fornecedor</strong><br>
        O <em>CNPJ</em> é somente leitura. Ajuste os demais campos e salve para aplicar as alterações.
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
  <form action="{{ route('fornecedores.update', $fornecedor->cnpj) }}"
        method="POST"
        class="needs-validation mt-3"
        novalidate>
    @method('PUT')
    @csrf
    @include('fornecedores.form', ['fornecedor' => $fornecedor])
  </form>
</div>

@push('scripts')
<script>
  // Inicializa Popover do Bootstrap
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });

  // Coachmark fixo
  (function(){
    const bubble = document.getElementById('hint-editar-fornecedor');
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
