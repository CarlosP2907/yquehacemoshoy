@extends('freeUser-template')

@section('title', 'Descubre Lugares')

@section('page-title', 'Descubre Lugares Increíbles')
@section('page-subtitle', 'Encuentra los mejores lugares basados en tus intereses')

@section('content')
<div class="container-fluid">
    <!-- Sección de Recomendaciones Personalizadas -->
    @auth
        @if(auth()->user()->interests->count() > 0)
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body text-white">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h3 class="mb-2">
                                    <i class="bi bi-stars me-2"></i>
                                    Lugares que te podrían interesar
                                </h3>
                                <p class="mb-0 opacity-75">
                                    Basado en tus intereses: 
                                    @foreach(auth()->user()->interests->take(3) as $interest)
                                        <span class="badge bg-white bg-opacity-25 me-1">{{ $interest->name }}</span>
                                    @endforeach
                                    @if(auth()->user()->interests->count() > 3)
                                        <span class="badge bg-white bg-opacity-25">+{{ auth()->user()->interests->count() - 3 }}</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="{{ route('interests.edit') }}" class="btn btn-light btn-sm">
                                    <i class="bi bi-gear me-1"></i>
                                    Ajustar intereses
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endauth

    <!-- Filtros -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('places.index') }}" id="filtersForm">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label for="search" class="form-label">
                                    <i class="bi bi-search me-1"></i>
                                    Buscar
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="search" 
                                       name="search" 
                                       value="{{ request('search') }}" 
                                       placeholder="Nombre, descripción...">
                            </div>
                            
                            <div class="col-md-2">
                                <label for="place_type_id" class="form-label">
                                    <i class="bi bi-tags me-1"></i>
                                    Tipo
                                </label>
                                <select class="form-select" id="place_type_id" name="place_type_id">
                                    <option value="">Todos</option>
                                    @foreach($placeTypes as $type)
                                        <option value="{{ $type->id }}" {{ request('place_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @auth
                            <div class="col-md-2">
                                <label class="form-label">
                                    <i class="bi bi-heart me-1"></i>
                                    Filtros
                                </label>
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="my_interests" 
                                           name="my_interests" 
                                           value="1"
                                           {{ request('my_interests') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="my_interests">
                                        Mis intereses
                                    </label>
                                </div>
                            </div>
                            @endauth

                            <div class="col-md-2">
                                <label for="sort" class="form-label">
                                    <i class="bi bi-sort-down me-1"></i>
                                    Ordenar
                                </label>
                                <select class="form-select" id="sort" name="sort">
                                    <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Nombre</option>
                                    <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>Más recientes</option>
                                    <option value="rating" {{ request('sort') === 'rating' ? 'selected' : '' }}>Mejor valorados</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    <a href="{{ route('places.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-x-circle"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-info" 
                                            id="locationBtn"
                                            title="Lugares cercanos">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Grid de Lugares -->
    <div class="row" id="placesGrid">
        @forelse($places as $place)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm place-card" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $loop->index * 50 }}">
                    
                    <!-- Imagen del lugar -->
                    <div class="position-relative">
                        @if($place->image)
                            <img src="{{ Storage::url($place->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $place->name }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 200px;">
                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        
                        <!-- Badge de estado -->
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge {{ $place->status === 'open' ? 'bg-success' : 'bg-danger' }}">
                                {{ $place->status === 'open' ? 'Abierto' : 'Cerrado' }}
                            </span>
                        </div>

                        <!-- Badge de tipo -->
                        <div class="position-absolute bottom-0 start-0 m-2">
                            <span class="badge bg-dark bg-opacity-75">
                                {{ $place->placeType->name ?? 'Sin categoría' }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <!-- Nombre y empresa -->
                        <h5 class="card-title mb-2">{{ $place->name }}</h5>
                        @if($place->company)
                            <p class="text-muted mb-2 small">
                                <i class="bi bi-building me-1"></i>
                                {{ $place->company->name }}
                            </p>
                        @endif

                        <!-- Descripción -->
                        @if($place->description)
                            <p class="card-text text-muted small mb-3">
                                {{ Str::limit($place->description, 100) }}
                            </p>
                        @endif

                        <!-- Intereses -->
                        @if($place->interests->count() > 0)
                            <div class="mb-3">
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($place->interests->take(3) as $interest)
                                        <span class="badge bg-light text-dark border">
                                            <i class="bi bi-heart me-1"></i>
                                            {{ $interest->name }}
                                        </span>
                                    @endforeach
                                    @if($place->interests->count() > 3)
                                        <span class="badge bg-light text-muted border">
                                            +{{ $place->interests->count() - 3 }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Información adicional -->
                        <div class="mt-auto">
                            <div class="row text-center small text-muted mb-3">
                                @if($place->price_range)
                                    <div class="col-4">
                                        <i class="bi bi-currency-dollar"></i>
                                        S/ {{ number_format($place->price_range, 0) }}
                                    </div>
                                @endif
                                @if($place->location)
                                    <div class="col-{{ $place->price_range ? '4' : '6' }}">
                                        <i class="bi bi-geo-alt"></i>
                                        {{ Str::limit($place->location, 20) }}
                                    </div>
                                @endif
                                @if($place->schedules->count() > 0)
                                    <div class="col-{{ $place->price_range && $place->location ? '4' : ($place->price_range || $place->location ? '6' : '12') }}">
                                        @if($place->isOpenNow())
                                            <span class="text-success">
                                                <i class="bi bi-check-circle"></i>
                                                Abierto
                                            </span>
                                        @else
                                            <span class="text-warning">
                                                <i class="bi bi-clock"></i>
                                                Cerrado
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Botones de acción -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('places.show', $place) }}" 
                                   class="btn btn-primary btn-sm flex-fill">
                                    <i class="bi bi-eye me-1"></i>
                                    Ver Detalles
                                </a>
                                @if($place->website)
                                    <a href="{{ $place->website }}" 
                                       target="_blank" 
                                       class="btn btn-outline-secondary btn-sm"
                                       title="Sitio web">
                                        <i class="bi bi-globe"></i>
                                    </a>
                                @endif
                                @if($place->phone)
                                    <a href="tel:{{ $place->phone }}" 
                                       class="btn btn-outline-success btn-sm"
                                       title="Llamar">
                                        <i class="bi bi-telephone"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Estado vacío -->
            <div class="col-12">
                <div class="card border-0">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-search text-muted mb-3" style="font-size: 4rem;"></i>
                        <h4 class="text-muted mb-3">No encontramos lugares</h4>
                        <p class="text-muted mb-4">
                            Intenta ajustar tus filtros o buscar por otros términos.
                        </p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ route('places.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-clockwise me-1"></i>
                                Ver todos los lugares
                            </a>
                            @auth
                                @if(auth()->user()->interests->count() === 0)
                                    <a href="{{ route('interests.select') }}" class="btn btn-primary">
                                        <i class="bi bi-heart me-1"></i>
                                        Configurar mis intereses
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Paginación -->
    @if($places->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $places->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.place-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    border: none;
}

.place-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.bg-gradient {
    position: relative;
    overflow: hidden;
}

.bg-gradient::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    pointer-events: none;
}

.badge {
    font-size: 0.7rem;
}

.card-img-top {
    transition: transform 0.3s ease;
}

.place-card:hover .card-img-top {
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .place-card:hover {
        transform: none;
    }
    
    .place-card:hover .card-img-top {
        transform: none;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Geolocalización para lugares cercanos
    const locationBtn = document.getElementById('locationBtn');
    if (locationBtn && navigator.geolocation) {
        locationBtn.addEventListener('click', function() {
            locationBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span>';
            locationBtn.disabled = true;
            
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    
                    // Agregar parámetros de ubicación al formulario
                    const form = document.getElementById('filtersForm');
                    const latInput = document.createElement('input');
                    latInput.type = 'hidden';
                    latInput.name = 'latitude';
                    latInput.value = lat;
                    
                    const lngInput = document.createElement('input');
                    lngInput.type = 'hidden';
                    lngInput.name = 'longitude';
                    lngInput.value = lng;
                    
                    form.appendChild(latInput);
                    form.appendChild(lngInput);
                    form.submit();
                },
                function(error) {
                    alert('No se pudo obtener tu ubicación');
                    locationBtn.innerHTML = '<i class="bi bi-geo-alt-fill"></i>';
                    locationBtn.disabled = false;
                }
            );
        });
    } else if (locationBtn) {
        locationBtn.style.display = 'none';
    }

    // Auto-submit para algunos filtros
    document.getElementById('my_interests')?.addEventListener('change', function() {
        document.getElementById('filtersForm').submit();
    });
});
</script>
@endpush
