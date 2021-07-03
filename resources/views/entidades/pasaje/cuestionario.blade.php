<x-app-layout>

    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center mt-4">
        {{ __(' Cuestionario - ') }}
        {{ $pasaje->usuario->name }}
        <br>
    </h2>
    <p class="font-semibold text-center mt-1">
        de {{ $pasaje->viaje->ruta->salida->nombre}} a {{ $pasaje->viaje->ruta->llegada->nombre}} -
        {{ $pasaje->viaje->salida_formatted()}}
        {{ $pasaje->viaje->hora_salida}}
    </p>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full sm:max-w-md
        px-4 py-3 mt-3 bg-white shadow-md overflow-hidden sm:rounded-lg">

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('pasaje.subir', ['pasaje'=> $pasaje]) }}">
            @csrf

            <div class="text-center ml-12 mr-12">
                <x-label for="temperatura" :value="__('Ingrese la temperatura del viajero')" />

                <x-input id="temperatura" class="block mt-1 w-full " type="number" name="temperatura"
                    :value="old('temperatura')" :max="45" min="35" step=".1" placeholder="Ej.: 37.5" required />
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

            <div>
            <hr>
            <div class=" container container-fluid">
                <button type="submit" class="btn btn-outline-success float-right">Subir Pasajero</button>
            </div>
        </form>

        <button type="button" href="#ventanaModal" data-toggle="modal" class="btn btn-danger float-left">Ausente</button>
    </div>

<!-- Modal -->
<div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Pasajero Ausente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            ¿Quiere marcar a {{$pasaje->usuario->name}} como ausente?
        </div>
        <div class="modal-footer container container-fluid">
            <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Salir</button>
            <form method="POST" action="{{ route('pasaje.ausente', ['pasaje'=> $pasaje]) }}">
                @csrf
                <button type="submit" class="btn btn-danger">Sí, no se presentó</button>
            </form>
        </div>
    </div>
</div>
</div>

</x-app-layout>
