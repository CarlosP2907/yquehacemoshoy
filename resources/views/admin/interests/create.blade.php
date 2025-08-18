@extends('admin-template')

@section('title', 'Crear Nuevo Interés')

@section('breadcrumbs')
    <li class="breadcrumb-item">Gestión de Usuarios</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.interests.index') }}">Intereses</a></li>
    <li class="breadcrumb-item active">Crear</li>
@endsection

@section('page-title', 'Crear Nuevo Interés')
@section('page-subtitle', 'Agrega un nuevo interés para los usuarios')

@section('page-actions')
    <a href="{{ route('admin.interests.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Volver
    </a>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-heart me-2 text-warning"></i>
                        Información del Interés
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.interests.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">
                                    Nombre del Interés <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="Ej: Deportes, Música, Arte, etc."
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">El nombre debe ser único y descriptivo.</div>
                            </div>
                            
                            <div class="col-md-12 mb-4">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="3" 
                                          placeholder="Describe brevemente este interés...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Opcional. Máximo 500 caracteres.</div>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-circle me-2"></i>
                                Crear Interés
                            </button>
                            <a href="{{ route('admin.interests.index') }}" class="btn btn-outline-secondary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Card de ayuda -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-light border-0 py-3">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-lightbulb me-2 text-info"></i>
                        Consejos para crear intereses
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="bi bi-check text-success me-2"></i>
                            <strong>Sé específico:</strong> "Fútbol" es mejor que "Deportes"
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check text-success me-2"></i>
                            <strong>Usa nombres comunes:</strong> Términos que los usuarios reconozcan fácilmente
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check text-success me-2"></i>
                            <strong>Evita duplicados:</strong> Revisa que no exista un interés similar
                        </li>
                        <li class="mb-0">
                            <i class="bi bi-check text-success me-2"></i>
                            <strong>Descripción útil:</strong> Ayuda a los usuarios a entender mejor el interés
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
