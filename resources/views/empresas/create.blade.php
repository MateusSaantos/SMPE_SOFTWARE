@extends('layout')

@section('conteudo')
@push('styles')
<link href="{{ asset('css/pages/empresas_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  {{-- Cabeçalho da página --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-building page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Nova Empresa</h1>
        <p class="page-head__subtitle">Cadastre os dados da sua empresa para acessar o sistema.</p>
      </div>
    </div>

    {{-- Botão de ajuda (Popover Bootstrap) --}}
    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="O que é este cadastro?"
            data-bs-content="Você está cadastrando a sua empresa para liberar o acesso ao sistema. Preencha CNPJ, razão social e endereço. Depois, crie o login vinculado ao CNPJ."
            aria-label="Ajuda sobre o cadastro de empresa">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Balão fixo (coachmark) que pode ser fechado --}}
  <div class="hint-bubble" id="hint-cadastro-empresa" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Você está cadastrando sua empresa</strong><br>
        Preencha os campos obrigatórios. Ao salvar, o sistema habilita a criação do <em>login</em> vinculado ao CNPJ.
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary hint-bubble__close" id="hint-close">Entendi</button>
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
        action="{{ route('empresas.store') }}"
        class="needs-validation mt-3"
        novalidate>
    @csrf
    @include('empresas.form')
  </form>
</div>

@push('scripts')
<script>
  // Inicializa Popover do Bootstrap
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });

  // Controla exibição do balão
  (function(){
    const key = 'empresaCoachSeen';
    const bubble = document.getElementById('hint-cadastro-empresa');
    const closeBtn = document.getElementById('hint-close');

    if (localStorage.getItem(key) === '1') {
      bubble?.classList.add('d-none');
    }
    closeBtn?.addEventListener('click', function () {
      bubble?.classList.add('d-none');
      localStorage.setItem(key, '1');
    });
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
