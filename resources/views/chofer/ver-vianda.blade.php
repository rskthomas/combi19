<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __(' VIANDAS ') }}
        </h2>
    </x-slot>
    <br>

    <div class=" max-w-7x100 mx-auto  w-full sm:max-w-screen-lg
             bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="card-header">
            PRODUCTOS COMPRADOS POR {{ $pasaje->usuario->name }}
        </div>
        <div class="card-body">
            <h5 class="card-title"></h5>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Accordion Item #1
                        </button>
                    </h2>
                </div>

            </div>

        </div>
    </div>


</x-app-layout>