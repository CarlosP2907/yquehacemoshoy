@extends('admin-template')

@section('title', 'Gestión de Intereses')

@section('breadcrumbs')
    <li class="breadcrumb-item">Gestión de Usuarios</li>
    <li class="breadcrumb-item active">Intereses</li>
@endsection

@section('page-title', 'Gestión de Intereses')
@section('page-subtitle', 'Administra los intereses disponibles para los usuarios')

@section('page-actions')
    <a href="{{ route('admin.interests.create') }}" class="btn btn-warning">
        <i class="bi bi-plus-circle me-2"></i>
        Nuevo Interés
    </a>
@endsection

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Lista de Intereses</h5>
                        <span class="badge bg-primary">{{ $interests->total() }} total</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($interests->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Usuarios</th>
                                        <th>Fecha de Creación</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($interests as $interest)
                                        <tr>
                                            <td>
                                                <span class="badge bg-light text-dark">#{{ $interest->id }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="interest-icon me-2">
                                                        <i class="bi bi-heart text-warning"></i>
                                                    </div>
                                                    <strong>{{ $interest->name }}</strong>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">
                                                    {{ $interest->description ? Str::limit($interest->description, 50) : 'Sin descripción' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $interest->users_count }} usuarios</span>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $interest->created_at->format('d/m/Y') }}</small>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('admin.interests.show', $interest) }}" 
                                                       class="btn btn-outline-info" title="Ver detalles">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.interests.edit', $interest) }}" 
                                                       class="btn btn-outline-warning" title="Editar">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    @if($interest->users_count == 0)
                                                        <button type="button" class="btn btn-outline-danger" 
                                                                onclick="deleteInterest({{ $interest->id }})" title="Eliminar">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-outline-secondary" 
                                                                disabled title="No se puede eliminar (tiene usuarios)">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        @if($interests->hasPages())
                            <div class="card-footer bg-white border-0 py-3">
                                {{ $interests->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-heart display-4 text-muted mb-3"></i>
                            <h5 class="text-muted">No hay intereses registrados</h5>
                            <p class="text-muted">Crea el primer interés para comenzar.</p>
                            <a href="{{ route('admin.interests.create') }}" class="btn btn-warning">
                                <i class="bi bi-plus-circle me-2"></i>
                                Crear Primer Interés
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este interés?</p>
                <p class="text-muted small">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function deleteInterest(id) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/admin/interests/${id}`;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}
</script>
@endsection
