{{-- resources/views/simulacoes_precos/create.blade.php --}}
@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/categorias_create.css') }}" rel="stylesheet">
  <style>
    /* Área de lista de produtos com rolagem */
    .product-list-scroll{
      max-height: 60vh;
      overflow: auto;
      border: 1px solid rgba(0,0,0,.05);
      border-radius: .5rem;
    }
    /* Cabeçalho da tabela fixo durante a rolagem */
    .product-list-scroll thead th{
      position: sticky;
      top: 0;
      background: var(--bs-body-bg, #fff);
      z-index: 2;
    }
    @media (max-width: 991.98px){
      .product-list-scroll{ max-height: 40vh; }
    }
  </style>
@endpush

<div class="container py-3 py-md-4">
  {{-- Cabeçalho --}}
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-calculator page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Simulador de Preços</h1>
        <p class="page-head__subtitle">Selecione um produto e simule o preço de venda com base em custos, tributos e margem.</p>
      </div>
    </div>
    <button type="button" class="btn btn-outline-primary btn-help"
            data-bs-toggle="popover"
            data-bs-title="Como usar o simulador?"
            data-bs-content="1) Selecione um produto. 2) Preencha custos, tributos e a margem desejada. 3) Calcule para ver preço sugerido, impostos e lucro.">
      <i class="fa-regular fa-circle-question me-2"></i> Ajuda
    </button>
  </div>

  {{-- Hint/coachmark --}}
  <div class="hint-bubble" id="hint-simulador-precos" role="status" aria-live="polite">
    <div class="d-flex align-items-start gap-2">
      <i class="fa-regular fa-circle-question hint-bubble__icon mt-1"></i>
      <div class="flex-grow-1">
        <strong>Passo a passo:</strong><br>
        Primeiro selecione o <em>produto</em> na lista ao lado. Depois, preencha os campos e calcule o preço sugerido.
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary hint-bubble__close" id="hint-close" style="display:none;">Entendi</button>
    </div>
    <span class="hint-bubble__arrow"></span>
  </div>

  {{-- Erros --}}
  @if ($errors->any())
    <div class="alert alert-danger mt-2">{{ $errors->first() }}</div>
  @endif

  <div class="row g-3 mt-2">
    {{-- Formulário esquerda --}}
    <div class="col-12 col-lg-8">
      <form method="POST" action="{{ route('simulacoes-precos.store') }}" class="needs-validation" novalidate id="form-simulador">
        @csrf
        <input type="hidden" name="produto_id" id="produto_id" value="{{ old('produto_id') }}"/>

        <div class="card shadow-sm">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="mb-0">Parâmetros de Cálculo</h5>
              <span class="badge bg-secondary" id="produto-badge" style="display:none;">Produto selecionado</span>
            </div>

            {{-- Resumo do produto selecionado --}}
            <div class="selected-product mb-3" id="selected-product" style="display:none;">
              <div class="d-flex align-items-start gap-3">
                <i class="fa-solid fa-box fs-3 text-muted"></i>
                <div class="flex-grow-1">
                  <div class="fw-semibold" id="sp-nome">—</div>
                  <div class="small text-muted">
                    <span id="sp-categoria">Categoria: —</span>
                  </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger" id="btn-clear-produto">
                  <i class="fa-solid fa-xmark"></i>
                </button>
              </div>
              <hr>
            </div>

            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Preço de Custo</label>
                <input type="number" step="0.01" name="preco_custo" class="form-control" required value="{{ old('preco_custo') }}">
                <div class="invalid-feedback">Informe o preço de custo.</div>
              </div>
              <div class="col-md-4">
                <label class="form-label">Frete (unitário)</label>
                <input type="number" step="0.01" name="frete" class="form-control" value="{{ old('frete', 0) }}">
              </div>
              <div class="col-md-4">
                <label class="form-label">Outras Despesas</label>
                <input type="number" step="0.01" name="outras_despesas" class="form-control" value="{{ old('outras_despesas', 0) }}">
              </div>

              <div class="col-md-3">
                <label class="form-label">ICMS (%)</label>
                <input type="number" step="0.01" name="icms" class="form-control" placeholder="18" required value="{{ old('icms') }}">
                <div class="invalid-feedback">Informe o ICMS.</div>
              </div>
              <div class="col-md-3">
                <label class="form-label">PIS (%)</label>
                <input type="number" step="0.01" name="pis" class="form-control" placeholder="1.65" required value="{{ old('pis') }}">
                <div class="invalid-feedback">Informe o PIS.</div>
              </div>
              <div class="col-md-3">
                <label class="form-label">COFINS (%)</label>
                <input type="number" step="0.01" name="cofins" class="form-control" placeholder="7.60" required value="{{ old('cofins') }}">
                <div class="invalid-feedback">Informe o COFINS.</div>
              </div>

              <div class="col-md-3">
                <label class="form-label">Modo de Margem</label>
                <select name="margem_calculo" class="form-select">
                  <option value="markup" {{ (old('margem_calculo','markup')==='markup') ? 'selected' : '' }}>Mark-up sobre custo</option>
                  <option value="margin" {{ (old('margem_calculo')==='margin') ? 'selected' : '' }}>Margem líquida no preço</option>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label">Margem Desejada (%)</label>
                <input type="number" step="0.01" name="margem_lucro" class="form-control" placeholder="25" required value="{{ old('margem_lucro') }}">
                <div class="invalid-feedback">Informe a margem desejada.</div>
              </div>

              <div class="col-md-3">
                <label class="form-label">Tipo de Simulação</label>
                <select name="tipo_simulacao" class="form-select">
                  <option value="">—</option>
                  <option value="promocao" {{ (old('tipo_simulacao')==='promocao') ? 'selected' : '' }}>Promoção</option>
                  <option value="oferta" {{ (old('tipo_simulacao')==='oferta') ? 'selected' : '' }}>Oferta</option>
                  <option value="baixar_preco" {{ (old('tipo_simulacao')==='baixar_preco') ? 'selected' : '' }}>Baixar preço</option>
                  <option value="aumentar_lucro" {{ (old('tipo_simulacao')==='aumentar_lucro') ? 'selected' : '' }}>Aumentar lucro</option>
                </select>
              </div>

              <div class="col-12">
                <label class="form-label">Observações</label>
                <textarea name="observacoes" class="form-control" rows="2">{{ old('observacoes') }}</textarea>
              </div>
            </div>

            <div class="mt-3 d-flex gap-2">
              <button class="btn btn-primary">
                <i class="fa-solid fa-calculator me-2"></i> Calcular & Salvar
              </button>
            </div>
          </div>
        </div>
      </form>

      {{-- Resultado --}}
      @if(session('calc'))
        @php $c = session('calc'); @endphp
        <div class="card mt-3 shadow-sm">
          <div class="card-body">
            <h5 class="mb-3">Resultado da Simulação</h5>
            <ul class="list-unstyled">
              <li><strong>Preço sugerido:</strong> R$ {{ number_format($c['preco_sugerido'],2,',','.') }}</li>
              <li><strong>Custo base:</strong> R$ {{ number_format($c['custo_base'],2,',','.') }}</li>
              <li><strong>Tributos ({{ number_format($c['t_total']*100,2,',','.') }}%):</strong> R$ {{ number_format($c['tributos_valor'],2,',','.') }}</li>
              <li><strong>Lucro estimado:</strong> R$ {{ number_format($c['lucro_valor'],2,',','.') }}</li>
              <li><strong>Margem efetiva:</strong> {{ number_format($c['margem_efetiva']*100,2,',','.') }}%</li>
              <li><strong>Markup efetivo:</strong> {{ number_format($c['markup_efetivo']*100,2,',','.') }}%</li>
            </ul>
          </div>
        </div>
      @endif
    </div>

    {{-- Lista de produtos direita --}}
    <div class="col-12 col-lg-4">
      <div class="card shadow-sm h-100">
        <div class="card-body d-flex flex-column">
          <h5 class="mb-3"><i class="fa-solid fa-box me-2"></i>Produtos</h5>

          {{-- Busca --}}
          <form method="GET" action="{{ route('simulacoes-precos.create') }}" class="row g-2 mb-3" role="search">
            <div class="col-9">
              <input type="search" name="q" class="form-control" placeholder="Buscar por nome" value="{{ request('q') }}">
            </div>
            <div class="col-3 d-grid">
              <button class="btn btn-outline-primary" title="Buscar" aria-label="Buscar">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </div>
          </form>

          {{-- Lista com rolagem --}}
          <div class="product-list-scroll">
            <table class="table align-middle mb-0">
              <thead>
                <tr>
                  <th>Produto</th>
                  <th class="text-end">Ações</th>
                </tr>
              </thead>
              <tbody>
              @forelse($produtos as $p)
                <tr id="row-prod-{{ $p->id }}">
                  <td>
                    <div class="fw-semibold">{{ $p->descricao }}</div>
                    <div class="small text-muted">{{ data_get($p, 'categoria.descricao', '—') }}</div>
                  </td>
                  <td class="text-end">
                    <div class="btn-group">
                      {{-- Ícone somente: Visualizar --}}
                      <button type="button"
                              class="btn btn-sm btn-outline-info btn-visualizar-produto"
                              title="Visualizar"
                              aria-label="Visualizar"
                              data-bs-toggle="modal"
                              data-bs-target="#modalProduto"
                              data-id="{{ $p->id }}"
                              data-nome="{{ $p->descricao }}"
                              data-categoria="{{ data_get($p, 'categoria.descricao', '—') }}"
                              data-ncm="{{ data_get($p, 'ncmItem.codigo', '—') }}"
                              data-ncm-desc="{{ data_get($p, 'ncmItem.descricao', '') }}"
                              data-unidade="{{ $p->unidade_medida ?? '—' }}"
                              data-preco-custo="{{ number_format($p->preco_custo, 2, ',', '.') }}"
                              data-preco-venda="{{ number_format($p->preco_venda, 2, ',', '.') }}"
                              data-estoque="{{ $p->estoque }}"
                              data-margem="{{ $p->margem_lucro ?? '—' }}"
                              data-icms="{{ $p->icms ?? '—' }}"
                              data-pis="{{ $p->pis ?? '—' }}"
                              data-cofins="{{ $p->cofins ?? '—' }}">
                        <i class="fa-regular fa-eye"></i>
                      </button>

                      {{-- Ícone somente: Selecionar --}}
                      <button type="button"
                              class="btn btn-sm btn-outline-success btn-selecionar-produto"
                              title="Selecionar"
                              aria-label="Selecionar"
                              data-id="{{ $p->id }}"
                              data-nome="{{ $p->descricao }}"
                              data-categoria="{{ data_get($p, 'categoria.descricao', '—') }}">
                        <i class="fa-solid fa-check"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="2" class="text-center text-muted">Nenhum produto encontrado.</td>
                </tr>
              @endforelse
              </tbody>
            </table>
          </div>

          {{-- Paginação (fora da área rolável) --}}
          <div class="d-flex justify-content-center mt-3">
            {{ $produtos->withQueryString()->links() }}
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

{{-- Modal de visualização do produto --}}
<div class="modal fade" id="modalProduto" tabindex="-1" aria-labelledby="modalProdutoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalProdutoLabel"><i class="fa-solid fa-box me-2"></i><span id="m-nome">Produto</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <div class="mb-2"><strong>Categoria:</strong> <span id="m-categoria">—</span></div>
            <div class="mb-2"><strong>NCM:</strong> <span id="m-ncm">—</span> <small class="text-muted d-block" id="m-ncm-desc"></small></div>
            <div class="mb-2"><strong>Unidade:</strong> <span id="m-unidade">—</span></div>
            <div class="mb-2"><strong>Estoque:</strong> <span id="m-estoque">—</span></div>
          </div>
          <div class="col-md-6">
            <div class="mb-2"><strong>Preço de custo:</strong> R$ <span id="m-preco-custo">—</span></div>
            <div class="mb-2"><strong>Preço de venda:</strong> R$ <span id="m-preco-venda">—</span></div>
            <div class="mb-2"><strong>Margem (produto):</strong> <span id="m-margem">—</span>%</div>
            <div class="mb-2"><strong>Tributos (cadastro):</strong>
              ICMS <span id="m-icms">—</span>% •
              PIS <span id="m-pis">—</span>% •
              COFINS <span id="m-cofins">—</span>%
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button"
                class="btn btn-success"
                id="modal-selecionar-produto">
          <i class="fa-solid fa-check me-1"></i> Selecionar este produto
        </button>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  // Popover Bootstrap
  document.querySelectorAll('[data-bs-toggle="popover"]').forEach(el => {
    new bootstrap.Popover(el, { trigger: 'focus' });
  });

  // Coachmark
  (function(){
    document.getElementById('hint-simulador-precos')?.classList.remove('d-none');
  })();

  // Validação e exigência de produto
  (function () {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        const prodId = document.getElementById('produto_id').value;
        if (!prodId) {
          event.preventDefault(); event.stopPropagation();
          alert('Selecione um produto na lista antes de calcular.');
          return;
        }
        if (!form.checkValidity()) {
          event.preventDefault(); event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();

  // Seleção + Modal
  (function () {
    const inputId = document.getElementById('produto_id');
    const selCard = document.getElementById('selected-product');
    const badge = document.getElementById('produto-badge');
    const btnClear = document.getElementById('btn-clear-produto');

    function destacarLinha(id) {
      document.querySelectorAll('tr[id^="row-prod-"]').forEach(tr => tr.classList.remove('table-success'));
      document.getElementById('row-prod-' + id)?.classList.add('table-success');
    }

    function renderResumo({id, nome, categoria}) {
      inputId.value = id;
      document.getElementById('sp-nome').textContent = nome || '—';
      document.getElementById('sp-categoria').textContent = `Categoria: ${categoria || '—'}`;
      selCard.style.display = 'block';
      badge.style.display = 'inline-block';
      destacarLinha(id);
    }

    // Botão "Selecionar" na tabela
    document.querySelectorAll('.btn-selecionar-produto').forEach(btn => {
      btn.addEventListener('click', function(){
        renderResumo({
          id: this.dataset.id,
          nome: this.dataset.nome,
          categoria: this.dataset.categoria
        });
      });
    });

    // Botão "Visualizar" -> preenche modal
    const modalEl = document.getElementById('modalProduto');

    document.querySelectorAll('.btn-visualizar-produto').forEach(btn => {
      btn.addEventListener('click', function(){
        document.getElementById('m-nome').textContent       = this.dataset.nome || '—';
        document.getElementById('m-categoria').textContent  = this.dataset.categoria || '—';
        document.getElementById('m-ncm').textContent        = this.dataset.ncm || '—';
        document.getElementById('m-ncm-desc').textContent   = this.dataset.ncmDesc || '';
        document.getElementById('m-unidade').textContent    = this.dataset.unidade || '—';
        document.getElementById('m-estoque').textContent    = this.dataset.estoque ?? '—';
        document.getElementById('m-preco-custo').textContent= this.dataset.precoCusto || '—';
        document.getElementById('m-preco-venda').textContent= this.dataset.precoVenda || '—';
        document.getElementById('m-margem').textContent     = (this.dataset.margem ?? '—');
        document.getElementById('m-icms').textContent       = (this.dataset.icms ?? '—');
        document.getElementById('m-pis').textContent        = (this.dataset.pis ?? '—');
        document.getElementById('m-cofins').textContent     = (this.dataset.cofins ?? '—');

        // Passa os dados para o botão "Selecionar este produto" do modal
        const btnSel = document.getElementById('modal-selecionar-produto');
        btnSel.dataset.id        = this.dataset.id;
        btnSel.dataset.nome      = this.dataset.nome;
        btnSel.dataset.categoria = this.dataset.categoria;
      });
    });

    // Botão "Selecionar este produto" dentro do modal
    document.getElementById('modal-selecionar-produto')?.addEventListener('click', function(){
      renderResumo({
        id: this.dataset.id,
        nome: this.dataset.nome,
        categoria: this.dataset.categoria
      });
      // fecha modal
      const modal = bootstrap.Modal.getInstance(modalEl);
      modal?.hide();
    });

    // Limpar seleção
    btnClear?.addEventListener('click', function(){
      inputId.value = '';
      selCard.style.display = 'none';
      badge.style.display = 'none';
      document.querySelectorAll('tr[id^="row-prod-"]').forEach(tr => tr.classList.remove('table-success'));
    });

    // Restaura seleção (old)
    const oldId = inputId.value;
    if (oldId) {
      const btn = document.querySelector(`.btn-selecionar-produto[data-id="${oldId}"]`);
      if (btn) {
        renderResumo({
          id: oldId,
          nome: btn.dataset.nome,
          categoria: btn.dataset.categoria
        });
      }
    }
  })();
</script>
@endpush
@endsection
