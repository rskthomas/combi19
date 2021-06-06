<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Comprar pasaje para') }}
        </h2>
    </x-slot>


    <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 w-full sm:max-w-screen-lg
            px-6 py-3 mt-3 bg-white shadow-md overflow-hidden sm:rounded-lg
             ">

        <div class="card-header">
            Datos del viaje
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$viaje->nombre}}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{$viaje->descripcion}} </h6>
            <div class="row">
                <div class="col-6">
                    <x-label for="Hora" :value="__('Hora de salida:')" /> {{$viaje->hora_salida}}

                </div>
                <div class="col-6">
                    <x-label for="fecha" :value="__('Fecha de salida:')"  />
                    {{$viaje->fecha_salida}}

                </div>
                <div class="col-6">
                    <x-label for="salida" :value="__('Lugar de salida: ')" />{{$viaje->ruta->salida->nombre}}

                </div>
                <div class="col-6">
                    <x-label for="fecha" :value="__('Lugar de llegada: ')" /> {{$viaje->ruta->llegada->nombre}}

                </div>

               
            </div>
            <br>
            <a href="{{ route('viaje.info', ['viaje' => $viaje]) }}" class="card-link">Mas informacion </a>
        </div>

        <!-- Content starts -->
    </div>
    <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 w-full sm:max-w-screen-lg
            px-6 py-3 mt-3 bg-white shadow-md overflow-hidden sm:rounded-lg
             ">

        <div class="card-header">
            Comprar Pasaje
        </div>
        <div class="card-body">

            <h6 class="card-subtitle mb-2 text-muted">A continuacion complete los datos requeridos para la compra de su pasaje </h6>
            <br>


            <form method="POST" action="{{ route('pasaje.store') }}">
                @csrf

                <div class="mb-3 row">
                    <label for="cantPasajes" class="col-sm-2 col-form-label rounded">Cantidad de Pasajes</label>
                    <div class="col-sm-1  col-md-2">
                        <input type="text" class="form-control-plaintext rounded" id="cantPasajes"  value="1">

                    </div>
                    <button type="button" class="btn " title="agregar" id="add" onclick="addPasaje('{{$viaje->precio}}')">
                        <svg id="add" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>

                    </button>
                    <button type="button" class="btn " title="agregar" id="subs" onclick="subsPasaje('{{$viaje->precio}}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                        </svg>

                    </button>
                </div>
                <div class="mb-3 row">
                <button type="button" class="btn btn-light" " title="agregarproductos" id="addproductos"> AGREGAR PRODUCTOS
                </button>
                </div>
                @include('/entidades/pasaje/comprarProductos')
                    <div class="mb-3 row">
                        <label for="totalPasaje" class="col-sm-2 col-form-label">Total Pasajes</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control-plaintext rounded" id="totalPasaje" value="{{$viaje->precio}}">
                        </div>
                    </div>
            
                    <div class="mb-3 row">
                        <label for="totalProductos" class="col-sm-2 col-form-label">Total Productos</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control-plaintext rounded" id="totalProductos" value="0">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Total Descuentos</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control-plaintext rounded" id="staticEmail" value="0">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="totalCompra" class="col-sm-2 col-form-label">Total A Pagar</label>
                        <div class="col-sm-10">
                            <input type="text" disabled class="form-control-plaintext rounded" id="totalCompra" value="{{$viaje->precio}}">
                        </div>
                    </div>
            

                <div class="flex items-center justify-end mt-4">

                    <x-button class="ml-4">
                        {{ __('Comprar Pasaje' ) }}
                    </x-button>
                </div>




            </form>

        </div>
    </div>



    <script src="{{asset('js/altaPasaje.js')}}"></script>

</x-app-layout>