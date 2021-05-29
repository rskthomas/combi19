<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>

@if(session()->has('popup'))
    <div class="alert alert-success" role="alert">
    <span>Se ha eliminado el usuario </span>
@endif

@if(session()->has('gold'))
    <div class="alert alert-success" role="alert">
    <span>Se ha registrado exitosamente como usuario Gold !</span>
    </div>
@endif

@if(session()->has('nogold'))
<div class="alert alert-success" role="alert">
<span>Se ha registrado exitosamente como usuario Viajero!</span>
</div>
@endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Aca va el formulario de busqueda
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
