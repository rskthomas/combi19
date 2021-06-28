<div style="background-color: rgb(66, 97, 114)">
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
            <div class="container p-2 ">

                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Nombre
                    </x-slot>
                    {{ $user->name }}
                </x-row>

                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Email
                    </x-slot>
                    {{ $user->email }}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Celular
                    </x-slot>
                    {{ $user->cellphone}}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Combi a cargo
                    </x-slot>
                    @isset($user->combi)
                    <a href="{{ route('combi.info', ['combi' => $user->combi]) }}">
                        {{ $user->combi->patente }}
                    </a>
                    @else
                    Libre
                    @endisset
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Cuenta creada el
                    </x-slot>
                    {{ $user->created_at->format('d-m-Y') }}
                </x-row>
                <hr />
            </div>
        </div>
    </div>


    @if (Auth::user()->hasRole('administrator'))

    <x-options-bar :item="$user" :tipo="'chofer'" />

    @endif

</x-app-layout>

<footer class="page-footer font-small white">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2021 Copyright:
      <a href="https://www.google.com" style="color:whitesmoke"> COMBI19.com</a>
    </div>

  </footer>

  </div>

