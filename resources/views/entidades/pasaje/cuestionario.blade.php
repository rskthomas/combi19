<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __(' Cuestionario - ') }}
            {{$pasaje->usuario->name}}
            <br>
        </h2>
    </x-slot>

    <div
    class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full sm:max-w-md
        px-6 py-3 mt-3 bg-white shadow-md overflow-hidden sm:rounded-lg">

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf



    </form>

</div>


</x-app-layout>
