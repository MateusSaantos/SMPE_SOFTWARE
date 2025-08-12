@push('styles')
<link href="{{ asset('css/pages/empresa-form.css') }}" rel="stylesheet">
@endpush

<div class="card shadow-sm c-form">
  <div class="card-header d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
      <i class="fa-solid fa-building"></i>
      <strong>{{ isset($empresa) ? 'Editar Empresa' : 'Cadastrar Empresa' }}</strong>
    </div>
    <span class="badge text-bg-primary">{{ isset($empresa) ? 'Edição' : 'Novo' }}</span>
  </div>

  <div class="card-body">
    {{-- Identificação --}}
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">CNPJ</label>
        <input type="text"
               name="cnpj"
               value="{{ old('cnpj', $empresa->cnpj ?? '') }}"
               placeholder="00.000.000/0000-00"
               class="form-control"
               inputmode="numeric"
               pattern="\d{2}\.?\d{3}\.?\d{3}/?\d{4}-?\d{2}"
               {{ isset($empresa) ? 'readonly' : '' }}
               required>
        <div class="form-text">Somente números ou formatado.</div>
        <div class="invalid-feedback">Informe um CNPJ válido.</div>
      </div>

      <div class="col-md-8">
        <label class="form-label">Razão Social</label>
        <input type="text" name="razao_social" value="{{ old('razao_social', $empresa->razao_social ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe a razão social.</div>
      </div>

      <div class="col-md-6">
        <label class="form-label">Nome Fantasia</label>
        <input type="text" name="nome_fantasia" value="{{ old('nome_fantasia', $empresa->nome_fantasia ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe o nome fantasia.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" value="{{ old('telefone', $empresa->telefone ?? '') }}" class="form-control" placeholder="(00) 00000-0000" inputmode="numeric" required>
        <div class="invalid-feedback">Informe o telefone.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">Inscrição Estadual</label>
        <input type="text" name="inscricao_estadual" value="{{ old('inscricao_estadual', $empresa->inscricao_estadual ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe a IE.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">Data de Abertura</label>
        <input type="date" name="data_abertura" value="{{ old('data_abertura', $empresa->data_abertura ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe a data de abertura.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">Porte</label>
        <input type="text" name="porte" value="{{ old('porte', $empresa->porte ?? '') }}" class="form-control" placeholder="ME / EPP / MEI ..." required>
        <div class="invalid-feedback">Informe o porte.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">E-mail</label>
        <input type="email" name="email" value="{{ old('email', $empresa->email ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe um e-mail válido.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">Regime Tributário</label>
        <input type="text" name="regime_tributario" value="{{ old('regime_tributario', $empresa->regime_tributario ?? '') }}" class="form-control" placeholder="Simples / Presumido / Real" required>
        <div class="invalid-feedback">Informe o regime tributário.</div>
      </div>

      <div class="col-md-3">
        <label class="form-label">CNAE</label>
        <input type="text" name="cnae" value="{{ old('cnae', $empresa->cnae ?? '') }}" class="form-control" placeholder="0000-0/00" required>
        <div class="invalid-feedback">Informe o CNAE.</div>
      </div>

      <div class="col-md-3 d-flex align-items-end gap-4">
        {{-- Switch MEI --}}
        <input type="hidden" name="optante_mei" value="0">
        <div class="form-check form-switch">
          <input class="form-check-input"
                 type="checkbox"
                 role="switch"
                 id="optante_mei"
                 name="optante_mei"
                 value="1"
                 {{ old('optante_mei', $empresa->optante_mei ?? 0) == 1 ? 'checked' : '' }}>
          <label class="form-check-label" for="optante_mei">Optante MEI</label>
        </div>

        {{-- Campo Ativa sempre ligado e não editável --}}
        <input type="hidden" name="status" value="1">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="status" checked disabled>
          <label class="form-check-label" for="status">Ativa</label>
        </div>
      </div>
    </div>

    <hr class="my-4">

    {{-- Endereço --}}
    <div class="d-flex align-items-center gap-2 mb-2">
      <i class="fa-solid fa-location-dot"></i>
      <h5 class="m-0">Endereço</h5>
    </div>

    <div class="row g-3">
      <div class="col-md-3">
        <label class="form-label">CEP</label>
        <input type="text" name="cep" value="{{ old('cep', $empresa->endereco->cep ?? '') }}" class="form-control" placeholder="00000-000" inputmode="numeric" required>
        <div class="invalid-feedback">Informe o CEP.</div>
      </div>
      <div class="col-md-2">
        <label class="form-label">UF</label>
        <input type="text" name="uf" value="{{ old('uf', $empresa->endereco->uf ?? '') }}" class="form-control text-uppercase" maxlength="2" placeholder="UF" required>
        <div class="invalid-feedback">Informe a UF.</div>
      </div>
      <div class="col-md-7">
        <label class="form-label">Cidade</label>
        <input type="text" name="cidade" value="{{ old('cidade', $empresa->endereco->cidade ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe a cidade.</div>
      </div>

      <div class="col-md-5">
        <label class="form-label">Bairro</label>
        <input type="text" name="bairro" value="{{ old('bairro', $empresa->endereco->bairro ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe o bairro.</div>
      </div>
      <div class="col-md-5">
        <label class="form-label">Logradouro</label>
        <input type="text" name="logradouro" value="{{ old('logradouro', $empresa->endereco->logradouro ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe o logradouro.</div>
      </div>
      <div class="col-md-2">
        <label class="form-label">Número</label>
        <input type="text" name="numero" value="{{ old('numero', $empresa->endereco->numero ?? '') }}" class="form-control" required>
        <div class="invalid-feedback">Informe o número.</div>
      </div>
      <div class="col-12">
        <label class="form-label">Complemento</label>
        <input type="text" name="complemento" value="{{ old('complemento', $empresa->endereco->complemento ?? '') }}" class="form-control" placeholder="Apto, sala, referência...">
      </div>
    </div>
  </div>

  <div class="card-footer d-flex justify-content-end gap-2">
    <a href="{{ route('empresas.index') }}" class="btn btn-outline-secondary">
      <i class="fa-solid fa-arrow-left"></i> Voltar
    </a>
    <button type="submit" class="btn btn-primary">
      <i class="fa-solid fa-floppy-disk"></i> {{ isset($empresa) ? 'Salvar alterações' : 'Salvar e continuar' }}
    </button>
  </div>
</div>

@push('scripts')
<script>
(() => {
  'use strict';
  const forms = document.querySelectorAll('.needs-validation');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();
</script>
@endpush
