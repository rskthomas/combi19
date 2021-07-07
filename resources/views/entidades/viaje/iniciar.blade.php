<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Pasajeros del viaje') }}

            @if ($viaje->pasajesLibres() > 0)

                <a class="btn btn-dark ml-4" role="button" title="express"
                    href="{{ route('pasaje.express', ['viaje' => $viaje]) }}">
                    Vender pasaje express
                </a>

            @else

                <button class="btn btn-dark ml-4" role="button" title="express" disabled ">
                    Vender pasaje express
                </button>
            <p class="text-red-900"> La combi está llena! </p>
            @endif
        </h2>

    </x-slot>


    @if (session()->has('pasaje_express_rechazado'))

        <div class="alert alert-warning text-center" role="alert">
            <span> {{ session()->get('pasaje_express_rechazado') }} presenta sintomas de COVID-19
                y no puede subir a la combi </span>

        </div>
    @endif
    @if (session()->has('pasaje_express_exitoso'))

        <div class="alert alert-success text-center" role="alert">
            <span> El pasajero {{ session()->get('pasaje_express_exitoso') }} puede subir a la combi </span>
            <br>
            <span> La contraseña de su nueva cuenta será enviada al email ingresado </span>
            <br>
            <span> Se le han cobrado {{ $viaje->precio }} ARS </span>
        </div>
    @endif
    @if (session()->has('pasaje_rechazado'))

        <div class="alert alert-warning text-center" role="alert">
            <span>El pasajero {{ session()->get('pasaje_rechazado')->usuario->name }} presenta sintomas de COVID-19 y
                se
                marca como rechazado por 15 dias</span>
            <p> Se le han devuelto {{ session()->get('pasaje_rechazado')->total_compra }} ARS</p>
        </div>
    @endif
    @if (session()->has('pasaje_ausente'))

        <div class="alert alert-warning text-center" role="alert">
            <span>El pasajero {{ session()->get('pasaje_ausente')->usuario->name }} no se ha presentado </span>
            <p> No se le devuelve el monto del pasaje</p>
        </div>
    @endif


    @if ($viaje->pasajes->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            <span>No hay pasajeros inscriptos, pero puede vender alguno en el lugar </span>
        </div>

    @else
        <div class="mt-4">
            <h2 class="font-bold text-xl leading-tight text-center p-2">
                {{ __('Listado de pasajero') }}
                <br>
                <p class="font-semibold text-center">
                    de {{ $viaje->ruta->salida->nombre }} a {{ $viaje->ruta->llegada->nombre }} -
                    {{ $viaje->salida_formatted() }}
                    {{ $viaje->hora_salida }}
                </p>
                <hr>
            </h2>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 ">


                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Numero de pasaje</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>

                            </tr>
                        </thead>
                        @foreach ($pasajes as $pasaje)

                            <tbody id='viajero'>
                                <tr>
                                    <td>{{ $pasaje->id }}</td>
                                    <td>{{ $pasaje->usuario->name }}</td>
                                    <td>{{ $pasaje->usuario->email }}</td>
                                    <td>{{ $pasaje->estado }}</td>
                                    <td>

                                        <!-- Tomar cuestionarip -->
                                        @if ($pasaje->estado == 'pendiente')
                                            <a href="{{ route('pasaje.cuestionario', ['pasaje' => $pasaje]) }}">
                                                <button type="button" class="btn btn-dark" title="IniciarPasaje">
                                                    Iniciar Cuestionario
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ route('pasaje.cuestionario', ['pasaje' => $pasaje]) }}">
                                                <button type="button" class="btn btn-dark" title="IniciarPasaje"
                                                    disabled>
                                                    Iniciar Cuestionario
                                                </button>
                                            </a>

                                        @endif

                                        <!-- BOTON VER -->
                                        <a class="btn btn-info" role="button" title="Ver usuario"
                                            href="{{ route('user.info', ['user' => $pasaje->usuario]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg>
                                        </a>
                                    </td>

                                </tr>
                            </tbody>

                        @endforeach
                    </table>


                    <div class="container">
                        {{ $pasajes->links() }}
                    </div>
                </div>


            </div>

        </div>
        <div class="flex items-center justify-center mt-6 btn-lg ">

            <a href="#ventanaModal" style="text-decoration:none" data-toggle="modal">
                <button type="button" class="btn btn-success" title="IniciarViaje">
                    Iniciar Viaje
                </button>
            </a>




            <div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">¿Esta seguro que desea iniciar el
                                viaje?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-sm">
                            El viaje pasa a estar activo, y los pasajeros que no se encuentran activos seran marcados
                            como "ausente"
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                            <form method="POST" action="{{ route('viaje.iniciar', ['viaje' => $viaje]) }}">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-success">Iniciar Viaje</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
