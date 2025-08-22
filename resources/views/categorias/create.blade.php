{{-- resources/views/categorias/create.blade.php --}}
@extends('layout')

@section('conteudo')
@push('styles')
<link href="{{ asset('css/pages/categorias_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  {{-- Cabeçalho da página --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-tags page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Nova Categoria</h1>
        <p class="page-head__subtitle">Cadastre categorias para organizar seus produtos.</p>
      </div>
    </div>

    {{-- Botão de ajuda (Popover Bootstrap) --}}
    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="O que é este cadastro?"
            data-bs-content="Informe a descrição da categoria (obrigatória) e, se quiser, uma observação. Você poderá usar essas categorias nos cadastros e lançamentos de produtos."
            aria-label="Ajuda sobre o cadastro de categoria">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Balão fixo (coachmark) --}}
  <div class="hint-bubble" id="hint-cadastro-categoria" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Você está cadastrando uma categoria</strong><br>
        A <em>Descrição</em> é obrigatória e deve identificar claramente o grupo de produtos. A <em>Observação</em> é opcional.
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
        action="{{ route('categorias.store') }}"
        class="needs-validation mt-3"
        novalidate>
    @csrf
    @include('categorias.form')
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
    const bubble = document.getElementById('hint-cadastro-categoria');
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
