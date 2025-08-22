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
        <h1 class="page-head__title">Detalhes do Produto</h1>
        <p class="page-head__subtitle">Veja as informações cadastradas deste produto.</p>
      </div>
    </div>

    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="O que posso fazer aqui?"
            data-bs-content="Revise todos os dados do produto. Use Editar para alterar ou Voltar para retornar à lista."
            aria-label="Ajuda sobre a visualização de produto">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Coachmark --}}
  <div class="hint-bubble" id="hint-visualizar-produto" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Você está visualizando um produto</strong><br>
        Confira categoria, NCM, preços, estoque e impostos.
      </div>
    </div>
    <span class="hint-bubble__arrow"></span>
  </div>

  {{-- Ações --}}
  <div class="mb-3 d-flex gap-2">
    <a class="btn btn-primary" href="{{ route('produtos.edit', $produto->id) }}">
      <i class="fa-regular fa-pen-to-square me-2"></i> Editar
    </a>
    <a class="btn btn-light" href="{{ route('produtos.index') }}">Voltar</a>
  </div>

  {{-- Detalhes --}}
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-6">
          <strong>Descrição:</strong><br>
          {{ $produto->descricao }}
        </div>
        <div class="col-md-3">
          <strong>Código de Barras:</strong><br>
          <span class="text-monospace">{{ $produto->codigo_barras ?: '—' }}</span>
        </div>
        <div class="col-md-3">
          <strong>Unidade:</strong><br>
          {{ $produto->unidade_medida }}
        </div>

        <div class="col-md-6">
          <strong>Categoria:</strong><br>
          {{ $produto->categoria->descricao ?? '—' }}
        </div>
        <div class="col-md-3">
          <strong>NCM:</strong><br>
          <span class="text-monospace">{{ $produto->ncmItem?->codigo ?? '—' }}</span>
        </div>
        <div class="col-md-3">
          <strong>CEST:</strong><br>
          <span class="text-monospace">{{ $produto->cest ?: '—' }}</span>
        </div>

        <div class="col-md-3">
          <strong>Preço Custo:</strong><br>
          R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}
        </div>
        <div class="col-md-3">
          <strong>Preço Venda:</strong><br>
          R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
        </div>
        <div class="col-md-3">
          <strong>Margem Lucro:</strong><br>
          {{ number_format($produto->margem_lucro, 2, ',', '.') }}%
        </div>
        <div class="col-md-3">
          <strong>Estoque:</strong><br>
          <span class="text-monospace">{{ (int) $produto->estoque }}</span>
        </div>

        <div class="col-md-3">
          <strong>ICMS:</strong><br>
          {{ number_format($produto->icms, 2, ',', '.') }}%
        </div>
        <div class="col-md-3">
          <strong>PIS:</strong><br>
          {{ number_format($produto->pis, 2, ',', '.') }}%
        </div>
        <div class="col-md-3">
          <strong>COFINS:</strong><br>
          {{ number_format($produto->cofins, 2, ',', '.') }}%
        </div>
        <div class="col-md-3">
          <strong>Status:</strong><br>
          @if($produto->ativo)
            <span class="badge text-bg-success">Ativo</span>
          @else
            <span class="badge text-bg-secondary">Inativo</span>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => new bootstrap.Popover(el, { trigger: 'focus' }));
</script>
@endpush
@endsection
