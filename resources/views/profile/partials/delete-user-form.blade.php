<section>
    <div class="alert alert-danger">
        <h6 class="alert-heading">
            <i class="bi bi-exclamation-triangle me-2"></i>
            Eliminar Cuenta
        </h6>
        <p class="mb-3">
            Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. 
            Antes de eliminar tu cuenta, descarga cualquier dato o información que desees conservar.
        </p>
        <hr>
        <button type="button" 
                class="btn btn-danger" 
                data-bs-toggle="modal" 
                data-bs-target="#confirmDeleteModal">
            <i class="bi bi-trash me-2"></i>
            Eliminar Cuenta
        </button>
    </div>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger" id="confirmDeleteModalLabel">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        ¿Estás seguro de que quieres eliminar tu cuenta?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    
                    <div class="modal-body">
                        <p class="text-muted mb-4">
                            Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. 
                            Ingresa tu contraseña para confirmar que deseas eliminar permanentemente tu cuenta.
                        </p>

                        <div class="mb-3">
                            <label for="delete_password" class="form-label">Contraseña</label>
                            <input type="password" 
                                   class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                                   id="delete_password" 
                                   name="password" 
                                   placeholder="Ingresa tu contraseña"
                                   required>
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i>
                            Eliminar Cuenta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@if($errors->userDeletion->isNotEmpty())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        deleteModal.show();
    });
</script>
@endif
