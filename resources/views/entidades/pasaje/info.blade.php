<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Pasaje- ') }} {{ $pasaje->salida}} - {{ $pasaje->llegada }}
        </h2>
    </x-slot>

    @if($pasaje->estado == 'cancelado')

    <div class="alert alert-danger text-center" role="alert">
        <span>Su pasaje ha sido cancelado. Lamentamos el inconveniente. Se le han devuelto ${{$pasaje->dinero_devuelto}}</span>
    </div>

    @elseif($pasaje->estado == 'cancelado por el usuario')
        <div class="alert alert-warning text-center" role="alert">
        <span>Ha cancelado el pasaje, se le han devuelto  ${{$pasaje->dinero_devuelto}}</span>
    </div>
    @elseif($pasaje->estado == 'rechazado')
        <div class="alert alert-warning text-center" role="alert">
        <span>Su pasaje ha sido rechazado por haber presentado sintomas compatibles con COVID, se le han devuelto ${{$pasaje->dinero_devuelto}}</span>
    </div>
    @endif

    <div class=" max-w-7x100 mx-auto  w-full sm:max-w-screen-lg
             bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="card-header">
            Datos de su pasaje
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $pasaje->nombre }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $pasaje->descripcion }} </h6>
            <div class="row">
                <div class="col-6">
                    <x-label for="Hora" :value="__('Hora de salida:')" /> {{ $pasaje->hora_salida }}

                </div>
                <div class="col-6">
                    <x-label for="fecha" :value="__('Fecha de salida:')" />
                    {{ $pasaje->fecha_salida }}

                </div>
                <div class="col-6 mt-2">
                    <x-label for="salida" :value="__('Lugar de salida: ')" />{{ $pasaje->nombre }}

                </div>
                <div class="col-6 mt-2">
                    <x-label for="fecha" :value="__('Lugar de llegada: ')" /> {{$pasaje->nombre }}
                </div>
                <div class="col-6 mt-2">
                    <x-label for="estado" :value="__('Estado del viaje: ')" /> {{$pasaje->estado }}


                </div>
            </div>
            <br>

        </div>
    </div>
    <br>
    <div class=" max-w-7x100 mx-auto  w-full sm:max-w-screen-lg
             bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="card-header">
            Datos de la compra
        </div>
        <div class="card-body">
            <h5 class="card-title">Productos comprados</h5>
            @if($pasaje->productos == "{}")
            <p class="text-start">Usted no ha comprado productos.</p>

            @else
            @foreach($productos as $key=> $value)
            <div class="row">
                <div class="col-3">
                    <p class="text-start">{{$key}}</p>

                </div>



                <div class="col-1">

                    <x-label for="preciou" :value="__('precio x u: ')" />
                </div>
                <div class="col-1">
                    <p class="text-start ">${{$value['precio'] }}</p>

                </div>



                <div class="col-1">

                    <x-label for="cantidad" :value="__('cantidad: ')" />
                </div>
                <div class="col-1">
                    <p class="text-start ">{{$value['cantidad'] }}</p>

                </div>



                <div class="col-2">

                    <x-label for="totalproducto" :value="__('Total producto: ')" />
                </div>
                <div class="col-2">
                    <p class="text-start ">${{$value['totalProducto'] }}</p>

                </div>

            </div>



            @endforeach




            @endif
            <div class="col-12 mt-2">
                <x-label for="estado" :value="__('Total productos : ')" /> ${{$pasaje->total_productos }}

            </div>
            <div class="col-12 mt-2">
                <x-label for="estado" :value="__('Total pagado por pasaje : ')" /> ${{$pasaje->total_pasaje }}

            </div>

            <div class="col-12 mt-2">
                <x-label for="estado" :value="__('Total descuentos obtenidos: ')" /> ${{$pasaje->total_descuentos}}

            </div>
            <div class="col-12 mt-2">
                <x-label for="estado" :value="__('Total compra: ')" /> ${{$pasaje->total_compra}}

            </div>


        </div>
    </div>
    <br>

    @if($pasaje->estado =='pendiente' )
    <div class=" max-w-7x100 mx-auto  w-full sm:max-w-screen-lg
             bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="card-header">
            Cancelacion de pasaje
        </div>
        <div class="card-body">
            <h5 class="card-title">Antes de cancelar el pasaje tenga en cuenta lo siguiente:</h5>
            <p class="text-start ">Si cancela el pasaje con 48 de anticipacion le devolveremos el total de la compra.
                Si su viaje esta pronto a realizarse (dentro de las 48 hs) le devolveremos el 50% del valor
            </p>
            <div class="flex items-center justify-end mt-4">

                <a href="#ventanaModal" style="text-decoration:none" data-toggle="modal">
                    <x-button type="button">
                        {{ __('Cancelar Pasaje') }}
                    </x-button>
                </a>
            </div>

        </div>



        <div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">¿Esta seguro que desea cancelar pasaje?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $fecha = date_create_from_format('d-m-Y H:i', $pasaje->fecha_salida . ' ' . $pasaje->hora_salida);
                        $dtz = new DateTimeZone('America/Argentina/Buenos_Aires');
                        $fecha_actual = new DateTime('now', $dtz);

                        if (date_modify($fecha_actual, "+48 hour") > ($fecha)) {
                            echo "Su viaje esta proximo a realizarse, se le devolvera el 50% del valor del pasaje($" . (($pasaje->total_compra) / 2) . ")";
                        } else {
                            echo "Se le devolvera  el valor del pasaje ($" . $pasaje->total_compra . ")";
                        }

                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                        <form method="POST" action="{{ route( 'pasaje.delete', [ 'pasaje' => $pasaje] ) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Cancelar Pasaje</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>