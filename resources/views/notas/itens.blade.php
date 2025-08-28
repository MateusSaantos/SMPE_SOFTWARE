@extends('layout')

@section('conteudo')
@push('styles')
  <link href="{{ asset('css/pages/fornecedores_index.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pages/fornecedores_create.css') }}" rel="stylesheet">
  <link href="{{ asset('css/components/confirm.css') }}" rel="stylesheet">
@endpush

<div class="container py-3 py-md-4">
  <div class="page-head">
    <div class="page-head__left">
      <i class="fa-solid fa-list page-head__icon"></i>
      <div>
        <h1 class="page-head__title">Itens da Nota</h1>
        <p class="page-head__subtitle">Adicione ou edite os itens desta nota.</p>
      </div>
    </div>
    <a class="btn btn-light" href="{{ route('notas.show', $nota->id) }}">Voltar à capa</a>
  </div>

  {{-- Resumo da nota --}}
  <div class="card shadow-sm mb-3">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-3"><strong>Número/Série:</strong><br>{{ $nota->numero }} / {{ $nota->serie ?: '—' }}</div>
        <div class="col-md-3"><strong>Emissão:</strong><br>{{ $nota->data_emissao ? $nota->data_emissao->format('d/m/Y') : '—' }}</div>
        <div class="col-md-4"><strong>Fornecedor:</strong><br>{{ $nota->fornecedor->razao_social ?? '—' }}</div>
        <div class="col-md-2"><strong>Total:</strong><br><span class="text-mono">R$ {{ number_format($nota->valor_total, 2, ',', '.') }}</span></div>
      </div>
    </div>
  </div>

  {{-- Form adicionar item --}}
  <form method="POST" action="{{ route('notas.itens.store', $nota->id) }}" class="needs-validation mb-3" novalidate>
    @csrf
    <div class="card shadow-sm c-form">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
          <i class="fa-solid fa-plus"></i>
          <strong>Adicionar Item</strong>
        </div>
        <span class="badge text-bg-primary">Novo</span>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-2">
            <label class="form-label">Quantidade</label>
            <input type="text" name="quantidade" class="form-control text-end text-mono js-decimal" inputmode="decimal" required>
            <div class="invalid-feedback">Informe a quantidade.</div>
          </div>
          <div class="col-md-2">
            <label class="form-label">Valor Unit. (R$)</label>
            <input type="text" name="valor_unitario" class="form-control text-end text-mono js-decimal" inputmode="decimal" required>
            <div class="invalid-feedback">Informe o valor unitário.</div>
          </div>
          <div class="col-md-4">
            <label class="form-label">NCM</label>
            <select name="ncm" class="form-select" required>
              <option value="" selected disabled>Selecione...</option>
              @foreach($ncms as $n)
                <option value="{{ $n->id }}">{{ $n->codigo }} — {{ $n->descricao }}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">Selecione o NCM.</div>
          </div>
          <div class="col-md-2">
            <label class="form-label">CEST</label>
            <input type="text" name="cest" class="form-control text-mono js-digits" placeholder="0000000" inputmode="numeric" pattern="\d{7}">
            <div class="form-text">7 dígitos (opcional)</div>
            <div class="invalid-feedback">Informe 7 dígitos ou deixe em branco.</div>
          </div>
          <div class="col-md-4">
            <label class="form-label">ICMS (%)</label>
            <input type="text" name="icms" class="form-control text-mono js-decimal" inputmode="decimal" value="0">
          </div>
          <div class="col-md-4">
            <label class="form-label">PIS (%)</label>
            <input type="text" name="pis" class="form-control text-mono js-decimal" inputmode="decimal" value="0">
          </div>
          <div class="col-md-4">
            <label class="form-label">COFINS (%)</label>
            <input type="text" name="cofins" class="form-control text-mono js-decimal" inputmode="decimal" value="0">
          </div>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-end gap-2">
        <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Adicionar</button>
      </div>
    </div>
  </form>

  {{-- Lista de itens --}}
  <div class="data-card">
    <div class="table-responsive">
      <table class="table table-hiper align-middle">
        <colgroup>
          <col style="width:160px"><!-- Qtd -->
          <col style="width:160px"><!-- Unit -->
          <col style="width:220px"><!-- NCM -->
          <col style="width:140px"><!-- CEST -->
          <col style="width:120px"><!-- ICMS -->
          <col style="width:120px"><!-- PIS -->
          <col style="width:120px"><!-- COFINS -->
          <col style="width:160px"><!-- Total linha -->
          <col style="width:160px"><!-- Ações -->
        </colgroup>
        <thead>
          <tr>
            <th class="text-end">Qtd</th>
            <th class="text-end">Valor Unit.</th>
            <th>NCM</th>
            <th>CEST</th>
            <th class="text-end">ICMS %</th>
            <th class="text-end">PIS %</th>
            <th class="text-end">COFINS %</th>
            <th class="text-end">Total</th>
            <th class="text-end">Ações</th>
          </tr>
        </thead>
        <tbody>
        @forelse($nota->itens as $item)
          <tr>
            <td class="text-end text-mono">{{ number_format($item->quantidade, 3, ',', '.') }}</td>
            <td class="text-end text-mono">R$ {{ number_format($item->valor_unitario, 2, ',', '.') }}</td>
            <td class="text-mono">{{ $item->ncmItem?->codigo }} — {{ $item->ncmItem?->descricao }}</td>
            <td class="text-mono">{{ $item->cest ?: '—' }}</td>
            <td class="text-end text-mono">{{ number_format($item->icms, 2, ',', '.') }}</td>
            <td class="text-end text-mono">{{ number_format($item->pis, 2, ',', '.') }}</td>
            <td class="text-end text-mono">{{ number_format($item->cofins, 2, ',', '.') }}</td>
            <td class="text-end text-mono">R$ {{ number_format($item->total, 2, ',', '.') }}</td>
            <td class="text-end">
              <div class="btn-group btn-group-actions">
                <button class="btn btn-icon" type="button" data-bs-toggle="collapse" data-bs-target="#edit-{{ $item->id }}" aria-expanded="false" title="Editar">
                  <i class="fa-regular fa-pen-to-square"></i>
                </button>

                <form id="del-item-{{ $item->id }}" action="{{ route('notas.itens.destroy', [$nota->id, $item->id]) }}" method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button type="button" class="btn btn-icon text-danger js-open-delete"
                          data-form="del-item-{{ $item->id }}"
                          data-title="Remover item?"
                          data-message="Remover este item da nota? Essa ação não pode ser desfeita."
                          title="Excluir">
                    <i class="fa-regular fa-trash-can"></i>
                  </button>
                </form>
              </div>

              <div class="collapse mt-2" id="edit-{{ $item->id }}">
                <form method="POST" action="{{ route('notas.itens.update', [$nota->id, $item->id]) }}" class="needs-validation" novalidate>
                  @csrf @method('PUT')
                  <div class="row g-2">
                    <div class="col-md-2">
                      <label class="form-label small m-0">Qtd</label>
                      <input type="text" name="quantidade" value="{{ number_format($item->quantidade, 3, ',', '.') }}" class="form-control form-control-sm text-end text-mono js-decimal" required>
                    </div>
                    <div class="col-md-2">
                      <label class="form-label small m-0">Valor Unit.</label>
                      <input type="text" name="valor_unitario" value="{{ number_format($item->valor_unitario, 2, ',', '.') }}" class="form-control form-control-sm text-end text-mono js-decimal" required>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label small m-0">NCM</label>
                      <select name="ncm" class="form-select form-select-sm" required>
                        @foreach($ncms as $n)
                          <option value="{{ $n->id }}" {{ (string)$item->ncm === (string)$n->id ? 'selected' : '' }}>
                            {{ $n->codigo }} — {{ $n->descricao }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-2">
                      <label class="form-label small m-0">CEST</label>
                      <input type="text" name="cest" value="{{ $item->cest }}" class="form-control form-control-sm text-mono js-digits" pattern="\d{7}">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label small m-0">ICMS %</label>
                      <input type="text" name="icms" value="{{ number_format($item->icms, 2, ',', '.') }}" class="form-control form-control-sm text-mono js-decimal">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label small m-0">PIS %</label>
                      <input type="text" name="pis" value="{{ number_format($item->pis, 2, ',', '.') }}" class="form-control form-control-sm text-mono js-decimal">
                    </div>
                    <div class="col-md-2">
                      <label class="form-label small m-0">COFINS %</label>
                      <input type="text" name="cofins" value="{{ number_format($item->cofins, 2, ',', '.') }}" class="form-control form-control-sm text-mono js-decimal">
                    </div>
                    <div class="col-12 d-flex justify-content-end mt-2">
                      <button class="btn btn-sm btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i> Salvar</button>
                    </div>
                  </div>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="9" class="text-center text-muted">Nenhum item adicionado ainda.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
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
        <h5 class="modal-title fw-bold mb-1" id="confirmDeleteTitle">Remover item?</h5>
        <p class="text-muted mb-0" id="confirmDeleteMessage">Essa ação não pode ser desfeita.</p>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn"><i class="fa-regular fa-trash-can me-2"></i> Remover</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
(function(){
  // Confirmação excluir
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

// Validação / normalização numérica
(function(){
  const forms=document.querySelectorAll('.needs-validation');
  const toDec=v=>(v||'').toString().replace(/\./g,'').replace(',', '.');
  const onlyDigits=v=>(v||'').replace(/\D/g,'');
  Array.from(forms).forEach(f=>{
    f.addEventListener('submit',e=>{
      f.querySelectorAll('.js-decimal').forEach(i=>i.value=toDec(i.value));
      f.querySelectorAll('.js-digits').forEach(i=>i.value=onlyDigits(i.value));
      if(!f.checkValidity()){ e.preventDefault(); e.stopPropagation(); }
      f.classList.add('was-validated');
    });
  });
})();
</script>
@endpush
@endsection
