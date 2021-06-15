<x-guest-layout>

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-30 h-20 text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nombre y Apellido')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocusoninput="setCustomValidity('')"
                    oninvalid="this.setCustomValidity('Por favor, ingrese un nombre valido') " />
            </div>

            <!-- Email Address -->
            <div class="mt-3 mb-3">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    oninvalid="this.setCustomValidity('Por favor, ingrese un mail valido')"
                    oninput="setCustomValidity('')" />
            </div>

            <!-- Datepicker -->
            <x-label for="birthdate" :value="__('Fecha de Nacimiento')" />

            <x-datepicker :name="'birthdate'" >
            </x-datepicker>

            <!-- Password -->
            <div class="mt-3">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" oninvalid="this.setCustomValidity('Por favor, ingrese una contraseña')"
                    oninput="setCustomValidity('')" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-3">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required
                    oninvalid="this.setCustomValidity('Por favor, repita la contraseña')"
                    oninput="setCustomValidity('')" />
            </div>

            <!-- isGold -->

            <x-label for="isGold" :value="__('Quiere ser viajero Gold?')" class="mt-2 font-bold" />

            <div class="mt-3 ml-5">

                <label for="gold">
                <input type="radio" name="gold" value="" checked>
                         No, quiero pagar el precio completo! </label><br>

                <input type="radio" name="gold" value="yes">
                <label for="isGold"> Sí, quiero ahorrar! </label>

            </div>

            <div class="flex items-center justify-end mt-3">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Ya registrado?') }}
                </a>

                <x-button class="ml-3">
                    {{ __('Registrar') }}
                </x-button>
            </div>

            <!-- Select Option Rol type  LOCAL ONLY
            <div class="mt-3">
                <x-label for="role_id" value="{{ __(' (para testeo) Registrarse como:') }}" />
                <select name="role_id"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="user">Viajero</option>
                    <option value="administrator">Administrador</option>
                </select>
            </div>
                        -->

        </form>
    </x-auth-card>
</x-guest-layout>
