<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} - {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">
                        ¡Bienvenido, {{ Auth::user()->name }}!
                    </h3>
                    
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(Auth::user()->getRoleNames() as $role)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst(str_replace('_', ' ', $role)) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Company-specific sections -->
            @hasrole('company')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h4 class="text-lg font-semibold mb-4">Panel de Empresa</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h5 class="font-semibold text-blue-800">Plan Actual</h5>
                            <p class="text-blue-600">{{ Auth::user()->currentPlan()?->name ?? 'Sin plan' }}</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h5 class="font-semibold text-green-800">Posts Este Mes</h5>
                            <p class="text-green-600">
                                {{ Auth::user()->posts()->whereMonth('created_at', now()->month)->count() }}
                                / {{ Auth::user()->currentPlan()?->allowed_posts ?? 0 }}
                            </p>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <h5 class="font-semibold text-yellow-800">Estado</h5>
                            <p class="text-yellow-600">
                                {{ Auth::user()->verified ? 'Verificada' : 'Pendiente verificación' }}
                            </p>
                        </div>
                    </div>

                    <!-- Company Actions -->
                    <div class="space-x-2">
                        @can('create posts')
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Crear Publicación
                        </button>
                        @endcan
                        
                        @can('view analytics')
                        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Ver Analytics
                        </button>
                        @endcan
                        
                        @can('manage profile')
                        <button class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
                            Gestionar Perfil
                        </button>
                        @endcan
                    </div>
                </div>
            </div>
            @endhasrole

            <!-- User-specific sections -->
            @hasanyrole('user|premium_user')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h4 class="text-lg font-semibold mb-4">Panel de Usuario</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h5 class="font-semibold text-blue-800">Tipo de Usuario</h5>
                            <p class="text-blue-600">{{ ucfirst(Auth::user()->type) }}</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h5 class="font-semibold text-green-800">Intereses</h5>
                            <p class="text-green-600">{{ Auth::user()->interests()->count() }} configurados</p>
                        </div>
                    </div>

                    <!-- User Actions -->
                    <div class="space-x-2">
                        @can('view places')
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Buscar Lugares
                        </button>
                        @endcan
                        
                        @can('create comments')
                        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Ver Recomendaciones
                        </button>
                        @endcan
                        
                        @can('edit profile')
                        <button class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
                            Configurar Intereses
                        </button>
                        @endcan
                    </div>

                    <!-- Premium User Features -->
                    @hasrole('premium_user')
                    <div class="mt-6 p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg border border-yellow-200">
                        <h5 class="font-semibold text-yellow-800 mb-2">🌟 Funciones Premium</h5>
                        <div class="space-x-2">
                            @can('advanced filters')
                            <button class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                Filtros Avanzados
                            </button>
                            @endcan
                            
                            @can('export data')
                            <button class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                Exportar Datos
                            </button>
                            @endcan
                            
                            @can('priority support')
                            <button class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                Soporte Premium
                            </button>
                            @endcan
                        </div>
                    </div>
                    @endhasrole
                </div>
            </div>
            @endhasanyrole

            <!-- Admin-specific sections -->
            @hasrole('admin')
            <div class="bg-red-50 overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-red-200">
                <div class="p-6">
                    <h4 class="text-lg font-semibold mb-4 text-red-800">🛠️ Panel de Administración</h4>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        @can('manage users')
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <h5 class="font-semibold text-gray-800 text-sm">Usuarios</h5>
                            <p class="text-2xl font-bold text-blue-600">{{ \App\Models\User::count() }}</p>
                        </div>
                        @endcan
                        
                        @can('manage companies')
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <h5 class="font-semibold text-gray-800 text-sm">Empresas</h5>
                            <p class="text-2xl font-bold text-green-600">{{ \App\Models\Company::count() }}</p>
                        </div>
                        @endcan
                        
                        @can('manage places')
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <h5 class="font-semibold text-gray-800 text-sm">Lugares</h5>
                            <p class="text-2xl font-bold text-purple-600">0</p>
                        </div>
                        @endcan
                        
                        @can('verify companies')
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <h5 class="font-semibold text-gray-800 text-sm">Verificaciones</h5>
                            <p class="text-2xl font-bold text-orange-600">{{ \App\Models\Company::where('verified', false)->count() }}</p>
                        </div>
                        @endcan
                    </div>

                    <!-- Admin Actions -->
                    <div class="space-x-2">
                        @can('manage users')
                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Gestionar Usuarios
                        </button>
                        @endcan
                        
                        @can('manage companies')
                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Gestionar Empresas
                        </button>
                        @endcan
                        
                        @can('view all analytics')
                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Analytics Globales
                        </button>
                        @endcan
                    </div>
                </div>
            </div>
            @endhasrole

            <!-- Common Account Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h4 class="font-semibold mb-4">Información de la Cuenta</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            @if(Auth::user()->phone)
                                <p><strong>Teléfono:</strong> {{ Auth::user()->phone }}</p>
                            @endif
                            @if(Auth::user()->location)
                                <p><strong>Ubicación:</strong> {{ Auth::user()->location }}</p>
                            @endif
                        </div>
                        <div>
                            @if(Auth::user() instanceof \App\Models\Company && Auth::user()->website)
                                <p><strong>Sitio Web:</strong> 
                                    <a href="{{ Auth::user()->website }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ Auth::user()->website }}
                                    </a>
                                </p>
                            @endif
                            <p><strong>Miembro desde:</strong> {{ Auth::user()->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
