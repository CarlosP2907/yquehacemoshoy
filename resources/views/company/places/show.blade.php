@extends('company-template')

@section('title', $place->name)

@section('page-title', $place->name)
@section('page-subtitle', 'Detalles completos de tu lugar')

@section('page-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('company.places.edit', $place) }}" class="btn btn-warning">
            <i class="bi bi-pencil-square me-2"></i>
            Editar Lugar
        </a>
        <form action="{{ route('company.places.destroy', $place) }}" 
              method="POST" 
              class="d-inline"
              onsubmit="return confirm('¿Estás seguro de eliminar este lugar? Esta acción no se puede deshacer.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-trash me-2"></i>
                Eliminar
            </button>
        </form>
    </div>
@endsection

@section('content')
<div class="row">
    <!-- Información Principal -->
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Información General
                    </h5>
                    <span class="badge {{ $place->status === 'open' ? 'bg-success' : 'bg-danger' }}">
                        <i class="bi bi-{{ $place->status === 'open' ? 'check-circle' : 'x-circle' }} me-1"></i>
                        {{ $place->status === 'open' ? 'Abierto' : 'Cerrado' }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1">Nombre</h6>
                        <p class="mb-3">{{ $place->name }}</p>
                        
                        <h6 class="text-muted mb-1">Tipo de Lugar</h6>
                        <p class="mb-3">
                            <span class="badge bg-secondary">{{ $place->placeType->name ?? 'Sin tipo' }}</span>
                        </p>
                        
                        @if($place->price_range)
                        <h6 class="text-muted mb-1">Rango de Precios</h6>
                        <p class="mb-3">
                            <span class="text-success fw-bold">S/ {{ number_format($place->price_range, 2) }}</span>
                        </p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if($place->phone)
                        <h6 class="text-muted mb-1">Teléfono</h6>
                        <p class="mb-3">
                            <a href="tel:{{ $place->phone }}" class="text-decoration-none">
                                <i class="bi bi-telephone me-1"></i>
                                {{ $place->phone }}
                            </a>
                        </p>
                        @endif
                        
                        @if($place->website)
                        <h6 class="text-muted mb-1">Sitio Web</h6>
                        <p class="mb-3">
                            <a href="{{ $place->website }}" target="_blank" class="text-decoration-none">
                                <i class="bi bi-globe me-1"></i>
                                Ver sitio web
                                <i class="bi bi-box-arrow-up-right ms-1"></i>
                            </a>
                        </p>
                        @endif
                        
                        <h6 class="text-muted mb-1">Fecha de Registro</h6>
                        <p class="mb-3">
                            <i class="bi bi-calendar me-1"></i>
                            {{ $place->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>
                
                @if($place->description)
                <div class="mt-3">
                    <h6 class="text-muted mb-2">Descripción</h6>
                    <div class="bg-light p-3 rounded">
                        {{ $place->description }}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Ubicación -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="bi bi-geo-alt-fill me-2"></i>
                    Ubicación
                </h5>
            </div>
            <div class="card-body">
                @if($place->location || $place->latitude || $place->longitude)
                    <div class="row">
                        @if($place->location)
                        <div class="col-md-12 mb-3">
                            <h6 class="text-muted mb-1">Dirección</h6>
                            <p class="mb-0">
                                <i class="bi bi-geo-alt me-1"></i>
                                {{ $place->location }}
                            </p>
                        </div>
                        @endif
                        
                        @if($place->latitude && $place->longitude)
                        <div class="col-md-6">
                            <h6 class="text-muted mb-1">Latitud</h6>
                            <p class="mb-0">{{ $place->latitude }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-1">Longitud</h6>
                            <p class="mb-0">{{ $place->longitude }}</p>
                        </div>
                        
                        <div class="col-12 mt-3">
                            <a href="https://www.google.com/maps?q={{ $place->latitude }},{{ $place->longitude }}" 
                               target="_blank" 
                               class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-map me-1"></i>
                                Ver en Google Maps
                                <i class="bi bi-box-arrow-up-right ms-1"></i>
                            </a>
                        </div>
                        @endif
                    </div>
                @else
                    <div class="text-center text-muted py-3">
                        <i class="bi bi-geo-alt" style="font-size: 2rem;"></i>
                        <p class="mb-0">No hay información de ubicación disponible</p>
                        <a href="{{ route('company.places.edit', $place) }}" class="btn btn-sm btn-outline-primary mt-2">
                            Agregar ubicación
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Intereses -->
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="bi bi-heart-fill me-2"></i>
                    Intereses Relacionados
                </h5>
            </div>
            <div class="card-body">
                @if($place->interests->count() > 0)
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($place->interests as $interest)
                            <span class="badge bg-light text-dark border px-3 py-2">
                                <i class="bi bi-heart me-1"></i>
                                {{ $interest->name }}
                            </span>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Los usuarios con estos intereses podrán encontrar más fácilmente tu lugar.
                        </small>
                    </div>
                @else
                    <div class="text-center text-muted py-3">
                        <i class="bi bi-heart" style="font-size: 2rem;"></i>
                        <p class="mb-0">No hay intereses asociados a este lugar</p>
                        <a href="{{ route('company.places.edit', $place) }}" class="btn btn-sm btn-outline-success mt-2">
                            Agregar intereses
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Imagen -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-image-fill me-2"></i>
                    Imagen Principal
                </h5>
            </div>
            <div class="card-body text-center">
                @if($place->image)
                    <img src="{{ Storage::url($place->image) }}" 
                         alt="{{ $place->name }}" 
                         class="img-fluid rounded mb-3" 
                         style="max-height: 300px; object-fit: cover;">
                    <div>
                        <a href="{{ route('company.places.edit', $place) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil me-1"></i>
                            Cambiar imagen
                        </a>
                    </div>
                @else
                    <div class="py-4">
                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-2 mb-3">No hay imagen disponible</p>
                        <a href="{{ route('company.places.edit', $place) }}" class="btn btn-outline-primary">
                            <i class="bi bi-cloud-upload me-1"></i>
                            Subir imagen
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Estadísticas Rápidas -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="bi bi-graph-up me-2"></i>
                    Estadísticas
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="text-primary mb-0">{{ $place->interests->count() }}</h4>
                            <small class="text-muted">Intereses</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="text-success mb-0">
                            {{ $place->status === 'open' ? 'Activo' : 'Inactivo' }}
                        </h4>
                        <small class="text-muted">Estado</small>
                    </div>
                </div>
                
                <hr class="my-3">
                
                <div class="text-center">
                    <small class="text-muted d-block">Última actualización</small>
                    <span class="text-primary">{{ $place->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        <!-- Acciones Rápidas -->
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="bi bi-lightning-fill me-2"></i>
                    Acciones Rápidas
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('company.places.edit', $place) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square me-2"></i>
                        Editar Lugar
                    </a>
                    
                    <button class="btn btn-outline-secondary" onclick="copyLink()">
                        <i class="bi bi-link-45deg me-2"></i>
                        Copiar enlace
                    </button>
                    
                    <hr class="my-2">
                    
                    <button class="btn btn-outline-danger" onclick="confirmDelete()">
                        <i class="bi bi-trash me-2"></i>
                        Eliminar Lugar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function copyLink() {
    const url = "{{ route('places.show', $place) }}";
    navigator.clipboard.writeText(url).then(function() {
        // Crear un toast o alert temporal
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.innerHTML = '<i class="bi bi-check-circle me-2"></i>Enlace copiado al portapapeles';
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            z-index: 9999;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        `;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    });
}

function confirmDelete() {
    if (confirm('¿Estás seguro de eliminar este lugar? Esta acción no se puede deshacer.')) {
        // Encontrar el formulario de eliminar y enviarlo
        const form = document.querySelector('form[action*="destroy"]');
        if (form) {
            form.submit();
        }
    }
}
</script>
@endpush
