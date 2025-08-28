@extends('layout')

@section('conteudo')
@push('styles')
  {{-- Reaproveita page-head + hint-bubble --}}
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  {{-- Cabeçalho --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-file-invoice page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Detalhes da Nota</h1>
        <p class="page-head__subtitle">Visualize os dados da capa e acesse os itens.</p>
      </div>
    </div>

    <button type="button" class="btn btn-outline-primary btn-help" data-bs-toggle="popover"
            data-bs-title="Dica" data-bs-content="Use Itens para ver/adicionar os itens da nota.">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Ações --}}
  <div class="mb-3 d-flex gap-2">
    <a class="btn btn-primary" href="{{ route('notas.edit', $nota->id) }}">
      <i class="fa-regular fa-pen-to-square me-2"></i> Editar Capa
    </a>
    <a class="btn btn-secondary" href="{{ route('notas.itens', $nota->id) }}">
      <i class="fa-solid fa-list me-2"></i> Itens
    </a>
    <a class="btn btn-light" href="{{ route('notas.index') }}">Voltar</a>
  </div>

  {{-- Detalhes --}}
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-2"><strong>Número:</strong><br>{{ $nota->numero }}</div>
        <div class="col-md-2"><strong>Série:</strong><br>{{ $nota->serie ?: '—' }}</div>
        <div class="col-md-3"><strong>Emissão:</strong><br>{{ $nota->data_emissao ? $nota->data_emissao->format('d/m/Y') : '—' }}</div>
        <div class="col-md-5"><strong>Fornecedor:</strong><br>{{ $nota->fornecedor->razao_social ?? '—' }} — {{ $nota->fornecedor_cnpj }}</div>

        <div class="col-md-4"><strong>CNPJ Destinatário:</strong><br><span class="text-mono">{{ $nota->cnpj_dest ?: '—' }}</span></div>
        <div class="col-md-4"><strong>Chave de Acesso:</strong><br><span class="text-mono">{{ $nota->chave_acesso ?: '—' }}</span></div>
        <div class="col-md-4"><strong>Entrada:</strong><br>{{ $nota->data_entrada ? $nota->data_entrada->format('d/m/Y') : '—' }}</div>

        <div class="col-md-3"><strong>Tipo:</strong><br>{{ ucfirst($nota->tipo) }}</div>
        <div class="col-md-3"><strong>Status:</strong><br>
          @php $map = ['rascunho'=>'secondary','lancada'=>'success','cancelada'=>'danger']; @endphp
          <span class="badge text-bg-{{ $map[$nota->status] ?? 'secondary' }}">{{ ucfirst($nota->status) }}</span>
        </div>
        <div class="col-md-3"><strong>Frete:</strong><br>R$ {{ number_format($nota->frete ?? 0, 2, ',', '.') }}</div>
        <div class="col-md-3"><strong>Outras Despesas:</strong><br>R$ {{ number_format($nota->outras_despesas ?? 0, 2, ',', '.') }}</div>

        <div class="col-md-12"><strong>Observação:</strong><br>{{ $nota->observacao ?: '—' }}</div>

        <div class="col-md-12"><hr class="my-2"></div>
        <div class="col-md-12"><strong>Total da Nota:</strong> <span class="text-mono">R$ {{ number_format($nota->valor_total, 2, ',', '.') }}</span></div>
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
