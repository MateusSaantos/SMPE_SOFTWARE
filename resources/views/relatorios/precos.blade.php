@extends('layouts.app')

@section('content')

@push('styles')
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">

  {{-- Cabeçalho --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-tags page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Relatório de Preços</h1>
        <p class="page-head__subtitle">
          Compare preços de custo, venda e identifique produtos com margem positiva ou negativa.
        </p>
      </div>
    </div>

    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="O que é este relatório?"
            data-bs-content="Este relatório mostra o preço de custo, preço de venda e a diferença entre eles para análise de margem."
            aria-label="Ajuda sobre relatório de preços">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Filtros --}}
  <form method="GET"
        action="{{ route('relatorios.precos') }}"
        class="card mt-3 p-3">

    <div class="row align-items-end">

      {{-- Produto --}}
      <div class="col-md-4">
        <label class="form-label">Produto</label>
        <input type="text"
               name="produto"
               class="form-control"
               value="{{ request('produto') }}"
               placeholder="Descrição do produto">
      </div>

      {{-- Status --}}
      <div class="col-md-3">
        <label class="form-label">Status</label>
        <select name="ativo" class="form-control">
          <option value="">Todos</option>
          <option value="1" {{ request('ativo') === '1' ? 'selected' : '' }}>Ativos</option>
          <option value="0" {{ request('ativo') === '0' ? 'selected' : '' }}>Inativos</option>
        </select>
      </div>

      {{-- Margem negativa --}}
      <div class="col-md-3">
        <div class="form-check mt-4">
          <input class="form-check-input"
                 type="checkbox"
                 name="margem_negativa"
                 value="1"
                 {{ request()->filled('margem_negativa') ? 'checked' : '' }}>
          <label class="form-check-label">
            Apenas margem negativa
          </label>
        </div>
      </div>

      {{-- Ações --}}
      <div class="col-md-2 text-end">
        <button type="submit" class="btn btn-primary w-100 mb-2">
          <i class="fas fa-filter"></i> Filtrar
        </button>

        <a href="{{ route('relatorios.precos.pdf', request()->query()) }}"
           target="_blank"
           class="btn btn-outline-secondary w-100">
          <i class="fas fa-print"></i> Imprimir
        </a>
      </div>

    </div>
  </form>

  {{-- Tabela --}}
  <div class="card mt-4">
    <div class="table-responsive">
      <table class="table table-striped table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>Produto</th>
            <th>Custo</th>
            <th>Venda</th>
            <th>Diferença</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($produtos as $produto)
            @php
              $diferenca = $produto->preco_venda - $produto->preco_custo;

              if ($diferenca < 0) {
                $badge = 'danger';
                $label = 'Margem negativa';
              } else {
                $badge = 'success';
                $label = 'Margem positiva';
              }
            @endphp
            <tr>
              <td>{{ $produto->descricao }}</td>
              <td>R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}</td>
              <td>R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
              <td>
                <span class="fw-bold text-{{ $diferenca < 0 ? 'danger' : 'success' }}">
                  R$ {{ number_format($diferenca, 2, ',', '.') }}
                </span>
              </td>
              <td>
                <span class="badge bg-{{ $produto->ativo ? 'success' : 'secondary' }}">
                  {{ $produto->ativo ? 'Ativo' : 'Inativo' }}
                </span>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center text-muted">
                Nenhum produto encontrado.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>

@push('scripts')
<script>
  document
    .querySelectorAll('[data-bs-toggle="popover"]')
    .forEach(el => new bootstrap.Popover(el, { trigger: 'focus' }));
</script>
@endpush

@endsection
