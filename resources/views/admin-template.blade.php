<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', config('app.name', '¿Y Qué Hacemos Hoy?') . ' - Panel de Administración')</title>
    
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
        <!-- Pantalla de acceso para super admin no autenticado -->
        <div class="welcome-screen">
            <div class="container">
                <div class="row justify-content-center align-items-center min-vh-100">
                    <div class="col-md-6 col-lg-4 text-center">
                        <div class="welcome-content">
                            <i class="bi bi-shield-fill-check welcome-icon text-warning"></i>
                            <h1 class="welcome-title mb-4">Panel de Administración</h1>
                            <p class="welcome-subtitle mb-5">Acceso exclusivo para administradores del sistema</p>
                            <div class="auth-buttons">
                                <a href="{{ route('login') }}" class="btn btn-warning btn-lg">
                                    <i class="bi bi-shield-lock me-2"></i>
                                    Acceso Administrativo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if(auth()->check() && auth()->user() && auth()->user()->is_admin)
        <!-- Layout con sidebar para super admin -->
        <div class="sidebar-layout">
            <!-- Overlay para móvil -->
            <div class="sidebar-overlay" id="sidebarOverlay"></div>
            
            <!-- Sidebar -->
            <nav class="sidebar sidebar-admin" id="sidebar">
                <!-- Header del sidebar -->
                <div class="sidebar-header">
                    <a href="{{ url('/admin-dashboard') }}" class="sidebar-brand">
                        <i class="bi bi-shield-fill-check me-2"></i>
                        <span class="sidebar-brand-text">Super Admin</span>
                    </a>
                </div>

                <!-- Navegación -->
                <ul class="sidebar-nav">
                    <li class="sidebar-nav-item">
                        <a href="{{ route('admin-dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('admin-dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span class="sidebar-nav-text">Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- Sección Gestión de Usuarios -->
                    <li class="sidebar-nav-section">
                        <span class="sidebar-nav-section-title">Gestión de Usuarios</span>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="{{ route('admin.interests.index') }}" class="sidebar-nav-link {{ request()->routeIs('admin.interests.*') ? 'active' : '' }}">
                            <i class="bi bi-heart"></i>
                            <span class="sidebar-nav-text">Intereses</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-building"></i>
                            <span class="sidebar-nav-text">Empresas</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-person-check"></i>
                            <span class="sidebar-nav-text">Verificaciones</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-ban"></i>
                            <span class="sidebar-nav-text">Suspensiones</span>
                        </a>
                    </li>
                    
                    <!-- Sección Contenido -->
                    <li class="sidebar-nav-section">
                        <span class="sidebar-nav-section-title">Contenido</span>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-card-list"></i>
                            <span class="sidebar-nav-text">Actividades</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-calendar-event"></i>
                            <span class="sidebar-nav-text">Eventos</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-chat-square-text"></i>
                            <span class="sidebar-nav-text">Reseñas</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-flag"></i>
                            <span class="sidebar-nav-text">Reportes</span>
                        </a>
                    </li>
                    
                    <!-- Sección Finanzas -->
                    <li class="sidebar-nav-section">
                        <span class="sidebar-nav-section-title">Finanzas</span>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-credit-card"></i>
                            <span class="sidebar-nav-text">Suscripciones</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-receipt"></i>
                            <span class="sidebar-nav-text">Transacciones</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-graph-up"></i>
                            <span class="sidebar-nav-text">Ingresos</span>
                        </a>
                    </li>
                    
                    <!-- Sección Analytics -->
                    <li class="sidebar-nav-section">
                        <span class="sidebar-nav-section-title">Analytics</span>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-bar-chart"></i>
                            <span class="sidebar-nav-text">Estadísticas</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-pie-chart"></i>
                            <span class="sidebar-nav-text">Demografía</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-activity"></i>
                            <span class="sidebar-nav-text">Actividad</span>
                        </a>
                    </li>
                    
                    <!-- Sección Sistema -->
                    <li class="sidebar-nav-section">
                        <span class="sidebar-nav-section-title">Sistema</span>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-gear"></i>
                            <span class="sidebar-nav-text">Configuración</span>
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
                            <i class="bi bi-database"></i>
                            <span class="sidebar-nav-text">Base de Datos</span>
                        </a>
                    </li>
                    <li class="sidebar-nav-item">
                        <a href="#" class="sidebar-nav-link">
                            <i class="bi bi-file-earmark-text"></i>
                            <span class="sidebar-nav-text">Logs</span>
                        </a>
                    </li>
                </ul>

                <!-- Información del admin -->
                <div class="sidebar-user">
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-avatar bg-warning">
                            <i class="bi bi-shield-fill text-dark"></i>
                        </div>
                        <div class="sidebar-user-details">
                            <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                            <div class="sidebar-user-role">
                                Super Admin
                            </div>
                        </div>
                        <div class="sidebar-user-menu dropdown">
                            <button class="sidebar-user-dropdown" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person-gear me-2"></i>
                                        Mi Perfil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-shield-check me-2"></i>
                                        Configuración
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-clock-history me-2"></i>
                                        Historial
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
                        <h1 class="content-title">@yield('page-title', 'Panel de Administración')</h1>
                        <p class="content-subtitle">@yield('page-subtitle', 'Gestión completa del sistema')</p>
                    </div>
                    <div class="content-actions">
                        @yield('page-actions')
                    </div>
                </div>

                <!-- Alerta de privilegios -->
                <div class="alert alert-warning fade-in mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-shield-exclamation me-2"></i>
                        <div>
                            <strong>Modo Super Administrador</strong>
                            <p class="mb-0">Tienes acceso completo al sistema. Usa estos privilegios con responsabilidad.</p>
                        </div>
                    </div>
                </div>

                <!-- Contenido de la página -->
                <div class="fade-in">
                    @yield('content')
                </div>
            </main>
        </div>
        @else
        <!-- Fallback si no es admin -->
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

        @yield('scripts')
    </script>
    
    @stack('scripts')
</body>
</html>
