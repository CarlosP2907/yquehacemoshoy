@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section bg-dark text-white py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10 col-xl-8 mt-5">
                <!-- Brand Header -->
                <div class="mb-5 fade-in-up">
                    <h1 class="hero-title text-white fw-bold mb-3">
                        ¿Qué Hacemos <span class="text-green">Hoy?</span>
                    </h1>
                    <div class="divider"></div>
                </div>

                <!-- Hero Content -->
                <div class="mb-5 fade-in-up" style="animation-delay: 0.2s;">
                    <h2 class="hero-subtitle text-white-90 mb-4">
                        Descubre los mejores lugares de <span class="fw-bold">Costa Rica</span>
                    </h2>
                    <p class="fs-5 text-white-80 mb-5 mx-auto" style="max-width: 600px;">
                        Tu buscador de experiencias únicas. Encuentra restaurantes, actividades, eventos y lugares increíbles cerca de ti.
                    </p>
                </div>

                <!-- Feature Cards Hero -->
                <div class="row g-4 mb-5">
                    @php
                        $heroFeatures = [
                            [
                                'icon' => 'bi-geo-alt',
                                'title' => 'Explora Lugares',
                                'description' => 'Descubre restaurantes, cafés y lugares únicos en tu área con reseñas reales',
                                'delay' => '0.4s'
                            ],
                            [
                                'icon' => 'bi-calendar-event',
                                'title' => 'Eventos Exclusivos',
                                'description' => 'Mantente al día con eventos y actividades locales que no te puedes perder',
                                'delay' => '0.6s'
                            ],
                            [
                                'icon' => 'bi-building',
                                'title' => 'Para Empresas',
                                'description' => 'Promociona tu negocio y conecta con miles de clientes potenciales',
                                'delay' => '0.8s'
                            ]
                        ];
                    @endphp

                    @foreach($heroFeatures as $feature)
                    <div class="col-lg-4 col-md-6 @if($loop->last) mx-auto @endif fade-in-up" style="animation-delay: {{ $feature['delay'] }};">
                        <div class="feature-card h-100 text-center">
                            <div class="feature-icon mx-auto">
                                <i class="bi {{ $feature['icon'] }}  fs-4"></i>
                            </div>
                            <h3 class="h5 fw-semibold text-dark mb-3">{{ $feature['title'] }}</h3>
                            <p class="text-muted mb-0">{{ $feature['description'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Call to Action -->
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center fade-in-up" style="animation-delay: 1s;">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3">
                            <i class="bi bi-rocket-takeoff me-2"></i>Comenzar Gratis
                        </a>
                        <a href="#about" class="btn btn-outline-light btn-lg px-5 py-3">
                            <i class="bi bi-info-circle me-2"></i>Saber Más
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-5 py-3">
                            <i class="bi bi-speedometer2 me-2"></i>Ir al Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nuestro Enfoque -->
<section>
    <div class="container py-5">
        <div class="row align-items-center">
            <!-- Texto del enfoque - Columna izquierda -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h2 class="display-6 fw-bold text-dark mb-4">Nuestro enfoque</h2>
                <p class="lead text-muted">
                    Creemos que cada día es una oportunidad para descubrir algo nuevo. Por eso, nos enfocamos en 
                    <strong>conectar a las personas con experiencias auténticas</strong> que enriquezcan su vida cotidiana.
                </p>
                <p class="text-muted mb-4">
                    Desde el restaurante familiar que lleva generaciones sirviendo los mejores casados, hasta el 
                    nuevo café de especialidad que acaba de abrir en tu barrio. Nuestra misión es simple: 
                    <em>hacer que cada salida sea memorable</em> y que cada negocio local tenga la oportunidad 
                    de brillar.
                </p>
                <p class="text-muted fw-semibold mb-4">
                    Porque cuando apoyas lo local, no solo descubres lugares increíbles, 
                    <strong class="text-green">construyes comunidad</strong>.
                </p>

                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4 py-3">
                        <i class="bi bi-person-plus me-2"></i>Comienza tu aventura
                    </a>
                @else
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-4 py-3">
                        <i class="bi bi-speedometer2 me-2"></i>Ir al Dashboard
                    </a>
                @endguest
            </div>

            <!-- Imagen - Columna derecha -->
            <div class="col-lg-6">
                <div class="position-relative">
                    <!-- Imagen principal -->
                    <img src="{{ asset('images/enfoque-hero.jpg') }}" 
                         alt="Experiencias auténticas en Costa Rica" 
                         class="img-fluid rounded-3 shadow-lg w-100"
                         style="border-radius: var(--border-radius-xl);
                                max-height: 400px; 
                                object-fit: cover; 
                                object-position: center;
                                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
                                ">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="about" class="py-5 bg-light">
    <div class="container py-5">
        <!-- Section Header -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="display-6 fw-bold text-dark mb-4">¿Por qué elegir nuestra plataforma?</h2>
                <p class="lead text-muted">
                    Conectamos a usuarios con experiencias increíbles y ayudamos a las empresas a crecer
                </p>
                <div class="divider"></div>
            </div>
        </div>

        <!-- Main Feature Cards -->
        <div class="row g-5 align-items-center mb-5">
            <!-- For Users Card -->
            <div class="col-lg-6">
                <div class="card border-0 h-100">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-start mb-4">
                            <div class="feature-icon-user me-3" style="margin-bottom: 20px; width: 50px; height: 50px;">
                                <i class="bi bi-person-heart text-white"></i>
                            </div>
                            <h3 class="h3 fw-bold text-dark mb-0" style="margin-top: 10px;">Para Usuarios</h3>
                        </div>
                        
                        @php
                            $userFeatures = [
                                [
                                    'title' => 'Encuentra lugares únicos',
                                    'description' => 'Descubre restaurantes, cafés y experiencias cerca de ti'
                                ],
                                [
                                    'title' => 'Eventos exclusivos',
                                    'description' => 'Accede a eventos y actividades especiales'
                                ],
                                [
                                    'title' => 'Contenido gratuito',
                                    'description' => 'Disfruta de funciones básicas sin costo'
                                ]
                            ];
                        @endphp

                        <ul class="list-unstyled mb-4">
                            @foreach($userFeatures as $feature)
                            <li class="d-flex align-items-start mb-3">
                                <div class="feature-check me-3 flex-shrink-0">
                                    <i class="bi bi-check text-white"></i>
                                </div>
                                <div>
                                    <strong class="text-dark">{{ $feature['title'] }}</strong>
                                    <p class="text-muted small mb-0">{{ $feature['description'] }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="bi bi-person-plus me-2"></i>Registrarse como Usuario
                        </a>
                    </div>
                </div>
            </div>

            <!-- For Companies Card -->
            <div class="col-lg-6">
                <div class="card border-0 h-100 bg-primary text-white">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center me-3" style="margin-bottom: 20px; width: 50px; height: 50px;">
                                <i class="bi bi-building text-green"></i>
                            </div>
                            <h3 class="h3 fw-bold text-white" style="margin-bottom: 20px;">Para Empresas</h3>
                        </div>
                        
                        @php
                            $companyFeatures = [
                                [
                                    'title' => 'Promociona tu negocio',
                                    'description' => 'Aumenta tu visibilidad y atrae más clientes'
                                ],
                                [
                                    'title' => 'Alcance masivo',
                                    'description' => 'Conecta con miles de clientes potenciales'
                                ],
                                [
                                    'title' => 'Gestión sencilla',
                                    'description' => 'Administra tu contenido de forma fácil'
                                ]
                            ];
                        @endphp

                        <ul class="list-unstyled mb-4">
                            @foreach($companyFeatures as $feature)
                            <li class="d-flex align-items-start mb-3">
                                <div class="bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 32px; height: 32px;">
                                    <i class="bi bi-check text-green" style="font-size: 16px;"></i>
                                </div>
                                <div>
                                    <strong class="text-white">{{ $feature['title'] }}</strong>
                                    <p class="text-white-80 small mb-0">{{ $feature['description'] }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('register') }}" class="btn btn-light">
                            <i class="bi bi-briefcase me-2"></i>Registrar Empresa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .feature-card .text-muted {
        color: var(--bs-text-muted) !important;
    }
</style>
@endpush