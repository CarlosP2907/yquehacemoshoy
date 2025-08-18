@extends('freeUser-template')

@section('title', 'Mi Perfil')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="text-center mb-5">
                <div class="welcome-content">
                    <i class="bi bi-person-circle welcome-icon text-primary"></i>
                    <h1 class="welcome-title mb-3">Mi Perfil</h1>
                    <p class="welcome-subtitle">
                        Gestiona tu información personal y preferencias
                    </p>
                </div>
            </div>
            <!-- Información del perfil -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person me-2 text-primary"></i>
                        Información Personal
                    </h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Sección de intereses -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-heart me-2 text-primary"></i>
                        Mis Intereses
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">
                        Gestiona tus intereses para recibir recomendaciones personalizadas.
                    </p>

                    @if(auth()->user()->interests->count() > 0)
                        <div class="mb-4">
                            <p class="small text-muted mb-3">Intereses actuales:</p>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(auth()->user()->interests as $interest)
                                    <span class="badge bg-primary">
                                        <i class="bi bi-heart-fill me-1"></i>
                                        {{ $interest->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="mb-4">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                No has seleccionado ningún interés aún.
                            </div>
                        </div>
                    @endif

                    <a href="{{ route('interests.edit') }}" 
                       class="btn btn-primary">
                        <i class="bi bi-pencil me-2"></i>
                        Editar mis intereses
                    </a>
                </div>
            </div>

            <!-- Cambiar contraseña -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-shield-lock me-2 text-primary"></i>
                        Seguridad
                    </h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Eliminar cuenta -->
            <div class="card shadow-sm border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Zona Peligrosa
                    </h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
