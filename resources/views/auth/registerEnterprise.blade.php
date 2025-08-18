
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
            <div class="text-center mb-4">
              <h2 class="h3 fw-bold text-primary">Crear Cuenta — Empresa</h2>
              <p class="text-white">Registra tu empresa</p>
            </div>

            <!-- User Type Selection -->
            <div class="mb-4">
                <label class="form-label">Tipo de Cuenta</label>
                <div class="row g-2">
                    <div class="col-6">
                        <a href="{{ route('register') }}" class="user-type-card text-decoration-none">
                            <div class="feature-icon-user">
                                <i class="bi bi-person fs-4"></i>
                            </div>
                            <span class="small fw-medium">Usuario</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('registerEnterprise') }}" class="user-type-card text-decoration-none active">
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

            <form method="POST" action="{{ route('register') }}">
              @csrf
              <input type="hidden" name="user_type" value="company">
              
              <!-- Debug: Mostrar todos los errores -->
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <h6>Errores de validación:</h6>
                      <ul class="mb-0">
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              
              <!-- Debug: Mostrar valor de user_type -->
              @if(old('user_type'))
                  <div class="alert alert-info">
                      user_type enviado: {{ old('user_type') }}
                  </div>
              @endif

              <div class="mb-3">
                <label for="name" class="form-label">Nombre de la Empresa</label>
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" required placeholder="Nombre de la empresa">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required placeholder="contacto@empresa.com">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3">
                <label for="company_location" class="form-label">Ubicación</label>
                <input id="company_location" name="company_location" type="text" class="form-control @error('company_location') is-invalid @enderror"
                       value="{{ old('company_location') }}" placeholder="Dirección completa">
                @error('company_location') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label for="company_phone" class="form-label">Teléfono</label>
                  <input id="company_phone" name="company_phone" type="text" class="form-control @error('company_phone') is-invalid @enderror"
                         value="{{ old('company_phone') }}" placeholder="2222-2222">
                  @error('company_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                  <label for="website" class="form-label">Sitio Web</label>
                  <input id="website" name="website" type="url" class="form-control @error('website') is-invalid @enderror"
                         value="{{ old('website') }}" placeholder="https://tusitio.com">
                  @error('website') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea id="description" name="description" rows="3" class="form-control @error('description') is-invalid @enderror"
                          placeholder="Describe tu empresa...">{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label for="password" class="form-label">Contraseña</label>
                  <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                  @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                  <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                  <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                </div>
              </div>

              <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-lg" onclick="console.log('user_type value:', document.querySelector('[name=user_type]').value); alert('Enviando con user_type: ' + document.querySelector('[name=user_type]').value);">Crear Cuenta Empresa</button>
              </div>

              <div class="text-center pt-3 border-top">
                <p class="text-white small">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-primary">Inicia sesión</a></p>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection