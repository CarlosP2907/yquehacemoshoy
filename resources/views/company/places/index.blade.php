@extends('company-template')

@section('title', 'Mis Lugares')

@section('page-title', 'Mis Lugares')
@section('page-subtitle', 'Gestiona los lugares y actividades de tu empresa')

@section('page-actions')
    <a href="{{ route('company.places.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>
        Crear Lugar
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Filtros -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('company.places.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Buscar</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Nombre del lugar...">
                    </div>
                    <div class="col-md-3">
                        <label for="place_type_id" class="form-label">Tipo de Lugar</label>
                        <select class="form-select" id="place_type_id" name="place_type_id">
                            <option value="">Todos los tipos</option>
                            <!-- Este select se poblará dinámicamente -->
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Estado</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Todos</option>
                            <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Abierto</option>
                            <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Cerrado</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div>
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="bi bi-search"></i>
                            </button>
                            <a href="{{ route('company.places.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lista de lugares -->
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-geo-alt me-2 text-primary"></i>
                    Lugares Registrados
                </h5>
                <span class="badge bg-primary">{{ $places->total() }} lugares</span>
            </div>
            <div class="card-body p-0">
                @if($places->count() > 0)
                    <!-- Vista de tabla para pantallas grandes -->
                    <div class="d-none d-lg-block">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Lugar</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th>Ubicación</th>
                                        <th>Intereses</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($places as $place)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if($place->image)
                                                    <img src="{{ Storage::url($place->image) }}" 
                                                         alt="{{ $place->name }}" 
                                                         class="rounded"
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                         style="width: 50px; height: 50px;">
                                                        <i class="bi bi-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-1">{{ $place->name }}</h6>
                                                @if($place->description)
                                                    <small class="text-muted">{{ Str::limit($place->description, 50) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $place->placeType->name ?? 'Sin tipo' }}</span>
                                    </td>
                                    <td>
                                        @if($place->status === 'open')
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i>
                                                Abierto
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle me-1"></i>
                                                Cerrado
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($place->location)
                                            <small class="text-muted">
                                                <i class="bi bi-geo-alt me-1"></i>
                                                {{ Str::limit($place->location, 30) }}
                                            </small>
                                        @else
                                            <small class="text-muted">Sin ubicación</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($place->interests->count() > 0)
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach($place->interests->take(2) as $interest)
                                                    <span class="badge bg-light text-dark">{{ $interest->name }}</span>
                                                @endforeach
                                                @if($place->interests->count() > 2)
                                                    <span class="badge bg-light text-muted">+{{ $place->interests->count() - 2 }}</span>
                                                @endif
                                            </div>
                                        @else
                                            <small class="text-muted">Sin intereses</small>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('company.places.show', $place) }}" 
                                               class="btn btn-outline-primary" 
                                               title="Ver detalles">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('company.places.edit', $place) }}" 
                                               class="btn btn-outline-warning" 
                                               title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('company.places.destroy', $place) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este lugar?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-outline-danger" 
                                                        title="Eliminar">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Vista de cards para pantallas pequeñas y medianas -->
                    <div class="d-lg-none">
                        <div class="row g-3 p-3">
                            @foreach($places as $place)
                                <div class="col-12">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body p-3">
                                            <!-- Header de la card -->
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="me-3 flex-shrink-0">
                                                    @if($place->image)
                                                        <img src="{{ Storage::url($place->image) }}" 
                                                             alt="{{ $place->name }}" 
                                                             class="rounded"
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-white rounded d-flex align-items-center justify-content-center border"
                                                             style="width: 60px; height: 60px;">
                                                            <i class="bi bi-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-grow-1 min-w-0">
                                                    <h6 class="mb-1 fw-bold">{{ $place->name }}</h6>
                                                    @if($place->description)
                                                        <p class="text-muted mb-2 small">{{ Str::limit($place->description, 80) }}</p>
                                                    @endif
                                                    <div class="d-flex gap-2 mb-2">
                                                        <span class="badge bg-secondary">{{ $place->placeType->name ?? 'Sin tipo' }}</span>
                                                        @if($place->status === 'open')
                                                            <span class="badge bg-success">
                                                                <i class="bi bi-check-circle me-1"></i>
                                                                Abierto
                                                            </span>
                                                        @else
                                                            <span class="badge bg-danger">
                                                                <i class="bi bi-x-circle me-1"></i>
                                                                Cerrado
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Información adicional -->
                                            <div class="row g-2 mb-3">
                                                <div class="col-12">
                                                    @if($place->location)
                                                        <small class="text-muted d-block">
                                                            <i class="bi bi-geo-alt me-1"></i>
                                                            {{ Str::limit($place->location, 50) }}
                                                        </small>
                                                    @else
                                                        <small class="text-muted d-block">
                                                            <i class="bi bi-geo-alt me-1"></i>
                                                            Sin ubicación
                                                        </small>
                                                    @endif
                                                </div>
                                                @if($place->interests->count() > 0)
                                                    <div class="col-12">
                                                        <div class="d-flex flex-wrap gap-1">
                                                            @foreach($place->interests->take(3) as $interest)
                                                                <span class="badge bg-light text-dark small">{{ $interest->name }}</span>
                                                            @endforeach
                                                            @if($place->interests->count() > 3)
                                                                <span class="badge bg-light text-muted small">+{{ $place->interests->count() - 3 }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Acciones -->
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('company.places.show', $place) }}" 
                                                   class="btn btn-outline-primary btn-sm flex-fill" 
                                                   title="Ver detalles">
                                                    <i class="bi bi-eye me-1"></i>
                                                    Ver
                                                </a>
                                                <a href="{{ route('company.places.edit', $place) }}" 
                                                   class="btn btn-outline-warning btn-sm flex-fill" 
                                                   title="Editar">
                                                    <i class="bi bi-pencil me-1"></i>
                                                    Editar
                                                </a>
                                                <form action="{{ route('company.places.destroy', $place) }}" 
                                                      method="POST" 
                                                      class="flex-fill"
                                                      onsubmit="return confirm('¿Estás seguro de eliminar este lugar?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-outline-danger btn-sm w-100" 
                                                            title="Eliminar">
                                                        <i class="bi bi-trash me-1"></i>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Paginación -->
                    @if($places->hasPages())
                        <div class="card-footer bg-white">
                            {{ $places->links() }}
                        </div>
                    @endif
                @else
                    <!-- Estado vacío -->
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-geo-alt text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="text-muted mb-3">No tienes lugares registrados</h5>
                        <p class="text-muted mb-4">
                            Comienza creando tu primer lugar para que los usuarios puedan descubrir tu empresa.
                        </p>
                        <a href="{{ route('company.places.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            Crear mi primer lugar
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.table-responsive {
    border-radius: 0.375rem;
}

.btn-group-sm .btn {
    padding: 0.25rem 0.5rem;
}

.badge {
    font-size: 0.75em;
}
</style>
@endpush
