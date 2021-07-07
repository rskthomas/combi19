<x-app-layout>

    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center mt-4">
        {{ __(' Cuestionario - Pasaje Express') }}
        <br>
    </h2>
    <p class="font-semibold text-center mt-1">
        para viaje {{ $viaje->ruta->salida->nombre}} a {{ $viaje->ruta->llegada->nombre}} -
        {{ $viaje->salida_formatted()}}
        {{ $viaje->hora_salida}}
    </p>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full sm:max-w-md
        px-4 py-3 mt-3 bg-white shadow-md overflow-hidden sm:rounded-lg">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />


        <form method="POST" action="{{route('pasaje.express', ['viaje'=>$viaje])}}">
            @csrf

            <div class="text-center ml-12 mr-12">
                <x-label for="temperatura" :value="__('Ingrese la temperatura del viajero')" />

                <x-input id="temperatura" class="block mt-1 w-full " type="number" name="temperatura"
                    :value="old('temperatura')" :max="45" min="35" step=".1" placeholder="Ej.: 37.5"
                    oninvalid="this.setCustomValidity('Por favor, ingrese una valor valido') " required />
            </div>
            <hr>
            <!-- Preguntas-->
            <x-label class="mb-4 text-sm text-center" for="temperatura" :value="__('Seleccione las que corresponda')" />

            <div class="block font-bold pl-4 text-base">
                <div class="form-check mb-2 ">
                    <input class="form-check-input" type="checkbox" value="si" name="preg[]" id="Check1">
                    <label class="form-check-label ml-2" for="Check1">
                        ¿Tuvo fiebre la última semana?
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="si" name="preg[]" id="Check1">
                    <label class="form-check-label ml-2" for="Check1">
                        ¿Tuvo o tiene pérdida de olfato o gusto?
                    </label>
                </div>

                <div class="form-check mb-2 ">
                    <input class="form-check-input" type="checkbox" value="si" name="preg[]" id="Check1">
                    <label class="form-check-label ml-2" for="Check1">
                        ¿Tuvo o tiene dolor de garganta?
                    </label>
                </div>

                <div class="form-check mb-2 ">
                    <input class="form-check-input" type="checkbox" value="si" name="preg[]" id="Check1">
                    <label class="form-check-label ml-2" for="Check1">
                        ¿Tiene dificultad respiratoria?
                    </label>
                </div>
            <hr/>
            <div>
                  <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nombre y Apellido')" />

                <x-input id="name" class="block mt-4 w-full" type="text" name="name" :value="old('name')" required
                    oninvalid="this.setCustomValidity('Por favor, ingrese un nombre valido') " />
            </div>

             <!-- Email Address -->
             <div class="mt-3 mb-3">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    oninvalid="this.setCustomValidity('Por favor, ingrese un mail valido')"
                    oninput="setCustomValidity('')" />
            </div>

            <hr>

            <div class="mt-3 mb-3 text-center">
                <x-label for="monto" :value="__('Monto a cobrar')" />
            <p class="text-red-900 text-lg"> {{$viaje->precio}} ARS </p>
            </div>

            <div class=" container container-fluid">
                <a type="button" href="{{route('viaje.iniciar', ['viaje'=>$viaje])}}" class="btn btn-outline-dark float-left">Volver</a>
                <button type="submit" class="btn btn-outline-success float-right">Vender Pasaje</button>
            </div>
        </form>

    </div>



</x-app-layout>
