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

@if(session()->has('tieneruta'))

<div class="alert alert-warning text-center" role="alert">
<span>Antes de eliminar la combi debe eliminar la ruta</span>
</div>

@endif

@if(session()->has('choferanclado'))

<div class="alert alert-warning text-center" role="alert">
<span>No se puede cambiar el chofer - tiene una ruta asignada</span>
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
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Patente </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $combi->patente }}
                        </div>
                    </div>
                </div>
                <hr />
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Modelo </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $combi->modelo }}
                        </div>
                    </div>
                </div>
                <hr />
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Cantidad de asientos </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $combi->asientos }}
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Tipo de combi </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $combi->tipo_de_combi }}
                        </div>
                    </div>
                </div>
                <hr />
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Chofer</div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            @isset($combi->chofer)
                            <a href="{{ route('profile', ['user' => $combi->chofer]) }}">
                            {{ $combi->chofer->name }}</a>
                            @else
                              Libre
                            @endisset
                        </div>
                    </div>
                </div>
                <hr />
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Ruta asignada</div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            @isset($combi->ruta)
                            <a href="{{ route('ruta.info', ['ruta' => $combi->ruta]) }}">
                            {{ $combi->ruta->id}}</a>
                            @else
                              <p>No hay ruta asiganada</p>
                            @endisset
                        </div>
                    </div>
                </div>
                <hr />
                <!-- a row -->
                <div class="row p-3 mt-3">
                    <div class="col-sm "> Combi registrada el </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $combi->created_at ->format('Y-m-d') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->hasRole('administrator'))

    <x-options-bar :item="$combi" :tipo="'combi'" />

    @endif
</x-app-layout>
