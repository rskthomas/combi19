<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Combi - ') }} {{ $combi ->patente }}
        </h2>
    </x-slot>


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
                            {{ $combi->chofer->name }}
                            @else
                              Libre
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
</x-app-layout>
