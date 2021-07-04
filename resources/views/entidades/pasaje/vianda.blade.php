<x-app-layout>

    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center mt-4">
        {{ __(' Viandas para  - ') }}
        {{ $pasaje->usuario->name }}
        <br>
    </h2>
    <p class="font-semibold text-center mt-1">
        de {{ $pasaje->viaje->ruta->salida->nombre }} a {{ $pasaje->viaje->ruta->llegada->nombre }} -
        {{ $pasaje->viaje->salida_formatted() }}
        {{ $pasaje->viaje->hora_salida }}
    </p>

    <div class=" max-w-7x100 mx-auto  w-full sm:max-w-screen-lg
    bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="card-header">
            Datos de la compra
        </div>
        <div class="card-body">
            <h5 class="card-title">Productos comprados</h5>
            @if ($pasaje->productos == '{}')
                <p class="text-start">Usted no ha comprado productos.</p>

            @else
                @foreach ($productos as $key => $value)
                    <div class="row">
                        <div class="col-3">
                            <p class="text-start">{{ $key }}</p>

                        </div>



                        <div class="col-1">

                            <x-label for="preciou" :value="__('precio x u: ')" />
                        </div>
                        <div class="col-1">
                            <p class="text-start ">${{ $value['precio'] }}</p>

                        </div>



                        <div class="col-1">

                            <x-label for="cantidad" :value="__('cantidad: ')" />
                        </div>
                        <div class="col-1">
                            <p class="text-start ">{{ $value['cantidad'] }}</p>

                        </div>



                        <div class="col-2">

                            <x-label for="totalproducto" :value="__('Total producto: ')" />
                        </div>
                        <div class="col-2">
                            <p class="text-start ">${{ $value['totalProducto'] }}</p>

                        </div>

                    </div>



                @endforeach




            @endif
            <div class="col-12 mt-2">
                <x-label for="estado" :value="__('Total productos : ')" /> ${{ $pasaje->total_productos }}

            </div>
            <div class="col-12 mt-2">
                <x-label for="estado" :value="__('Total pagado por pasaje : ')" /> ${{ $pasaje->total_pasaje }}

            </div>

            <div class="col-12 mt-2">
                <x-label for="estado" :value="__('Total descuentos obtenidos: ')" /> ${{ $pasaje->total_descuentos }}

            </div>
            <div class="col-12 mt-2">
                <x-label for="estado" :value="__('Total compra: ')" /> ${{ $pasaje->total_compra }}

            </div>


        </div>
    </div>

</x-app-layout>
