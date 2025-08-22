{{-- resources/views/categorias/edit.blade.php --}}
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
        <h1 class="page-head__title">Editar Categoria</h1>
        <p class="page-head__subtitle">Altere os dados da categoria selecionada.</p>
      </div>
    </div>

    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="Dica rápida"
            data-bs-content="Atualize a descrição (obrigatória) e ajuste a observação se necessário."
            aria-label="Ajuda sobre edição de categoria">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Balão fixo --}}
  <div class="hint-bubble" id="hint-editar-categoria" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Você está editando uma categoria</strong><br>
        Mantenha a <em>Descrição</em> clara e objetiva.
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
        action="{{ route('categorias.update', $categoria->id) }}"
        class="needs-validation mt-3"
        novalidate>
    @csrf @method('PUT')
    @include('categorias.form', ['categoria' => $categoria])
  </form>
</div>

@push('scripts')
<script>
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });

  (function(){
    const bubble = document.getElementById('hint-editar-categoria');
    bubble?.classList.remove('d-none');
  })();

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
