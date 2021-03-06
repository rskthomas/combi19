<!--Just copy and paste each <div> -->

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
            {{ __('Buscar Pasaje') }}
        </x-nav-link>
        <!-- Mis viajes  -->
        <x-nav-link :href="route('user.viajes', ['user' => Auth::user()])" :active="request()->routeIs('user.viajes')">
            {{ __('Mis viajes') }}
        </x-nav-link>
        <!-- Viajes Disponibles  -->
        <x-nav-link :href="route('viaje.index')" :active="request()->routeIs('viaje.index')">
            {{ __('Viajes disponibles') }}
        </x-nav-link>

    </div>




<!-- viajerosComentarios Dropdown -->
 <div class="hidden sm:flex sm:items-center sm:ml-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="flex items-center text-sm font-medium text-black hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                {{ __('Comentarios') }}

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>


        <x-slot name="content">

            <form method="GET" action="{{ route('comentario.create') }}">

                <x-dropdown-link :href="route('comentario.create')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Agregar comentario') }}
                </x-dropdown-link>
            </form>

            <form method="GET" action="{{ route('comentario.index') }}">

                <x-dropdown-link :href="route('comentario.index')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Ver mis  comentarios') }}
                </x-dropdown-link>
            </form>

        </x-slot>



    </x-dropdown>
</div>




