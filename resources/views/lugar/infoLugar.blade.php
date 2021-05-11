<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Combi - ') }} {{ $combi ->patente }}
        </h2>
    </x-slot>


@if(session()->has('bajaerronea'))
<div class="alert alert-warning text-center" role="alert">
<span>Antes de eliminar la ruta debe eliminar la ruta</span>
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
                            {{ $lugar->created_at ->format('Y-m-d') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
