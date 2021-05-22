<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Chofer - ') }} {{ $user->name }}
        </h2>
    </x-slot>
    @if (session()->has('perfilmodificado'))

        <div class="alert alert-success text-center" role="alert">
            Se ha modificado el perfil con exito
        </div>
    @endif
    <div class="py-8 col-md-5 mx-auto ">
        <div class="bg-white border-b border-gray-200 ">


@if(session()->has('tienecombi'))

<div class="alert alert-warning text-center" role="alert">
<span> No se puede eliminar el chofer; tiene combi asignada</span>
</div>

@endif


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
                                @isset($user->combi)
                                    <a href="{{ route('combi.info', ['combi' => $user->combi]) }}">
                                        {{ $user->combi->patente }}
                                    </a>
                                @else
                                    Libre
                                @endisset
                            </div>
                        </div>
                    </div>
                    <hr />


                <!-- a row -->
                <div class="row p-3 mt-3">
                    <div class="col-sm "> Cuenta creada el </div>
                    <div class="col-sm ">
                        <div class="col-sm-9 text-secondary text-left">
                            {{ $user->created_at->format('d-m-Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if (Auth::user()->hasRole('administrator'))

    <x-options-bar :item="$user" :tipo="'chofer'" />

    @endif

</x-app-layout>
