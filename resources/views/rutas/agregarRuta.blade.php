<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Crear Ruta') }}
        </h2>
    </x-slot>

    @if(session()->has('rutaagregada'))

    <div class="alert alert-success text-center" role="alert">
        <span>Se ha creado la ruta</span>
    </div>

    @endif
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Content starts -->
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100">

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('ruta.store') }}">
                    @csrf

                    <div class=" text-sm text-gray-700"> Seleccione los campos</div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <select aria-label=".form-select-sm example" name="salida" id="salida" required class="btn-lg btn-block text-sm text-gray-700 mt-2 justify-end rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option selected disabled hidden> Salida </option>
                                @foreach ($lugares as $lugar)
                                <option value="{{$lugar->id}}" class="mr-2 text-sm text-gray-700">{{$lugar-> nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <select aria-label=".form-select-sm example" name="llegada" id="llegada" required class="btn-lg btn-block text-sm text-gray-700 mt-2  justify-end rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option selected disabled hidden> Llegada </option>
                                @foreach ($lugares as $lugar)
                                <option value="{{$lugar->id}}" class="mr-2 text-sm text-gray-700">{{$lugar-> nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                    <hr class="mt-4">
                    <select aria-label=".form-select-sm example" name="combi" id="combi" required class=" btn-lg btn-block text-sm text-gray-700 mt-2  justify-end rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                        <option selected disabled hidden>Seleccione una combi </option>
                        @foreach ($combis as $combi)

                        <option class="mr-2 text-sm text-gray-700" value="{{ $combi->id }}">
                            {{ $combi->patente }}
                        </option>

                        @endforeach
                    </select>

</div>
                    </div>

                    @if($combis->isEmpty())
                    <p class="text-sm text-red-700 mt-2"> No hay ninguna combi disponible </p>
                    @endif

                    <div class="mt-4">
                        <x-label for="tiempo" :value="__('Tiempo estimado de viaje')" />

                        <x-input id="tiempo" class="block mt-1 w-full" type="text" name="tiempo" :value="old('tiempo')" required oninvalid="this.setCustomValidity('Por favor, ingrese el tiempo estimado del viaje')" oninput="setCustomValidity('')" />
                    </div>
                    <div class="mt-4">
                        <x-label for="kms" :value="__('Cantidad de kilometros aproximados')" />

                        <x-input id="kms" class="block mt-1 w-full" type="text" name="kms" :value="old('email')" required oninvalid="this.setCustomValidity('Por favor, ingrese una cantidad de kilometros')" oninput="setCustomValidity('')" />
                    </div>


                    <div class="flex items-center justify-end mt-4">

                        <x-button class="ml-4">
                            {{ __('Crear Ruta') }}
                        </x-button>
                    </div>

                </form>


            </div>



            </form>
        </div>
    </div>

    </div>


</x-app-layout>









<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
</script>
