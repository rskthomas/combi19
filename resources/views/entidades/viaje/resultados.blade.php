<div style="background-color: rgb(66, 97, 114)">
<x-app-layout>


@if(isset(Auth::user()->bloqueado))

<div class="alert alert-warning" role="alert">
    <span> Por el momento usted no puede comprar pasajes ya que se encuentra bloqueado. Para mas informacion comuniquese con el administrador </span>
</div>

@endif
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
                                @if (Auth::user()->hasRole('user')&& (!isset(Auth::user()->bloqueado) ))
                                
                                @if($viaje->pasajesLibres() != 0)
                             
                                <a href="{{ route('pasaje.create', ['viaje' => $viaje]) }}">
                                    <button type="button" class="btn btn-primary" title="Comprar">

                                        Comprar Pasaje!
                                    </button></a>
                             
                                @else
                                <button type="button" class="btn btn-primary" title="Comprar" disabled>

                                    AGOTADO
                                </button>


                                @endif
                                @endif

                            </td>

                        </tr>
                    </tbody>

                @endforeach
            </table>


    @endif

</x-app-layout>

<footer class="page-footer font-small white">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2021 Copyright:
      <a href="https://www.google.com" style="color:whitesmoke"> COMBI19.com</a>
    </div>
  </footer>

  </div>



