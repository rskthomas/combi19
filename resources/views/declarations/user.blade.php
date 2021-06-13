<!--Just copy and paste each <div> -->

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
            {{ __('Buscar Pasaje') }}
        </x-nav-link>
        <x-nav-link :href="route('viaje.index')" :active="request()->routeIs('home')">
            {{ __('Viajes disponibles') }}
        </x-nav-link>
    </div>
