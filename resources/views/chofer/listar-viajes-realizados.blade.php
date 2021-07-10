<div style="background-color: rgb(66, 97, 114)">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Viajes realizados') }}
            </h2>

        </x-slot>

        @if (!isset($resultado) or $resultado->isEmpty())
        <div class="alert alert-success text-center" role="alert">
            <span>No hay viajes realizados </span>
        </div>

        @else
       


            <div class="mt-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 ">


                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre viaje</th>
                                    <th scope="col">Ruta</th>
                                    <th scope="col">Fecha de salida </th>
                                    <th scope="col">Hora de salida</th>
                                    <th scope="col">Estado </th>


                                </tr>
                            </thead>
                            @foreach ($resultado as $viaje)

                            <tbody id='viaje'>
                                <tr>

                                    <td>{{$viaje->nombre}}</td>
                                    <td>{{$viaje->salida}} - {{$viaje->llegada}}</td>
                                    <td>{{ $viaje->fecha_salida}}</td>
                                    <td>{{ $viaje->hora_salida}}</td>
                                    <td>{{ $viaje->estado}}</td>

                                    <td></td>

                                    <td>

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

            @endif
    </x-app-layout>

    <footer class="page-footer font-small white">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2021 Copyright:
            <a href="https://www.google.com" style="color:whitesmoke"> COMBI19.com</a>
        </div>
    </footer>
</div>