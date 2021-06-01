<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Content starts -->
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100">

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            <form method="POST" action="{{ route('producto.update',['producto' => $producto->id]) }}">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="">
                    <x-label for="nombre" :value="__('Nombre del Producto')" />
                    <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre',$producto->nombre)"
                        placeholder="Ej.:Alfajor"  required autofocus oninvalid="this.setCustomValidity('Por favor, ingrese un nombre')" oninput="setCustomValidity('')" />
                </div>

                <!-- Descripcion -->
                <div class="mt-4">
                    <x-label for="descripcion" :value="__('Descripcion')" />

                    <x-input id="descripcion" class="block mt-1 w-full" type="text" name="descripcion" :value="old('descripcion',$producto->descripcion)"
                        placeholder="Ej.: Masa fina cubierta con chocolate"  required autofocus oninvalid="this.setCustomValidity('Por favor, ingrese una descripcion')" oninput="setCustomValidity('')" />
                </div>

                 <!-- Precio -->
                 <div class="mt-4">
                    <x-label for="precio" :value="__('Precio')" />

                    <x-input id="precio" class="block mt-1 w-full" type="text" name="precio" :value="old('precio',$producto->precio)"
                        placeholder="Ej.: 50.00"  required autofocus oninvalid="this.setCustomValidity('Por favor, ingrese un Precio')" oninput="setCustomValidity('')" />
                </div>


                <div class="flex items-center justify-end mt-4">

                    <x-button class="ml-4">
                        {{ __('Editar' ) }}
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
