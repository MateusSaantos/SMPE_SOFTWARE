{{-- resources/views/fornecedores/index.blade.php --}}
@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/fornecedores_index.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
  {{-- estilos do modal de confirmação (opcional, mas recomendado) --}}
  <link href="{{ asset('css/components/confirm.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  <div class="content-limiter">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Cabeçalho --}}
    <div class="page-head">
      <div class="page-head__left">
        <i class="fa-solid fa-truck-field page-head__icon"></i>
        <div>
          <h1 class="page-head__title">Fornecedores</h1>
          <p class="page-head__subtitle">Liste, pesquise e gerencie seus fornecedores.</p>
        </div>
      </div>

      <button type="button"
              class="btn btn-outline-primary btn-help"
              data-bs-toggle="popover"
              data-bs-title="Como funciona esta lista?"
              data-bs-content="Busque por CNPJ ou Razão Social. Clique no nome para ver detalhes. Use as ações à direita para visualizar, editar ou excluir."
              aria-label="Ajuda sobre a lista de fornecedores">
        <i class="fa-regular fa-circle-question me-2"></i> Ajuda
      </button>
    </div>

    {{-- Balão fixo --}}
    <div class="hint-bubble" id="hint-lista-fornecedor" role="status" aria-live="polite" style="display:block">
      <div class="d-flex align-items-start gap-2">
        <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
        <div class="flex-grow-1">
          <strong>Dica rápida</strong><br>
          Pesquise pelo <em>CNPJ</em> ou pela <em>Razão Social</em>. Clique no nome para ver detalhes.
          Use os botões à direita para visualizar, editar ou excluir.
        </div>
      </div>
      <span class="hint-bubble__arrow"></span>
    </div>

    {{-- Botão cadastrar abaixo do cabeçalho, quando houver registros --}}
    @if($fornecedores->count() >= 1)
      <div class="mb-3">
        <a href="{{ route('fornecedores.create') }}" class="btn btn-primary">
          <i class="fa-solid fa-plus me-2"></i> Cadastrar Fornecedor
        </a>
      </div>
    @endif

    {{-- Busca --}}
    <form method="GET" class="mb-3">
      <div class="input-group input-search-modern">
        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
        <input type="text" name="q" value="{{ $q }}" class="form-control"
               placeholder="Buscar por CNPJ, razão social, nome fantasia">
        <button class="btn btn-primary" type="submit">Buscar</button>
      </div>
    </form>

    {{-- Lista / Vazio --}}
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
      @php
        $perPage = (int) request('per_page', $fornecedores->perPage());
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
              <col>                      {{-- Nome (Razão Social) --}}
              <col style="width:160px">  {{-- Telefone --}}
              <col style="width:200px">  {{-- CPF/CNPJ --}}
              <col style="width:140px">  {{-- Ações (3 botões) --}}
            </colgroup>

            <thead>
              <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>CPF/CNPJ</th>
                <th class="text-end">Ações</th>
              </tr>
            </thead>

            <tbody>
            @foreach($fornecedores as $f)
              <tr>
                <td class="cell-name">
                  <a href="{{ route('fornecedores.show', $f->cnpj) }}" class="name-link" title="Ver fornecedor">
                    {{ $f->razao_social }}
                  </a>
                </td>

                <td class="nowrap">{{ $f->telefone ?? '-' }}</td>

                <td class="text-mono nowrap">{{ $f->cnpj }}</td>

                <td class="text-end">
                  <div class="btn-group btn-group-actions">
                    <a class="btn btn-icon" href="{{ route('fornecedores.show', $f->cnpj) }}" title="Ver">
                      <i class="fa-regular fa-eye"></i>
                    </a>
                    <a class="btn btn-icon" href="{{ route('fornecedores.edit', $f->cnpj) }}" title="Editar">
                      <i class="fa-regular fa-pen-to-square"></i>
                    </a>

                    {{-- Form de exclusão + botão que abre o modal bonito --}}
                    <form id="del-{{ $f->cnpj }}" action="{{ route('fornecedores.destroy', $f->cnpj) }}" method="POST" class="d-inline">
                      @csrf @method('DELETE')
                      <button type="button"
                              class="btn btn-icon text-danger js-open-delete"
                              data-form="del-{{ $f->cnpj }}"
                              data-title="Remover fornecedor?"
                              data-message="Remover <strong>{{ $f->razao_social }}</strong>? Essa ação não pode ser desfeita."
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
        {{ $fornecedores->appends(request()->query())->links() }}
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
        <h5 class="modal-title fw-bold mb-1" id="confirmDeleteTitle">Remover fornecedor?</h5>
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
