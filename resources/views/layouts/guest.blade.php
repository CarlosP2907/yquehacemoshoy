<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-100">
        <!-- Mobile Navigation -->
        <div id="mobile-nav" class="mobile-nav">
            <div class="mobile-nav-header">
                <div class="flex items-center">
                    <div class="bg-[#359744] p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-[#014220]">{{ config('app.name') }}</h2>
                </div>
                <button id="mobile-nav-close" class="p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="mobile-nav-content">
                <a href="{{ route('welcome') }}" class="mobile-nav-item {{ request()->routeIs('welcome') ? 'active' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Inicio
                </a>
                <a href="{{ route('login') }}" class="mobile-nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Iniciar Sesión
                </a>
                <a href="{{ route('register') }}" class="mobile-nav-item {{ request()->routeIs('register') ? 'active' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Registrarse
                </a>
            </div>
        </div>

        <div class="min-h-screen">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Logo -->
                        <div class="flex items-center">
                            <!-- Mobile Menu Button -->
                            <button id="mobile-menu-toggle" class="lg:hidden p-2 mr-2 text-gray-600 hover:text-gray-900">
                                <div class="hamburger" id="mobile-hamburger">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </button>

                            <a href="{{ route('welcome') }}" class="flex items-center">
                                <div class="bg-[#359744] p-2 rounded-lg mr-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-lg sm:text-xl font-bold text-[#014220]">{{ config('app.name') }}</h1>
                                    <p class="text-xs text-gray-500 hidden sm:block">Descubre Costa Rica</p>
                                </div>
                            </a>
                        </div>

                        <!-- Desktop Navigation -->
                        <nav class="hidden lg:flex items-center space-x-8">
                            <a href="{{ route('welcome') }}" 
                               class="text-gray-600 hover:text-[#359744] font-medium transition-colors {{ request()->routeIs('welcome') ? 'text-[#359744]' : '' }}">
                                Inicio
                            </a>
                            <a href="#" class="text-gray-600 hover:text-[#359744] font-medium transition-colors">
                                Explorar
                            </a>
                            <a href="#" class="text-gray-600 hover:text-[#359744] font-medium transition-colors">
                                Empresas
                            </a>
                        </nav>

                        <!-- Auth Buttons -->
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" 
                               class="hidden sm:inline-flex btn-outline text-sm px-4 py-2">
                                Iniciar Sesión
                            </a>
                            <a href="{{ route('register') }}" 
                               class="btn-primary text-sm px-4 py-2">
                                Registrarse
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main>
                <!-- Form Container with responsive styling -->
                @if(request()->routeIs('login') || request()->routeIs('register'))
                    <div class="min-h-screen flex flex-col justify-center py-6 sm:py-12 px-4 sm:px-6 lg:px-8">
                        <div class="w-full max-w-md mx-auto">
                            <div class="bg-white shadow-lg rounded-lg px-6 py-8 sm:px-8 sm:py-10">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                @else
                    {{ $slot }}
                @endif
            </main>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
                const mobileNav = document.getElementById('mobile-nav');
                const mobileNavClose = document.getElementById('mobile-nav-close');
                const mobileHamburger = document.getElementById('mobile-hamburger');

                function toggleMobileMenu() {
                    mobileNav.classList.toggle('open');
                    mobileHamburger.classList.toggle('open');
                }

                function closeMobileMenu() {
                    mobileNav.classList.remove('open');
                    mobileHamburger.classList.remove('open');
                }

                mobileMenuToggle?.addEventListener('click', toggleMobileMenu);
                mobileNavClose?.addEventListener('click', closeMobileMenu);

                // Close mobile menu when clicking on nav items
                const mobileNavItems = document.querySelectorAll('.mobile-nav-item');
                mobileNavItems.forEach(item => {
                    item.addEventListener('click', closeMobileMenu);
                });
            });
        </script>
    </body>
</html>
