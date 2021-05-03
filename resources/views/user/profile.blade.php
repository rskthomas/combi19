<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Perfil - ') }} {{ $user->name }}
        </h2>
    </x-slot>


    <div class="py-8 col-md-5 mx-auto ">
        <div class="bg-white border-b border-gray-200 ">

            <div class="container p-2 ">
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Nombre </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $user->name }}
                        </div>
                    </div>
                </div>
                <hr />
                 <!-- a row -->
                 <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Email </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $user->email }}
                        </div>
                    </div>
                </div>
                <hr />

                @if ($user->hasRole('chofer'))
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Celular </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $user->cellphone }}
                        </div>
                    </div>
                </div>
                <hr />

                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">Combi a cargo </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ '<a> a combi' }}
                        </div>
                    </div>
                </div>
                <hr />

                @endif

                @if ($user->hasRole('user'))
                <!-- a row -->
                <div class="row p-4 ">
                    <div class="col-sm font-semibold ">
                        Tipo de usuario</h4>
                    </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            @if ($user->isGold)
                               {{'Gold'}}
                            @else
                                {{'Comun'}}
                            @endif
                        </div>
                    </div>
                </div>
                <hr />

                @endif

                <!-- a row -->
                <div class="row p-3 mt-3">
                    <div class="col-sm "> Cuenta creada el </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $user->created_at ->format('Y-m-d') }}
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
