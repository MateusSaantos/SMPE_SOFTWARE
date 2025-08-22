{{-- resources/views/produtos/form.blade.php --}}
@csrf

<div class="card shadow-sm c-form">
  <div class="card-header d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
      <i class="fa-solid fa-box"></i>
      <strong>{{ isset($produto) ? 'Editar Produto' : 'Cadastrar Produto' }}</strong>
    </div>
    <span class="badge text-bg-primary">{{ isset($produto) ? 'Edição' : 'Novo' }}</span>
  </div>

  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Descrição</label>
        <input type="text"
               name="descricao"
               value="{{ old('descricao', $produto->descricao ?? '') }}"
               class="form-control"
               maxlength="255"
               required>
        <div class="invalid-feedback">Informe a descrição.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">Código de Barras</label>
        <input type="text"
               name="codigo_barras"
               value="{{ old('codigo_barras', $produto->codigo_barras ?? '') }}"
               class="form-control text-mono js-digits"
               placeholder="Somente números"
               inputmode="numeric"
               pattern="\d{8,14}">
        <div class="form-text">8 a 14 dígitos. Opcional.</div>
        <div class="invalid-feedback">Informe 8–14 dígitos ou deixe em branco.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">Unidade de Medida</label>
        <select name="unidade_medida" class="form-select" required>
          @php $um = old('unidade_medida', $produto->unidade_medida ?? 'UN'); @endphp
          @foreach(['UN','KG','LT','CX','PC'] as $opt)
            <option value="{{ $opt }}" {{ $um === $opt ? 'selected' : '' }}>{{ $opt }}</option>
          @endforeach
        </select>
        <div class="invalid-feedback">Selecione a unidade.</div>
      </div>

      <div class="col-md-6">
        <label class="form-label">Categoria do Produto</label>
        <select name="categoria_produto" class="form-select" required>
          @php $catSel = old('categoria_produto', $produto->categoria_produto ?? ''); @endphp
          <option value="" disabled {{ $catSel==='' ? 'selected' : '' }}>Selecione...</option>
          @foreach($categorias as $c)
            <option value="{{ $c->id }}" {{ (string)$catSel === (string)$c->id ? 'selected' : '' }}>
              {{ $c->descricao }}
            </option>
          @endforeach
        </select>
        <div class="invalid-feedback">Selecione a categoria.</div>
      </div>

      <div class="col-md-6">
        <label class="form-label">NCM</label>
        <select name="ncm" class="form-select" required>
          @php $ncmSel = old('ncm', $produto->ncm ?? ''); @endphp
          <option value="" disabled {{ $ncmSel==='' ? 'selected' : '' }}>Selecione...</option>
          @foreach($ncms as $n)
            <option value="{{ $n->id }}" {{ (string)$ncmSel === (string)$n->id ? 'selected' : '' }}>
              {{ $n->codigo }} — {{ $n->descricao }}
            </option>
          @endforeach
        </select>
        <div class="invalid-feedback">Selecione o NCM.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">CEST</label>
        <input type="text"
               name="cest"
               value="{{ old('cest', $produto->cest ?? '') }}"
               class="form-control text-mono js-digits"
               placeholder="0000000"
               inputmode="numeric"
               pattern="\d{7}">
        <div class="form-text">7 dígitos. Opcional.</div>
        <div class="invalid-feedback">Informe 7 dígitos ou deixe em branco.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">Margem de Lucro (%)</label>
        <input type="text"
               name="margem_lucro"
               value="{{ old('margem_lucro', $produto->margem_lucro ?? '0') }}"
               class="form-control text-mono js-decimal"
               inputmode="decimal">
        <div class="invalid-feedback">Informe um número válido.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">Preço de Custo (R$)</label>
        <input type="text"
               name="preco_custo"
               value="{{ old('preco_custo', $produto->preco_custo ?? '0,00') }}"
               class="form-control text-end text-mono js-decimal"
               inputmode="decimal"
               required>
        <div class="invalid-feedback">Informe o preço de custo.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">Preço de Venda (R$)</label>
        <input type="text"
               name="preco_venda"
               value="{{ old('preco_venda', $produto->preco_venda ?? '0,00') }}"
               class="form-control text-end text-mono js-decimal"
               inputmode="decimal"
               required>
        <div class="invalid-feedback">Informe o preço de venda.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">ICMS (%)</label>
        <input type="text"
               name="icms"
               value="{{ old('icms', $produto->icms ?? '0') }}"
               class="form-control text-mono js-decimal"
               inputmode="decimal">
      </div>

      <div class="col-md-3">
        <label class="form-label">PIS (%)</label>
        <input type="text"
               name="pis"
               value="{{ old('pis', $produto->pis ?? '0') }}"
               class="form-control text-mono js-decimal"
               inputmode="decimal">
      </div>

      <div class="col-md-3">
        <label class="form-label">COFINS (%)</label>
        <input type="text"
               name="cofins"
               value="{{ old('cofins', $produto->cofins ?? '0') }}"
               class="form-control text-mono js-decimal"
               inputmode="decimal">
      </div>

      <div class="col-md-3">
        <label class="form-label">Estoque</label>
        <input type="text"
               name="estoque"
               value="{{ old('estoque', $produto->estoque ?? '0') }}"
               class="form-control text-end text-mono js-integer"
               inputmode="numeric"
               required>
        <div class="invalid-feedback">Informe o estoque.</div>
      </div>

      <div class="col-md-3 d-flex align-items-end">
        <div class="form-check form-switch">
          @php $ativo = old('ativo', isset($produto) ? (int)$produto->ativo : 1); @endphp
          <input class="form-check-input" type="checkbox" role="switch" id="ativoSwitch" name="ativo" value="1" {{ $ativo ? 'checked' : '' }}>
          <label class="form-check-label" for="ativoSwitch">Ativo</label>
        </div>
      </div>
    </div>
  </div>

  <div class="card-footer d-flex justify-content-end gap-2">
    <button type="submit" class="btn btn-primary">
      <i class="fa-solid fa-floppy-disk"></i>
      {{ isset($produto) ? 'Salvar alterações' : 'Salvar' }}
    </button>
    <a class="btn btn-light" href="{{ route('produtos.index') }}">Cancelar</a>
  </div>
</div>

@push('scripts')
<script>
(() => {
  'use strict';

  // Validação e normalização
  const forms = document.querySelectorAll('.needs-validation');
  const toDecimal = (v) => {
    v = (v || '').toString().trim().replace(/\./g,'').replace(',', '.');
    if (v === '') return '';
    return v;
  };
  const onlyDigits = (v) => (v || '').replace(/\D/g, '');

  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      // normaliza decimais
      form.querySelectorAll('.js-decimal').forEach(inp => { inp.value = toDecimal(inp.value); });
      // inteiros e dígitos
      form.querySelectorAll('.js-integer').forEach(inp => { inp.value = onlyDigits(inp.value); });
      form.querySelectorAll('.js-digits').forEach(inp => { inp.value = onlyDigits(inp.value); });

      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });

  // máscaras suaves
  document.querySelectorAll('.js-integer').forEach(inp => {
    inp.addEventListener('input', () => inp.value = onlyDigits(inp.value));
  });
  document.querySelectorAll('.js-digits').forEach(inp => {
    inp.addEventListener('input', () => inp.value = onlyDigits(inp.value));
  });
})();
</script>
@endpush
