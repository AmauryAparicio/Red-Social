<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Red Social</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/front.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        Red Social
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">


                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item ml-auto my-auto">
                                <a href=" {{ route('image.create') }} " class="ml-auto nav-link">
                                    Subir imagen
                                </a>
                            </li>
                            <li class="nav-item ml-auto my-auto">
                                <a href=" {{ route('likes') }} " class="ml-auto nav-link">
                                    Mis favoritas
                                </a>
                            </li>
                            <li class="nav-item ml-auto my-auto">
                                <a href=" {{ route('user.index') }} " class="ml-auto nav-link">
                                    Descubrir gente
                                </a>
                            </li>
                            <li class="navbar-brand ml-0 mr-0 my-auto">
                                <div class="text-right nav-img">
                                    @if (\Auth::check())
                                    @include('includes.avatar')
                                    @endif
                                </div>
                            </li>
                            <li class="nav-item dropdown my-auto">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href=" {{ route('home') }} ">
                                        {{ __('Inicio') }}
                                    </a>

                                    <a class="dropdown-item"
                                        href=" {{ route('profile', ['id' => Auth::user()->id]) }} ">
                                        {{ __('Mi perfil') }}
                                    </a>

                                    <a class="dropdown-item" href="#">
                                        {{ __('Mis datos') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('config') }}">
                                        {{ __('Configuracion') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
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
