@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10 col-xl-8">
                <!-- Brand Header -->
                <div class="mb-5 fade-in-up">
                    <h1 class="hero-title text-white">
                        ¿Qué Hacemos <span class="text-gradient">Hoy?</span>
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

                <!-- Feature Cards -->
                <div class="row g-4 mb-5">
                    <div class="col-lg-4 col-md-6 fade-in-up" style="animation-delay: 0.4s;">
                        <div class="feature-card h-100 text-center">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-geo-alt text-white fs-4"></i>
                            </div>
                            <h3 class="h5 fw-semibold text-dark mb-3">Explora Lugares</h3>
                            <p class="text-muted mb-0">Descubre restaurantes, cafés y lugares únicos en tu área con reseñas reales</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 fade-in-up" style="animation-delay: 0.6s;">
                        <div class="feature-card h-100 text-center">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-calendar-event text-white fs-4"></i>
                            </div>
                            <h3 class="h5 fw-semibold text-dark mb-3">Eventos Exclusivos</h3>
                            <p class="text-muted mb-0">Mantente al día con eventos y actividades locales que no te puedes perder</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mx-auto fade-in-up" style="animation-delay: 0.8s;">
                        <div class="feature-card h-100 text-center">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-building text-white fs-4"></i>
                            </div>
                            <h3 class="h5 fw-semibold text-dark mb-3">Para Empresas</h3>
                            <p class="text-muted mb-0">Promociona tu negocio y conecta con miles de clientes potenciales</p>
                        </div>
                    </div>
                </div>

                <!-- Call to Action -->
                @if (!Auth::check())
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center fade-in-up" style="animation-delay: 1s;">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3">
                        <i class="bi bi-rocket-takeoff me-2"></i>Comenzar Gratis
                    </a>
                    <a href="#about" class="btn btn-outline-light btn-lg px-5 py-3">
                        <i class="bi bi-info-circle me-2"></i>Saber Más
                    </a>
                </div>
                @else
                <div class="d-flex justify-content-center fade-in-up" style="animation-delay: 1s;">
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-5 py-3">
                        <i class="bi bi-speedometer2 me-2"></i>Ir al Dashboard
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="about" class="py-5 bg-light">
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="display-6 fw-bold text-dark mb-4">¿Por qué elegir nuestra plataforma?</h2>
                <p class="lead text-muted">
                    Conectamos a usuarios con experiencias increíbles y ayudamos a las empresas a crecer
                </p>
                <div class="divider"></div>
            </div>
        </div>

        <div class="row g-5 align-items-center">
            <!-- For Users -->
            <div class="col-lg-6">
                <div class="card border-0 h-100">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="feature-icon me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-person-heart text-white"></i>
                            </div>
                            <h3 class="h3 fw-bold text-dark mb-0">Para Usuarios</h3>
                        </div>
                        
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-start mb-3">
                                <div class="feature-check me-3 flex-shrink-0">
                                    <i class="bi bi-check text-white"></i>
                                </div>
                                <div>
                                    <strong class="text-dark">Encuentra lugares únicos</strong>
                                    <p class="text-muted small mb-0">Descubre restaurantes, cafés y experiencias cerca de ti</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start mb-3">
                                <div class="feature-check me-3 flex-shrink-0">
                                    <i class="bi bi-check text-white"></i>
                                </div>
                                <div>
                                    <strong class="text-dark">Eventos exclusivos</strong>
                                    <p class="text-muted small mb-0">Accede a eventos y actividades especiales</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start">
                                <div class="feature-check me-3 flex-shrink-0">
                                    <i class="bi bi-check text-white"></i>
                                </div>
                                <div>
                                    <strong class="text-dark">Contenido gratuito</strong>
                                    <p class="text-muted small mb-0">Disfruta de funciones básicas sin costo</p>
                                </div>
                            </li>
                        </ul>

                        <div class="mt-4">
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                <i class="bi bi-person-plus me-2"></i>Registrarse como Usuario
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- For Companies -->
            <div class="col-lg-6">
                <div class="card border-0 h-100 bg-primary text-white">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-building text-white"></i>
                            </div>
                            <h3 class="h3 fw-bold text-white mb-0">Para Empresas</h3>
                        </div>
                        
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-start mb-3">
                                <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3 flex-shrink-0" style="width: 32px; height: 32px;">
                                    <i class="bi bi-check text-white" style="font-size: 16px;"></i>
                                </div>
                                <div>
                                    <strong class="text-white">Promociona tu negocio</strong>
                                    <p class="text-white-80 small mb-0">Aumenta tu visibilidad y atrae más clientes</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start mb-3">
                                <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3 flex-shrink-0" style="width: 32px; height: 32px;">
                                    <i class="bi bi-check text-white" style="font-size: 16px;"></i>
                                </div>
                                <div>
                                    <strong class="text-white">Alcance masivo</strong>
                                    <p class="text-white-80 small mb-0">Conecta con miles de clientes potenciales</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start">
                                <div class="bg-white bg-opacity-20 rounded-circle p-2 me-3 flex-shrink-0" style="width: 32px; height: 32px;">
                                    <i class="bi bi-check text-white" style="font-size: 16px;"></i>
                                </div>
                                <div>
                                    <strong class="text-white">Gestión sencilla</strong>
                                    <p class="text-white-80 small mb-0">Administra tu contenido de forma fácil</p>
                                </div>
                            </li>
                        </ul>

                        <div class="mt-4">
                            <a href="{{ route('register') }}" class="btn btn-light">
                                <i class="bi bi-briefcase me-2"></i>Registrar Empresa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="row mt-5 pt-5 text-center">
            <div class="col-md-3 col-6 mb-4">
                <div class="p-3">
                    <h3 class="display-5 fw-bold text-primary mb-2">500+</h3>
                    <p class="text-muted mb-0">Lugares Registrados</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="p-3">
                    <h3 class="display-5 fw-bold text-primary mb-2">1,200+</h3>
                    <p class="text-muted mb-0">Usuarios Activos</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="p-3">
                    <h3 class="display-5 fw-bold text-primary mb-2">95%</h3>
                    <p class="text-muted mb-0">Satisfacción</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="p-3">
                    <h3 class="display-5 fw-bold text-primary mb-2">24/7</h3>
                    <p class="text-muted mb-0">Soporte</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection