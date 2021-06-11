<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Editar Comentario') }}
        </h2>
    </x-slot>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Content starts -->
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100">

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                <form method="POST" action="{{ route('comentario.update', ['comentario' => $comentario->id]) }}">
                    @csrf
                    @method('PUT')

                    <!-- Contenido-->

                    <div class="">

                        <x-label for="contenido " :value="__('Contenido del mensaje')" />
                        <textarea name="contenido" id="contenido" rows="4" cols="30"></textarea>
                        {{-- noseq  va aca --}}

                    </div>

                    {{-- faltaria actualizar la fecha de edition, o sea cambiarle la fecha de created at:( q nose si no se actualiza solo.. ??) --}}

                    <div class="flex items-center justify-end mt-4">

                        <x-button class="ml-4">
                            {{ __('Editar') }}
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
