{{-- resources/views/fornecedores/index.blade.php --}}
@extends('layout')

@section('conteudo')
@push('styles')
<link href="{{ asset('css/pages/fornecedores_index.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  <div class="content-limiter"><!-- << padroniza a largura -->
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3 page-head-simple">
      <div class="d-flex align-items-center gap-2">
        <i class="fa-solid fa-truck-field page-head__icon"></i>
        <div>
          <h1 class="h5 mb-0">Fornecedores</h1>
          <small class="text-muted">Liste, pesquise e gerencie seus fornecedores.</small>
        </div>
      </div>

      <button type="button"
              class="btn btn-outline-primary btn-help"
              data-bs-toggle="popover"
              data-bs-title="Dica rápida"
              data-bs-content="Use a busca por CNPJ, razão social ou fantasia. Nas ações, visualize, edite ou remova o cadastro."
              aria-label="Ajuda sobre a lista de fornecedores">
        <i class="fa-regular fa-circle-question me-2"></i> Ajuda
      </button>
    </div>

    <form method="GET" class="mb-3">
      <div class="input-group input-search-modern">
        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
        <input type="text" name="q" value="{{ $q }}" class="form-control"
               placeholder="Buscar por CNPJ, razão social, nome fantasia">
        <button class="btn btn-primary" type="submit">Buscar</button>
      </div>
    </form>

    @if($fornecedores->count() === 0)
      <div class="data-card data-card--empty">
        <div class="empty-state">
          <i class="fa-regular fa-folder-open empty-state__icon"></i>
          <div class="empty-state__text">
            Nenhum fornecedor encontrado.
            <a href="{{ route('fornecedores.create') }}">Cadastrar agora</a>.
          </div>
        </div>
      </div>
    @else
      <div class="data-card">
        <div class="table-responsive">
          <table class="table table-modern align-middle">
            <colgroup>
              <col style="width: 160px;">
              <col>
              <col style="width: 260px;">
              <col style="width: 160px;">
              <col>
              <col style="width: 130px;">
            </colgroup>
            <thead class="table-light sticky-head">
              <tr>
                <th>CNPJ</th>
                <th>Razão Social</th>
                <th class="d-none d-md-table-cell">Nome Fantasia</th>
                <th class="d-none d-sm-table-cell">Telefone</th>
                <th class="d-none d-lg-table-cell">Endereço</th>
                <th class="text-end">Ações</th>
              </tr>
            </thead>
            <tbody>
            @foreach($fornecedores as $f)
              <tr>
                <td class="text-mono nowrap">{{ $f->cnpj }}</td>
                <td class="fw-medium text-truncate-2" title="{{ $f->razao_social }}">{{ $f->razao_social }}</td>
                <td class="text-muted d-none d-md-table-cell text-truncate" title="{{ $f->nome_fantasia }}">{{ $f->nome_fantasia }}</td>
                <td class="d-none d-sm-table-cell nowrap">{{ $f->telefone }}</td>
                <td class="d-none d-lg-table-cell text-truncate" title="@if($f->endereco){{ $f->endereco->logradouro }}, {{ $f->endereco->numero }} - {{ $f->endereco->bairro }} - {{ $f->endereco->cidade }}/{{ $f->endereco->uf }}@endif">
                  @if($f->endereco)
                    <span class="addr-chip">
                      {{ $f->endereco->logradouro }}, {{ $f->endereco->numero }}
                      — {{ $f->endereco->bairro }} — {{ $f->endereco->cidade }}/{{ $f->endereco->uf }}
                    </span>
                  @endif
                </td>
                <td class="text-end">
                  <div class="btn-group btn-group-actions">
                    <a class="btn btn-icon" href="{{ route('fornecedores.show', $f->cnpj) }}" title="Detalhes">
                      <i class="fa-regular fa-eye"></i>
                    </a>
                    <a class="btn btn-icon" href="{{ route('fornecedores.edit', $f->cnpj) }}" title="Editar">
                      <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('fornecedores.destroy', $f->cnpj) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Remover este fornecedor?')">
                      @csrf @method('DELETE')
                      <button class="btn btn-icon text-danger" title="Excluir">
                        <i class="fa-regular fa-trash-can"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <div class="d-flex justify-content-end mt-2">
          {{ $fornecedores->links() }}
        </div>
      </div>
    @endif
  </div><!-- /.content-limiter -->
</div>

@push('scripts')
<script>
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });
</script>
@endpush
@endsection
