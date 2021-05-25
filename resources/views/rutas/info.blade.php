<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Ruta - ') }} {{ $ruta ->salida->nombre}} - {{ $ruta ->llegada->nombre}}
        </h2>
    </x-slot>

@if(session()->has('rutamodificada'))

<div class="alert alert-success text-center" role="alert">
    Se ha modificado la ruta con exito
</div>

@endif
@if(session()->has('nosepuedeeliminar'))

<div class="alert alert-danger text-center" role="alert">
    No se puede eliminar la ruta, tiene viajes  asignados. Pruebe eliminarlos primero
</div>

@endif




    <div class="py-8 col-md-5 mx-auto ">
        <div class="bg-white border-b border-gray-200 ">

            <div class="container p-2 ">
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Lugar de salida
                    </x-slot>
                    {{ $ruta->salida->nombre}}
                </x-row>
                <hr />
                 <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Lugar de llegada
                    </x-slot>
                    {{$ruta->llegada->nombre}}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Combi Asignada
                    </x-slot>
                    <a href="{{ route('combi.info', ['combi' => $ruta->combi]) }}">

                        {{ $ruta->combi->patente  }} </a>
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Tiempo estimado de viaje
                    </x-slot>
                    {{ $ruta->tiempo}}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        kilometros aproximados
                    </x-slot>
                    {{ $ruta->kms}}
                </x-row>
                <hr />

                <x-row>
                    <x-slot name="type">
                        Ruta registrada el
                    </x-slot>
                    {{ $ruta->created_at ->format('Y-m-d') }}
                </x-row>
                <hr />
            </div>
        </div>
    </div>

    @if (Auth::user()->hasRole('administrator'))

    <x-options-bar :item="$ruta" :tipo="'ruta'" />

    @endif

</x-app-layout>
