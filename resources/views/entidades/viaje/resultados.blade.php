<x-app-layout>
    @if($resultado->isEmpty())
    <div class="alert mt-6 alert-warning text-center" role="alert">
        <span>No se encontraron viajes</span>
    </br><hr>
        <a class="text-center" href="{{route('home')}}">Regresar</a>
    </div>


    @else

        <div class="container w-75 bg-white sm:px-2 px-auto py-3 mt-4 shadow-md overflow-hidden sm:rounded-lg ">

            <h1 class="font-semibold pb-2 text-center">-- Resultados de la búsqueda --</h1>

            <table class="table table-hover">
                <thead class="text-sm">
                    <tr>
                        <th scope="col">Salida</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Comodidad</th>
                        <th scope="col">Informacion</th>
                        <th scope="col">Precio</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                @foreach ($resultado as $viaje)

                    <tbody class="items-center bg-gray-200">
                        <tr>
                            <td class="">{{ $viaje->salida_formatted() }}
                                </br>
                                {{ $viaje->hora_salida }} hs</td>
                            <td> Activo </td>
                            <td>{{ $viaje->ruta->combi->tipo_de_combi }}</td>
                            <td class="text-yellow-700">{{ $viaje->pasajesLibres() }} pasajes disponibles!
                                </br>
                                Tiempo estimado: {{ $viaje->ruta->tiempo }}
                            </td>
                            <td>{{ $viaje->precio }} ARS</td>


                            <td>
                                <!-- BOTON Comprar -->
                                <a href="{{url('/pasaje/alta/'. $viaje->id) }} ">
                            <button type=" button" class="btn btn-primary" title="Comprar Pasaje">

                                    Comprar

                                    </button>
                            </td>

                        </tr>
                    </tbody>

                @endforeach
            </table>


    @endif

</x-app-layout>
