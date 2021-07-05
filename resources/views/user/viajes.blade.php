<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight ">
            {{ __('Mis viajes') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session()->has('mensaje'))
        <div class="alert mt-6 alert-warning text-center" role="alert">
            <span>{{session('mensaje')}} </span>
        </div>
        @endif
        @if( $resultado->isEmpty() )
        <div class="alert mt-6 alert-warning text-center" role="alert">
            <span>Usted no tiene ningun pasaje disponible </span>
        </div>

        @else


        <table class="table table-hover bg-white mt-4 table-bordered   ">
            <thead align="center">
                <tr class="thead-dark">
                    <th scope="col">Salida</th>
                    <th scope="col">Llegada</th>
                    <th scope="col">Num. asiento</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Ver viaje</th>
                    <th scope="col">Precio Total</th>
                </tr>
            </thead>
            @foreach ($resultado as $pasaje)

            <tbody id='pasajes' align="center">
                <tr class="te">
                    <td>{{$pasaje->nombre}} -
                        {{ $pasaje->fecha_salida }}
                        </br>
                        {{ $pasaje->hora_salida }} hs
                    </td>

                    <td>{{ $pasaje->llegada }}</td>
                    <td class="font-black ">{{ $pasaje->asiento }}</td>
                    <td> Viaje {{ $pasaje->estado }} 
                    @if($pasaje->estado == 'cancelado'||$pasaje->estado == 'cancelado por el usuario'|| $pasaje->estado == 'rechazado' )
                    se le han devuelto ${{$pasaje->dinero_devuelto}}
                        @endif</td>
                    <td>

                        <!--Boton info -->
                        <a href="{{ route('pasaje.info', ['pasaje' => $pasaje]) }}">
                            <button type="button" class="btn btn-info" title="Ver pasaje">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg>

                            </button>



                    </td>
                    <td class="table-success text-center">{{ $pasaje->total_compra }}</td>
                </tr>
            </tbody>

            @endforeach
        </table>


        <div class="container">
            {{ $resultado->links() }}
        </div>
        @endif

    </div>
</x-app-layout>