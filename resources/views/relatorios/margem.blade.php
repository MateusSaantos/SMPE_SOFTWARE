@extends('layouts.app')

@section('content')

@push('styles')
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">

  {{-- Cabeçalho --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-chart-line page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Relatório de Margem</h1>
        <p class="page-head__subtitle">
          Analise o lucro e a margem percentual dos produtos cadastrados.
        </p>
      </div>
    </div>

    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="O que é este relatório?"
            data-bs-content="Este relatório apresenta o custo, preço de venda, lucro e margem percentual de cada produto."
            aria-label="Ajuda sobre relatório de margem">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Filtros --}}
  <form method="GET"
        action="{{ route('relatorios.margem') }}"
        class="card mt-3 p-3">

    <div class="row align-items-end">

      {{-- Produto --}}
      <div class="col-md-4">
        <label class="form-label">Produto</label>
        <input
          type="text"
          name="produto"
          class="form-control"
          value="{{ request('produto') }}"
          placeholder="Descrição do produto">
      </div>

      {{-- Categoria --}}
      <div class="col-md-3">
        <label class="form-label">Categoria</label>
        <select name="categoria" class="form-control">
          <option value="">Todas</option>
          @foreach($categorias ?? [] as $categoria)
            <option value="{{ $categoria->id }}"
              {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
              {{ $categoria->descricao }}
            </option>
          @endforeach
        </select>
      </div>

      {{-- Margem mínima --}}
      <div class="col-md-3">
        <label class="form-label">Margem mínima (%)</label>
        <input
          type="number"
          step="0.01"
          name="margem_min"
          class="form-control"
          value="{{ request('margem_min') }}"
          placeholder="Ex: 20">
      </div>

      {{-- Ações --}}
      <div class="col-md-2 text-end">
        <button type="submit" class="btn btn-primary w-100 mb-2">
          <i class="fas fa-filter"></i> Filtrar
        </button>

        <a href="{{ route('relatorios.margem.pdf', request()->query()) }}"
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
            <th>Categoria</th>
            <th>Custo</th>
            <th>Venda</th>
            <th>Lucro</th>
            <th>Margem (%)</th>
          </tr>
        </thead>
        <tbody>
          @forelse($produtos as $produto)
            @php
              $lucro = $produto->preco_venda - $produto->preco_custo;
              $margem = $produto->preco_venda > 0
                ? ($lucro / $produto->preco_venda) * 100
                : 0;

              if ($margem < 10) {
                $badge = 'danger';
              } elseif ($margem < 20) {
                $badge = 'warning';
              } else {
                $badge = 'success';
              }
            @endphp
            <tr>
              <td>{{ $produto->descricao }}</td>
              <td>{{ $produto->categoria->descricao ?? '-' }}</td>
              <td>R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}</td>
              <td>R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
              <td>R$ {{ number_format($lucro, 2, ',', '.') }}</td>
              <td>
                <span class="badge bg-{{ $badge }}">
                  {{ number_format($margem, 2, ',', '.') }}%
                </span>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted">
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
