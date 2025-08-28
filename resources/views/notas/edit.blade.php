@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  {{-- Cabeçalho --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-file-invoice page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Editar Nota Fiscal</h1>
        <p class="page-head__subtitle">Atualize os dados da capa da nota.</p>
      </div>
    </div>

    {{-- Ajuda --}}
    <button type="button" class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="Dica"
            data-bs-content="Ajuste frete/despesas e datas. Os itens são gerenciados em outra tela.">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Erros --}}
  @if ($errors->any())
    <div class="alert alert-danger mt-2">{{ $errors->first() }}</div>
  @endif

  {{-- Form --}}
  <form method="POST" action="{{ route('notas.update', $nota->id) }}" class="needs-validation mt-3" novalidate>
    @method('PUT')
    @include('notas.form', ['nota' => $nota])
  </form>
</div>

@push('scripts')
<script>
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => new bootstrap.Popover(el, { trigger: 'focus' }));
</script>
@endpush
@endsection
