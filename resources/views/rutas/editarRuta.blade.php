<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Editar Ruta') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Content starts -->
        <x-auth-card>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('updateruta') }}">
            @csrf @method('PUT')
            <input type="hidden" name="id" value="{{ $ruta->id}}">
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="llegada" class="form-label">Salida</label>
                    </div>
                    <div class="col-md-8">
                        <select aria-label=".form-select-sm example" name="lugar_salida" id="lugar_salida" required class="form-select  rounded border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 w-full">
                            <option selected hidden value="{{$ruta->salida->id}} "> {{$ruta->salida->nombre}}</option>
                            @foreach ($lugares as $lugar)
                            <option value="{{$lugar->id}}" class="mr-2 text-sm text-gray-700">{{$lugar-> nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="llegada" class="form-label">LLegada</label>
                    </div>
                    <div class="col-md-8">
                        <select aria-label=".form-select-sm example" name="lugar_llegada" id="lugar_llegada" required class="form-select  rounded border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 w-full">
                        <option selected hidden value="{{$ruta->llegada->id}} "> {{$ruta->llegada->nombre}}</option>
                            @foreach ($lugares as $lugar)
                            <option value="{{$lugar->id}}" class="mr-2 text-sm text-gray-700">{{$lugar-> nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="combi" class="form-label">Combi Asignada</label>
                    </div>
                    <div class="col-md-8">
                        <select aria-label=".form-select-sm example" name="combi_id" id="combi_id" required class="form-select  rounded border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 w-full">

                            <option selected hidden value="{{$ruta->combi->id}} "> {{$ruta->combi->patente}}</option>
                            @foreach ($combis as $combi)

                            <option class="mr-2 text-sm text-gray-700" value="{{ $combi->id }}">
                                {{ $combi->patente }}
                            </option>

                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <x-label for="tiempo" :value="__('Tiempo estimado de viaje')" />

                    <x-input id="tiempo" class="block mt-1 w-full" type="text" name="tiempo" :value="old('tiempo',$ruta->tiempo)" required oninvalid="this.setCustomValidity('Por favor, ingrese el tiempo estimado del viaje')" oninput="setCustomValidity('')" />
                </div>
                <div class="mt-4">
                    <x-label for="kms" :value="__('Cantidad de kilometros aproximados')" />

                    <x-input id="kms" class="block mt-1 w-full" type="text" name="kms" :value="old('email',$ruta->kms)" required oninvalid="this.setCustomValidity('Por favor, ingrese una cantidad de kilometros')" oninput="setCustomValidity('')" />
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