<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Cuéntanos tus intereses - {{ config('app.name') }}</title>
    
    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- CSS Files -->
    @vite(['resources/css/app.css'])
</head>
<body class="interests-selection-page">
    <div class="welcome-screen">
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-lg-10 col-xl-8">
                    <div class="welcome-content text-center mb-5">
                        <i class="bi bi-heart-fill welcome-icon"></i>
                        <h1 class="welcome-title mb-3">¡Cuéntanos qué te gusta!</h1>
                        <p class="welcome-subtitle mb-4">
                            Selecciona tus intereses para que podamos recomendarte las mejores actividades, 
                            eventos y lugares perfectos para ti.
                        </p>
                    </div>
                    
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <form action="{{ route('interests.store') }}" method="POST" id="interestsForm">
                        @csrf
                        
                        <div class="interests-grid mb-4">
                            @forelse($interests as $interest)
                                <div class="interest-option fade-in" style="animation-delay: {{ $loop->index * 0.05 }}s">
                                    <input type="checkbox" 
                                           class="btn-check" 
                                           name="interests[]" 
                                           value="{{ $interest->id }}" 
                                           id="interest_{{ $interest->id }}"
                                           {{ in_array($interest->id, old('interests', [])) ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary interest-label" for="interest_{{ $interest->id }}">
                                        <div class="interest-content">
                                            <i class="bi bi-heart interest-icon"></i>
                                            <span class="interest-name">{{ $interest->name }}</span>
                                            @if($interest->description)
                                                <small class="interest-description">{{ $interest->description }}</small>
                                            @endif
                                        </div>
                                    </label>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-exclamation-circle display-4 text-muted mb-3"></i>
                                    <h5 class="text-muted">No hay intereses disponibles</h5>
                                    <p class="text-muted">Por favor, contacta al administrador.</p>
                                </div>
                            @endforelse
                        </div>
                        
                        <div class="text-center">
                            <div class="selection-counter mb-4">
                                <span class="badge bg-primary" id="selectionCount">0 seleccionados</span>
                            </div>
                            
                            @if($interests->count() > 0)
                                <div class="auth-buttons">
                                    <button type="submit" class="btn btn-primary btn-lg me-3" id="continueBtn" disabled>
                                        <i class="bi bi-arrow-right me-2"></i>
                                        Continuar
                                    </button>
                                    <a href="{{ route('interests.skip') }}" class="btn btn-outline-light btn-lg">
                                        Omitir por ahora
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>
                    
                    <div class="text-center mt-4">
                        <small class="text-light opacity-75">
                            <i class="bi bi-shield-check me-1"></i>
                            Puedes cambiar tus intereses en cualquier momento desde tu perfil
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[name="interests[]"]');
            const continueBtn = document.getElementById('continueBtn');
            const selectionCount = document.getElementById('selectionCount');
            
            function updateSelection() {
                const selected = document.querySelectorAll('input[name="interests[]"]:checked');
                const count = selected.length;
                
                // Actualizar contador
                selectionCount.textContent = count === 0 ? '0 seleccionados' : 
                    count === 1 ? '1 seleccionado' : `${count} seleccionados`;
                
                // Habilitar/deshabilitar botón
                continueBtn.disabled = count === 0;
                
                // Agregar clase visual al contador
                selectionCount.className = count > 0 ? 'badge bg-warning' : 'badge bg-secondary';
            }
            
            // Agregar event listeners
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelection);
            });
            
            // Inicializar
            updateSelection();
            
            // Animación de entrada
            document.querySelectorAll('.interest-option').forEach((option, index) => {
                option.style.animationDelay = `${index * 0.05}s`;
                option.classList.add('fade-in-up');
            });
        });
    </script>
    
    <style>
        .interests-selection-page {
            font-family: 'Instrument Sans', sans-serif;
        }
        
        .interests-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
            max-height: 400px;
            overflow-y: auto;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .interest-option {
            opacity: 0;
            transform: translateY(20px);
        }
        
        .interest-label {
            width: 100%;
            height: auto;
            padding: 1.25rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
        }
        
        .interest-label:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            border-color: rgba(255, 255, 255, 0.6);
            background: rgba(255, 255, 255, 0.2);
        }
        
        .btn-check:checked + .interest-label {
            background: var(--bs-primary);
            border-color: var(--bs-primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(var(--bs-primary-rgb), 0.3);
        }
        
        .interest-content {
            text-align: center;
        }
        
        .interest-icon {
            font-size: 1.75rem;
            display: block;
            margin-bottom: 0.75rem;
            opacity: 0.9;
        }
        
        .btn-check:checked + .interest-label .interest-icon {
            opacity: 1;
        }
        
        .interest-name {
            font-weight: 600;
            font-size: 1.1rem;
            display: block;
            margin-bottom: 0.5rem;
        }
        
        .interest-description {
            opacity: 0.8;
            font-size: 0.9rem;
            display: block;
            line-height: 1.4;
        }
        
        .btn-check:checked + .interest-label .interest-description {
            opacity: 0.9;
        }
        
        .fade-in {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .selection-counter .badge {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
        
        @media (max-width: 991px) {
            .interests-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                max-height: 350px;
                padding: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .interests-grid {
                grid-template-columns: 1fr 1fr;
                gap: 0.75rem;
            }
            
            .interest-label {
                padding: 1rem;
            }
            
            .interest-name {
                font-size: 1rem;
            }
        }
    </style>
</body>
</html>
