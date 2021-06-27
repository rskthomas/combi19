<div style="background-color: rgb(66, 97, 114)">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Combi - ') }} {{ $combi ->patente }}
        </h2>
    </x-slot>


    @if(session()->has('bajaerronea'))

    <div class="alert alert-warning text-center" role="alert">
        <span>Antes de eliminar la combi debe desasignar la ruta</span>
    </div>

    @endif


    @if(session()->has('choferanclado'))

    <div class="alert alert-warning text-center" role="alert">
        <span>La combi no puede quedar sin un chofer; tiene una ruta asignada</span>
    </div>

    @endif

    @if(session()->has('tienechofer'))

    <div class="alert alert-warning text-center" role="alert">
        <span>No se puede eliminar la combi, tiene un chofer asignado</span>
    </div>

    @endif

    @if(session()->has('combimodificado'))

    <div class="alert alert-success text-center" role="alert">
        Se ha modificado la combi con exito
    </div>

    @endif
    <div class="py-8 col-md-5 mx-auto ">
        <div class="bg-white border-b border-gray-200 ">

            <div class="container p-2 ">
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Patente
                    </x-slot>
                    {{ $combi->patente }}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Modelo
                    </x-slot>
                    {{ $combi->modelo }}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Cantidad de asientos
                    </x-slot>
                    {{ $combi->asientos }}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Tipo de combi
                    </x-slot>
                    {{ $combi->tipo_de_combi }}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Chofer
                    </x-slot>
                    @isset($combi->chofer)
                    <a href="{{ route('chofer.info', ['chofer' => $combi->chofer]) }}">
                        {{ $combi->chofer->name }}</a>
                    @else
                    Libre
                    @endisset
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Ruta asignada
                    </x-slot>
                    @isset($combi->ruta)
                    <a href="{{ route('ruta.info', ['ruta' => $combi->ruta]) }}">
                        {{ $combi->ruta->id}}</a>
                    @else
                    No hay ruta asiganada
                    @endisset
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Combi registrada el
                    </x-slot>
                    {{ $combi->created_at ->format('Y-m-d') }}
                </x-row>
            </div>
        </div>
    </div>

    @if (Auth::user()->hasRole('administrator'))

    <x-options-bar :item="$combi" :tipo="'combi'" />

    @endif
</x-app-layout>

<footer class="page-footer font-small white">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2021 Copyright:
      <a href="https://www.google.com" style="color:whitesmoke"> COMBI19.com</a>
    </div>
  </footer>

  </div>
