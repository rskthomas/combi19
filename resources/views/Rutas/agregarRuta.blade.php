<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Crear Ruta') }}
        </h2>
    </x-slot>

    @if(session()->has('rutaagregada'))

<div class="alert alert-success" role="alert">
    <span>Se ha creado la ruta</span>
</div>

@endif
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Content starts -->
        <x-auth-card>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('altaruta') }}">
                @csrf
                <select aria-label=".form-select-sm example" name="salida" id="salida" required
                        class="text-sm text-gray-700 mt-4 justify-end rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option selected disabled hidden>Salida</option>
                    @foreach ($lugares as $lugar)
                    <option value="{{$lugar->id}}" class="mr-2 text-sm text-gray-700">{{$lugar-> nombre}}</option>
                    @endforeach
                </select>

                <select aria-label=".form-select-sm example" name="llegada" id="llegada" required
                        class="text-sm text-gray-700 mt-4 justify-end rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option selected disabled hidden>LLegada </option>
                    @foreach ($lugares as $lugar)
                    <option value="{{$lugar->id}}" class="mr-2 text-sm text-gray-700" >{{$lugar-> nombre}}</option>
                    @endforeach
                </select>


              

                    <select aria-label=".form-select-sm example" name="combi" id="combi" required
                        class="text-sm text-gray-700 mt-4 justify-end rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option selected disabled hidden>Seleccione una combi </option>
                        @foreach ($combis as $combi)

                            <option class="mr-2 text-sm text-gray-700" value="{{ $combi->id }}">
                                {{ $combi->patente }}</option>

                        @endforeach

                    </select>

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
    </x-auth-card>

    </div>


</x-app-layout>









<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
    integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
</script>

