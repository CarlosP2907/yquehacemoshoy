@extends('admin-template')

@section('title', 'Editar Interés')

@section('breadcrumbs')
    <li class="breadcrumb-item">Gestión de Usuarios</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.interests.index') }}">Intereses</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('page-title', 'Editar Interés')
@section('page-subtitle', 'Modifica la información del interés: {{ $interest->name }}')

@section('page-actions')
    <div class="btn-group" role="group">
        <a href="{{ route('admin.interests.show', $interest) }}" class="btn btn-outline-info">
            <i class="bi bi-eye me-2"></i>
            Ver Detalles
        </a>
        <a href="{{ route('admin.interests.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>
            Volver
        </a>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-pencil me-2 text-warning"></i>
                        Editar Información
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.interests.update', $interest) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">
                                    Nombre del Interés <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $interest->name) }}" 
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
                                          placeholder="Describe brevemente este interés...">{{ old('description', $interest->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Opcional. Máximo 500 caracteres.</div>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-circle me-2"></i>
                                Guardar Cambios
                            </button>
                            <a href="{{ route('admin.interests.index') }}" class="btn btn-outline-secondary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Información adicional -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-light border-0 py-3">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-info-circle me-2 text-info"></i>
                        Información Adicional
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong>Usuarios interesados:</strong> 
                                <span class="badge bg-info">{{ $interest->users()->count() }} usuarios</span>
                            </p>
                            <p class="mb-2">
                                <strong>Fecha de creación:</strong> 
                                {{ $interest->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong>Última actualización:</strong> 
                                {{ $interest->updated_at->format('d/m/Y H:i') }}
                            </p>
                            <p class="mb-0">
                                <strong>ID del interés:</strong> 
                                <code>#{{ $interest->id }}</code>
                            </p>
                        </div>
                    </div>
                    
                    @if($interest->users()->count() > 0)
                        <div class="alert alert-info mt-3" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Nota:</strong> Este interés tiene usuarios asociados. Los cambios afectarán las recomendaciones.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
