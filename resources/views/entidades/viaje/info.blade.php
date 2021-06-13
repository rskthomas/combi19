<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Viaje- ') }} {{ $viaje ->nombre}}
        </h2>
    </x-slot>

    @if(session()->has('modificado'))

    <div class="alert alert-success text-center" role="alert">
        Se ha modificado el viaje con exito
    </div>

    @endif
    @if(session()->has('nosepuedeeliminar'))

    <div class="alert alert-danger text-center" role="alert">
        No se puede eliminar el viaje, tiene pasajes vendidos
    </div>

    @endif

    @if(count($viaje->pasajes)!=0 && Auth::user()->hasRole('administrator')  )
    <div class="alert alert-warning text-center" role="alert">
       Recuerde que este viaje tiene pasajes vendidos, por lo tanto no se podra editar ni eliminar.

    </div>

    @endif


    <div class="py-8 col-md-5 mx-auto ">
        <div class="bg-white border-b border-gray-200 ">

            <div class="container p-2 ">
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Nombre
                    </x-slot>
                    {{ $viaje->nombre}}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Descripcion
                    </x-slot>
                    {{$viaje->descripcion}}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Ruta
                    </x-slot>
                    <a href="{{ route('ruta.info', [$viaje->ruta] ) }}">{{ $viaje->ruta->salida->nombre}}-{{ $viaje->ruta->llegada->nombre}}</a>
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Fecha de Salida
                    </x-slot>
                    {{ $viaje->fecha_salida}}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Hora de salida
                    </x-slot>
                    {{ $viaje->hora_salida}}
                </x-row>
                <hr />

                <x-row>
                    <x-slot name="type">
                        Estado
                    </x-slot>
                    {{ $viaje->estado}}
                </x-row>
                <hr />
                <x-row>
                    <x-slot name="type">
                        Cantidad de asientos
                    </x-slot>
                    {{ $viaje->cant_asientos}}
                </x-row>
                <hr />
                <x-row>
                    <x-slot name="type">
                        Disponibles
                    </x-slot>
                    {{ $viaje-> pasajesLibres()}}
                </x-row>
                <hr />
                <x-row>
                    <x-slot name="type">
                        Precio
                    </x-slot>
                    {{ $viaje-> precio}}
                </x-row>
                <hr />


                <x-row>
                    <x-slot name="type">
                       Creado el 
                    </x-slot>
                    {{ $viaje->created_at ->format('Y-m-d') }}
                </x-row>
                <hr />
            </div>
        </div>
    </div>

    @if (Auth::user()->hasRole('administrator') && count($viaje->pasajes)==0)

    <x-options-bar :item="$viaje" :tipo="'viaje'" />

    @endif

</x-app-layout>
