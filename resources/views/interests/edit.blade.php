@extends('freeUser-template')

@section('title', 'Editar mis intereses')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="text-center mb-5">
                <div class="welcome-content">
                    <i class="bi bi-heart-fill welcome-icon text-primary"></i>
                    <h1 class="welcome-title mb-3">Edita tus intereses</h1>
                    <p class="welcome-subtitle">
                        Actualiza tus preferencias para mejorar tus recomendaciones personalizadas
                    </p>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Formulario -->
            <form action="{{ route('interests.update') }}" method="POST" id="interestsForm">
                @csrf
                @method('PUT')
                
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-heart me-2 text-primary"></i>
                                Mis Intereses
                            </h5>
                            <span class="badge bg-primary" id="selectionCount">
                                {{ count($userInterests) }} seleccionados
                            </span>
                        </div>
                        <p class="text-muted mb-0 mt-2">Selecciona todos los temas que te interesen</p>
                    </div>
                    
                    <div class="card-body">
                        <div class="interests-grid">
                            @forelse($interests as $interest)
                                <div class="interest-option fade-in" style="animation-delay: {{ $loop->index * 0.03 }}s">
                                    <input type="checkbox" 
                                           class="btn-check" 
                                           name="interests[]" 
                                           value="{{ $interest->id }}" 
                                           id="interest_{{ $interest->id }}"
                                           {{ in_array($interest->id, $userInterests) ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary interest-label" for="interest_{{ $interest->id }}">
                                        <div class="interest-content">
                                            <i class="bi bi-heart interest-icon"></i>
                                            <span class="interest-name">{{ $interest->name }}</span>
                                            @if($interest->description)
                                                <small class="interest-description">{{ $interest->description }}</small>
                                            @endif
                                        </div>
                                    </label>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-exclamation-circle display-4 text-muted mb-3"></i>
                                    <h5 class="text-muted">No hay intereses disponibles</h5>
                                    <p class="text-muted">Por favor, contacta al administrador.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white border-0 py-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('freeUser-template') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>
                                Volver al inicio
                            </a>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Guardar cambios
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Información adicional -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card border-0 bg-primary bg-opacity-10">
                        <div class="card-body text-center">
                            <i class="bi bi-lightbulb text-primary display-6 mb-3"></i>
                            <h6 class="card-title">¿Por qué es importante?</h6>
                            <p class="card-text small text-muted">
                                Tus intereses nos ayudan a recomendarte actividades, eventos y lugares 
                                que realmente disfrutarás.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 bg-success bg-opacity-10">
                        <div class="card-body text-center">
                            <i class="bi bi-shield-check text-success display-6 mb-3"></i>
                            <h6 class="card-title">Privacidad garantizada</h6>
                            <p class="card-text small text-muted">
                                Tus intereses son privados y solo se usan para mejorar tu experiencia 
                                en la plataforma.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.interests-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1rem;
    max-height: 500px;
    overflow-y: auto;
    padding: 1rem;
}

.interest-option {
    opacity: 0;
    transform: translateY(20px);
}

.interest-label {
    width: 100%;
    height: auto;
    padding: 1.25rem;
    border: 2px solid #dee2e6;
    border-radius: 12px;
    transition: all 0.3s ease;
    background: white;
}

.interest-label:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    border-color: var(--bs-primary);
}

.btn-check:checked + .interest-label {
    background: var(--bs-primary);
    border-color: var(--bs-primary);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(var(--bs-primary-rgb), 0.3);
}

.interest-content {
    text-align: center;
}

.interest-icon {
    font-size: 1.75rem;
    display: block;
    margin-bottom: 0.75rem;
    opacity: 0.7;
}

.btn-check:checked + .interest-label .interest-icon {
    opacity: 1;
}

.interest-name {
    font-weight: 600;
    font-size: 1rem;
    display: block;
    margin-bottom: 0.5rem;
}

.interest-description {
    opacity: 0.7;
    font-size: 0.85rem;
    display: block;
    line-height: 1.3;
}

.btn-check:checked + .interest-label .interest-description {
    opacity: 0.9;
}

.fade-in {
    animation: fadeInUp 0.6s ease forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .interests-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 0.75rem;
        max-height: 400px;
    }
    
    .interest-label {
        padding: 1rem;
    }
}

@media (max-width: 576px) {
    .interests-grid {
        grid-template-columns: 1fr 1fr;
    }
}
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('input[name="interests[]"]');
        const selectionCount = document.getElementById('selectionCount');
        
        function updateSelection() {
            const selected = document.querySelectorAll('input[name="interests[]"]:checked');
            const count = selected.length;
            
            selectionCount.textContent = count === 0 ? '0 seleccionados' : 
                count === 1 ? '1 seleccionado' : `${count} seleccionados`;
            
            selectionCount.className = count > 0 ? 'badge bg-primary' : 'badge bg-secondary';
        }
        
        // Agregar event listeners
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelection);
        });
        
        // Inicializar
        updateSelection();
    });
</script>
@endsection
