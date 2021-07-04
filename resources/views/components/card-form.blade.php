<style>
    input::placeholder {
        text-transform: none;
    }

    /* hide arrows from number*/
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

</style>
<div  id="nuevaTarjeta">
<form method="POST" action="{{ route('tarjeta.store') }}" name="formularioTarjeta" >
    @csrf


        <div class="row card p-3">

            <x-auth-validation-errors class="mb-4 justify-center" :errors="$errors" class=" pl-4 " />

            <div class="col-sm-12 mt-3">
                <x-label for="name" :value="__('Nombre')" />

                <x-input id="name" style="text-transform: uppercase" class="block mt-1 w-full" type="text" name="name"
                    :value="old('name')" placeholder="Como se encuentra en su tarjeta" required />
            </div>

            <div class="col-sm-12 mt-2">
                <x-label for="number" :value="__('Numero de la tarjeta de Credito')" />

                <x-input id="number" class="block mt-1 w-full" type="number" name="number" :value="old('number')"
                    placeholder="0000 0000 0000 0000" pattern="[0-9]{13,17}" required />
            </div>

            <div class="row p-3">

                <div class="form-group col-sm-4">
                    <x-label for="expiration_month" :value="__('Mes')" />
                    <select
                        class="form-control text-sm text-gray-700 justify-end rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        id="expiration_month" name="expiration_month">

                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor

                    </select>
                </div>
                <div class="form-group col-sm-4">
                    <x-label for="expiration_year" :value="__('Año')" />
                    <select
                        class="form-control text-sm text-gray-700 justify-end rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        id="expiration_year" name="expiration_year">

                        {{ $last = date('Y') + 5 }}
                        {{ $now = date('Y') - 1 }}

                        @for ($i = $now; $i <= $last; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor

                    </select>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <x-label for="cvc" :value="__('CVC')" />

                        <input
                            class="form-control text-sm text-gray-700 justify-end rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            id="cvc" name="cvc" type="number" placeholder="123" pattern="pattern=" [0-9]{3,4}"">
                    </div>
                </div>
            </div>
            <div class="align-self-end" id="opcionesNuevaTarjeta" hidden>
                <input hidden id="nuevaTarjetaAgregada" name="nuevaTarjetaAgregada">


                <input class="form-check-input" type="checkbox" id="serGold" name="serGold" value="1" checked>
                <label class="form-check-label" for="flexCheckDefault">
                    Quiero guardar esta tarjeta para futuras compras
                </label>
                <x-button type="button" id="botonCancelar" hidden>
                    {{ __('Cancelar') }}
                </x-button>

            </div>
        </div>
        <div class="align-self-end" id="opcionesNuevaTarjeta" hidden  >
            <input hidden id="nuevaTarjetaAgregada" name="nuevaTarjetaAgregada">


            <input class="form-check-input" type="checkbox"  id="serGold" name="serGold"  value="1" checked>
            <label class="form-check-label" for="flexCheckDefault"  >
            @if (Auth::user()->isGold())
                Guardar esta tarjeta y seguir siendo gold


            @else
                Quiero ser gold para la proxima compra

            @endif
            </label>
            <x-button type="button" id="botonCancelar" hidden >
                {{ __('Cancelar') }}
            </x-button>

            <div class="align-self-end" id="continuar">

                <x-button class="" id="botonContinuar">
                    {{ __('Continuar') }}
                </x-button>

            </div>

        </div>


</form>
</div>
