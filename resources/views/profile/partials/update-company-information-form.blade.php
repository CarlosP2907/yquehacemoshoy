<section>
    <header>
        <h2 class="h5 fw-semibold text-primary">
            {{ __('Información de la Empresa') }}
        </h2>

        <p class="text-muted small">
            {{ __("Actualiza la información de perfil de tu empresa.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('company.profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">{{ __('Nombre de la Empresa') }}</label>
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $company->name) }}" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email', $company->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if ($company instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $company->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-muted small">
                            {{ __('Tu dirección de email no está verificada.') }}

                            <button form="send-verification" class="btn btn-link p-0 text-decoration-underline small">
                                {{ __('Haz clic aquí para reenviar el email de verificación.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="text-success small">
                                {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de email.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">{{ __('Teléfono') }}</label>
                <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" 
                       value="{{ old('phone', $company->phone) }}" placeholder="2222-2222">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="website" class="form-label">{{ __('Sitio Web') }}</label>
                <input id="website" name="website" type="url" class="form-control @error('website') is-invalid @enderror" 
                       value="{{ old('website', $company->website) }}" placeholder="https://tusitio.com">
                @error('website')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="location" class="form-label">{{ __('Ubicación') }}</label>
                <input id="location" name="location" type="text" class="form-control @error('location') is-invalid @enderror" 
                       value="{{ old('location', $company->location) }}" placeholder="Dirección completa">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="description" class="form-label">{{ __('Descripción') }}</label>
                <textarea id="description" name="description" rows="4" 
                          class="form-control @error('description') is-invalid @enderror" 
                          placeholder="Describe tu empresa y servicios...">{{ old('description', $company->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle me-1"></i>
                {{ __('Guardar') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success alert-sm mb-0" role="alert">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    {{ __('Guardado.') }}
                </div>
            @endif
        </div>
    </form>
</section>
