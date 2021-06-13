<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Comprar pasaje  ') }}
        </h2>
    </x-slot>
    <br>


    <div class=" max-w-7x100 mx-auto  w-full sm:max-w-screen-lg
             bg-white shadow-md overflow-hidden sm:rounded-lg">


        <x-auth-validation-errors class="mb-4 justify-center" :errors="$errors" class=" pl-4 " />

        <div class="card-header">
            Datos del viaje
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $viaje->nombre }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $viaje->descripcion }} </h6>
            <div class="row">
                <div class="col-6">
                    <x-label for="Hora" :value="__('Hora de salida:')" /> {{ $viaje->hora_salida }}

                </div>
                <div class="col-6">
                    <x-label for="fecha" :value="__('Fecha de salida:')" />
                    {{ $viaje->fecha_salida }}

                </div>
                <div class="col-6 mt-2">
                    <x-label for="salida" :value="__('Lugar de salida: ')" />{{ $viaje->ruta->salida->nombre }}

                </div>
                <div class="col-6 mt-2">
                    <x-label for="fecha" :value="__('Lugar de llegada: ')" /> {{ $viaje->ruta->llegada->nombre }}

                </div>


            </div>
            <br>
            <a href="{{ route('viaje.info', ['viaje' => $viaje]) }}" class="card-link">Mas informacion </a>
        </div>

        <!-- Content starts -->
    </div>
    <br>
    <form method="POST" action="{{ route('pasaje.store', ['viaje' => $viaje]) }}">
        @csrf
        @if(Auth::user()->isGold== 1 && Auth::user()->tarjeta->vencida() |Auth::user()->isGold== 0 )
        <input hidden id="gold" value="0">
        @else 
        <input hidden id="gold" value="1">
        @endif


        <div class=" max-w-7x100 mx-auto  w-full sm:max-w-screen-lg
             bg-white shadow-md overflow-hidden sm:rounded-lg">

            <div class="card-header">
                Comprar Pasaje
            </div>
            <div class="card-body">

                <h6 class="card-subtitle mb-2 text-muted">A continuacion complete los datos requeridos para la compra de
                    su pasaje </h6>
                <h6 class="card-subtitle mb-2 text-muted">Recuerde que si ha decidido ser usuario gold recibira grandes descuentos </h6>
                <br>




                <div class="mb-3 row" hidden>
                    <!-- ver si lo borramos-->
                    <label for="cantPasajes" class="col-sm-2 col-form-label rounded">Cantidad de Pasajes</label>
                    <div class="col-sm-1  col-md-2">
                        <input type="text" class="form-control-plaintext rounded" id="cantPasajes" name="cantPasajes" value="1">

                    </div>
                    <button type="button" class="btn " title="agregar" id="add" onclick="addPasaje('{{ $viaje->precio }}')">
                        <svg id="add" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>

                    </button>
                    <button type="button" class="btn " title="agregar" id="subs" onclick="subsPasaje('{{ $viaje->precio }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                        </svg>

                    </button>
                </div>


            </div>
        </div>
        <br>
        <div class=" max-w-7x100 mx-auto  w-full sm:max-w-screen-lg
             bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="card-header">
                <div class="mb-3 row">
                    <button type="button" class="btn btn-light" title="agregarproductos" id="addproductos"> AGREGAR
                        PRODUCTOS
                    </button>
                </div>


                @include('/entidades/pasaje/comprarProductos')

            </div>
        </div>
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 w-full sm:max-w-screen-lg
            px-6 py-3 mt-3 bg-white shadow-md overflow-hidden sm:rounded-lg
             ">

            <div class="card-header">
                <div class="mb-3 row">
                    <label for="totalPasaje" class="col-sm-2 col-form-label">Total Pasajes $</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext rounded" id="totalPasaje" name="totalPasaje" value="{{ $viaje->precio }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="totalProductos" class="col-sm-2 col-form-label">Total Productos $</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext rounded" id="totalProductos" name="totalProductos" value="0">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="totalDescuentos" class="col-sm-2 col-form-label">Total Descuentos-$</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext rounded" id="totalDescuentos" name="totalDescuentos" value="0">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="totalCompra" class="col-sm-2 col-form-label">Total A Pagar $</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext rounded" name="totalCompra" id="totalCompra" value="{{ $viaje->precio }}">
                    </div>
                </div>
            </div>
            <div class=" max-w-1xl mx-auto sm:px-2 lg:px-0 w-full sm:max-w-screen-lg
            px-0 py-3 mt-0 bg-white shadow-md overflow-hidden sm:rounded-lg">

                <div class="card-header "> Pago
                    <hr>
                    <!-- Si el usuario es gold, usar la tarjeta guardada-->
                    @if (Auth::user()->isGold() && !Auth::user()->tarjeta->vencida())

                    <x-label for="tarjeta" class="text-1x1 " :value="__('Tarjeta a utilizar:')" />

                    <div class=" w-50 max-w-1xl sm:px-2 lg:px-0 w-50 sm:max-w-screen-lg
                     bg-white shadow-md overflow-hidden sm:rounded-lg text-secondary">

                        <p class="mt-6 text-3xl text-center ">{{ '**** **** **** ' . substr(Auth::user()->tarjeta->number , -4) }}</p>
                        <p class="mt-6 text-1xl text-center">{{strtoupper(Auth::user()->name) }}</p>


                    </div>


                </div>
                @else
                @if(Auth::user()->isGold() && Auth::user()->tarjeta->vencida())

                <div class="alert alert-success" role="alert">
                    <span>Su tarjeta se encuentra vencida, por favor ingrese una nueva tarjeta </span>
                </div>
                @endif


                @include('/entidades/pasaje/pagarPasaje')

                @endif


                <div class="flex items-center justify-end mt-4">

                    <x-button class="ml-4">
                        {{ __('Comprar Pasaje') }}
                    </x-button>
                </div>


            </div>
        </div>



    </form>

    </div>

    <script src="{{ asset('js/altaPasaje.js') }}"></script>

</x-app-layout>