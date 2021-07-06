<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Bienvenido/a Chofer') }}
        </h2>
    </x-slot>

    <h2 class="font-bold text-xl leading-tight text-center mt-4">
        {{ __('Mis Proximos Viajes') }}
        <hr>
    </h2>
    @if (session()->has('viajefinalizado'))
        <div class="alert alert-success text-center" role="alert">
            <span>Su viaje ha concluido! :)</span>
        </div>
    @endif
    @if (session()->has('viajeiniciado'))
        <div class="alert alert-success text-center" role="alert">
            <span>Su viaje ha iniciado! :)</span>
        </div>
    @endif
    @if (session()->has('viajecancelado'))
        <div class="alert alert-success text-center" role="alert">
            <span>Se ha cancelado el viaje y se le ha devuelto el dinero a los pasajeros </span>
        </div>
    @endif

    @if (!isset($viajes) or $viajes->isEmpty())
        <div class="alert alert-warning text-center mt-10" role="alert">
            <span> No hay ningun viaje asignado</span>
        </div>
    @else

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 text-center">


                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Ruta</th>
                                <th scope="col">Fecha de salida </th>
                                <th scope="col">Hora de salida</th>
                                <th scope="col">Estado </th>
                                <th scope="col">Asientos libres</th>
                                <th scope="col"> </th>


                            </tr>
                        </thead>
                        @foreach ($viajes as $viaje)

                            <tbody id='viaje'>
                                <tr>

                                    <td>
                                        <a href="{{ route('ruta.info', [$viaje->ruta]) }}">{{ $viaje->ruta->salida->nombre }}-{{ $viaje->ruta->llegada->nombre }}
                                        </a>
                                    </td>
                                    <td>{{ $viaje->salida_formatted() }}
                                        @if (!Date::createFromFormat('d-m-Y', $viaje->fecha_salida) == Date::today())
                                            <br>
                                            <p class="text-color-red"> Hoy! </p>
                                        @endif

                                    </td>
                                    <td>{{ $viaje->hora_salida }}</td>
                                    <td>{{ $viaje->estado }}</td>
                                    <td class="text-center">{{ $viaje->pasajesLibres() }}</td>

                                    <td>
                                        <!-- Iniciar Viaje -->
                                        @if ($viaje->estado == 'pendiente')
                                            <a href="{{ route('viaje.iniciar', ['viaje' => $viaje]) }}">
                                                <button type="button" class="btn btn-dark" title="IniciarViaje">
                                                    Iniciar Cuestionarios
                                                </button>
                                            </a>
                                        @else
                                            <a href="#ventanaModal" style="text-decoration:none" data-toggle="modal">
                                                <button type="button" class="btn btn-dark" title="IniciarViaje">
                                                    Finalizar
                                                </button>
                                            </a>
                                        @endif


                                        <a href="{{ route('viaje.cancelar', ['viaje' => $viaje]) }}">
                                            @if ($viaje->estado == 'pendiente')
                                                <button type="button" class="btn btn-danger" title="IniciarViaje">
                                                @else
                                                    <button type="button" class="btn btn-danger" title="IniciarViaje"
                                                        disabled>
                                            @endif
                                            Cancelar
                                            </button>
                                        </a>
                                        <!-- BOTON VER -->
                                        <a href="{{ route('viaje.info', ['viaje' => $viaje]) }}">
                                            <button type="button" class="btn btn-info" title="Ver Viaje">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg>

                                            </button>

                                        </a>


                                    </td>

                                </tr>
                            </tbody>
                        @endforeach
                    </table>

                </div>
            </div>


            <div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">¿Esta seguro que desea finalizar el
                                viaje?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            El viaje sera dado por finalizado
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                            <form method="POST" action="{{ route('viaje.finalizar', ['viaje' => $viaje]) }}">
                                @csrf
                                @method('get')
                                <button type="submit" class="btn btn-danger">Finalizar</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

        </div>

    @endif
</x-app-layout>
