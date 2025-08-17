{{-- resources/views/fornecedores/show.blade.php --}}
@extends('layout')

@section('conteudo')
@push('styles')
  {{-- Reaproveita page-head + hint-bubble do create/editar --}}
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  {{-- Cabeçalho da página (padrão unificado) --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-truck-field page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Detalhes do Fornecedor</h1>
        <p class="page-head__subtitle">Veja as informações cadastradas deste fornecedor.</p>
      </div>
    </div>

    {{-- Botão de ajuda (Popover Bootstrap) --}}
    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="O que posso fazer aqui?"
            data-bs-content="Esta é a tela de visualização. Revise os dados do fornecedor. Você pode clicar em Editar para alterar informações ou Voltar para retornar à lista."
            aria-label="Ajuda sobre a visualização de fornecedor">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Balão fixo (coachmark) — com botão Entendi para fechar --}}
  <div class="hint-bubble" id="hint-visualizar-fornecedor" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Você está visualizando um fornecedor</strong><br>
        Confira o <em>CNPJ</em>, razão social, contatos e endereço. Se algo estiver incorreto, use o botão <strong>Editar</strong>.
      </div>
    </div>
    <span class="hint-bubble__arrow"></span>
  </div>

  {{-- Barra de ações da página --}}
  <div class="mb-3 d-flex gap-2">
    <a class="btn btn-primary" href="{{ route('fornecedores.edit', $fornecedor->cnpj) }}">
      <i class="fa-regular fa-pen-to-square me-2"></i> Editar
    </a>
    <a class="btn btn-light" href="{{ route('fornecedores.index') }}">
      Voltar
    </a>
  </div>

  {{-- Detalhes --}}
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-3">
          <strong>CNPJ:</strong><br>
          <span class="text-monospace">{{ $fornecedor->cnpj }}</span>
        </div>

        <div class="col-md-5">
          <strong>Razão Social:</strong><br>
          {{ $fornecedor->razao_social }}
        </div>

        <div class="col-md-4">
          <strong>Nome Fantasia:</strong><br>
          {{ $fornecedor->nome_fantasia ?: '—' }}
        </div>

        <div class="col-md-4">
          <strong>Inscrição Estadual:</strong><br>
          {{ $fornecedor->inscricao_estadual ?: '—' }}
        </div>

        <div class="col-md-4">
          <strong>Telefone:</strong><br>
          {{ $fornecedor->telefone ?: '—' }}
        </div>

        <div class="col-md-12">
          <strong>Endereço:</strong><br>
          @if($fornecedor->endereco)
            {{ $fornecedor->endereco->logradouro }}, {{ $fornecedor->endereco->numero }}
            - {{ $fornecedor->endereco->bairro }} - {{ $fornecedor->endereco->cidade }}/{{ $fornecedor->endereco->uf }}
          @else
            —
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  // Inicializa Popover do Bootstrap
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });
</script>
@endpush
@endsection
