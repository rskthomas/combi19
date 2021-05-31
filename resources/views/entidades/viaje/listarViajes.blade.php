<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Listar Viajes ') }}
        </h2>

    </x-slot>
    @if(session()->has('eliminado'))

    <div class="alert alert-success text-center" role="alert">
        <span>Se ha eliminado la viaje </span>
    </div>

    @endif

    @if($resultado->isEmpty())
    <div class="alert alert-success text-center" role="alert">
        <span>No hay Viajes disponibles, pruebe agregando uno </span>
    </div>

    @else

    <div class="mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 ">


                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Fecha de salida</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Ruta</th>
                            <th scope="col">Acciones </th>

                        </tr>
                    </thead>
                    @foreach ($resultado as $viaje)

                    <tbody id='Viajes'>
                        <tr>
                            <td>{{ $viaje->nombre}}</td>
                            <td>{{ $viaje->descripcion}}</td>
                            <td>{{ $viaje->fecha_salida }}</td>
                            <td>{{ $viaje->hora_salida }}</td>
                            <td>
                            <a href="{{ route('ruta.info', ['ruta' => $viaje->ruta]) }}">
                            {{ $viaje->ruta->salida->nombre}}-{{ $viaje->ruta->llegada->nombre}}-combi-{{ $viaje->ruta->combi->id}}</td>
                            <td>
                            


                            <!-- BOTON MODIFICAR -->
                            <td>
                                <a href="{{ route('viaje.edit', ['viaje' => $viaje->id]) }}"  >
                                    <button type="button" class="btn btn-primary" title="Editar viaje">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                        </svg>
                                    </button>
                                </a>

                                <!-- BOTON VER -->
                                <a href="{{ route('viaje.info', ['viaje' => $viaje]) }}">
                                    <button type="button" class="btn btn-primary" title="Ver viaje">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg>

                                    </button>
                                </a>
                            </td>

                        </tr>
                    </tbody>

                    @endforeach
                </table>


                <div class="container">
                    {{ $resultado->links() }}
                </div>
            </div>



        </div>
    @endif
    </div>
</x-app-layout>
