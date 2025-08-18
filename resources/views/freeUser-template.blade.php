<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', config('app.name', '¿Y Qué Hacemos Hoy?'))</title>
    
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
<body>
    @guest
        <!-- Pantalla de bienvenida para usuarios no autenticados -->
        <div class="welcome-screen">
            <div class="container">
                <div class="row justify-content-center align-items-center min-vh-100">
                    <div class="col-md-8 col-lg-6 text-center">
                        <div class="welcome-content">
                            <i class="bi bi-emoji-smile welcome-icon"></i>
                            <h1 class="welcome-title mb-4">¿Y Qué Hacemos Hoy?</h1>
                            <p class="welcome-subtitle mb-5">Descubre actividades increíbles para hacer en tu tiempo libre</p>
                            <div class="auth-buttons">
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Iniciar Sesión
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                                        <i class="bi bi-person-plus me-2"></i>
                                        Registrarse
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if(auth()->check() && auth()->user())
        <!-- Layout con sidebar para usuarios autenticados -->
        <div class="sidebar-layout">
            <!-- Overlay para móvil -->
            <div class="sidebar-overlay" id="sidebarOverlay"></div>
            
            <!-- Sidebar -->
            <nav class="sidebar" id="sidebar">
                <!-- Header del sidebar -->
                <div class="sidebar-header">
                    <a href="{{ url('/freeUser-template') }}" class="sidebar-brand">
                        <span class="sidebar-brand-text">¿Y Qué Hacemos Hoy?</span>
                    </a>
                </div>

                <!-- Navegación -->
                <ul class="sidebar-nav">
                    <li class="sidebar-nav-item">
                        <a href="{{ route('freeUser-template') }}" class="sidebar-nav-link {{ request()->routeIs('freeUser-template') ? 'active' : '' }}">
                            <i class="bi bi-house-door"></i>
                            <span class="sidebar-nav-text">inicio</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="{{ route('interests.edit') }}" class="sidebar-nav-link {{ request()->routeIs('interests.index') ? 'active' : '' }}">
                            <i class="bi bi-check-circle"></i>
                            <span class="sidebar-nav-text">Intereses</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="{{ route('places.index') }}" class="sidebar-nav-link {{ request()->routeIs('places.index') ? 'active' : '' }}">
                            <i class="bi bi-geo-alt"></i>
                            <span class="sidebar-nav-text">Lugares</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-search"></i>
                            <span class="sidebar-nav-text">Explorar</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-heart"></i>
                            <span class="sidebar-nav-text">Favoritos</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-clock-history"></i>
                            <span class="sidebar-nav-text">Historial</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-calendar-event"></i>
                            <span class="sidebar-nav-text">Planes</span>
                        </a>
                    </li>
                    @if(auth()->check() && auth()->user() && auth()->user()->is_company)
                        <li class="sidebar-nav-item">
                            <a href="#" class="sidebar-nav-link">
                                <i class="bi bi-building"></i>
                                <span class="sidebar-nav-text">Mi Empresa</span>
                            </a>
                        </li>
                        <li class="sidebar-nav-item">
                            <a href="#" class="sidebar-nav-link">
                                <i class="bi bi-people"></i>
                                <span class="sidebar-nav-text">Equipo</span>
                            </a>
                        </li>
                    @endif
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-trophy"></i>
                            <span class="sidebar-nav-text">Logros</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="{{ route('profile.edit') }}" class="sidebar-nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                            <i class="bi bi-person-circle"></i>
                            <span class="sidebar-nav-text">Mi Perfil</span>
                        </a>
                    </li>
                </ul>

                <!-- Información del usuario -->
                <div class="sidebar-user">
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-avatar">
                            @if(auth()->user()->is_company)
                                <i class="bi bi-building"></i>
                            @else
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="sidebar-user-details">
                            <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                            <div class="sidebar-user-role">
                                @if(auth()->user()->is_company)
                                    Empresa
                                @else
                                    Usuario
                                @endif
                            </div>
                        </div>
                        <div class="sidebar-user-menu dropdown">
                            <button class="sidebar-user-dropdown" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person me-2"></i>
                                        Perfil
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
</body>
</html>