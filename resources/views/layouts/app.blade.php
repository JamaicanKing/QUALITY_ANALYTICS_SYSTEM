<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('evaluation.index') }}">
                                        {{ __('Evaluation Management') }}
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('agent.index') }}">
                                        {{ __('Agent Management') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('category.index') }}">
                                        {{ __('Category') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('query.index') }}">
                                        {{ __('Query Categories') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('rating.index') }}">
                                        {{ __('Ratings') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('attribute.index') }}">
                                        {{ __('Attribute') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('reason.index') }}">
                                        {{ __('Reason') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('teamleader.index') }}">
                                        {{ __('Teamleaders') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('manager.index') }}">
                                        {{ __('Managers') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('primaryFunction.index') }}">
                                        {{ __('Primary Function') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('departments.index') }}">
                                        {{ __('Departments') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('locations.index') }}">
                                        {{ __('Locations') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('classifications.index') }}">
                                        {{ __('Classifications') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('market.index') }}">
                                        {{ __('Markets') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('skillset.index') }}">
                                        {{ __('Skillsets') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('observationType.index') }}">
                                        {{ __('Observation Type') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('evaluationClassification.index') }}">
                                        {{ __('Evalauation Classification') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
