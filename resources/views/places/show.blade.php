@extends('freeUser-template')

@section('title', $place->name)

@section('page-title', $place->name)
@section('page-subtitle', $place->placeType->name ?? 'Lugar')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Contenido Principal -->
        <div class="col-lg-8">
            <!-- Galería de Imagen -->
            <div class="card shadow-sm mb-4">
                <div class="position-relative">
                    @if($place->image)
                        <img src="{{ Storage::url($place->image) }}" 
                             class="card-img-top" 
                             alt="{{ $place->name }}"
                             style="height: 400px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                             style="height: 400px;">
                            <div class="text-center">
                                <i class="bi bi-image text-muted mb-3" style="font-size: 4rem;"></i>
                                <p class="text-muted">No hay imagen disponible</p>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Estado del lugar -->
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge {{ $place->status === 'open' ? 'bg-success' : 'bg-danger' }} fs-6">
                            <i class="bi bi-{{ $place->status === 'open' ? 'check-circle' : 'x-circle' }} me-1"></i>
                            {{ $place->status === 'open' ? 'Abierto' : 'Cerrado' }}
                        </span>
                    </div>

                    <!-- Tipo de lugar -->
                    <div class="position-absolute bottom-0 start-0 m-3">
                        <span class="badge bg-dark bg-opacity-75 fs-6">
                            <i class="bi bi-tag me-1"></i>
                            {{ $place->placeType->name ?? 'Sin categoría' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Información Principal -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="h3 mb-3">{{ $place->name }}</h1>
                            
                            @if($place->company)
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-building text-primary me-2"></i>
                                    <span class="text-muted">Por {{ $place->company->name }}</span>
                                </div>
                            @endif

                            @if($place->description)
                                <div class="mb-4">
                                    <h5 class="mb-2">Acerca de este lugar</h5>
                                    <p class="text-muted">{{ $place->description }}</p>
                                </div>
                            @endif
                        </div>
                        
                        <div class="col-md-4">
                            <!-- Información de contacto -->
                            @if($place->price_range)
                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Precio promedio</h6>
                                    <p class="h5 text-success mb-0">
                                        <i class="bi bi-currency-colon"></i>
                                        ₡ {{ number_format($place->price_range, 2) }}
                                    </p>
                                </div>
                            @endif

                            @if($place->phone || $place->website)
                                <div class="mb-3">
                                    <h6 class="text-muted mb-2">Contacto</h6>
                                    @if($place->phone)
                                        <div class="mb-2">
                                            <a href="tel:{{ $place->phone }}" 
                                               class="btn btn-outline-success btn-sm">
                                                <i class="bi bi-telephone me-1"></i>
                                                {{ $place->phone }}
                                            </a>
                                        </div>
                                    @endif
                                    @if($place->website)
                                        <div class="mb-2">
                                            <a href="{{ $place->website }}" 
                                               target="_blank" 
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-globe me-1"></i>
                                                Sitio Web
                                                <i class="bi bi-box-arrow-up-right ms-1"></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Intereses -->
            @if($place->interests->count() > 0)
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">
                            <i class="bi bi-heart text-danger me-2"></i>
                            Intereses relacionados
                        </h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($place->interests as $interest)
                                <span class="badge bg-light text-dark border px-3 py-2">
                                    <i class="bi bi-heart me-1"></i>
                                    {{ $interest->name }}
                                </span>
                            @endforeach
                        </div>
                        
                        @auth
                            @php
                                $userInterests = auth()->user()->interests->pluck('id')->toArray();
                                $matchingInterests = $place->interests->whereIn('id', $userInterests);
                            @endphp
                            @if($matchingInterests->count() > 0)
                                <div class="alert alert-info mt-3">
                                    <i class="bi bi-lightbulb me-2"></i>
                                    <strong>¡Perfecto para ti!</strong> 
                                    Este lugar coincide con {{ $matchingInterests->count() }} de tus intereses:
                                    @foreach($matchingInterests as $interest)
                                        <span class="badge bg-primary ms-1">{{ $interest->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @endif

            <!-- Ubicación -->
            @if($place->location || ($place->latitude && $place->longitude))
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">
                            <i class="bi bi-geo-alt text-primary me-2"></i>
                            Ubicación
                        </h5>
                        
                        @if($place->location)
                            <p class="mb-3">
                                <i class="bi bi-geo-alt me-1"></i>
                                {{ $place->location }}
                            </p>
                        @endif

                        @if($place->latitude && $place->longitude)
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="https://www.google.com/maps?q={{ $place->latitude }},{{ $place->longitude }}" 
                                   target="_blank" 
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-map me-1"></i>
                                    Ver en Google Maps
                                    <i class="bi bi-box-arrow-up-right ms-1"></i>
                                </a>
                                
                                <a href="https://waze.com/ul?ll={{ $place->latitude }},{{ $place->longitude }}&navigate=yes" 
                                   target="_blank" 
                                   class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-signpost me-1"></i>
                                    Abrir en Waze
                                    <i class="bi bi-box-arrow-up-right ms-1"></i>
                                </a>

                                <button class="btn btn-outline-secondary btn-sm" onclick="copyCoordinates()">
                                    <i class="bi bi-clipboard me-1"></i>
                                    Copiar coordenadas
                                </button>
                            </div>
                            
                            <div class="mt-3 small text-muted">
                                <strong>Coordenadas:</strong> {{ $place->latitude }}, {{ $place->longitude }}
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Acciones Rápidas -->
            <div class="card shadow-sm mb-4 sticky-top" style="top: 20px;">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-lightning-fill me-2"></i>
                        Acciones
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($place->phone)
                            <a href="tel:{{ $place->phone }}" class="btn btn-success">
                                <i class="bi bi-telephone-fill me-2"></i>
                                Llamar ahora
                            </a>
                        @endif
                        
                        @if($place->website)
                            <a href="{{ $place->website }}" target="_blank" class="btn btn-primary">
                                <i class="bi bi-globe me-2"></i>
                                Visitar sitio web
                                <i class="bi bi-box-arrow-up-right ms-1"></i>
                            </a>
                        @endif

                        @if($place->latitude && $place->longitude)
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $place->latitude }},{{ $place->longitude }}" 
                               target="_blank" 
                               class="btn btn-outline-primary">
                                <i class="bi bi-map me-2"></i>
                                Cómo llegar
                                <i class="bi bi-box-arrow-up-right ms-1"></i>
                            </a>
                        @endif

                        <button class="btn btn-outline-secondary" onclick="sharePlace()">
                            <i class="bi bi-share me-2"></i>
                            Compartir lugar
                        </button>

                        @auth
                            <button class="btn btn-outline-danger" onclick="addToFavorites()">
                                <i class="bi bi-heart me-2"></i>
                                Guardar en favoritos
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-info">
                                <i class="bi bi-person-plus me-2"></i>
                                Inicia sesión para guardar
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Información de la empresa -->
            @if($place->company)
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-building me-2"></i>
                            Empresa
                        </h5>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-2">{{ $place->company->name }}</h6>
                        
                        @if($place->company->description)
                            <p class="text-muted small mb-3">{{ Str::limit($place->company->description, 100) }}</p>
                        @endif

                        <div class="row text-center small">
                            <div class="col-12">
                                <div class="">
                                    <strong class="d-block text-primary">{{ $place->company->places->count() }}</strong>
                                    <small class="text-muted">Lugares</small>
                                </div>
                            </div>
                        </div>

                        @if($place->company->website)
                            <div class="mt-3">
                                <a href="{{ $place->company->website }}" 
                                   target="_blank" 
                                   class="btn btn-outline-primary btn-sm w-100">
                                    <i class="bi bi-globe me-1"></i>
                                    Ver empresa
                                    <i class="bi bi-box-arrow-up-right ms-1"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Horarios de Atención -->
            @if($place->schedules->count() > 0)
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-clock me-2"></i>
                            Horarios de Atención
                        </h5>
                    </div>
                    <div class="card-body">
                        @php
                            $today = strtolower(now()->format('l')); // monday, tuesday, etc.
                            $todaySchedule = $place->schedules->where('day_of_week', $today)->first();
                        @endphp
                        
                        <!-- Estado actual -->
                        @if($todaySchedule)
                            <div class="alert {{ $place->isOpenNow() ? 'alert-success' : 'alert-warning' }} mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-{{ $place->isOpenNow() ? 'check-circle' : 'clock' }} me-2"></i>
                                    <div>
                                        <strong>
                                            {{ $place->isOpenNow() ? 'Abierto ahora' : 'Cerrado ahora' }}
                                        </strong>
                                        <div class="small">
                                            Hoy: {{ $todaySchedule->formatted_schedule }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Horarios de la semana -->
                        <div class="schedule-list">
                            @foreach($place->schedules as $schedule)
                                <div class="d-flex justify-content-between align-items-center py-2 {{ $schedule->day_of_week === $today ? 'bg-light rounded px-2' : '' }}">
                                    <div class="fw-{{ $schedule->day_of_week === $today ? 'bold' : 'normal' }}">
                                        {{ $schedule->day_name }}
                                        @if($schedule->day_of_week === $today)
                                            <small class="badge bg-primary ms-1">Hoy</small>
                                        @endif
                                    </div>
                                    <div class="text-end {{ $schedule->day_of_week === $today ? 'fw-bold' : 'text-muted' }}">
                                        {{ $schedule->formatted_schedule }}
                                        @if($schedule->special_note)
                                            <div class="small text-muted">{{ $schedule->special_note }}</div>
                                        @endif
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <hr class="my-1">
                                @endif
                            @endforeach
                        </div>

                        <!-- Nota sobre horarios especiales -->
                        <div class="mt-3 text-center">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Los horarios pueden variar en días festivos o fechas especiales
                            </small>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Lugares similares -->
            @if($similarPlaces->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-stars me-2"></i>
                            También te podría interesar
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        @foreach($similarPlaces as $similarPlace)
                            <div class="border-bottom p-3 {{ $loop->last ? '' : '' }}">
                                <div class="d-flex">
                                    <div class="me-3">
                                        @if($similarPlace->image)
                                            <img src="{{ Storage::url($similarPlace->image) }}" 
                                                 alt="{{ $similarPlace->name }}" 
                                                 class="rounded"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                 style="width: 60px; height: 60px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">
                                            <a href="{{ route('places.show', $similarPlace) }}" 
                                               class="text-decoration-none">
                                                {{ $similarPlace->name }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">{{ $similarPlace->placeType->name ?? 'Sin tipo' }}</small>
                                        @if($similarPlace->company)
                                            <br><small class="text-muted">{{ $similarPlace->company->name }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="p-3">
                            <a href="{{ route('places.index') }}" class="btn btn-outline-info btn-sm w-100">
                                <i class="bi bi-search me-1"></i>
                                Ver más lugares
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function copyCoordinates() {
    const coords = "{{ $place->latitude }}, {{ $place->longitude }}";
    navigator.clipboard.writeText(coords).then(function() {
        showToast('Coordenadas copiadas al portapapeles', 'success');
    });
}

function sharePlace() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $place->name }}',
            text: 'Mira este lugar increíble que encontré',
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href).then(function() {
            showToast('Enlace copiado al portapapeles', 'success');
        });
    }
}

function addToFavorites() {
    // Aquí iría la lógica para agregar a favoritos
    showToast('Funcionalidad de favoritos próximamente', 'info');
}

function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `
        <i class="bi bi-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
        ${message}
    `;
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#28a745' : '#17a2b8'};
        color: white;
        padding: 12px 20px;
        border-radius: 5px;
        z-index: 9999;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        animation: slideIn 0.3s ease;
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// CSS para animaciones
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
document.head.appendChild(style);
</script>
@endpush
