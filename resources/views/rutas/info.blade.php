<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Ruta- ') }} {{ $ruta ->salida->nombre}} -{{ $ruta ->llegada->nombre}}
        </h2>
    </x-slot>
    @if(session()->has('rutamodificada'))

<div class="alert alert-success" role="alert">
    Se ha modificado el perfil con exito
</div>

@endif


    <div class="py-8 col-md-5 mx-auto ">
        <div class="bg-white border-b border-gray-200 ">

            <div class="container p-2 ">
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Lugar de salida </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $ruta->salida->nombre}}
                        </div>
                    </div>
                </div>

                <hr />
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Lugar de llegada </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{$ruta->llegada->nombre}}
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Combi Asignada </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            <a href="{{ route('combi.info', ['combi' => $ruta->combi]) }}">

                        {{ $ruta->combi->patente  }} </a><!-- ponerle un link -->
                        </div>
                    </div>
                </div>
                <hr />

                  <!-- a row -->
                  <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Tiempo estimado de viaje</div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $ruta->tiempo}}
                        </div>
                    </div>
                </div>
                <hr />

                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">kilometros aproximados</div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $ruta->kms}}
                        </div>
                    </div>
                </div>
                <hr />




                <!-- a row -->
                <div class="row p-3 mt-3">
                    <div class="col-sm "> Ruta registrada el  </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $ruta->created_at ->format('Y-m-d') }}
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
