<div style="background-color: rgb(66, 97, 114)">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Crear comentario') }}
        </h2>
    </x-slot>
    @if (session()->has('popup'))

        <div class="alert alert-success text-center" role="alert">
            Se ha creado con éxito el Comentario!
        </div>

    @endif



    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Content starts -->
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100">

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                <form method="POST" action="{{ route('comentario.store') }}">
                    @csrf
                    {{-- Nombre --}}
                    <div class="">

                        <x-label for="contenido " :value="__('Contenido del mensaje')" />
                        <textarea name="contenido" id="contenido" rows="4" cols="30"></textarea>
                        {{-- noseq  va aca --}}

                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <x-button class="ml-4">
                            {{ __('Comentar') }}
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

