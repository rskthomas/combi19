<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Ingrese los datos de su busqueda') }}
        </h2>
    </x-slot>



    @if (session()->has('popup'))
        <div class="alert alert-success" role="alert">
            <span>Se ha eliminado el usuario </span>
        </div>
    @endif

    @if (session()->has('gold'))
        <div class="alert alert-success" role="alert">
            <span>Se ha registrado exitosamente como usuario Gold !</span>
        </div>
    @endif

    @if (session()->has('nogold'))
        <div class="alert alert-success" role="alert">
            <span>Se ha registrado exitosamente como usuario Viajero!</span>
        </div>
    @endif


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full sm:max-w-md
            px-6 py-3 mt-3 bg-white shadow-md overflow-hidden sm:rounded-lg">

        <form method="POST" action="{{ route('combi.store') }}">
            @csrf

            <div class="form-group">
                <x-label for="lugar_salida" :value="__('Lugar de salida')" />

                <x-input id="lugar_salida" class="block mt-1 w-full" type="text" name="lugar_salida"
                    class="typeahead form-control" required />
            </div>

            <div class="form-group">
                <x-label for="Date" :value="__('Fecha de Salida')" />
                <x-datepicker :name="'date'">
                </x-datepicker>
            </div>

            <!-- Fecha de salida-->

        </form>
    </div>

    <script type="text/javascript">

        var path = "{{ route('home.autocomplete') }}";

        $('input.typeahead').typeahead({

            source:  function (query, process) {

            return $.get(path, { query: query }, function (data) {

                    return process(data);

                });

            }

        });

    </script>


</x-app-layout>
