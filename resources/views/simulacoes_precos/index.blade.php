{{-- resources/views/simulacoes_precos/index.blade.php --}}
@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/categorias_index.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pages/categorias_create.css') }}" rel="stylesheet">
  <link href="{{ asset('css/components/confirm.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  <div class="content-limiter">

    {{-- Cabeçalho: título à esquerda e Ajuda à direita --}}
    <div class="page-head d-flex justify-content-between align-items-start">
      <div class="page-head__left d-flex">
        <i class="fa-solid fa-sliders page-head__icon"></i>
        <div>
          <h1 class="page-head__title mb-1">Histórico de Precificações</h1>
          <p class="page-head__subtitle mb-0">Liste, pesquise e gerencie as simulações de preço realizadas.</p>
        </div>
      </div>

      <div class="ms-3">
        <button type="button"
                class="btn btn-outline-primary btn-help"
                data-bs-toggle="popover"
                data-bs-title="Como funciona esta lista?"
                data-bs-content="Pesquise pelo produto, filtre por período, tipo e modo. Clique em Visualizar para ver os detalhes.">
          <i class="fa-regular fa-circle-question me-2"></i> Ajuda
        </button>
      </div>
    </div>

    {{-- Hint --}}
    <div class="hint-bubble" id="hint-lista-simulacoes" role="status" aria-live="polite" style="display:block">
      <div class="d-flex align-items-start gap-2">
        <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
        <div class="flex-grow-1">
          <strong>Dica rápida</strong><br>
          Pesquise pelo <em>Produto</em>, ajuste filtros e use as ações à direita para <strong>visualizar</strong>, <strong>recalcular</strong> ou <strong>excluir</strong>.
        </div>
      </div>
      <span class="hint-bubble__arrow"></span>
    </div>

    {{-- Nova Simulação logo abaixo da dica --}}
    <div class="mb-3 mt-2">
      <a href="{{ route('simulacoes-precos.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i> Nova Simulação
      </a>
    </div>

    {{-- ALERTAS --}}
    @if(session('ok'))
      <div class="alert alert-success mt-3">{{ session('ok') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger mt-3">{{ $errors->first() }}</div>
    @endif

    {{-- Filtros (Busca ocupa a linha toda; demais filtros descem) --}}
    <form method="GET" class="mb-3">
      <div class="row g-2">
        {{-- Linha 1: busca full width --}}
        <div class="col-12">
          <div class="input-group input-search-modern">
            <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Buscar por produto">
            <button class="btn btn-primary" type="submit">Buscar</button>
          </div>
        </div>

        {{-- Linha 2: filtros adicionais --}}
        <div class="col-12 col-md-3">
          <select name="tipo_simulacao" class="form-select" aria-label="Filtrar por tipo">
            <option value="">Tipo (todos)</option>
            @foreach(['promocao'=>'Promoção','oferta'=>'Oferta','baixar_preco'=>'Baixar preço','aumentar_lucro'=>'Aumentar lucro'] as $k=>$v)
              <option value="{{ $k }}" {{ (($tipo ?? '')===$k) ? 'selected' : '' }}>{{ $v }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-12 col-md-3">
          <select name="margem_calculo" class="form-select" aria-label="Filtrar por modo">
            <option value="" {{ (($modo ?? '')==='') ? 'selected' : '' }}>Modo (ambos)</option>
            <option value="markup" {{ (($modo ?? '')==='markup') ? 'selected' : '' }}>Mark-up</option>
            <option value="margin" {{ (($modo ?? '')==='margin') ? 'selected' : '' }}>Margem</option>
          </select>
        </div>

        <div class="col-6 col-md-2">
          <input type="date" name="de" class="form-control" value="{{ $de ?? '' }}" aria-label="Data inicial">
        </div>
        <div class="col-6 col-md-2">
          <input type="date" name="ate" class="form-control" value="{{ $ate ?? '' }}" aria-label="Data final">
        </div>

        <div class="col-12 col-md-2 d-grid">
          <a href="{{ route('simulacoes-precos.index') }}" class="btn btn-outline-secondary">Limpar</a>
        </div>
      </div>
    </form>

    @php
      $perPage = (int) request('per_page', $simulacoes->perPage());
      $sizes = [10,25,50,100];
    @endphp

    {{-- Lista ou vazio --}}
    @if($simulacoes->count() === 0)
      <div class="data-card data-card--empty">
        <div class="empty-state">
          <i class="fa-regular fa-folder-open empty-state__icon"></i>
          <div class="empty-state__text">
            Nenhuma simulação encontrada.
            <a href="{{ route('simulacoes-precos.create') }}">Criar agora</a>.
          </div>
        </div>
      </div>
    @else
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
              <col style="width:140px">
              <col>
              <col style="width:140px">
              <col style="width:110px">
              <col style="width:140px">
              <col style="width:150px">
              <col style="width:170px">
              <col style="width:180px">
            </colgroup>

            <thead>
              <tr>
                <th>Data</th>
                <th>Produto</th>
                <th>Tipo</th>
                <th>Modo</th>
                <th>Margem alvo</th>
                <th>Tributos (t)</th>
                <th>Preço sugerido</th>
                <th class="text-end">Ações</th>
              </tr>
            </thead>

            <tbody>
            @foreach($simulacoes as $s)
              @php
                $labelsTipo = ['promocao'=>'Promoção','oferta'=>'Oferta','baixar_preco'=>'Baixar preço','aumentar_lucro'=>'Aumentar lucro'];
                $produtoNome = data_get($s, 'produto.descricao', '—');
                $custoBase   = ($s->preco_custo + $s->frete + $s->outras_despesas);
                $tTotal      = ($s->icms + $s->pis + $s->cofins);
              @endphp
              <tr id="row-sim-{{ $s->id }}">
                <td class="text-muted">{{ optional($s->created_at)->format('d/m/Y H:i') }}</td>

                <td class="cell-name">
                  <span class="name-link"
                        role="button"
                        data-bs-toggle="modal"
                        data-bs-target="#modalVisualizar"
                        data-id="{{ $s->id }}"
                        data-produto-id="{{ $s->produto_id }}"
                        data-produto="{{ $produtoNome }}"
                        data-tipo="{{ $labelsTipo[$s->tipo_simulacao] ?? '—' }}"
                        data-modo="{{ $s->margem_calculo==='markup'?'Mark-up':'Margem' }}"
                        data-custo="{{ number_format($custoBase,2,',','.') }}"
                        data-icms="{{ number_format($s->icms*100,2,',','.') }}"
                        data-pis="{{ number_format($s->pis*100,2,',','.') }}"
                        data-cofins="{{ number_format($s->cofins*100,2,',','.') }}"
                        data-margem="{{ number_format($s->margem_lucro*100,2,',','.') }}"
                        data-preco="{{ number_format($s->preco_sugerido,2,',','.') }}"
                        data-obs="{{ $s->observacoes }}">
                    {{ $produtoNome }}
                  </span>
                  @if($s->observacoes)
                    <div class="small text-muted text-truncate" style="max-width:520px" title="{{ $s->observacoes }}">{{ $s->observacoes }}</div>
                  @endif
                </td>

                <td class="text-capitalize">{{ $labelsTipo[$s->tipo_simulacao] ?? '—' }}</td>

                <td>
                  <span class="badge bg-{{ $s->margem_calculo==='markup' ? 'secondary' : 'info' }}">
                    {{ $s->margem_calculo==='markup' ? 'Mark-up' : 'Margem' }}
                  </span>
                </td>

                <td>{{ number_format($s->margem_lucro*100,2,',','.') }}%</td>
                <td>{{ number_format($tTotal*100,2,',','.') }}%</td>
                <td><strong>R$ {{ number_format($s->preco_sugerido,2,',','.') }}</strong></td>

                <td class="text-end">
                  <div class="btn-group btn-group-actions">
                    <button class="btn btn-icon btn-visualizar"
                            title="Visualizar"
                            data-bs-toggle="modal"
                            data-bs-target="#modalVisualizar"
                            data-id="{{ $s->id }}"
                            data-produto-id="{{ $s->produto_id }}"
                            data-produto="{{ $produtoNome }}"
                            data-tipo="{{ $labelsTipo[$s->tipo_simulacao] ?? '—' }}"
                            data-modo="{{ $s->margem_calculo==='markup'?'Mark-up':'Margem' }}"
                            data-custo="{{ number_format($custoBase,2,',','.') }}"
                            data-icms="{{ number_format($s->icms*100,2,',','.') }}"
                            data-pis="{{ number_format($s->pis*100,2,',','.') }}"
                            data-cofins="{{ number_format($s->cofins*100,2,',','.') }}"
                            data-margem="{{ number_format($s->margem_lucro*100,2,',','.') }}"
                            data-preco="{{ number_format($s->preco_sugerido,2,',','.') }}"
                            data-obs="{{ $s->observacoes }}">
                      <i class="fa-regular fa-eye"></i>
                    </button>

                    <a class="btn btn-icon"
                       title="Recalcular"
                       href="{{ route('simulacoes-precos.create', ['produto_id' => $s->produto_id]) }}">
                      <i class="fa-solid fa-rotate"></i>
                    </a>

                    <form id="del-sim-{{ $s->id }}" action="{{ route('simulacoes-precos.destroy', $s->id) }}" method="POST" class="d-inline">
                      @csrf @method('DELETE')
                      <button type="button"
                              class="btn btn-icon text-danger js-open-delete"
                              data-form="del-sim-{{ $s->id }}"
                              data-title="Remover simulação?"
                              data-message="Remover a simulação de <strong>{{ $produtoNome }}</strong>? Essa ação não pode ser desfeita."
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
        {{ $simulacoes->appends(request()->query())->links() }}
      </div>
    @endif
  </div>
</div>

{{-- Modal de Visualização --}}
<div class="modal fade" id="modalVisualizar" tabindex="-1" aria-labelledby="modalVisualizarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content modal-confirm">
      <div class="modal-header border-0 pb-0">
        <div class="modal-confirm__icon">
          <i class="fa-solid fa-sliders"></i>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body pt-0">
        <h5 class="modal-title fw-bold mb-3" id="modalVisualizarLabel">Detalhes da simulação</h5>
        <div class="row g-3">
          <div class="col-md-6">
            <div class="mb-2"><strong>Produto:</strong> <span id="v-produto">—</span></div>
            <div class="mb-2"><strong>Tipo:</strong> <span id="v-tipo">—</span></div>
            <div class="mb-2"><strong>Modo:</strong> <span id="v-modo">—</span></div>
            <div class="mb-2"><strong>Observações:</strong> <span id="v-obs">—</span></div>
          </div>
          <div class="col-md-6">
            <div class="mb-2"><strong>Custo base:</strong> R$ <span id="v-custo">—</span></div>
            <div class="mb-2">
              <strong>Tributos:</strong>
              ICMS <span id="v-icms">—</span>% •
              PIS <span id="v-pis">—</span>% •
              COFINS <span id="v-cofins">—</span>%
            </div>
            <div class="mb-2"><strong>Margem alvo:</strong> <span id="v-margem">—</span>%</div>
            <div class="mb-2"><strong>Preço sugerido:</strong> R$ <span id="v-preco">—</span></div>
          </div>
        </div>
      </div>
      <div class="modal-footer border-0">
        <a id="v-recalcular" class="btn btn-primary" href="#">
          <i class="fa-solid fa-rotate me-2"></i> Recalcular
        </a>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
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
        <h5 class="modal-title fw-bold mb-1" id="confirmDeleteTitle">Remover simulação?</h5>
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

  // Modal Visualizar
  (function(){
    const createUrl = "{{ route('simulacoes-precos.create') }}";

    function preencherModal(btn) {
      document.getElementById('v-produto').textContent = btn.dataset.produto || '—';
      document.getElementById('v-tipo').textContent    = btn.dataset.tipo || '—';
      document.getElementById('v-modo').textContent    = btn.dataset.modo || '—';
      document.getElementById('v-obs').textContent     = btn.dataset.obs || '—';
      document.getElementById('v-custo').textContent   = btn.dataset.custo || '—';
      document.getElementById('v-icms').textContent    = btn.dataset.icms || '—';
      document.getElementById('v-pis').textContent     = btn.dataset.pis || '—';
      document.getElementById('v-cofins').textContent  = btn.dataset.cofins || '—';
      document.getElementById('v-margem').textContent  = btn.dataset.margem || '—';
      document.getElementById('v-preco').textContent   = btn.dataset.preco || '—';

      const produtoId = btn.dataset.produtoId || '';
      document.getElementById('v-recalcular').href =
        createUrl + (produtoId ? ('?produto_id=' + encodeURIComponent(produtoId)) : '');
    }

    document.querySelectorAll('.btn-visualizar, .cell-name .name-link').forEach(btn => {
      btn.addEventListener('click', function(){ preencherModal(this); });
    });
  })();
</script>
@endpush
@endsection
