<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', config('app.name', '¿Y Qué Hacemos Hoy?') . ' - Portal Empresas')</title>
    
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
    
    @stack('styles')
</head>
<body>
    @guest
        <!-- Pantalla de bienvenida para empresas no autenticadas -->
        <div class="welcome-screen">
            <div class="container">
                <div class="row justify-content-center align-items-center min-vh-100">
                    <div class="col-md-8 col-lg-6 text-center">
                        <div class="welcome-content">
                            <i class="bi bi-building welcome-icon"></i>
                            <h1 class="welcome-title mb-4">Portal Empresas</h1>
                            <p class="welcome-subtitle mb-5">Gestiona tu empresa y conecta con usuarios interesados en tus servicios</p>
                            <div class="auth-buttons">
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Iniciar Sesión
                                </a>
                                @if (Route::has('registerEnterprise'))
                                    <a href="{{ route('registerEnterprise') }}" class="btn btn-outline-light btn-lg">
                                        <i class="bi bi-building-plus me-2"></i>
                                        Registrar Empresa
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if(Auth::guard('company')->check() && Auth::guard('company')->user())
        <!-- Layout con sidebar para empresas autenticadas -->
        <div class="sidebar-layout">
            <!-- Overlay para móvil -->
            <div class="sidebar-overlay" id="sidebarOverlay"></div>
            
            <!-- Sidebar -->
            <nav class="sidebar" id="sidebar">
                <!-- Header del sidebar -->
                <div class="sidebar-header">
                    <a href="{{ url('/company-template') }}" class="sidebar-brand">
                        <i class="bi bi-building me-2"></i>
                        <span class="sidebar-brand-text">Portal Empresas</span>
                    </a>
                </div>

                <!-- Navegación -->
                <ul class="sidebar-nav">
                    <li class="sidebar-nav-item">
                        <a href="{{ route('company-dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('company-dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span class="sidebar-nav-text">Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- Sección Gestión de Empresa -->
                    <li class="sidebar-nav-section">
                        <span class="sidebar-nav-section-title">Gestión</span>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="{{ route('company.profile.edit') }}" class="sidebar-nav-link {{ request()->routeIs('company.profile.*') ? 'active' : '' }}">
                            <i class="bi bi-building-gear"></i>
                            <span class="sidebar-nav-text">Mi Empresa</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-card-list"></i>
                            <span class="sidebar-nav-text">Servicios</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-calendar-plus"></i>
                            <span class="sidebar-nav-text">Eventos</span>
                        </a>
                    </li>
                    
                    <!-- Sección Lugares -->
                    <li class="sidebar-nav-section">
                        <span class="sidebar-nav-section-title">Mis Lugares</span>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="{{ route('company.places.index') }}" class="sidebar-nav-link {{ request()->routeIs('company.places.index') ? 'active' : '' }}">
                            <i class="bi bi-geo-alt"></i>
                            <span class="sidebar-nav-text">Mis Lugares</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="{{ route('company.places.create') }}" class="sidebar-nav-link {{ request()->routeIs('company.places.create') ? 'active' : '' }}">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span class="sidebar-nav-text">Crear Lugar</span>
                        </a>
                    </li>
                    
                    <!-- Sección Clientes -->
                    <li class="sidebar-nav-section">
                        <span class="sidebar-nav-section-title">Clientes</span>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-people"></i>
                            <span class="sidebar-nav-text">Usuarios</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-star"></i>
                            <span class="sidebar-nav-text">Reseñas</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-chat-dots"></i>
                            <span class="sidebar-nav-text">Mensajes</span>
                        </a>
                    </li>
                    
                    <!-- Sección Marketing -->
                    <li class="sidebar-nav-section">
                        <span class="sidebar-nav-section-title">Marketing</span>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-megaphone"></i>
                            <span class="sidebar-nav-text">Promociones</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-graph-up"></i>
                            <span class="sidebar-nav-text">Analytics</span>
                        </a>
                    </li>
                    
                    <!-- Sección Sistema -->
                    <li class="sidebar-nav-section">
                        <span class="sidebar-nav-section-title">Sistema</span>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-credit-card"></i>
                            <span class="sidebar-nav-text">Suscripción</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-bell"></i>
                            <span class="sidebar-nav-text">Notificaciones</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-shield-check"></i>
                            <span class="sidebar-nav-text">Seguridad</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-gear"></i>
                            <span class="sidebar-nav-text">Configuración</span>
                        </a>
                    </li>
                </ul>

                <!-- Información de la empresa -->
                <div class="sidebar-user">
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-avatar bg-primary">
                            <i class="bi bi-building text-white"></i>
                        </div>
                        <div class="sidebar-user-details">
                            <div class="sidebar-user-name">{{ Auth::guard('company')->user()->name }}</div>
                            <div class="sidebar-user-role">
                                @if(Auth::guard('company')->user()->plan)
                                    Plan {{ ucfirst(Auth::guard('company')->user()->plan) }}
                                @else
                                    Plan Gratuito
                                @endif
                            </div>
                        </div>
                        <div class="sidebar-user-menu dropdown">
                            <button class="sidebar-user-dropdown" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('company.profile.edit') }}">
                                        <i class="bi bi-building-gear me-2"></i>
                                        Perfil Empresa
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-credit-card me-2"></i>
                                        Mi Suscripción
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-bell me-2"></i>
                                        Notificaciones
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-shield-check me-2"></i>
                                        Seguridad
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>
                                            Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Contenido principal -->
            <main class="main-content">
                <!-- Botón de menú para móvil -->
                <button class="mobile-menu-btn d-lg-none mb-3" id="mobileMenuBtn">
                    <i class="bi bi-list"></i>
                </button>

                <!-- Header del contenido -->
                <div class="content-header fade-in">
                    <div>
                        <nav class="breadcrumb-custom">
                            <ol class="breadcrumb">
                                @yield('breadcrumbs')
                            </ol>
                        </nav>
                        <h1 class="content-title">@yield('page-title', 'Dashboard Empresarial')</h1>
                        <p class="content-subtitle">@yield('page-subtitle', 'Gestiona tu empresa y servicios')</p>
                    </div>
                    <div class="content-actions">
                        @yield('page-actions')
                    </div>
                </div>

                <!-- Notificaciones de estado -->
                @if(!Auth::guard('company')->user()->verified)
                <div class="alert alert-warning fade-in mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div>
                            <strong>Empresa pendiente de verificación</strong>
                            <p class="mb-0">Tu empresa está pendiente de verificación. Algunas funciones pueden estar limitadas hasta que sea aprobada.</p>
                        </div>
                    </div>
                </div>
                @endif

                @if(Auth::guard('company')->user()->plan === 'free')
                <div class="alert alert-info fade-in mb-4" role="alert">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <div>
                                <strong>Plan Gratuito</strong>
                                <p class="mb-0">Estás en el plan gratuito. Actualiza para acceder a más funciones.</p>
                            </div>
                        </div>
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="bi bi-arrow-up-circle me-1"></i>
                            Actualizar Plan
                        </a>
                    </div>
                </div>
                @endif

                <!-- Contenido de la página -->
                <div class="fade-in">
                    @yield('content')
                </div>
            </main>
        </div>
        @else
        <!-- Fallback si la sesión se corrompe -->
        <script>window.location.href = "{{ route('login') }}";</script>
        @endif
    @endguest

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            // Toggle sidebar
            function toggleSidebar() {
                if (sidebar) {
                    sidebar.classList.toggle('collapsed');
                }
            }

            // Toggle mobile sidebar
            function toggleMobileSidebar() {
                if (sidebar && sidebarOverlay) {
                    sidebar.classList.toggle('mobile-open');
                    sidebarOverlay.classList.toggle('active');
                }
            }

            // Event listeners
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', toggleMobileSidebar);
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', toggleMobileSidebar);
            }

            // Close mobile sidebar on window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768 && sidebar && sidebarOverlay) {
                    sidebar.classList.remove('mobile-open');
                    sidebarOverlay.classList.remove('active');
                }
            });
        });
    </script>
    
    @yield('scripts')
    @stack('scripts')
</body>
</html>