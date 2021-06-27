<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Pasaje- ') }} {{ $pasaje->viaje->ruta->salida->nombre }} - {{ $pasaje->viaje->ruta->llegada->nombre }}
        </h2>
    </x-slot>
    <div class=" max-w-7x100 mx-auto  w-full sm:max-w-screen-lg
             bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="card-header">
            Datos de su pasaje
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $pasaje->viaje->nombre }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $pasaje->viaje->descripcion }} </h6>
            <div class="row">
                <div class="col-6">
                    <x-label for="Hora" :value="__('Hora de salida:')" /> {{ $pasaje->viaje->hora_salida }}

                </div>
                <div class="col-6">
                    <x-label for="fecha" :value="__('Fecha de salida:')" />
                    {{ $pasaje->viaje->fecha_salida }}

                </div>
                <div class="col-6 mt-2">
                    <x-label for="salida" :value="__('Lugar de salida: ')" />{{ $pasaje->viaje->ruta->salida->nombre }}

                </div>
                <div class="col-6 mt-2">
                    <x-label for="fecha" :value="__('Lugar de llegada: ')" /> {{$pasaje->viaje->ruta->llegada->nombre }}
                </div>
                <div class="col-6 mt-2">
                    <x-label for="estado" :value="__('Estado del viaje: ')" /> {{$pasaje->viaje->estado }}

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



        <div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
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
                    $fecha=date_create_from_format('d-m-Y H:i',$pasaje->viaje->fecha_salida.' '.$pasaje->viaje->hora_salida);
                    $dtz=new DateTimeZone('America/Argentina/Buenos_Aires');
                    
                    if(!date_modify($fecha,"+48 hour") > new DateTime('now',$dtz)){
                        echo "Su viaje esta proximo a realizarse, se le devolvera el 50% del valor del pasaje($".(($pasaje->total_compra)/2).")";
                    }else{
                        echo "Se le devolvera  el valor del pasaje ($".$pasaje->total_compra.")";
                    }

                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <form method="POST" action="{{ route( 'pasaje.delete', [ 'pasaje' => $pasaje] ) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>