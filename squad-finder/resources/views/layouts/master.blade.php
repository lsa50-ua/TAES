<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href= {{ route('home') }}>
                    <img src="/images/logo.png" alt="SquadFinder logo" width="30" height="30" class="d-inline-block align-text-top">
                    SquadFinder</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <button class="btn btn-outline-success me-2" type="button" onclick="window.location='{{ route('home') }}'">Home</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-outline-success me-2" type="button" onclick="window.location='{{ route('games') }}'">Games</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-outline-success me-2" type="button" onclick="window.location='{{ route('platforms') }}'">Platforms</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-outline-success me-2" type="button" onclick="window.location='{{ route('ListaGrupos') }}'">Groups</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-outline-success me-2" type="button" onclick="window.location='{{ route('friends.list') }}'">Friends</button>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-outline-success me-2" type="button" onclick="window.location='{{ route('about') }}'">About</button>
                        </li>
                        
                        @if(Auth::check() && auth()->user()->isAdmin)
                            <li class="nav-item">
                                <button class="btn btn-outline-success me-2" type="button" onclick="window.location='{{ route('profile.list') }}'">Users</button>
                            </li>
                        @endif
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <button class="btn btn-outline-primary me-2" type="button" onclick="window.location='{{ route('login') }}'">Login</button>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <button class="btn btn-outline-primary me-2" type="button" onclick="window.location='{{ route('register') }}'">Register</button>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile', Auth::user()->id) }}">
                                        {{ __('Profile') }}
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
        <div class="d-flex flex-column" style="margin-top: 2%; min-height: 92vh;">
            <div class="container">
                @yield('content')
            </div>
            <footer class="footer mt-auto" style="background-color: #038b1a;">
                <div class="container py-3">
                    <p class="float-end"><a href="{{ route('home') }}" style="text-decoration: none; color: white;">Back to Home</a></p>
                    <p style="color: white;">&copy; 2023 SquadFinder, Inc.   
                        {{-- <a href="{{ route('home') }}" style="text-decoration: none; color: white;">Privacy</a>  
                        <a href="{{ route('home') }}" style="text-decoration: none; color: white;">Terms</a> --}}
                    </p>
                </div>
            </footer>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    </body>
</html>