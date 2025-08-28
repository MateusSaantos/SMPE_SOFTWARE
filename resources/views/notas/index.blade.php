@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/fornecedores_index.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
  <link href="{{ asset('css/components/confirm.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  <div class="content-limiter">

    <div class="page-head">
      <div class="page-head__left">
        <i class="fa-solid fa-file-invoice page-head__icon"></i>
        <div>
          <h1 class="page-head__title">Notas Fiscais (manuais)</h1>
          <p class="page-head__subtitle">Liste, pesquise e gerencie suas notas fiscais cadastradas manualmente.</p>
        </div>
      </div>
      <button type="button" class="btn btn-outline-primary btn-help"
              data-bs-toggle="popover"
              data-bs-title="Como funciona?"
              data-bs-content="Busque por número, série, chave de acesso ou fornecedor. Clique no número para visualizar.">
        <i class="fa-regular fa-circle-question me-2"></i> Ajuda
      </button>
    </div>

    <div class="hint-bubble" id="hint-lista-notas" role="status" aria-live="polite" style="display:block">
      <div class="d-flex align-items-start gap-2">
        <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
        <div class="flex-grow-1">
          <strong>Dica rápida</strong><br>
          Pesquise por <em>número</em>, <em>série</em>, <em>chave de acesso</em> ou <em>fornecedor</em>.
        </div>
      </div>
      <span class="hint-bubble__arrow"></span>
    </div>

    @if(session('success')) <div class="alert alert-success mt-3">{{ session('success') }}</div> @endif
    @if(session('error'))   <div class="alert alert-danger mt-3">{{ session('error') }}</div> @endif

    <div class="mb-3">
      <a href="{{ route('notas.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i> Inserir Nota Manual
      </a>
    </div>

    <form method="GET" class="mb-3">
      <div class="input-group input-search-modern">
        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
        <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Buscar por número, série, chave ou fornecedor">
        <button class="btn btn-primary" type="submit">Buscar</button>
      </div>
    </form>

    @if($notas->count() === 0)
      <div class="data-card data-card--empty">
        <div class="empty-state">
          <i class="fa-regular fa-folder-open empty-state__icon"></i>
          <div class="empty-state__text">
            Nenhuma nota fiscal encontrada.
            <a href="{{ route('notas.create') }}">Cadastrar agora</a>.
          </div>
        </div>
      </div>
    @else
      @php $perPage = (int) request('per_page', $notas->perPage()); $sizes = [10,25,50,100]; @endphp

      <div class="data-card">
        <div class="list-toolbar">
          <span class="label">Visualizar:</span>
          @foreach($sizes as $n)
            <a class="size-link {{ $perPage === $n ? 'is-active' : '' }}" href="{{ request()->fullUrlWithQuery(['per_page'=>$n,'page'=>1]) }}">{{ $n }}</a>
          @endforeach
        </div>

        <div class="table-responsive">
          <table class="table table-hiper align-middle">
            <colgroup>
              <col style="width:140px"><!-- Número -->
              <col style="width:80px"><!-- Série -->
              <col style="width:160px"><!-- Emissão -->
              <col><!-- Fornecedor -->
              <col style="width:140px"><!-- Total -->
              <col style="width:120px"><!-- Status -->
              <col style="width:160px"><!-- Ações -->
            </colgroup>
            <thead>
              <tr>
                <th>Número</th>
                <th>Série</th>
                <th>Emissão</th>
                <th>Fornecedor</th>
                <th class="text-end">Total</th>
                <th>Status</th>
                <th class="text-end">Ações</th>
              </tr>
            </thead>
            <tbody>
            @foreach($notas as $n)
              <tr>
                <td class="cell-name"><a href="{{ route('notas.show', $n->id) }}" class="name-link">{{ $n->numero }}</a></td>
                <td>{{ $n->serie ?: '—' }}</td>
                <td>{{ $n->data_emissao ? $n->data_emissao->format('d/m/Y') : '—' }}</td>
                <td>{{ $n->fornecedor->razao_social ?? '—' }}</td>
                <td class="text-end text-mono">{{ number_format($n->valor_total, 2, ',', '.') }}</td>
                <td>
                  @php $map=['rascunho'=>'secondary','lancada'=>'success','cancelada'=>'danger']; @endphp
                  <span class="badge text-bg-{{ $map[$n->status] ?? 'secondary' }}">{{ ucfirst($n->status) }}</span>
                </td>
                <td class="text-end">
                  <div class="btn-group btn-group-actions">
                    <a class="btn btn-icon" href="{{ route('notas.show', $n->id) }}" title="Ver"><i class="fa-regular fa-eye"></i></a>
                    <a class="btn btn-icon" href="{{ route('notas.edit', $n->id) }}" title="Editar capa"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a class="btn btn-icon" href="{{ route('notas.itens', $n->id) }}" title="Itens"><i class="fa-solid fa-list"></i></a>

                    <form id="del-nota-{{ $n->id }}" action="{{ route('notas.destroy', $n->id) }}" method="POST" class="d-inline">
                      @csrf @method('DELETE')
                      <button type="button" class="btn btn-icon text-danger js-open-delete"
                        data-form="del-nota-{{ $n->id }}" data-title="Remover nota fiscal?"
                        data-message="Remover a nota nº <strong>{{ $n->numero }}</strong>? Essa ação não pode ser desfeita."
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

        <div class="list-toolbar border-top">
          <span class="label">Visualizar:</span>
          @foreach($sizes as $n)
            <a class="size-link {{ $perPage === $n ? 'is-active' : '' }}" href="{{ request()->fullUrlWithQuery(['per_page'=>$n,'page'=>1]) }}">{{ $n }}</a>
          @endforeach
        </div>
      </div>

      <div class="d-flex justify-content-end mt-2">{{ $notas->appends(request()->query())->links() }}</div>
    @endif
  </div>
</div>

{{-- Modal confirmação --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-confirm">
      <div class="modal-header border-0 pb-0">
        <div class="modal-confirm__icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
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
document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => new bootstrap.Popover(el, { trigger: 'focus' }));
(function(){
  const modalEl=document.getElementById('confirmDeleteModal'); if(!modalEl) return;
  const modal=new bootstrap.Modal(modalEl);
  const titleEl=document.getElementById('confirmDeleteTitle');
  const msgEl=document.getElementById('confirmDeleteMessage');
  const btnConfirm=document.getElementById('confirmDeleteBtn');
  let targetFormId=null;
  document.querySelectorAll('.js-open-delete').forEach(btn=>{
    btn.addEventListener('click',()=>{
      targetFormId=btn.dataset.form;
      titleEl.textContent=btn.dataset.title||'Confirmar exclusão';
      msgEl.innerHTML=btn.dataset.message||'Tem certeza?';
      modal.show();
    });
  });
  btnConfirm.addEventListener('click',()=>{ if(targetFormId) document.getElementById(targetFormId)?.submit(); });
})();
</script>
@endpush
@endsection
