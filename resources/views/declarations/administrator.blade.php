<!--Just copy and paste each <div> -->

<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
        {{ __('Home') }}
    </x-nav-link>
</div>


<!-- Admin choferes Dropdown -->
<div class="hidden sm:flex sm:items-center sm:ml-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button
                class="flex items-center text-sm font-medium text-black hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                {{ __('Choferes') }}

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">

            <form method="GET" action="{{ route('chofer.create') }}">

                <x-dropdown-link :href="route('chofer.create')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Alta chofer') }}
                </x-dropdown-link>
            </form>

            <form method="GET" action="{{ route('chofer.index') }}">

                <x-dropdown-link :href="route('chofer.index')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Listar choferes') }}
                </x-dropdown-link>
            </form>

        </x-slot>



    </x-dropdown>
</div>


<!-- Admin combis Dropdown -->
<div class="hidden sm:flex sm:items-center sm:ml-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button
                class="flex items-center text-sm font-medium text-black hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                {{ __('Combis') }}

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">

            <form method="GET" action="{{ route('combi.new') }}">

                <x-dropdown-link :href="route('combi.new')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Alta Combi') }}
                </x-dropdown-link>
            </form>

            <form method="GET" action="{{ route('combi.listar') }}">

                <x-dropdown-link :href="route('combi.listar')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Listar Combis') }}
                </x-dropdown-link>
            </form>

        </x-slot>



    </x-dropdown>

</div>



<!-- Admin Ruta  -->
<div class="hidden sm:flex sm:items-center sm:ml-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button
                class="flex items-center text-sm font-medium text-black hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                {{ __('Rutas ') }}

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">

            <form method="GET" action="{{ route('ruta.create') }}">

                <x-dropdown-link :href="route('ruta.create')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Alta Ruta') }}
                </x-dropdown-link>
            </form>

            <form method="GET" action="{{ route('ruta.index') }}">

                <x-dropdown-link :href="route('ruta.index')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Listar Rutas') }}
                </x-dropdown-link>
            </form>

        </x-slot>



    </x-dropdown>
</div>

<!-- Admin Lugares -->
<div class="hidden sm:flex sm:items-center sm:ml-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button
                class="flex items-center text-sm font-medium text-black hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                {{ __('Lugares ') }}

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">

            <form method="GET" action="{{ route('lugar.create') }}">

                <x-dropdown-link :href="route('lugar.create')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Alta Lugar') }}
                </x-dropdown-link>
            </form>
            <form method="GET" action="{{ route('lugar.index') }}">

                <x-dropdown-link :href="route('lugar.create')" onclick="event.preventDefault();
                    this.closest('form').submit();">
                    {{ __('Listar lugares') }}


                </x-dropdown-link>
            </form>

        </x-slot>
    </x-dropdown>
</div>

<!-- Admin Ruta  -->
<div class="hidden sm:flex sm:items-center sm:ml-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button
                class="flex items-center text-sm font-medium text-black hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                {{ __('Viajes ') }}

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">

            <form method="GET" action="{{ route('viaje.create') }}">

                <x-dropdown-link :href="route('viaje.create')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Alta viaje') }}
                </x-dropdown-link>
            </form>

            <form method="GET" action="{{ route('viaje.index') }}">

                <x-dropdown-link :href="route('viaje.index')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Listar Viajes') }}
                </x-dropdown-link>
            </form>

        </x-slot>



    </x-dropdown>
</div>

<!-- Admin Productos -->
<div class="hidden sm:flex sm:items-center sm:ml-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button
                class="flex items-center text-sm font-medium text-black hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                {{ __('Productos ') }}

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">

            <form method="GET" action="{{ route('producto.create') }}">

                <x-dropdown-link :href="route('producto.create')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Alta Producto') }}
                </x-dropdown-link>
            </form>
            <form method="GET" action="{{ route('producto.index') }}">

                <x-dropdown-link :href="route('producto.create')" onclick="event.preventDefault();
                    this.closest('form').submit();">
                    {{ __('Listar Productos') }}

                </x-dropdown-link>

            </form>

        </x-slot>
    </x-dropdown>
</div>

<div class="hidden sm:flex sm:items-center sm:ml-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button
                class="flex items-center text-sm font-medium text-black hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                {{ __('Viajeros') }}

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>


        <x-slot name="content">
            <form method="GET" action="{{ route('comentario.index')}}">
                <x-dropdown-link :href="route('comentario.index')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Listar comentarios') }}
                </x-dropdown-link>
            </form>


            <x-dropdown-link :href="route('user.bloqueados')">
                {{ __('Listar bloqueados') }}
            </x-dropdown-link>


        </x-slot>


    </x-dropdown>
</div>
