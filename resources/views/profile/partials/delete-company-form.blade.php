<section class="space-y-6">
    <header>
        <h2 class="h5 fw-semibold text-danger">
            {{ __('Eliminar Empresa') }}
        </h2>

        <p class="text-muted small">
            {{ __('Una vez que se elimine tu empresa, todos sus recursos y datos se eliminarán permanentemente. Antes de eliminar tu empresa, descarga cualquier dato o información que desees conservar.') }}
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-company-deletion">
        <i class="bi bi-exclamation-triangle me-1"></i>
        {{ __('Eliminar Empresa') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirm-company-deletion" tabindex="-1" aria-labelledby="confirm-company-deletion-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('company.profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header border-0">
                        <h5 class="modal-title text-danger" id="confirm-company-deletion-label">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ __('¿Estás seguro de que quieres eliminar tu empresa?') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted">
                            {{ __('Una vez que se elimine tu empresa, todos sus recursos y datos se eliminarán permanentemente. Ingresa tu contraseña para confirmar que deseas eliminar permanentemente tu empresa.') }}
                        </p>

                        <div class="mt-3">
                            <label for="password" class="form-label visually-hidden">{{ __('Contraseña') }}</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control @error('password', 'companyDeletion') is-invalid @enderror"
                                placeholder="{{ __('Contraseña') }}"
                            >
                            @error('password', 'companyDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Cancelar') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i>
                            {{ __('Eliminar Empresa') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@if ($errors->companyDeletion->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = new bootstrap.Modal(document.getElementById('confirm-company-deletion'));
            modal.show();
        });
    </script>
@endif
