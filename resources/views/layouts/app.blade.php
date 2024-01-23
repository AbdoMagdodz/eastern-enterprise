<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Eastern Enterprise</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/validateNumbers.js') }}"></script>
    @yield('styles')
    @livewireStyles
</head>

<body>
    <div id="app">
        <nav class="bg-white shadow-md py-4 px-6  w-full z-10">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ url('/') }}" class="font-bold text-xl text-black-50">Eastern Enterprise</a>
                <button type="button"
                    class="block md:hidden rounded-md p-2 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="hidden md:flex items-center">
                    <ul class="flex space-x-6 position-relative">
                        @guest
                            @if (Route::has('login'))
                                <li><a href="{{ route('login') }}"
                                        class="{{ Route::currentRouteName() === 'login' ? 'text-blue-500' : 'text-black' }} hover:text-blue-500 underline">Login</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}"
                                        class="{{ Route::currentRouteName() === 'register' ? 'text-blue-500' : 'text-black' }} hover:text-blue-500 underline">Register</a>
                                </li>
                            @endif
                        @else
                            <li class="text-bold">
                                Hello,
                                {{ Auth::user()->name }}
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" class="hover:text-blue-500 underline"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf</form>
                            </li>
                            <li>
                                <a href="{{ route('companies.create') }}"></a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @livewireScripts
    @yield('scripts')
</body>

</html>
