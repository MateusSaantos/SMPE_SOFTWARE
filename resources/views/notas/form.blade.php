@csrf

<div class="card shadow-sm c-form">
  <div class="card-header d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
      <i class="fa-solid fa-file-invoice"></i>
      <strong>{{ isset($nota) ? 'Editar Capa' : 'Cadastrar Capa' }}</strong>
    </div>
    <span class="badge text-bg-primary">{{ isset($nota) ? 'Edição' : 'Novo' }}</span>
  </div>

  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-3">
        <label class="form-label">Número</label>
        <input type="text" name="numero" value="{{ old('numero', $nota->numero ?? '') }}" class="form-control" maxlength="15" required>
        <div class="invalid-feedback">Informe o número da nota.</div>
      </div>

      <div class="col-md-2">
        <label class="form-label">Série</label>
        <input type="text" name="serie" value="{{ old('serie', $nota->serie ?? '') }}" class="form-control" maxlength="5">
      </div>

      <div class="col-md-3">
        <label class="form-label">Data de Emissão</label>
        <input type="date" name="data_emissao" value="{{ old('data_emissao', isset($nota->data_emissao)?$nota->data_emissao->format('Y-m-d'):'') }}" class="form-control">
      </div>

      <div class="col-md-4">
        <label class="form-label">Fornecedor</label>
        <select name="fornecedor_cnpj" class="form-select" required>
          @php $forSel = old('fornecedor_cnpj', $nota->fornecedor_cnpj ?? ''); @endphp
          <option value="" disabled {{ $forSel==='' ? 'selected' : '' }}>Selecione...</option>
          @foreach($fornecedores as $f)
            <option value="{{ $f->cnpj }}" {{ (string)$forSel === (string)$f->cnpj ? 'selected' : '' }}>
              {{ $f->razao_social }} — {{ $f->cnpj }}
            </option>
          @endforeach
        </select>
        <div class="invalid-feedback">Selecione o fornecedor.</div>
      </div>

      <div class="col-md-4">
        <label class="form-label">CNPJ Destinatário</label>
        <input type="text" name="cnpj_dest" value="{{ old('cnpj_dest', $nota->cnpj_dest ?? '') }}" class="form-control text-mono js-digits" placeholder="Somente números (14)" inputmode="numeric" pattern="\d{14}">
        <div class="invalid-feedback">Informe 14 dígitos.</div>
      </div>

      <div class="col-md-4">
        <label class="form-label">Chave de Acesso</label>
        <input type="text" name="chave_acesso" value="{{ old('chave_acesso', $nota->chave_acesso ?? '') }}" class="form-control text-mono js-digits" placeholder="44 dígitos" inputmode="numeric" pattern="\d{44}">
        <div class="invalid-feedback">Informe 44 dígitos (ou deixe em branco).</div>
      </div>

      <div class="col-md-4">
        <label class="form-label">Data de Entrada</label>
        <input type="date" name="data_entrada" value="{{ old('data_entrada', isset($nota->data_entrada)?$nota->data_entrada->format('Y-m-d'):'') }}" class="form-control">
      </div>

      <div class="col-md-3">
        <label class="form-label">Tipo</label>
        <select name="tipo" class="form-select" required>
          @php $tipo = old('tipo', $nota->tipo ?? 'entrada'); @endphp
          @foreach(['entrada'=>'Entrada','saida'=>'Saída'] as $k=>$v)
            <option value="{{ $k }}" {{ $tipo===$k ? 'selected':'' }}>{{ $v }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
          @php $status = old('status', $nota->status ?? 'rascunho'); @endphp
          @foreach(['rascunho'=>'Rascunho','lancada'=>'Lançada','cancelada'=>'Cancelada'] as $k=>$v)
            <option value="{{ $k }}" {{ $status===$k ? 'selected':'' }}>{{ $v }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">Frete (R$)</label>
        <input type="text" name="frete" value="{{ old('frete', isset($nota)?number_format($nota->frete,2,',','.'):'0,00') }}" class="form-control text-end text-mono js-decimal" inputmode="decimal">
      </div>

      <div class="col-md-3">
        <label class="form-label">Outras Despesas (R$)</label>
        <input type="text" name="outras_despesas" value="{{ old('outras_despesas', isset($nota)?number_format($nota->outras_despesas,2,',','.'):'0,00') }}" class="form-control text-end text-mono js-decimal" inputmode="decimal">
      </div>

      <div class="col-12">
        <label class="form-label">Observação</label>
        <textarea name="observacao" class="form-control" rows="3">{{ old('observacao', $nota->observacao ?? '') }}</textarea>
      </div>
    </div>
  </div>

  <div class="card-footer d-flex justify-content-end gap-2">
    <button type="submit" class="btn btn-primary">
      <i class="fa-solid fa-floppy-disk"></i> {{ isset($nota) ? 'Salvar alterações' : 'Salvar e inserir itens' }}
    </button>
    <a class="btn btn-light" href="{{ route('notas.index') }}">Cancelar</a>
  </div>
</div>

@push('scripts')
<script>
(() => {
  'use strict';
  const forms = document.querySelectorAll('.needs-validation');

  const onlyDigits = v => (v || '').replace(/\D/g, '');
  const toDecimal  = v => {
    v = (v || '').toString().trim().replace(/\./g,'').replace(',', '.');
    return v === '' ? '' : v;
  };

  Array.from(forms).forEach(form => {
    form.addEventListener('submit', e => {
      // Normaliza campos
      form.querySelectorAll('.js-digits').forEach(inp => inp.value = onlyDigits(inp.value));
      form.querySelectorAll('.js-decimal').forEach(inp => inp.value = toDecimal(inp.value));

      if (!form.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();
</script>
@endpush
