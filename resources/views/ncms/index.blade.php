{{-- resources/views/ncms/index.blade.php --}}
@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/fornecedores_index.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
  {{-- estilos do modal de confirmação --}}
  <link href="{{ asset('css/components/confirm.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  <div class="content-limiter">

    {{-- Cabeçalho --}}
    <div class="page-head">
      <div class="page-head__left">
        <i class="fa-solid fa-barcode page-head__icon"></i>
        <div>
          <h1 class="page-head__title">NCM</h1>
          <p class="page-head__subtitle">Liste, pesquise e gerencie códigos NCM.</p>
        </div>
      </div>

      <button type="button"
              class="btn btn-outline-primary btn-help"
              data-bs-toggle="popover"
              data-bs-title="Como funciona esta lista?"
              data-bs-content="Busque pelo código (8 dígitos) ou pela descrição. Clique no código para visualizar. Use as ações à direita para ver, editar ou excluir."
              aria-label="Ajuda sobre a lista de NCM">
        <i class="fa-regular fa-circle-question me-2"></i> Ajuda
      </button>
    </div>

    {{-- Balão fixo --}}
    <div class="hint-bubble" id="hint-lista-ncm" role="status" aria-live="polite" style="display:block">
      <div class="d-flex align-items-start gap-2">
        <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
        <div class="flex-grow-1">
          <strong>Dica rápida</strong><br>
          Pesquise por <em>código</em> (8 dígitos) ou <em>descrição</em>. Clique no código para visualizar.
          Use os botões à direita para ver, editar ou excluir.
        </div>
      </div>
      <span class="hint-bubble__arrow"></span>
    </div>

    {{-- ALERTAS --}}
    @if(session('success'))
      <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    {{-- Botão cadastrar (sempre visível) --}}
    <div class="mb-3">
      <a href="{{ route('ncms.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i> Cadastrar NCM
      </a>
    </div>

    {{-- Busca --}}
    <form method="GET" class="mb-3">
      <div class="input-group input-search-modern">
        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
        <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control"
               placeholder="Buscar por código (8 dígitos) ou descrição">
        <button class="btn btn-primary" type="submit">Buscar</button>
      </div>
    </form>

    {{-- Lista / Vazio --}}
    @if($ncms->count() === 0)
      <div class="data-card data-card--empty">
        <div class="empty-state">
          <i class="fa-regular fa-folder-open empty-state__icon"></i>
          <div class="empty-state__text">
            Nenhum NCM encontrado.
            <a href="{{ route('ncms.create') }}">Cadastrar agora</a>.
          </div>
        </div>
      </div>
    @else
      @php
        $perPage = (int) request('per_page', $ncms->perPage());
        $sizes = [10,25,50,100];
      @endphp

      <div class="data-card">

        {{-- Toolbar superior --}}
        <div class="list-toolbar">
          <span class="label">Visualizar:</span>
          @foreach($sizes as $n)
            <a  class="size-link {{ $perPage === $n ? 'is-active' : '' }}"
                href="{{ request()->fullUrlWithQuery(['per_page' => $n, 'page' => 1]) }}">
              {{ $n }}
            </a>
          @endforeach
        </div>

        <div class="table-responsive">
          <table class="table table-hiper align-middle">
            <colgroup>
              <col style="width:180px">  {{-- Código --}}
              <col>                      {{-- Descrição --}}
              <col style="width:160px">  {{-- Ações --}}
            </colgroup>

            <thead>
              <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th class="text-end">Ações</th>
              </tr>
            </thead>

            <tbody>
            @foreach($ncms as $n)
              <tr>
                <td class="text-mono cell-name">
                  <a href="{{ route('ncms.show', $n->id) }}" class="name-link" title="Ver NCM">
                    {{ $n->codigo }}
                  </a>
                </td>

                <td class="nowrap text-truncate" style="max-width:520px">{{ $n->descricao }}</td>

                <td class="text-end">
                  <div class="btn-group btn-group-actions">
                    <a class="btn btn-icon" href="{{ route('ncms.show', $n->id) }}" title="Ver">
                      <i class="fa-regular fa-eye"></i>
                    </a>
                    <a class="btn btn-icon" href="{{ route('ncms.edit', $n->id) }}" title="Editar">
                      <i class="fa-regular fa-pen-to-square"></i>
                    </a>

                    {{-- Form de exclusão + botão que abre o modal bonito --}}
                    <form id="del-ncm-{{ $n->id }}" action="{{ route('ncms.destroy', $n->id) }}" method="POST" class="d-inline">
                      @csrf @method('DELETE')
                      <button type="button"
                              class="btn btn-icon text-danger js-open-delete"
                              data-form="del-ncm-{{ $n->id }}"
                              data-title="Remover NCM?"
                              data-message="Remover o código <strong>{{ $n->codigo }}</strong>? Essa ação não pode ser desfeita."
                              title="Excluir">
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

        {{-- Toolbar inferior --}}
        <div class="list-toolbar border-top">
          <span class="label">Visualizar:</span>
          @foreach($sizes as $n)
            <a  class="size-link {{ $perPage === $n ? 'is-active' : '' }}"
                href="{{ request()->fullUrlWithQuery(['per_page' => $n, 'page' => 1]) }}">
              {{ $n }}
            </a>
          @endforeach
        </div>

      </div>

      {{-- Paginação --}}
      <div class="d-flex justify-content-end mt-2">
        {{ $ncms->appends(request()->query())->links() }}
      </div>
    @endif
  </div>
</div>

{{-- Modal de confirmação (bonito) --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-confirm">
      <div class="modal-header border-0 pb-0">
        <div class="modal-confirm__icon">
          <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <div class="modal-body pt-0">
        <h5 class="modal-title fw-bold mb-1" id="confirmDeleteTitle">Remover NCM?</h5>
        <p class="text-muted mb-0" id="confirmDeleteMessage">Essa ação não pode ser desfeita.</p>
      </div>

      <div class="modal-footer border-0">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
          <i class="fa-regular fa-trash-can me-2"></i> Remover
        </button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  // Popover
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(function (el) {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });

  // Confirmação de exclusão (modal)
  (function(){
    const modalEl   = document.getElementById('confirmDeleteModal');
    if(!modalEl) return;

    const modal     = new bootstrap.Modal(modalEl);
    const titleEl   = document.getElementById('confirmDeleteTitle');
    const msgEl     = document.getElementById('confirmDeleteMessage');
    const btnConfirm= document.getElementById('confirmDeleteBtn');

    let targetFormId = null;

    document.querySelectorAll('.js-open-delete').forEach(btn => {
      btn.addEventListener('click', () => {
        targetFormId = btn.dataset.form;
        titleEl.textContent = btn.dataset.title || 'Confirmar exclusão';
        msgEl.innerHTML     = btn.dataset.message || 'Tem certeza?';
        modal.show();
      });
    });

    btnConfirm.addEventListener('click', () => {
      if (targetFormId) {
        const form = document.getElementById(targetFormId);
        if (form) form.submit();
      }
    });
  })();
</script>
@endpush
@endsection
