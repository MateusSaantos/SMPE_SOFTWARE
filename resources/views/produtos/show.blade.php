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
            data-bs-content="Revise todos os dados do produto. Use Editar para alterar ou Voltar para retornar à lista.">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Ações --}}
  <div class="mb-3 d-flex gap-2">
    <a class="btn btn-primary" href="{{ route('produtos.edit', $produto->id) }}">
      <i class="fa-regular fa-pen-to-square me-2"></i> Editar
    </a>
    <a class="btn btn-light" href="{{ route('produtos.index') }}">Voltar</a>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row g-4">

        {{-- Imagem do produto --}}
        <div class="col-md-4 text-center">
          @if($produto->imagem)
            <img
              src="{{ asset('storage/' . $produto->imagem) }}"
              alt="Imagem do produto"
              class="img-fluid rounded border"
              style="max-height: 280px; object-fit: contain;"
            >
          @else
            <div class="border rounded d-flex align-items-center justify-content-center text-muted"
                 style="height: 280px;">
              <i class="fa-regular fa-image fa-3x me-2"></i>
              Sem imagem
            </div>
          @endif
        </div>

        {{-- Dados --}}
        <div class="col-md-8">
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
              {{ (int) $produto->estoque }}
            </div>

            <div class="col-md-3">
              <strong>Estoque Mínimo:</strong><br>
              {{ (int) $produto->estoque_minimo }}
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

            <div class="col-md-6">
              <strong>Origem da Mercadoria:</strong><br>
              {{ $produto->origem_mercadoria }} —
              @switch($produto->origem_mercadoria)
                @case(0) Nacional @break
                @case(1) Estrangeira (Importação direta) @break
                @case(2) Estrangeira (Mercado interno) @break
                @case(3) Nacional (40–70% importado) @break
                @case(4) Nacional (processos básicos) @break
                @case(5) Nacional (≤ 40% importado) @break
                @case(6) Estrangeira (sem similar) @break
                @case(7) Estrangeira (interno, sem similar) @break
                @case(8) Nacional (> 70% importado) @break
                @default —
              @endswitch
            </div>

            <div class="col-md-3">
              <strong>Alíquota IPI:</strong><br>
              {{ number_format($produto->aliquota_ipi, 2, ',', '.') }}%
            </div>

            <div class="col-md-3">
              <strong>Enquadramento IPI:</strong><br>
              {{ $produto->ipi_enquadramento ?: '—' }}
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
