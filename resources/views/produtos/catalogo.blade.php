@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">

  {{-- Cabeçalho padrão --}}
  <div class="page-head mb-4">
    <div class="page-head__left">
      <i class="fa-solid fa-boxes-stacked page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Catálogo de Produtos</h1>
        <p class="page-head__subtitle">
          Visualização rápida dos produtos cadastrados.
        </p>
      </div>
    </div>

    {{-- Botão Ajuda --}}
    <button type="button"
            class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="O que posso fazer aqui?"
            data-bs-content="Visualize os produtos em formato de catálogo. Clique em um item para ver os detalhes completos.">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Busca --}}
  <form class="mb-4">
    <div class="input-group">
      <input type="text"
             name="q"
             class="form-control"
             placeholder="Buscar produto..."
             value="{{ $q ?? '' }}">
      <button class="btn btn-primary">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
    </div>
  </form>

  {{-- Grid --}}
  <div class="row g-3 g-md-4">
    @forelse($produtos as $produto)
      <div class="col-6 col-md-4 col-lg-3">
        <a href="{{ route('produtos.show', $produto) }}"
           class="text-decoration-none text-dark">

          <div class="card h-100 shadow-sm">

            {{-- Imagem --}}
            <div class="ratio ratio-1x1 bg-light">
              @if($produto->imagem)
                <img src="{{ Storage::url($produto->imagem) }}"
                     class="img-fluid p-2"
                     style="object-fit:contain"
                     alt="{{ $produto->descricao }}">
              @else
                <div class="d-flex align-items-center justify-content-center text-muted">
                  <i class="fa-regular fa-image fa-2x"></i>
                </div>
              @endif
            </div>

            {{-- Corpo --}}
            <div class="card-body text-center py-2">
              <h6 class="mb-1 text-truncate fw-semibold">
                {{ $produto->descricao }}
              </h6>
            </div>

            {{-- Preço --}}
            <div class="card-footer bg-white text-center fw-bold text-primary">
              R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}
            </div>

          </div>
        </a>
      </div>
    @empty
      <div class="col-12 text-center text-muted py-5">
        Nenhum produto encontrado.
      </div>
    @endforelse
  </div>

  {{-- Paginação --}}
  <div class="mt-4">
    {{ $produtos->withQueryString()->links() }}
  </div>

</div>

@push('scripts')
<script>
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => {
    new bootstrap.Popover(el, { trigger: 'focus' })
  })
</script>
@endpush
@endsection
