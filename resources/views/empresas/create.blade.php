@extends('layout')

@section('conteudo')
<h1>Nova Empresa</h1>

{{-- Mostra erros de validação, se existirem --}}
@if ($errors->any())
  <div class="alert alert-danger">
    {{ $errors->first() }}
  </div>
@endif

<form method="POST"
      action="{{ route('empresas.store') }}"
      class="needs-validation"  {{-- <- importante para o JS --}}
      novalidate>                {{-- <- evita popups nativos do navegador --}}
  @csrf

  @include('empresas.form') {{-- o botão SUBMIT está dentro do partial --}}
</form>
@endsection
