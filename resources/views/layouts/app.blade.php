<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .cta-button {
            display: inline-block;
            color: #000000;
            transition: background-color 0.2s ease;
        }
        .auth-button {
            display: inline-block;
            color: #f36767;
            transition: background-color 0.2s ease;
        }

        .cta-button:hover {
            background-color: #555;
            text-decoration: none;
            color: #D94452;
        }
        .auth-button:hover {
            background-color: #f5a6a6;
            text-decoration: none;
            color: #3b3636;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link auth-button" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link auth-button" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li><a class="nav-link cta-button" href="{{ route('tasks.index') }}">Tasks</a></li>
                            @role('Admin')
                            <li><a class="nav-link cta-button" href="{{ route('users.index') }}">Manage Users</a></li>
                            
                            <li><a class="nav-link cta-button" href="{{ route('roles.index') }}">Manage Role</a></li>
                            @endrole
                            <li><a class="nav-link cta-button" href="{{ route('products.index') }}">Products</a></li>
                            <li>
                                @auth
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="nav-link auth-button">
                                            {{ __(auth()->user()->name) }}, Logout
                                        </button>
                                    </form>
                                @endauth
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
</body>

</html>
