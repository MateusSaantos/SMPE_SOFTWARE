@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
  <link href="{{ asset('css/components/confirm.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  <div class="content-limiter">

    <div class="page-head">
      <div class="page-head__left">
        <i class="fa-solid fa-file-import page-head__icon"></i>
        <div>
          <h1 class="page-head__title">Importar XML de NF-e</h1>
          <p class="page-head__subtitle">Envie o XML para revisar fornecedor e itens antes de lançar.</p>
        </div>
      </div>
    </div>

    @if($errors->any())
      <div class="alert alert-danger">
        @foreach($errors->all() as $err)
          <div>{{ $err }}</div>
        @endforeach
      </div>
    @endif

    {{-- Formulário de upload --}}
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <form method="POST" action="{{ route('notas.import.preview') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
          @csrf
          <div class="row g-3">
            <div class="col-md-8">
              <label class="form-label">Arquivo XML</label>
              <input type="file" name="xml" class="form-control" accept=".xml" required>
              <div class="form-text">NF-e 4.00 (.xml)</div>
            </div>
            <div class="col-md-4 d-flex align-items-end">
              <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass me-2"></i> Pré-visualizar</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    {{-- Se tiver preview pronto, mostra a tela de revisão --}}
    @if(session('preview_token'))
      @include('notas.import_xml_review', ['token' => session('preview_token')])
    @endif

  </div>
</div>
@endsection
