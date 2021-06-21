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
