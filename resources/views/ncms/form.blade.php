{{-- resources/views/ncms/form.blade.php --}}
@csrf

<div class="card shadow-sm c-form">
  <div class="card-header d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
      <i class="fa-solid fa-barcode"></i>
      <strong>{{ isset($ncm) ? 'Editar NCM' : 'Cadastrar NCM' }}</strong>
    </div>
    <span class="badge text-bg-primary">{{ isset($ncm) ? 'Edição' : 'Novo' }}</span>
  </div>

  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Código (8 dígitos)</label>
        <input type="text"
               name="codigo"
               value="{{ old('codigo', $ncm->codigo ?? '') }}"
               class="form-control js-codigo-ncm text-mono"
               placeholder="00000000"
               inputmode="numeric"
               pattern="\d{8}"
               required>
        <div class="form-text">Somente números (8 dígitos).</div>
        <div class="invalid-feedback">Informe um código NCM válido (8 dígitos).</div>
      </div>

      <div class="col-md-8">
        <label class="form-label">Descrição</label>
        <input type="text"
               name="descricao"
               value="{{ old('descricao', $ncm->descricao ?? '') }}"
               class="form-control"
               maxlength="255"
               required>
        <div class="invalid-feedback">Informe a descrição.</div>
      </div>
    </div>
  </div>

  <div class="card-footer d-flex justify-content-end gap-2">
    <button type="submit" class="btn btn-primary">
      <i class="fa-solid fa-floppy-disk"></i>
      {{ isset($ncm) ? 'Salvar alterações' : 'Salvar' }}
    </button>
    <a class="btn btn-light" href="{{ route('ncms.index') }}">Cancelar</a>
  </div>
</div>

@push('scripts')
<script>
(() => {
  'use strict';
  const forms = document.querySelectorAll('.needs-validation');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      const code = form.querySelector('.js-codigo-ncm');
      if (code) code.value = (code.value || '').replace(/\D/g, '').slice(0,8);

      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });

  // máscara suave (00000000)
  const code = document.querySelector('.js-codigo-ncm');
  if (code) {
    code.addEventListener('input', () => {
      code.value = (code.value || '').replace(/\D/g, '').slice(0,8);
    });
  }
})();
</script>
@endpush
