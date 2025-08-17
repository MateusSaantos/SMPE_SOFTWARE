{{-- Modal de confirmação de exclusão --}}
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
        <h5 class="modal-title fw-bold mb-1" id="confirmDeleteTitle">Remover fornecedor?</h5>
        <p class="text-muted mb-0" id="confirmDeleteMessage">
          Essa ação não pode ser desfeita.
        </p>
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
