<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center mt-4">
        {{ __(' Vianda para  - ') }}
        {{ $pasaje->usuario->name }}
        <br>
    </h2>
    <p class="font-semibold text-center mt-1">
        de {{ $pasaje->viaje->ruta->salida->nombre }} a {{ $pasaje->viaje->ruta->llegada->nombre }} -
        {{ $pasaje->viaje->salida_formatted() }}
        {{ $pasaje->viaje->hora_salida }}
    </p>

    @if (session()->has('pasaje_activo'))

        <div class="alert alert-success text-center" role="alert">
            <span>El pasajero {{ session()->get('pasaje_activo')->usuario->name }} puede subir a la combi </span>
            <br>
            @if ($pasaje->productos <> '{}')
            <span>Por favor, entregue su vianda </span>
            @endif
        </div>
    @endif



    <div class="  mx-auto  w-full sm:max-w-screen-lg
    bg-white shadow-md overflow-hidden sm:rounded-lg text-center">

        <div class="card-body">
            <h5 class="card-title">Productos comprados</h5>
            @if ($pasaje->productos == '{}')
                <p class="text-start text-red-900">El pasajero no ha comprado ningun producto.</p>

            @else
                @foreach ($productos as $key => $value)
                    <div class="row ">
                        <div class="col-sm">
                            <p class="text-start text-green-900">{{ $key }}</p>
                        </div>

                        <div class="col-sm sm:rounded-sm text-lg bg-indigo-200">
                            <x-label for="cantidad" :value="__('Cantidad ')" />
                            <p class="text-start ">{{ $value['cantidad'] }}</p>
                        </div>

                        <div class="col-sm">
                            <x-label for="preciou" :value="__('precio x unidad ')" />
                            <p class="text-start ">${{ $value['precio'] }}</p>
                        </div>

                        <div class="col-sm">
                            <x-label for="totalproducto" :value="__('Total producto: ')" />
                            <p class="text-start ">${{ $value['totalProducto'] }}</p>
                        </div>

                    </div>

                @endforeach

            @endif
            <div class="col-12 mt-2 mb-4 text-center">
                <x-label for="estado" class="text-lg" :value="__('Total productos : ')" /> $ ARS
                {{ $pasaje->total_productos }}
            </div>

            <a href="{{ route('viaje.iniciar', ['viaje' => $pasaje->viaje]) }}" class="mt-4">
                <button type="button" class="btn btn-success" title="VolverIniciar">
                    Volver
                </button>
            </a>

        </div>
    </div>

</x-app-layout>
