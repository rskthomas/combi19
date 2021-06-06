<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Pagar Pasajes') }}
        </h2>
    </x-slot>

<div class="flex flex-col items-center sm:pt-0 sm:justify-center pt-3 mb-32">


<!-- Content starts -->

@include('components.card-form')

</div>
