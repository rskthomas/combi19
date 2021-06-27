<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Viajeros del viaje') }}
        </h2>

    </x-slot>

@if($viaje->pasajes->isEmpty())
    <div class="alert alert-warning text-center" role="alert">
        <span>No hay pasajeros inscriptos, pero puede vender alguno en el lugar </span>
    </div>

    @else
    <div class="mt-4">
        <h2 class="font-bold text-xl leading-tight text-center p-2">
            {{ __('Listado de pasajero') }}
            <br>
            <p class="font-semibold text-center">
                de {{ $viaje->ruta->salida->nombre}} a {{ $viaje->ruta->llegada->nombre}} -
                {{ $viaje->salida_formatted()}}
                {{ $viaje->hora_salida}}
            </p>
            <hr>
        </h2>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 ">


                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Estado</th>
                            <th scope="col"> Acciones</th>

                        </tr>
                    </thead>
                    @foreach ($pasajes as $pasaje)

                    <tbody id='viajero'>
                        <tr>
                            <td>{{ $pasaje->usuario->name }}</td>
                            <td>{{ $pasaje->usuario->email }}</td>
                            <td>{{ $pasaje->estado }}</td>
                            <td>

                                <!-- Tomar cuestionarip -->
                             <button href="#" type="button" class="btn btn-dark" title="IniciarViaje">
                                   Iniciar Cuestionario
                              </button>

                                <!-- BOTON VER -->
                                <a href="{{ route('user.info', ['user' => $pasaje->usuario]) }}">
                                    <button type="button" class="btn btn-info" title="Ver chofer">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg>

                                    </button>
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
    @endif
</x-app-layout>
