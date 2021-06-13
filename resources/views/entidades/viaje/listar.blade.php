<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-100 leading-tight">
        {{ __('Listar Viajes') }}
    </h2>

</x-slot>

@if(session()->has('eliminado'))

<div class="alert alert-success" role="alert">
    <span>Se ha eliminado correctamente </span>
</div>

@endif

@if($resultado->isEmpty())
<div class="alert alert-success text-center" role="alert">
    <span>No hay viajes disponibles, pruebe agregando uno </span>
</div>

@else


<div class="mt-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 ">


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Ruta</th>
                        <th scope="col">Fecha de salida </th>
                        <th scope="col">Hora de salida</th>
                        <th scope="col">Estado </th>
                        <th scope="col"> precio</th>
                        <th scope="col"> Asientos libres</th>
                        <th scope="col">  </th>


                    </tr>
                </thead>
                @foreach ($resultado as $viaje)

                <tbody id='viaje'>
                    <tr>
                    
                        <td>
                        <a href="{{ route('ruta.info', [$viaje->ruta] ) }}">{{ $viaje->ruta->salida->nombre}}-{{ $viaje->ruta->llegada->nombre}}
                        </a>
                        </td>
                        <td>{{ $viaje->fecha_salida}}</td>
                        <td>{{ $viaje->hora_salida}}</td>
                        <td>{{ $viaje->estado}}</td>
                        <td>{{ $viaje->precio}}</td>
                        <td>{{ $viaje->pasajesLibres()}}</td>
                        <td>         <td>
                               
                        @if (Auth::user()->hasRole('user') )
                        <a href="{{ route('pasaje.create', ['viaje' => $viaje]) }}">
                                    <button type="button" class="btn btn-primary" title="Comprar">

                                  Comprar Pasaje!
                                    </button></a>
@endif

                                <!-- BOTON VER -->
                                <a href="{{ route('viaje.info', ['viaje' => $viaje]) }}">
                                    <button type="button" class="btn btn-primary" title="Ver Viaje">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg>

                                    </button>
                            </td>
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
    </div>
</div>
@endif
</x-app-layout>