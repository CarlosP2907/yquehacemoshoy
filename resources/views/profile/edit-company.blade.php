@extends('company-template')

@section('title', 'Perfil de Empresa')

@section('page-title', 'Perfil de Empresa')
@section('page-subtitle', 'Gestiona la información de tu empresa')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="mb-0 fw-semibold">Información de la Empresa</h5>
            </div>
            <div class="card-body">
                @include('profile.partials.update-company-information-form')
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="mb-0 fw-semibold">Cambiar Contraseña</h5>
            </div>
            <div class="card-body">
                @include('profile.partials.update-password-form', ['isCompany' => true])
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm border-danger">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="mb-0 fw-semibold text-danger">Zona Peligrosa</h5>
            </div>
            <div class="card-body">
                @include('profile.partials.delete-company-form')
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.form-control:focus {
    border-color: var(--bs-primary);
    box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
}

.card {
    transition: all 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.border-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.15) !important;
}
</style>
@endpush
