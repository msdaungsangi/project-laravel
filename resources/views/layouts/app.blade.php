<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- bootstrap css --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    {{-- bootstrap bundle --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    {{-- jquery & Ajax --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @guest
                            @if (Route::has('login'))
                            
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('users.index')}}">User Lists</a>
                            </li>
                        @endguest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                        </li>
                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}">
                                @csrf
                                <a type="button" class="btn btn-sm btn-outline-danger" href="{{ route('logout') }}">
                                    Logout
                                </a>
                            </form>
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
    @yield('script')
</body>

</html>
