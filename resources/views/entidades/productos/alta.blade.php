<div style="background-color: rgb(66, 97, 114)">

    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Crear un nuevo Producto') }}
        </h2>
    </x-slot>
 @if (session()->has('popup'))

<div class="alert alert-success text-center" role="alert">
    Se ha creado con éxito el Producto!
</div>

@endif

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Content starts -->
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100">

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            <form method="POST" action="{{ route('producto.store') }}">
                @csrf
                {{-- Nombre --}}
                <div class="">
                    <x-label for="nombre" :value="__('Nombre del Producto')" />
                    <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')"
                        placeholder="Ej.:Alfajor"  required autofocus oninvalid="this.setCustomValidity('Por favor, ingrese un nombre')" oninput="setCustomValidity('')" />
                </div>

                <!-- Descripcion -->
                <div class="mt-4">
                    <x-label for="descripcion" :value="__('Descripcion')" />

                    <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" :value="old('descripcion')"
                        placeholder="Ej.: Masa fina cubierta en chocolate"  required autofocus oninvalid="this.setCustomValidity('Por favor, ingrese una descripcion')" oninput="setCustomValidity('')" />
                </div>

                <x-label for="tipo" :value="__('Tipo del producto?')" class="mt-2 font-bold" />
                <div class="mt-4 ml-5">
                    <label for="tipo">
                    <input type="radio" name="tipo" value="Salado" checked>
                             Salado </label><br>

                    <input type="radio" name="tipo" value="Dulce">
                    <label for="tipo"> Dulce </label>
                </div>

                 <!-- Precio -->
                 <div class="mt-4">
                    <x-label for="precio" :value="__('Precio')" />

                    <x-input id="precio" class="block mt-1 w-full" type="number " step=".01" name="precio" :value="old('precio')"
                        placeholder="Ej.: 50.00"  required autofocus oninvalid="this.setCustomValidity('Por favor, ingrese un precio valido')" oninput="setCustomValidity('')" />
                </div>





                <div class="flex items-center justify-end mt-4">

                    <x-button class="ml-4">
                        {{ __('Crear' ) }}
                    </x-button>
                </div>

            </form>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
</div>
</div>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
    integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
</script>


<footer class="page-footer font-small white">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2021 Copyright:
      <a href="https://www.google.com" style="color:whitesmoke"> COMBI19.com</a>
    </div>
  </footer>

  </div>



