<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Perfil - ') }} {{ $user->name }}
        </h2>
    </x-slot>
    @if (session()->has('perfilmodificado'))

    <div class="alert alert-success text-center" role="alert">
        Se ha modificado el perfil con exito
    </div>
    @endif
    <div class="py-8 col-md-5 mx-auto ">
        <div class="bg-white border-b border-gray-200 ">


            @if(session()->has('tienecombi'))

            <div class="alert alert-warning text-center" role="alert">
                <span> No se puede eliminar el chofer; tiene combi asignada</span>
            </div>

            @endif



            <div class="container p-2 ">

                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Nombre
                    </x-slot>
                    {{ $user->name }}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Email
                    </x-slot>
                    {{ $user->email }}
                </x-row>
                <hr />

                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Tipo de usuario
                    </x-slot>
                    @if ($user->isGold)
                    {{ 'Gold' }}
                    @else
                    {{ 'Comun' }}
                    @endif
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Fecha de nacimiento
                    </x-slot>
                    {{ $user->birthdate }}
                </x-row>
                <hr />

                <!-- a row -->
                @if ($user->isGold)
                <x-row>
                    <x-slot name="type">
                        Tarjeta de Credito
                        <hr>
                        <p class=" col-sm-9 text-secondary text-right"> terminada en  </p>
                    </x-slot>
                    {{ '** **** ' . substr($user->tarjeta->number , -4) }}
                </x-row>
                <hr />
                @endif

                <!-- a row -->
                    <x-row>
                        <x-slot name="type">
                            Cuenta creada el
                        </x-slot>
                        {{ $user->created_at->format('d-m-Y') }}
                    </x-row>

            </div>
        </div>
    </div>

</x-app-layout>
