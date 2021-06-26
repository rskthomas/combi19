<div style="background-color: rgb(66, 97, 114)">
    <x-app-layout>

    @if (session()->has('popup'))
        <div class="alert alert-success" role="alert">
            <span>Se ha eliminado el usuario </span>
        </div>
    @endif

    @if (session()->has('pasajeComprado'))
        <div class="alert alert-success text-center" role="alert">
            <span>Se ha comprado exitosamente el pasaje!</span>
        </div>
    @endif

    @if (session()->has('usuarioSinPasaje'))

    <div class="alert alert-success text-center" role="alert">
        <span>Debes haber viajado al menos una vez para comentar en la Pagina!</span>
    </div>


    @endif


    <div
        class="flex items-center  container w-50 bg-white sm:px-2 px-auto py-3 mt-4 shadow-md overflow-hidden sm:rounded-lg ">


        <div class="w-50">
            <h1 class="font-semibold pb-2 text-center"> Buscá tu pasaje en combi </h1>
        </div>

        <form method="POST" class="w-50 pl-4" action="{{ route('viaje.search') }}">
            @csrf

            <div class="form-group ">
                <x-label for="departure" :value="__('Lugar de salida')" />
                <input oninput="this.value = this.value.toUpperCase()" id="search" type="text" name="departure"
                    placeholder="Busque el lugar de origen" :value="old('departure')"
                    class="typeahead form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required />
            </div>

            <div class="form-group">
                <x-label for="destination" :value="__('Lugar de destino')" />
                <input oninput="this.value = this.value.toUpperCase()" id="search" type="text" name="destination"
                    placeholder="Busque el lugar de destino" :value="old('destination')"
                    class=" w-auto typeahead form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required />
            </div>

            <div class="form-group">
                <x-label for="fecha_salida" :value="__('Fecha de Salida')" />
                <x-datepicker :name="'fecha_salida'">
                </x-datepicker>
            </div>

            <x-button :class="'w-100 justify-center'">
                Buscar viaje!</x-button>

        </form>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mt-4" :errors="$errors" />
    </div>


    <!-- Import typeahead.js -->
    <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>

    <!-- Initialize typeahead.js on the input -->
    <script>
        $(document).ready(function() {
            var bloodhound = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: 'api/lugares/find?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
            });

            $('.typeahead').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                name: 'lugares',
                source: bloodhound,
                display: function(data) {
                    return data.nombre //Input value to be set when you select a suggestion.
                },
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item rounded-md shadow-sm border-gray-300" bg-gray-600">No se encontró nada.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown">'
                    ],
                    suggestion: function(data) {
                        return '<div style="font-weight:bold; margin-top:-10px ! important;" class="list-group-item rounded-md shadow-sm border-gray-300" bg-gray-600">' +
                            data.nombre + '</div></div>'
                    }
                }
            });
        });

    </script>


<br>


    @include('entidades.comentarios.vista')




</x-app-layout>


<footer class="page-footer font-small white">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2021 Copyright:
      <a href="https://www.google.com" style="color:whitesmoke"> COMBI19.com</a>
    </div>
  </footer>

  </div>
