@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
  <link href="{{ asset('css/components/confirm.css') }}" rel="stylesheet">
  <style>
    /* ===== Hint Bubble (coachmark) – mesmo padrão do exemplo ===== */
    .hint-bubble{
      position: relative;
      background: var(--bg-panel, #fff);
      border: 1px solid var(--line-soft, #e5e7eb);
      border-radius: 12px;
      padding: 12px 14px;
      box-shadow: 0 6px 18px rgba(17,24,39,.08);
      font-size: .95rem;
      margin-top: .25rem;
    }
    .hint-bubble__icon{ color:#4f46e5; }
    .hint-bubble__close{ white-space: nowrap; }
    .hint-bubble__arrow{
      position:absolute; left:24px; bottom:-8px; width:16px; height:16px;
      background: #fff; border-left:1px solid var(--line-soft, #e5e7eb);
      border-bottom:1px solid var(--line-soft, #e5e7eb);
      transform: rotate(45deg);
    }

    /* Garantir altura idêntica entre o file input e o botão em todos os navegadores */
    .input-group > .btn { height: 100%; }
    /* Em alguns browsers o file input fica 2px mais alto — isso equilibra */
    input[type="file"].form-control { padding-top:.375rem; padding-bottom:.375rem; }
  </style>
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

      {{-- Botão de ajuda (Popover Bootstrap) - padrão do exemplo --}}
      <button type="button"
              class="btn btn-outline-primary btn-help"
              data-bs-toggle="popover"
              data-bs-title="Como importar o XML?"
              data-bs-content="Selecione o arquivo .xml (NF-e 4.00) e clique em Pré-visualizar. Na próxima etapa, vinculamos automaticamente o fornecedor pelo CNPJ e os itens pelo EAN — se não existir, abrimos o cadastro rápido."
              aria-label="Ajuda sobre importação de XML">
        <i class="fa-regular fa-circle-question me-2"></i> Ajuda
      </button>
    </div>

    @if($errors->any())
      <div class="alert alert-danger">
        @foreach($errors->all() as $err)
          <div>{{ $err }}</div>
        @endforeach
      </div>
    @endif

    {{-- Balão fixo (coachmark) - padrão do exemplo --}}
    <div class="hint-bubble" id="hint-import-xml" role="status" aria-live="polite">
      <div class="d-flex align-items-start gap-2">
        <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
        <div class="flex-grow-1">
          <strong>Importe o arquivo da NF-e</strong><br>
          Aponte para o arquivo <em>.xml</em> (versão 4.00) e clique em <em>Pré-visualizar</em>. Vamos identificar o fornecedor pelo <em>CNPJ</em> e os itens pelo <em>EAN</em>; se não houver correspondência, o cadastro rápido será exibido.
        </div>
        {{-- Mantido igual ao seu padrão: botão presente, mas oculto --}}
        <button type="button" class="btn btn-sm btn-outline-secondary hint-bubble__close" id="hint-close" style="display:none;">Entendi</button>
      </div>
      <span class="hint-bubble__arrow"></span>
    </div>

    {{-- Formulário de upload --}}
    <div class="card shadow-sm mb-4 mt-2">
      <div class="card-body">
        <form method="POST" action="{{ route('notas.import.preview') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
          @csrf

          <div class="row g-3">
            <div class="col-12">
              <label class="form-label">Arquivo XML</label>
              <div class="input-group">
                <input type="file" name="xml" class="form-control" accept=".xml" required>
                <button class="btn btn-primary" type="submit">
                  <i class="fa-solid fa-magnifying-glass me-2"></i> Pré-visualizar
                </button>
              </div>
              <div class="form-text">NF-e 4.00 (.xml)</div>
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

@push('scripts')
<script>
  // Inicializa Popover do Bootstrap (padrão do exemplo)
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });

  // Coachmark fixo (mesmo comportamento do exemplo: apenas garante visível)
  (function(){
    const bubble = document.getElementById('hint-import-xml');
    bubble?.classList.remove('d-none');
  })();

  // (Opcional) Validação Bootstrap padrão
  (function () {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>
@endpush
@endsection
