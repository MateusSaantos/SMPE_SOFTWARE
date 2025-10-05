{{-- resources/views/notas/list.blade.php --}}
@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/fornecedores_index.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
  <link href="{{ asset('css/components/confirm.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  <div class="content-limiter">

    {{-- Cabeçalho (título + Ajuda à direita) --}}
    <div class="page-head d-flex justify-content-between align-items-start">
      <div class="page-head__left d-flex">
        <i class="fa-solid fa-file-invoice-dollar page-head__icon"></i>
        <div>
          <h1 class="page-head__title mb-1">Notas Fiscais</h1>
          <p class="page-head__subtitle mb-0">Liste, pesquise e gerencie suas notas fiscais.</p>
        </div>
      </div>
      <div class="ms-3">
        <button type="button"
                class="btn btn-outline-primary btn-help"
                data-bs-toggle="popover"
                data-bs-title="Como funciona esta lista?"
                data-bs-content="Busque por número, série, fornecedor ou CNPJ. Use os filtros de tipo e período. Clique no número para visualizar.">
          <i class="fa-regular fa-circle-question me-2"></i> Ajuda
        </button>
      </div>
    </div>

    {{-- Dica --}}
    <div class="hint-bubble" id="hint-lista-notas" role="status" aria-live="polite" style="display:block">
      <div class="d-flex align-items-start gap-2">
        <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
        <div class="flex-grow-1">
          <strong>Dica rápida</strong><br>
          Pesquise por <em>número</em>, <em>série</em>, <em>fornecedor</em> ou <em>CNPJ</em>.
          Use os filtros abaixo para refinar por <em>tipo</em> e <em>período</em>.
        </div>
      </div>
      <span class="hint-bubble__arrow"></span>
    </div>

    {{-- Ações (Nova + Importar XML) --}}
    <div class="d-flex flex-wrap gap-2 mb-3 mt-2">
      <a href="{{ route('notas.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i> Nova Nota Manual
      </a>
      <a href="{{ route('notas.import.form') }}" class="btn btn-primary">
        <i class="fa-solid fa-file-import me-2"></i> Importar XML
      </a>
    </div>

    {{-- ALERTAS --}}
    @if(session('success'))
      <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    {{-- Filtros (busca ocupa a linha toda; filtros na segunda linha) --}}
    <form method="GET" class="mb-3" role="search">
      <div class="row g-2">
        {{-- Linha 1: Busca full width --}}
        <div class="col-12">
          <div class="input-group input-search-modern">
            <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input type="text"
                   name="q"
                   value="{{ request('q', $q ?? '') }}"
                   class="form-control"
                   placeholder="Buscar por número, série, fornecedor ou CNPJ">
            <button class="btn btn-primary" type="submit">Buscar</button>
          </div>
        </div>

        {{-- Linha 2: Tipo + Período + Limpar --}}
        <div class="col-12 col-md-3">
          @php $tipoSel = request('tipo'); @endphp
          <select name="tipo" class="form-select" aria-label="Filtrar por tipo">
            <option value="" {{ $tipoSel==='' || $tipoSel===null ? 'selected' : '' }}>Tipo (todos)</option>
            <option value="entrada" {{ $tipoSel==='entrada' ? 'selected' : '' }}>Entrada</option>
            <option value="saida"   {{ $tipoSel==='saida'   ? 'selected' : '' }}>Saída</option>
          </select>
        </div>

        <div class="col-6 col-md-2">
          <input type="date" name="de"  class="form-control" value="{{ request('de') }}"  aria-label="Data inicial" placeholder="dd/mm/aaaa">
        </div>
        <div class="col-6 col-md-2">
          <input type="date" name="ate" class="form-control" value="{{ request('ate') }}" aria-label="Data final"   placeholder="dd/mm/aaaa">
        </div>

        <div class="col-12 col-md-2 d-grid">
          <a href="{{ route('notas.index') }}" class="btn btn-outline-secondary">Limpar</a>
        </div>
      </div>
    </form>

    {{-- Lista / Vazio --}}
    @if($notas->count() === 0)
      <div class="data-card data-card--empty">
        <div class="empty-state">
          <i class="fa-regular fa-folder-open empty-state__icon"></i>
          <div class="empty-state__text">
            Nenhuma nota encontrada.
            <a href="{{ route('notas.create') }}">Lançar agora</a> ou
            <a href="{{ route('notas.import.form') }}">importar XML</a>.
          </div>
        </div>
      </div>
    @else
      @php
        $perPage = (int) request('per_page', $notas->perPage());
        $sizes = [10,25,50,100];
      @endphp

      <div class="data-card">
        {{-- Toolbar superior --}}
        <div class="list-toolbar">
          <span class="label">Visualizar:</span>
          @foreach($sizes as $n)
            <a class="size-link {{ $perPage === $n ? 'is-active' : '' }}"
               href="{{ request()->fullUrlWithQuery(['per_page' => $n, 'page' => 1]) }}">
              {{ $n }}
            </a>
          @endforeach
        </div>

        <div class="table-responsive">
          <table class="table table-hiper align-middle">
            <colgroup>
              <col style="width:210px">   {{-- Número/Série --}}
              <col>                      {{-- Fornecedor --}}
              <col style="width:120px">  {{-- Tipo --}}
              <col style="width:160px">  {{-- Total --}}
              <col style="width:160px">  {{-- Ações --}}
            </colgroup>

            <thead>
              <tr>
                <th>Número / Série</th>
                <th>Fornecedor</th>
                <th>Tipo</th>
                <th class="text-end">Total</th>
                <th class="text-end">Ações</th>
              </tr>
            </thead>

            <tbody>
            @foreach($notas as $n)
              @php
                // ajuste o campo conforme seu modelo (ex.: $n->tipo, $n->natureza, etc.)
                $tipoNota = strtolower($n->tipo ?? 'entrada');
                $isEntrada = $tipoNota === 'entrada';
              @endphp
              <tr>
                <td class="cell-name">
                  <a href="{{ route('notas.show', $n->id) }}" class="name-link" title="Ver capa da nota">
                    {{ $n->numero }}{{ $n->serie ? ' / '.$n->serie : '' }}
                  </a>
                </td>

                <td>{{ data_get($n, 'fornecedor.razao_social', '—') }}</td>

                <td>
                  <span class="badge {{ $isEntrada ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ $isEntrada ? 'Entrada' : 'Saída' }}
                  </span>
                </td>

                <td class="text-end text-mono">
                  R$ {{ number_format($n->valor_total ?? 0, 2, ',', '.') }}
                </td>

                <td class="text-end">
                  <div class="btn-group btn-group-actions">
                    <a class="btn btn-icon" href="{{ route('notas.show', $n->id) }}" title="Ver">
                      <i class="fa-regular fa-eye"></i>
                    </a>
                    <a class="btn btn-icon" href="{{ route('notas.edit', $n->id) }}" title="Editar capa">
                      <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <a class="btn btn-icon" href="{{ route('notas.itens', $n->id) }}" title="Lançar itens">
                      <i class="fa-solid fa-list-check"></i>
                    </a>

                    {{-- Excluir --}}
                    <form id="del-nota-{{ $n->id }}" action="{{ route('notas.destroy', $n->id) }}" method="POST" class="d-inline">
                      @csrf @method('DELETE')
                      <button type="button"
                              class="btn btn-icon text-danger js-open-delete"
                              data-form="del-nota-{{ $n->id }}"
                              data-title="Remover nota?"
                              data-message="Remover a nota <strong>{{ $n->numero }}{{ $n->serie ? ' / '.$n->serie : '' }}</strong>? Essa ação não pode ser desfeita."
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
            <a class="size-link {{ $perPage === $n ? 'is-active' : '' }}"
               href="{{ request()->fullUrlWithQuery(['per_page' => $n, 'page' => 1]) }}">
              {{ $n }}
            </a>
          @endforeach
        </div>
      </div>

      {{-- Paginação --}}
      <div class="d-flex justify-content-end mt-2">
        {{ $notas->appends(request()->query())->links() }}
      </div>
    @endif
  </div>
</div>

{{-- Modal de confirmação --}}
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
        <h5 class="modal-title fw-bold mb-1" id="confirmDeleteTitle">Remover nota?</h5>
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

  // Confirmação de exclusão
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
