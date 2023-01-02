<div class="absolute top-0 right-0 mt-4 mr-4">
    @if(Route::has('login'))
        <div class="space-x-4 sm:mt-6 sm:mr-6 sm:space-x-6">
            @auth
                <a href="{{ url('/home') }}" class="text-sm font-normal text-teal-800 no-underline uppercase hover:underline">{{ __('Home') }}</a>

                <a
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="font-medium text-teal-600 transition duration-150 ease-in-out hover:text-teal-500 focus:outline-none focus:underline">
                    {{ __('Log out') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm font-normal text-teal-800 no-underline uppercase hover:underline">{{ __('Log In') }}</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm font-normal text-teal-800 no-underline uppercase hover:underline">{{ __('Register') }}</a>
                @endif
            @endauth
        </div>
    @endif
</div>
<!--Home            SocialMedia
-signup -signin as creator -signin as reader -->
<nav  x-data="{ open: false }"  class="relative px-4 py-4 flex justify-between items-center bg-white background:linear-gradient(to right, #4dc0b5 var(--scroll), transparent 0)">
    <a class="flex text-3xl font-bold leading-none text-gray-900 no-underline hover:no-underline" href="#">
        <x-links.application-logo class="block w-auto text-gray-800 fill-current h-9" />
    </a>
    <div class="absolute lg:hidden right-5" >
        <button data-collapse-toggle="navbar-default" type="button" aria-controls="navbar-default" aria-expanded="false" class="flex items-center p-3 text-blue-600 navbar-burger">
            <svg class="block w-4 h-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <title>Mobile menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </button>
    </div>
    <div class="relative z-50 hidden mt-5 lg:flex lg:mx-auto lg:items-center lg:w-auto lg:space-x-6" id="navbar-default">
        <div class="absolute z-50 flex flex-col flex-wrap p-4 mt-4 border border-gray-100 rounded-lg md:static lg:static backdrop-blur-sm md:backdrop-filter-none lg:backdrop-filter-none sm:max-xl:right-12 md:right-0 lg:right-0 md:-top-14 lg:-top-14 -right-5 sm:top-4 lg:bg-transparent md:bg-transparent sm:bg-transparent bg-white/30 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <div class="flex w-max gap-14">
                @if(!session()->has('logged'))
                    @if(Route::is('Home') )
                        <x-links.nav-link :href="route('welcome')">
                            {{ __('Explore') }}
                        </x-links.nav-link>
                    @else
                        <x-links.nav-link :href="route('home')" :active="request()->routeIs('welcome')">
                            {{ __('Home') }}
                        </x-links.nav-link>
                    @endif
                @endif
                @if(Route::is('ShowCreators') )
                    <x-links.nav-link :href="route('ShowSeries')">
                        {{ __('ShowSeries') }}
                    </x-links.nav-link>
                @else
                    <x-links.nav-link :href="route('ShowCreators')">
                        {{ __('ShowCreators') }}
                    </x-links.nav-link>
                @endif
                @auth
                    <x-links.nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('ShowByTheme') }}
                    </x-links.nav-link>
                    <x-links.nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                        {{ __('ShowByStyle') }}
                    </x-links.nav-link>
                    <x-links.nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('ExploreView') }}
                    </x-links.nav-link>
                @endauth
            </div>

            @if (Route::has('login'))
                <div class="px-6 py-4 sm:block">
                    @auth
                        <a href="{{ route('logout') }}" class="text-sm text-gray-700 underline dark:text-gray-500" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">{{ __('SignOut') }}</a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @else
                        <x-links.nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('SignIn') }}
                        </x-links.nav-link>
                        @if (Route::has('register'))
                            <x-links.nav-link :href="route('register')" :active="request()->routeIs('register')">
                                {{ __('SignUp') }}
                            </x-links.nav-link>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</nav>
<!--Container-->
