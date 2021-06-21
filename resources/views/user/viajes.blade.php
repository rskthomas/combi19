<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight ">
            {{ __('Mis viajes') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if($resultado->isEmpty())
        <div class="alert mt-6 alert-warning text-center" role="alert">
            <span>Usted no ha adquirido ningun pasaje </span>
        </div>

        @else
        <table class="table table-hover bg-white mt-4 table-bordered   ">
            <thead align="center">
                <tr class="thead-dark">
                    <th scope="col">Salida</th>
                    <th scope="col">Llegada</th>
                    <th scope="col">Numero de asiento</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Precio Total</th>
                </tr>
            </thead>
            @foreach ($resultado as $pasaje)

            <tbody id='pasajes' align="center">
                <tr class="te">
                    <td>{{ $pasaje->viaje->salida_formatted() }}
                    </br>
                    {{ $pasaje->viaje->hora_salida }} hs</td>

                    <td >{{ $pasaje->viaje->ruta->llegada->nombre }}</td>
                    <td class="font-black " >{{ $pasaje->asiento }}</td>
                    <td >{{ $pasaje->estado }} </td>
                    <td class="table-success text-center">{{ $pasaje->total_pasaje }}</td>
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
