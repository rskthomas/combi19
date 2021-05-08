<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Alta de chofer') }}
        </h2>
    </x-slot>

@if(session()->has('popup'))

<div class="alert alert-success" role="alert">
  Se ha creado con éxito un usuario chofer
</div>

@endif

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Content starts -->
        <x-auth-card>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('altachofer') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Nombre del chofer')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                        autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required />
                </div>

                <!-- Cellphone -->
                <div class="mt-4">
                    <x-label for="cellphone" :value="__('Celular')" />

                    <x-input id="cellphone" class="block mt-1 w-full"
                                type="tel"
                                name="cellphone"
                                :value="old('cellphone')" required
                                placeholder="0221-4067811"
                                pattern="[0-9]{4}-[0-9]{7}"
                        required />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Contraseña')" />

                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirmar  Contraseña')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-end mt-4">

                    <x-button class="ml-4" >
                        {{ __('Registrar Chofer') }}
                    </x-button>
                </div>

            </form>
        </x-auth-card>

    </div>

</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
