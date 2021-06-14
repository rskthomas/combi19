<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Alta de tarjeta') }}
        </h2>
    </x-slot>

    <div class="flex flex-col items-center sm:pt-0 sm:justify-center pt-3 mb-32">
        <!-- Content starts -->

       @include('components.card-form')

       <button class="inline-flex items-center px-4 mt-16 py-2 bg-red-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-gray-900 focus:outline-none focus:border-red-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'" >
        <a href="{{ route('home') }}"> Continuar sin ser Gold :(</a>
    </button>




    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
    integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
</script>
