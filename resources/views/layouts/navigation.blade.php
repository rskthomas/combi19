<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">


    <!--Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <!--if user is logged in, show normal dashboard-->
                @if (Auth::check())
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <x-application-logo class="block h-15 w-auto fill-current text-gray-600" />
                        </a>
                    </div>

                    <!-- Navigation Links, for each role -->
                    @role('administrator')
                    @include('declarations.administrator')
                    @endrole

                    @role('chofer')
                    @include('declarations.chofer')
                    @endrole

                    @role('user')
                    @include('declarations.user')
                    @endrole

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                            @role('user')
                            @if( Auth::user()->isGold() )

                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            fill="currentColor" class="bi bi-pencil" viewBox="0 0 20 20">
                            <path
                                d="M 19.214844 7.503906 C 19.214844 7.558594 19.210938 7.613281 19.199219 7.667969 L 17.964844 12.601562 C 17.902344 12.851562 17.679688 13.027344 17.421875 13.027344 L 10.023438 13.066406 C 10.019531 13.066406 10.019531 13.066406 10.019531 13.066406 L 2.617188 13.066406 C 2.359375 13.066406 2.136719 12.890625 2.074219 12.640625 L 0.839844 7.6875 C 0.824219 7.628906 0.820312 7.570312 0.824219 7.515625 C 0.347656 7.367188 0 6.917969 0 6.390625 C 0 5.742188 0.527344 5.214844 1.175781 5.214844 C 1.828125 5.214844 2.355469 5.742188 2.355469 6.390625 C 2.355469 6.757812 2.1875 7.085938 1.925781 7.300781 L 3.46875 8.859375 C 3.859375 9.25 4.402344 9.476562 4.957031 9.476562 C 5.609375 9.476562 6.234375 9.164062 6.628906 8.644531 L 9.167969 5.28125 C 8.953125 5.066406 8.824219 4.773438 8.824219 4.449219 C 8.824219 3.800781 9.351562 3.269531 10 3.269531 C 10.648438 3.269531 11.175781 3.800781 11.175781 4.449219 C 11.175781 4.761719 11.050781 5.050781 10.851562 5.261719 L 13.371094 8.636719 C 13.765625 9.164062 14.394531 9.476562 15.050781 9.476562 C 15.609375 9.476562 16.136719 9.257812 16.53125 8.863281 L 18.085938 7.308594 C 17.816406 7.09375 17.644531 6.761719 17.644531 6.390625 C 17.644531 5.742188 18.171875 5.214844 18.824219 5.214844 C 19.472656 5.214844 20 5.742188 20 6.390625 C 20 6.90625 19.671875 7.339844 19.214844 7.503906 Z M 17.84375 14.824219 C 17.84375 14.511719 17.59375 14.261719 17.285156 14.261719 L 2.777344 14.261719 C 2.46875 14.261719 2.21875 14.511719 2.21875 14.824219 L 2.21875 16.167969 C 2.21875 16.476562 2.46875 16.730469 2.777344 16.730469 L 17.285156 16.730469 C 17.59375 16.730469 17.84375 16.476562 17.84375 16.167969 Z M 17.84375 14.824219 " />
                            </svg>

                            @endif
                            @endrole
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->


                            @csrf
                            <x-dropdown-link href="{{ route('user.info', ['user' => Auth::user()]) }}" >
                                {{ __('Mi perfil') }}
                            </x-dropdown-link>


                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar Sesion') }}
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>

    @else
        <div class="flex-shrink-0 flex items-center">
            <a href="{{ route('home') }}">
                <x-application-logo class="block h-14 w-auto fill-current text-gray-600" />
            </a>
        </div>
        <div class="flex-shrink-0 flex items-center font-semibold lead text-gray-600 pl-10 pt-3">
            <h2>Bienvenido a Combi 19</h2>
        </div>

        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">

                <a href="{{ route('login') }}" class="text-sm text-gray-600 font-semibold underline">Iniciar sesión</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-600 font-semibold underline">Registrarse</a>
                @endif

            </div>
        @endif

        @endif
    </div>


</nav>
