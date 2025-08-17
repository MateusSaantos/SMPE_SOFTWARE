{{-- resources/views/fornecedores/_form.blade.php --}}
@csrf

<div class="card shadow-sm c-form">
  <div class="card-header d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
      <i class="fa-solid fa-truck-field"></i>
      <strong>{{ isset($fornecedor) ? 'Editar Fornecedor' : 'Cadastrar Fornecedor' }}</strong>
    </div>
    <span class="badge text-bg-primary">{{ isset($fornecedor) ? 'Edição' : 'Novo' }}</span>
  </div>

  <div class="card-body">
    {{-- Identificação --}}
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">CNPJ</label>
        <input type="text"
               name="cnpj"
               value="{{ old('cnpj', $fornecedor->cnpj ?? '') }}"
               placeholder="00.000.000/0000-00"
               class="form-control js-cnpj"
               inputmode="numeric"
               pattern="\d{2}\.?\d{3}\.?\d{3}/?\d{4}-?\d{2}"
               {{ isset($fornecedor) ? 'readonly' : '' }}
               {{ isset($fornecedor) ? '' : 'required' }}>
        <div class="form-text">Somente números ou formatado.</div>
        <div class="invalid-feedback">Informe um CNPJ válido.</div>
      </div>

      <div class="col-md-8">
        <label class="form-label">Razão Social</label>
        <input type="text" name="razao_social" value="{{ old('razao_social', $fornecedor->razao_social ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe a razão social.</div>
      </div>

      <div class="col-md-6">
        <label class="form-label">Nome Fantasia</label>
        <input type="text" name="nome_fantasia" value="{{ old('nome_fantasia', $fornecedor->nome_fantasia ?? '') }}" class="form-control">
        <div class="form-text">Opcional.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">Telefone</label>
        <input type="text"
               name="telefone"
               value="{{ old('telefone', $fornecedor->telefone ?? '') }}"
               class="form-control js-telefone"
               placeholder="(00) 00000-0000"
               inputmode="numeric">
        <div class="invalid-feedback">Informe um telefone válido.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">Inscrição Estadual</label>
        <input type="text" name="inscricao_estadual" value="{{ old('inscricao_estadual', $fornecedor->inscricao_estadual ?? '') }}" class="form-control">
        <div class="form-text">Opcional em alguns casos.</div>
      </div>
    </div>

    <hr class="my-4">

    {{-- Endereço --}}
    <div class="d-flex align-items-center gap-2 mb-2">
      <i class="fa-solid fa-location-dot"></i>
      <h5 class="m-0">Endereço</h5>
    </div>

    @php $e = $fornecedor->endereco ?? null; @endphp
    <div class="row g-3">
      <div class="col-md-3">
        <label class="form-label">CEP</label>
        <input type="text"
               name="cep"
               value="{{ old('cep', $e->cep ?? '') }}"
               class="form-control js-cep"
               placeholder="00000-000"
               inputmode="numeric"
               pattern="\d{5}-?\d{3}"
               required>
        <div class="invalid-feedback">Informe um CEP válido.</div>
      </div>

      <div class="col-md-2">
        <label class="form-label">UF</label>
        <input type="text"
               name="uf"
               value="{{ old('uf', $e->uf ?? '') }}"
               class="form-control text-uppercase js-uf"
               maxlength="2"
               pattern="[A-Za-z]{2}"
               placeholder="UF"
               required>
        <div class="invalid-feedback">Informe a UF (ex.: MG).</div>
      </div>

      <div class="col-md-7">
        <label class="form-label">Cidade</label>
        <input type="text" name="cidade" value="{{ old('cidade', $e->cidade ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe a cidade.</div>
      </div>

      <div class="col-md-5">
        <label class="form-label">Bairro</label>
        <input type="text" name="bairro" value="{{ old('bairro', $e->bairro ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe o bairro.</div>
      </div>

      <div class="col-md-5">
        <label class="form-label">Logradouro</label>
        <input type="text" name="logradouro" value="{{ old('logradouro', $e->logradouro ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe o logradouro.</div>
      </div>

      <div class="col-md-2">
        <label class="form-label">Número</label>
        <input type="text" name="numero" value="{{ old('numero', $e->numero ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe o número.</div>
      </div>

      <div class="col-12">
        <label class="form-label">Complemento</label>
        <input type="text" name="complemento" value="{{ old('complemento', $e->complemento ?? '') }}" class="form-control" placeholder="Apto, sala, referência...">
      </div>
    </div>
  </div>

  <div class="card-footer d-flex justify-content-end gap-2">
    <button type="submit" class="btn btn-primary">
      <i class="fa-solid fa-floppy-disk"></i> {{ isset($fornecedor) ? 'Salvar alterações' : 'Salvar' }}
    </button>
    <a class="btn btn-light" href="{{ route('fornecedores.index') }}">Cancelar</a>
  </div>
</div>

@push('scripts')
<script>
(() => {
  'use strict';

  // Bootstrap validation
  const forms = document.querySelectorAll('.needs-validation');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      // Sanitiza antes de validar/enviar
      const cnpj = form.querySelector('.js-cnpj');
      if (cnpj && !cnpj.readOnly) cnpj.value = (cnpj.value || '').replace(/\D/g, '');

      const cep = form.querySelector('.js-cep');
      if (cep) cep.value = (cep.value || '').replace(/\D/g, '').replace(/^(\d{5})(\d{3}).*/, '$1-$2');

      const tel = form.querySelector('.js-telefone');
      if (tel) {
        const d = (tel.value || '').replace(/\D/g, '');
        // Formata dinamicamente como (00) 00000-0000 ou (00) 0000-0000
        tel.value = d.length > 10
          ? d.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3')
          : d.replace(/^(\d{2})(\d{4,5})(\d{4}).*/, '($1) $2-$3');
      }

      const uf = form.querySelector('.js-uf');
      if (uf) uf.value = (uf.value || '').toUpperCase();

      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });

  // Máscaras suaves em tempo real (sem libs)
  const maskOnInput = (el, re, fmt) => {
    el.addEventListener('input', () => {
      const digits = el.value.replace(/\D/g, '');
      el.value = digits.replace(re, fmt);
    });
  };

  const cnpj = document.querySelector('.js-cnpj');
  if (cnpj && !cnpj.readOnly) {
    // 00.000.000/0000-00
    maskOnInput(cnpj, /^(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,4})(\d{0,2}).*/, (m,a,b,c,d,e)=>
      [a, b?'.'+b:'', c?'.'+c:'', d?'/'+d:'', e?'-'+e:''].join('')
    );
  }

  const cep = document.querySelector('.js-cep');
  if (cep) maskOnInput(cep, /^(\d{0,5})(\d{0,3}).*/, (m,a,b)=> b ? a+'-'+b : a);

  const tel = document.querySelector('.js-telefone');
  if (tel) {
    tel.addEventListener('input', () => {
      const d = tel.value.replace(/\D/g, '');
      tel.value = d.length > 10
        ? d.replace(/^(\d{0,2})(\d{0,5})(\d{0,4}).*/, (m,a,b,c)=> (a?`(${a}) `:'') + (b || '') + (c?`-${c}`:''))
        : d.replace(/^(\d{0,2})(\d{0,4,5})(\d{0,4}).*/, (m,a,b,c)=> (a?`(${a}) `:'') + (b || '') + (c?`-${c}`:''));
    });
  }
})();
</script>
@endpush
