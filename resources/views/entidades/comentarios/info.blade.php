<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Comentario - ') }} {{ $comentario->contenido }}
        </h2>
    </x-slot>


    @if (session()->has('comentariomodificado'))
        <div class="alert alert-success text-center" role="alert">
            <span>Comentario modificado con exito! </span>
        </div>

    @endif

    <div class="py-8 col-md-5 mx-auto ">
        <div class="bg-white border-b border-gray-200 ">

            <div class="container p-2 ">

                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Autor
                    </x-slot>
                    {{ $comentario->autor }}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Contenido
                    </x-slot>
                    {{ $comentario->contenido }}
                </x-row>
                <hr />

                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Fecha del Comentario
                    </x-slot>
                    {{ $comentario->created_at }}
                </x-row>

            </div>
        </div>
    </div>


    @if (Auth::user()->hasRole('user'))

        <x-options-bar :item="$comentario" :tipo="'comentario'" />

    @endif


</x-app-layout>
