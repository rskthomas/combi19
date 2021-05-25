<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Lugar - ') }} {{ $lugar ->nombre }}
        </h2>
    </x-slot>


    @if(session()->has('bajaerronea'))
    <div class="alert alert-warning text-center" role="alert">
        <span>Antes de eliminar/editar el lugar debe eliminar la rutas relacionadas con el mismo </span>
    </div>

    @endif

    
    @if(session()->has('lugarmodificado'))
    <div class="alert alert-success text-center" role="alert">
        <span>Lugar modificado con exito </span>
    </div>

    @endif


   

    <div class="py-8 col-md-5 mx-auto ">
        <div class="bg-white border-b border-gray-200 ">

            <div class="container p-2 ">
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Terminal </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $lugar->nombre}}
                        </div>
                    </div>
                </div>
                <hr />
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Provincia </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $lugar->provincia }}
                        </div>
                    </div>
                </div>
                <hr />

                <!-- a row -->
                <div class="row p-3 mt-3">
                    <div class="col-sm "> Lugar registrado el </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $lugar->created_at  }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if (Auth::user()->hasRole('administrator'))

<x-options-bar :item="$lugar" :tipo="'lugar'" />

@endif





</x-app-layout>