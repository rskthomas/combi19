<x-app-layout>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <link id="bs-css" href="{{ asset('css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js" integrity="sha512-5pjEAV8mgR98bRTcqwZ3An0MYSOleV04mwwYj2yw+7PBhFVf/0KcE+NEox0XrFiU5+x5t5qidmo5MgBkDD9hEw==" crossorigin="anonymous"></script>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Crear Viaje') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Content starts -->
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100">

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('viaje.store') }}">

                    @csrf

                    <x-label for="nombre" :value="__('Ingrese un nombre descriptivo para su viaje')" />

                    <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus />




                    <label for="descripcion">Descripcion </label>

                    <textarea class="form-control" id='descripcion' name="descripcion" :value="old('descripcion')">
{{old('descripcion')}}            
                    </textarea>





                    <div class=" text-sm text-gray-700"> Seleccione una ruta </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <select aria-label=".form-select-sm example"  id="ruta" name="ruta" :value="old('ruta')" required class="btn-lg btn-block text-sm text-gray-700 mt-2 justify-end rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option selected disabled hidden> ---Ruta--- </option>
                                @if((old('ruta')))
                                <option selected disabled hidden> {{old('ruta')}} </option>
                                <div class=" text-sm text-gray-700"> Descripcion </div>
                                @endif

                                @foreach ($rutas as $ruta)
                                <option value="{{$ruta->id}}" class="mr-2 text-sm text-gray-700">{{$ruta->salida->nombre}}-{{$ruta->llegada->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>




                    <br>
                    <x-label for="salida" :value="__('Dia de salida')" />

                    <div class='input-group date mt-1' id='datetimepicker1'>
                        <input type='text' placeholder="dd - mm - yyyy" id="fecha_salida" name="fecha_salida" :value="old('fecha_salida')" required readonly class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>




                    <div>
                        <x-label for="hora_salida" :value="__('Hora de salida')" />
                        <input type="time" class="block mt-1 w-full" id="hora_salida" name="hora_salida" :value="old('hora_salida')" required>
                    </div>

                    <div class="mt-4 mb-4">
                        <x-label for="precio" :value="__('Precio($ARS)')" />
                        <x-input id="precio" class="block mt-1 w-full" type="number" name="precio" :value="old('precio')" :min="0" placeholder="0" required />

                    </div>

                    <div class="mt-4 mb-4">
                        <x-label for="cant_asientos" :value="__('Cantidad de asientos')" />
                        <x-input id="cant_asientos" class="block mt-1 w-full" type="number" name="cant_asientos" :value="old('precio')" :min="0" placeholder="0" required />

                    </div>


                    <div class="flex items-center justify-end mt-4">

                        <x-button class="ml-4">
                            {{ __('Crear Viaje') }}
                        </x-button>
                    </div>




                    <!--javascript code which enables the datepicker -->




                    <script type="text/javascript">
                        $(function() {
                            $('#datetimepicker1').datepicker({
                                format: "dd-mm-yyyy",
                                weekStart: 0,
                                language: "es",
                                autoclose: true,
                                todayHighlight: true,
                                orientation: "auto",
                                startDate: new Date()


                            });
                        });
                    </script>




                </form>
            </div>
        </div>

    </div>


</x-app-layout>