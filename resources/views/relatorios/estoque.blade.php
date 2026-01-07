@extends('layouts.app')

@section('content')

@push('styles')
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">

  {{-- Cabeçalho --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-warehouse page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Relatório de Estoque</h1>
        <p class="page-head__subtitle">
          Visualize a quantidade disponível, estoque mínimo e produtos em situação crítica.
        </p>
      </div>
    </div>

    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="O que é este relatório?"
            data-bs-content="Este relatório exibe o estoque atual dos produtos, destacando itens sem estoque ou abaixo do mínimo configurado."
            aria-label="Ajuda sobre relatório de estoque">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Filtros --}}
  <form method="GET"
        action="{{ route('relatorios.estoque') }}"
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

      {{-- Estoque baixo --}}
      <div class="col-md-3">
        <div class="form-check mt-4">
          <input
            class="form-check-input"
            type="checkbox"
            name="estoque_baixo"
            value="1"
            {{ request()->filled('estoque_baixo') ? 'checked' : '' }}>
          <label class="form-check-label">
            Apenas estoque baixo
          </label>
        </div>
      </div>

      {{-- Ações --}}
      <div class="col-md-2 text-end">
        <button type="submit" class="btn btn-primary w-100 mb-2">
          <i class="fas fa-filter"></i> Filtrar
        </button>

        <a href="{{ route('relatorios.estoque.pdf', request()->query()) }}"
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
            <th>Unidade</th>
            <th>Estoque</th>
            <th>Mínimo</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($produtos as $produto)
            @php
              if ($produto->estoque == 0) {
                $status = 'Sem estoque';
                $badge  = 'danger';
              } elseif ($produto->estoque <= $produto->estoque_minimo) {
                $status = 'Estoque baixo';
                $badge  = 'warning';
              } else {
                $status = 'OK';
                $badge  = 'success';
              }
            @endphp
            <tr>
              <td>{{ $produto->descricao }}</td>
              <td>{{ $produto->categoria->descricao ?? '-' }}</td>
              <td>{{ $produto->unidade_medida }}</td>
              <td>{{ $produto->estoque }}</td>
              <td>{{ $produto->estoque_minimo }}</td>
              <td>
                <span class="badge bg-{{ $badge }}">
                  {{ $status }}
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
