<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Modificar Combi') }}
        </h2>
    </x-slot>



    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Content starts -->
        <x-auth-card>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('combi.update',['combi' => $combi]) }}">
                @csrf @method('PUT')

                <div class="">
                    <x-label for="modelo" :value="__('Modelo')" />

                    <x-input id="modelo" class="block mt-1 w-full" type="number" name="modelo" 
                        :max="2100" min="1950" placeholder="{{$combi -> modelo}}" />
                </div>

                <!-- patente -->
                <div class="mt-4">
                    <x-label for="patente" :value="__('Patente de la combi')" />

                    <x-input id="patente" class="block mt-1 w-full" type="text" name="patente"
                        placeholder="{{$combi -> patente}}" pattern="([A-z0-9\s]){6,10}" autofocus />
                </div>

                <!--cantidad de  asientos -->
                <div class="mt-4">
                    <x-label for="asientos" :value="__('Cantidad de asientos')" />

                    <x-input id="asientos" class="block mt-1 w-full" type="number" name="asientos"
                        :value="old('asientos')" :max="180" min="0" placeholder="{{$combi -> asientos}}" />
                </div>


                <!-- Seleccionar chofer  -->
                <label for="chofer_id" class="mr-2 text-sm text-gray-700">Seleccione un chofer</label>

                    <select aria-label=".form-select-sm example" name="chofer_id" id="chofer_id" :value= "old('chofer',$combi->chofer)"
                        class="text-sm text-gray-700 mt-4 justify-end rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                        @isset($combi->chofer)
                        <option selected >{{$combi->chofer->name}}</option>
                        @else
                        <option selected disabled hidden>Seleccione un Chofer</option>
                        @endisset


                        @foreach ($resultado as $chofer)

                            <option class="mr-2 text-sm text-gray-700" value="{{ $chofer->id }}">
                                {{ $chofer->name }}</option>

                        @endforeach
                        <option class= "text-red-900" value="null">Ningun chofer</option>
                    </select>
                    @if ($resultado->isEmpty())
                    <p class="mt-3 text-sm text-left text-red-800 align-middle">
                        No hay ningun chofer disponible, </p>
                    <p class="mt-1 text-sm text-left text-green-800 align-middle">
                        No te preocupes, puedes editarlo mas adelante!</p>

                @endif

                <!-- Tip de combi  -->
                <div class="mt-4">
                    <x-label for="tipo_de_combi" :value="__('Tipo de Combi')" />
                    <div class="ml-12 mt-3 mb-2 text-sm text-gray-700">
                        <div class="form-check mb-2">
                            <input class="form-check-input" value="comoda" type="radio" name="tipo_de_combi" :value="old('tipo_de_combi',$combi->tipo_de_combi)"
                                id="tipo_de_combi" {{ ( $combi->isComoda() ) ? "checked" : "" }} >
                            <label class="form-check-label " for="flexRadioDefault2">
                                Cómoda
                            </label>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input" value="superComoda" type="radio" name="tipo_de_combi"
                                id="tipo_de_combi" {{  !($combi->isComoda()) ? "checked" : "" }} >
                            <label class="form-check-label" for="flexRadioDefault1">
                                Súper Cómoda
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">

                    <x-button class="ml-4" >
                        {{ __('Modificar') }}
                    </x-button>
                </div>

            </form>
        </x-auth-card>

    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
