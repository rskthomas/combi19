<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Producto - ') }} {{ $producto ->nombre }}
        </h2>
    </x-slot>





    @if(session()->has('productomodificado'))
    <div class="alert alert-success text-center" role="alert">
        <span>Producto modificado con exito! </span>
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
                    {{ $producto->nombre}}
                </x-row>
                <hr />
                 <!-- a row -->
                 <x-row>
                    <x-slot name="type">
                        Descripcion
                    </x-slot>
                    {{ $producto->descripcion}}
                </x-row>
                <hr />
                <!-- a row -->
                <x-row>
                    <x-slot name="type">
                        Precio
                    </x-slot>
                    {{ $producto->precio}}
                </x-row>
                <hr />
                <!-- a row -->
                 <x-row>
                    <x-slot name="type">
                        Producto registrado el
                    </x-slot>
                    {{ $producto->created_at }}
                </x-row>

            </div>
        </div>
    </div>


    @if (Auth::user()->hasRole('administrator'))

<x-options-bar :item="$producto" :tipo="'producto'" />

@endif





</x-app-layout>
