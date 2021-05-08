<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Crear Ruta') }}
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Content starts -->
        <x-auth-card>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('altachofer') }}">

                <select class="form-select" aria-label="Default select example">
                    <option selected>Salida</option>
                    @foreach ($lugares as $lugares)
                    <option value="1">$lugares-> name</option>
                    @endforeach
                </select>

                <select class="form-select" aria-label="Default select example">
                    <option selected>Llegada</option>
                    @foreach ($lugares as $lugares)
                    <option value="1">$lugares-> name</option>
                    @endforeach
                </select>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Seleccione una combi/option>
                    @foreach ($combis as $combi)
                    <option value="1">$combi-> name</option>
                    @endforeach
                </select>




            </form>
        </x-auth-card>

    </div>


</x-app-layout>












<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>