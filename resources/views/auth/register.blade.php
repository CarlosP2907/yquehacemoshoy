
@extends('layouts.app')

@push('styles')
@vite(['resources/css/pages/auth.css'])
@endpush

@section('content')
<div class="register-page">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg" style="border-radius: 1rem;">
                    <div class="card-body">
                        <!-- Page Title -->
                        <div class="text-center mb-4">
                            <h2 class="h3 fw-bold text-primary">Crear Cuenta  — Usuario</h2>
                            <p class="text-white">Únete a nuestra comunidad</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf

                        <!-- User Type Selection -->
                            <div class="mb-4">
                                <label class="form-label">Tipo de Cuenta</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="radio" name="user_type" value="user" id="user-type-user" class="d-none" {{ old('user_type', 'user') == 'user' ? 'checked' : '' }}>
                                        <button type="button" class="user-type-card {{ old('user_type', 'user') == 'user' ? 'active' : '' }}" id="user-btn">
                                            <div class="feature-icon-user">
                                                <i class="bi bi-person fs-4"></i>
                                            </div>
                                            <span class="small fw-medium">Usuario</span>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('registerEnterprise') }}" class="user-type-card text-decoration-none">
                                            <div class="feature-icon-user">
                                                <i class="bi bi-building fs-4"></i>
                                            </div>
                                            <span class="small fw-medium">Empresa</span>
                                        </a>
                                    </div>
                                </div>
                                
                                @error('user_type')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Basic Fields -->
                            <div class="row g-3 mt-1 mb-3">
                                <div class="col-12">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                           name="name" value="{{ old('name') }}" required autofocus 
                                           placeholder="Tu nombre completo">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <label for="email" class="form-label">Correo Electrónico</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required 
                                           placeholder="tu@email.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Dynamic Fields Container -->
                            <div id="dynamic-fields" class="mb-4">
                                <!-- User Fields -->
                                <div id="user-fields" class="fields-section" style="display: {{ old('user_type', 'user') == 'user' ? 'block' : 'none' }};">
                                    <div class="section-header mb-3">
                                        <h4 class="h6 fw-medium text-primary d-flex align-items-center">
                                            <i class="bi bi-person-circle text-primary me-2"></i>
                                            Información Personal
                                        </h4>
                                    </div>
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="location" class="form-label">Ubicación</label>
                                            <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" 
                                                   name="location" value="{{ old('location') }}" placeholder="Ciudad, Provincia">
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Teléfono</label>
                                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" 
                                                   name="phone" value="{{ old('phone') }}" placeholder="8888-8888">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Company Fields -->
                                <div id="company-fields" class="fields-section" style="display: {{ old('user_type') == 'company' ? 'block' : 'none' }};">
                                    <div class="section-header mb-3">
                                        <h4 class="h6 fw-medium text-primary d-flex align-items-center">
                                            <i class="bi bi-building text-primary me-2"></i>
                                            Información de la Empresa
                                        </h4>
                                    </div>
                                    
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="company_location" class="form-label">Ubicación de la Empresa</label>
                                            <input id="company_location" type="text" class="form-control @error('company_location') is-invalid @enderror" 
                                                   name="company_location" value="{{ old('company_location') }}" placeholder="Dirección completa">
                                            @error('company_location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="company_phone" class="form-label">Teléfono</label>
                                            <input id="company_phone" type="text" class="form-control @error('company_phone') is-invalid @enderror" 
                                                   name="company_phone" value="{{ old('company_phone') }}" placeholder="2222-2222">
                                            @error('company_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="website" class="form-label">Sitio Web</label>
                                            <input id="website" type="url" class="form-control @error('website') is-invalid @enderror" 
                                                   name="website" value="{{ old('website') }}" placeholder="https://tusitio.com">
                                            @error('website')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="description" class="form-label">Descripción</label>
                                            <textarea id="description" name="description" rows="3" 
                                                      class="form-control @error('description') is-invalid @enderror" 
                                                      placeholder="Describe tu empresa y servicios...">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Fields -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required placeholder="Mínimo 8 caracteres">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                    <input id="password_confirmation" type="password" class="form-control" 
                                           name="password_confirmation" required placeholder="Repite tu contraseña">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-person-plus me-2"></i>
                                    Crear Cuenta
                                </button>
                            </div>

                            <div class="text-center pt-3 border-top">
                                <p class="text-white small">
                                    ¿Ya tienes cuenta? 
                                    <a href="{{ route('login') }}" class="text-primary ms-1 fw-medium">
                                        Inicia sesión aquí
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Script iniciado');
    
    // Función para obtener elementos de forma segura
    function getElement(id) {
        const element = document.getElementById(id);
        if (!element) {
            console.error(`Elemento no encontrado: ${id}`);
        }
        return element;
    }

    // Obtener elementos
    const userTypeUser = getElement('user-type-user');
    const userBtn = getElement('user-btn');
    const userFields = getElement('user-fields');
    const companyFields = getElement('company-fields');

    // Verificar que todos los elementos existen
    if (!userTypeUser || !userBtn || !userFields || !companyFields) {
        console.error('Faltan elementos del DOM, abortando...');
        return;
    }

    // Event listener para el botón de usuario
    userBtn.addEventListener('click', function(e) {
        console.log('Click en botón usuario');
        userTypeUser.checked = true;
        userFields.style.display = 'block';
        companyFields.style.display = 'none';
        userBtn.classList.add('active');
    });

    // Inicializar el estado
    if (userTypeUser.checked) {
        userFields.style.display = 'block';
        companyFields.style.display = 'none';
        userBtn.classList.add('active');
    }
});
</script>
@endpush