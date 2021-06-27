<div style="background-color: rgb(66, 97, 114)">
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
                <x-row>
                    <x-slot name="type">
                        Terminal
                    </x-slot>
                    {{ $lugar->nombre}}
                </x-row>
                <hr />
                 <!-- a row -->
                 <x-row>
                    <x-slot name="type">
                        Provincia
                    </x-slot>
                    {{ $lugar->provincia}}
                </x-row>
                <hr />
                <!-- a row -->
                 <x-row>
                    <x-slot name="type">
                        Lugar registrado el
                    </x-slot>
                    {{ $lugar->created_at }}
                </x-row>

            </div>
        </div>
    </div>


    @if (Auth::user()->hasRole('administrator'))

<x-options-bar :item="$lugar" :tipo="'lugar'" />

@endif





</x-app-layout>

<footer class="page-footer font-small white">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2021 Copyright:
      <a href="https://www.google.com" style="color:whitesmoke"> COMBI19.com</a>
    </div>
  </footer>

  </div>
