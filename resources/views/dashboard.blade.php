<x-app-layout>
    <x-slot name="header">
        <div class="fade-in">
            <h2 class="text-lg sm:text-xl lg:text-2xl font-semibold text-[#014220]">
                Dashboard
            </h2>
            <p class="text-sm text-[#374151] mt-1">
                @if(auth()->user()->is_company)
                    Panel de control empresarial
                @else
                    Tu espacio personal
                @endif
            </p>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="card mb-6 sm:mb-8 slide-up">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-4 sm:mb-0">
                        <h3 class="text-lg sm:text-xl font-semibold text-[#014220] mb-1">
                            ¡Bienvenido{{ auth()->user()->is_company ? 'a' : '' }}, {{ auth()->user()->name }}!
                        </h3>
                        <p class="text-sm sm:text-base text-[#374151]">
                            @if(auth()->user()->is_company)
                                Gestiona tu empresa y descubre nuevas oportunidades
                            @else
                                Descubre lugares increíbles cerca de ti
                            @endif
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="bg-[#359744]/10 p-3 sm:p-4 rounded-full">
                            @if(auth()->user()->is_company)
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-[#359744]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            @else
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-[#359744]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <!-- Stat Card 1 -->
                <div class="stat-card slide-up" style="animation-delay: 0.1s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-[#374151] font-medium">Total</p>
                            <p class="text-xl sm:text-2xl font-bold text-[#014220] mt-1">0</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="stat-card slide-up" style="animation-delay: 0.2s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-[#374151] font-medium">Activos</p>
                            <p class="text-xl sm:text-2xl font-bold text-[#359744] mt-1">0</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="stat-card slide-up" style="animation-delay: 0.3s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-[#374151] font-medium">Favoritos</p>
                            <p class="text-xl sm:text-2xl font-bold text-[#359744] mt-1">0</p>
                        </div>
                        <div class="bg-red-100 p-3 rounded-full">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 4 -->
                <div class="stat-card slide-up" style="animation-delay: 0.4s">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-[#374151] font-medium">Visitas</p>
                            <p class="text-xl sm:text-2xl font-bold text-[#359744] mt-1">0</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Main Content Area -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Quick Actions -->
                    <div class="card slide-up" style="animation-delay: 0.5s">
                        <div class="card-header">
                            <h3 class="text-base sm:text-lg font-semibold text-[#014220]">Acciones Rápidas</h3>
                            <p class="text-xs sm:text-sm text-[#374151] mt-1">¿Qué quieres hacer hoy?</p>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            @if(auth()->user()->is_company)
                                <!-- Company Actions -->
                                <button class="action-btn touch-target">
                                    <div class="flex items-center">
                                        <div class="bg-[#359744]/10 p-2 rounded-lg mr-3 flex-shrink-0">
                                            <svg class="w-5 h-5 text-[#359744]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <h4 class="text-sm font-medium text-[#014220]">Crear Lugar</h4>
                                            <p class="text-xs text-[#374151]">Agregar nueva ubicación</p>
                                        </div>
                                    </div>
                                </button>
                                
                                <button class="action-btn touch-target">
                                    <div class="flex items-center">
                                        <div class="bg-blue-100 p-2 rounded-lg mr-3 flex-shrink-0">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <h4 class="text-sm font-medium text-[#014220]">Gestionar Posts</h4>
                                            <p class="text-xs text-[#374151]">Administrar contenido</p>
                                        </div>
                                    </div>
                                </button>
                            @else
                                <!-- User Actions -->
                                <button class="action-btn touch-target">
                                    <div class="flex items-center">
                                        <div class="bg-[#359744]/10 p-2 rounded-lg mr-3 flex-shrink-0">
                                            <svg class="w-5 h-5 text-[#359744]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <h4 class="text-sm font-medium text-[#014220]">Explorar Lugares</h4>
                                            <p class="text-xs text-[#374151]">Descubre cerca de ti</p>
                                        </div>
                                    </div>
                                </button>
                                
                                <button class="action-btn touch-target">
                                    <div class="flex items-center">
                                        <div class="bg-red-100 p-2 rounded-lg mr-3 flex-shrink-0">
                                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <h4 class="text-sm font-medium text-[#014220]">Mis Favoritos</h4>
                                            <p class="text-xs text-[#374151]">Lugares guardados</p>
                                        </div>
                                    </div>
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="card slide-up" style="animation-delay: 0.6s">
                        <div class="card-header">
                            <h3 class="text-base sm:text-lg font-semibold text-[#014220]">Actividad Reciente</h3>
                        </div>
                        <div class="space-y-4">
                            <!-- Empty State -->
                            <div class="text-center py-8">
                                <div class="bg-gray-100 p-4 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-sm font-medium text-[#374151] mb-2">Sin actividad reciente</h4>
                                <p class="text-xs text-[#374151]">Tu actividad aparecerá aquí cuando comiences a usar la plataforma</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Profile Card -->
                    <div class="card slide-up" style="animation-delay: 0.7s">
                        <div class="text-center">
                            <div class="bg-[#359744]/10 p-4 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                                @if(auth()->user()->is_company)
                                    <svg class="w-8 h-8 text-[#359744]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                @else
                                    <svg class="w-8 h-8 text-[#359744]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                @endif
                            </div>
                            <h4 class="text-sm sm:text-base font-semibold text-[#014220] mb-1">{{ auth()->user()->name }}</h4>
                            <p class="text-xs sm:text-sm text-[#374151] mb-4">
                                @if(auth()->user()->is_company)
                                    Empresa
                                @else
                                    Usuario
                                @endif
                            </p>
                            <button class="btn-outline text-xs sm:text-sm touch-target">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Editar Perfil
                            </button>
                        </div>
                    </div>

                    <!-- Quick Tips -->
                    <div class="card slide-up" style="animation-delay: 0.8s">
                        <div class="card-header">
                            <h3 class="text-sm sm:text-base font-semibold text-[#014220]">💡 Consejos</h3>
                        </div>
                        <div class="space-y-3">
                            @if(auth()->user()->is_company)
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <p class="text-xs text-blue-800 font-medium mb-1">Optimiza tu perfil</p>
                                    <p class="text-xs text-blue-700">Completa la información de tu empresa para aparecer en más búsquedas</p>
                                </div>
                                <div class="bg-green-50 p-3 rounded-lg">
                                    <p class="text-xs text-green-800 font-medium mb-1">Sube fotos de calidad</p>
                                    <p class="text-xs text-green-700">Las imágenes profesionales atraen más clientes</p>
                                </div>
                            @else
                                <div class="bg-blue-50 p-3 rounded-lg">
                                    <p class="text-xs text-blue-800 font-medium mb-1">Explora cerca de ti</p>
                                    <p class="text-xs text-blue-700">Usa la búsqueda por ubicación para descubrir lugares increíbles</p>
                                </div>
                                <div class="bg-green-50 p-3 rounded-lg">
                                    <p class="text-xs text-green-800 font-medium mb-1">Guarda tus favoritos</p>
                                    <p class="text-xs text-green-700">Marca los lugares que más te gusten para visitarlos después</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
