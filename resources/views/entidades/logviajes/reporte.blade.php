<div style="background-color: rgb(66, 97, 114)">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Reporte de viajes realizados') }}
            </h2>

        </x-slot>
        @if(isset($busqueda))

        <div class="alert alert-success" role="alert">
            <span>Resultados de su busqueda</span>
        </div>
        @endif


        @if (!isset($resultado) or $resultado->isEmpty())
        <div class="alert alert-success text-center" role="alert">
            <span>No hay viajes </span>
        </div>

        @else
        <div class="mt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 ">

                    <form method="POST" class="" action="{{ route('logviaje.search') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6 ">
                                <x-label for="departure" :value="__('Lugar de salida')" />
                                <input oninput="this.value = this.value.toUpperCase()" id="search" type="text" name="departure" placeholder="Busque el lugar de origen" :value="old('departure')" class="typeahead form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            </div>

                            <div class="form-group col-6">
                                <x-label for="destination" :value="__('Lugar de destino')" />
                                <input oninput="this.value = this.value.toUpperCase()" id="search" type="text" name="destination" placeholder="Busque el lugar de destino" :value="old('destination')" class=" w-auto typeahead form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            </div>

                        </div>
                        <div class="row">


                            <div class="form-group col-6">
                                <x-label for="fecha_desde" :value="__('Desde')" />
                                <x-datepickercopy :name="'fecha_desde'" :id="'id_fecha_desde'">
                                </x-datepickercopy>
                            </div>

                            <div class="form-group col-6">
                                <x-label for="fecha_hasta" :value="__('Hasta')" />
                                <x-datepickercopy :name="'fecha_hasta'" :id="'id_fecha_hasta'">
                                </x-datepickercopy>
                            </div>

                        </div>

                        <x-button :class="'w-100 justify-center'">
                            Buscar viaje!</x-button>

                    </form>

                </div>
            </div>




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



                    </div>

                </div>
            </div>

        </div>

        @endif


        <footer class="page-footer font-small white">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">© 2021 Copyright:
                <a href="https://www.google.com" style="color:whitesmoke"> COMBI19.com</a>
            </div>
        </footer>


</div>

<script languaje="javascript">

</script>


</x-app-layout>