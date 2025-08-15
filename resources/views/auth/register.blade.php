@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <!-- Page Title -->
                    <div class="text-center mb-4">
                        <h2 class="h3 fw-bold text-primary">Crear Cuenta</h2>
                        <p class="text-muted">Únete a nuestra comunidad</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- User Type Selection -->
                        <div class="mb-4">
                            <label class="form-label">Tipo de Cuenta</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="radio" name="user_type" value="user" id="user-type-user" class="d-none" checked onclick="toggleUserType('user')">
                                    <label for="user-type-user" class="radio-card d-block h-100 text-center p-3">
                                        <svg class="w-6 h-6 text-primary mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="small fw-medium">Usuario</span>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" name="user_type" value="company" id="user-type-company" class="d-none" onclick="toggleUserType('company')">
                                    <label for="user-type-company" class="radio-card d-block h-100 text-center p-3">
                                        <svg class="w-6 h-6 text-primary mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        <span class="small fw-medium">Empresa</span>
                                    </label>
                                </div>
                            </div>
                            @error('user_type')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Tu nombre completo">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="tu@email.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- User Fields (shown by default) -->
                        <div id="user-fields">
                            <div class="form-section mb-4">
                                <h4 class="h6 fw-medium text-primary mb-3 d-flex align-items-center">
                                    <svg class="icon-primary me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Información Personal
                                </h4>
                                
                                <!-- Location -->
                                <div class="mb-3">
                                    <label for="location" class="form-label">Ubicación</label>
                                    <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" placeholder="Ciudad, Provincia">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="form-label">Teléfono</label>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="8888-8888">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Company Fields (hidden by default) -->
                        <div id="company-fields" style="display: none;">
                            <div class="form-section mb-4">
                                <h4 class="h6 fw-medium text-primary mb-3 d-flex align-items-center">
                                    <svg class="icon-primary me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Información de la Empresa
                                </h4>
                                
                                <!-- Company Location -->
                                <div class="mb-3">
                                    <label for="company_location" class="form-label">Ubicación de la Empresa</label>
                                    <input id="company_location" type="text" class="form-control @error('company_location') is-invalid @enderror" name="company_location" value="{{ old('company_location') }}" placeholder="Dirección completa">
                                    @error('company_location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Company Phone -->
                                <div class="mb-3">
                                    <label for="company_phone" class="form-label">Teléfono de la Empresa</label>
                                    <input id="company_phone" type="text" class="form-control @error('company_phone') is-invalid @enderror" name="company_phone" value="{{ old('company_phone') }}" placeholder="2222-2222">
                                    @error('company_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Website -->
                                <div class="mb-3">
                                    <label for="website" class="form-label">Sitio Web</label>
                                    <input id="website" type="url" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" placeholder="https://tusitio.com">
                                    @error('website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="description" class="form-label">Descripción</label>
                                    <textarea id="description" name="description" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="Describe tu empresa y servicios...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Repite tu contraseña">
                        </div>

                        <!-- Submit Button and Links -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Crear Cuenta') }}
                            </button>
                        </div>

                        <div class="text-center pt-3 border-top">
                            <p class="text-muted small">
                                ¿Ya tienes cuenta? 
                                <a href="{{ route('login') }}" class="text-primary fw-medium">
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

<script>
    function toggleUserType(type) {
        const userFields = document.getElementById('user-fields');
        const companyFields = document.getElementById('company-fields');
        
        if (type === 'user') {
            userFields.style.display = 'block';
            companyFields.style.display = 'none';
            
            // Clear company fields
            document.getElementById('company_location').value = '';
            document.getElementById('company_phone').value = '';
            document.getElementById('website').value = '';
            document.getElementById('description').value = '';
        } else {
            userFields.style.display = 'none';
            companyFields.style.display = 'block';
            
            // Clear user fields
            document.getElementById('location').value = '';
            document.getElementById('phone').value = '';
        }
    }

    // Add animation to radio card selection
    document.addEventListener('DOMContentLoaded', function() {
        const radioInputs = document.querySelectorAll('input[name="user_type"]');
        
        radioInputs.forEach(input => {
            input.addEventListener('change', function() {
                // Remove checked class from all cards
                document.querySelectorAll('.radio-card').forEach(card => {
                    card.classList.remove('checked');
                });
                
                // Add checked class to selected card
                this.closest('label').classList.add('checked');
            });
        });
    });
</script>
@endsection