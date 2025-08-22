{{-- resources/views/categorias/form.blade.php --}}
@csrf

<div class="card shadow-sm c-form">
  <div class="card-header d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
      <i class="fa-solid fa-tags"></i>
      <strong>{{ isset($categoria) ? 'Editar Categoria' : 'Cadastrar Categoria' }}</strong>
    </div>
    <span class="badge text-bg-primary">{{ isset($categoria) ? 'Edição' : 'Novo' }}</span>
  </div>

  <div class="card-body">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Descrição</label>
        <input type="text"
               name="descricao"
               value="{{ old('descricao', $categoria->descricao ?? '') }}"
               class="form-control"
               maxlength="255"
               required>
        <div class="invalid-feedback">Informe a descrição da categoria.</div>
      </div>

      <div class="col-12">
        <label class="form-label">Observação</label>
        <textarea name="observacao"
                  class="form-control"
                  rows="3"
                  placeholder="Opcional">{{ old('observacao', $categoria->observacao ?? '') }}</textarea>
      </div>
    </div>
  </div>

  <div class="card-footer d-flex justify-content-end gap-2">
    <button type="submit" class="btn btn-primary">
      <i class="fa-solid fa-floppy-disk"></i>
      {{ isset($categoria) ? 'Salvar alterações' : 'Salvar' }}
    </button>
    <a class="btn btn-light" href="{{ route('categorias.index') }}">Cancelar</a>
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
