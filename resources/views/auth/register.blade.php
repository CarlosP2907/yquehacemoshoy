<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- User Type Selection -->
        <div class="mb-4">
            <x-input-label :value="__('Tipo de Registro')" />
            <div class="flex space-x-4 mt-2">
                <label class="flex items-center">
                    <input type="radio" name="user_type" value="user" class="mr-2" checked onclick="toggleUserType('user')">
                    <span class="text-sm text-gray-700">Usuario</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="user_type" value="company" class="mr-2" onclick="toggleUserType('company')">
                    <span class="text-sm text-gray-700">Empresa</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- User Fields (shown by default) -->
        <div id="user-fields">
            <!-- Location -->
            <div class="mt-4">
                <x-input-label for="location" :value="__('Ubicación')" />
                <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" />
                <x-input-error :messages="$errors->get('location')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Teléfono')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
        </div>

        <!-- Company Fields (hidden by default) -->
        <div id="company-fields" style="display: none;">
            <!-- Company Location -->
            <div class="mt-4">
                <x-input-label for="company_location" :value="__('Ubicación de la Empresa')" />
                <x-text-input id="company_location" class="block mt-1 w-full" type="text" name="company_location" :value="old('company_location')" />
                <x-input-error :messages="$errors->get('company_location')" class="mt-2" />
            </div>

            <!-- Company Phone -->
            <div class="mt-4">
                <x-input-label for="company_phone" :value="__('Teléfono de la Empresa')" />
                <x-text-input id="company_phone" class="block mt-1 w-full" type="text" name="company_phone" :value="old('company_phone')" />
                <x-input-error :messages="$errors->get('company_phone')" class="mt-2" />
            </div>

            <!-- Website -->
            <div class="mt-4">
                <x-input-label for="website" :value="__('Sitio Web')" />
                <x-text-input id="website" class="block mt-1 w-full" type="url" name="website" :value="old('website')" />
                <x-input-error :messages="$errors->get('website')" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Descripción')" />
                <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function toggleUserType(type) {
            const userFields = document.getElementById('user-fields');
            const companyFields = document.getElementById('company-fields');
            
            if (type === 'user') {
                userFields.style.display = 'block';
                companyFields.style.display = 'none';
                
                // Clear company fields
                document.getElementById('company_location').value = '';
                document.getElementById('company_phone').value = '';
                document.getElementById('website').value = '';
                document.getElementById('description').value = '';
            } else {
                userFields.style.display = 'none';
                companyFields.style.display = 'block';
                
                // Clear user fields
                document.getElementById('location').value = '';
                document.getElementById('phone').value = '';
            }
        }
    </script>
</x-guest-layout>
