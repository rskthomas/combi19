<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Perfil - ') }} {{ $user->name }}
        </h2>
    </x-slot>
    @if(session()->has('perfilmodificado'))

    <div class="alert alert-success" role="alert">
        Se ha modificado el perfil con exito
    </div>

    @endif


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
                            @isset($user->combi)
                                <a href="{{ route('profile', ['user' => $user]) }}">
                                {{ $user->combi->patente }}
                                @else
                                  Libre
                                @endisset
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

                <a href="{{ route('edit',['user' => $user]) }}">
                    <button type="button" class="btn btn-primary" title="Editar chofer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                        </svg>
                    </button>
                    Editar Usuario
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
