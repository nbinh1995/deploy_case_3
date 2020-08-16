<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> GreatJob | @yield('title', 'Home Page')</title>

    <!-- Spinner js -->
    <script src="{{asset('js/spinner.js')}}"></script>
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Yanone+Kaffeesatz" />
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Cantarell' type='text/css' />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- Fonts Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    @stack('css')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>


<body>
    @include("partials.spinner")
    <div id="app">
        <header class="container-fluid shadow-sm header">
            <div class="row">
                <div class="col-sm-12 menu">
                    <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white">
                        <div class="container">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{asset('/images/logo_jobport.png')}}" alt="" width="75px">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('home')}}">{{ __('Trang Chủ') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('jobs.list')}}">{{ __('Việc Làm') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{route('companies.list')}}">{{ __('Nhà Tuyển Dụng') }}</a>
                                    </li>
                                    @auth
                                    @if (Auth::user()->role == 1)
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{route('companies.candidates',['company'=> Auth::user()->company])}}">{{ __('Ứng Viên') }}</a>
                                    </li>
                                    @endif
                                    @endauth
                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng Nhập') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Đăng Ký') }}</a>
                                    </li>
                                    @endif
                                    @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <div class="container">
                                                <div class="row justify-content-between align-items-center">
                                                    @switch(Auth::user()->role)
                                                    @case(1)
                                                    <div class="col-9">
                                                        <a class="dropdown-item"
                                                            href="{{ route('companies.edit',['company'=> Auth::user()->company]) }}">{{ __('Nhà tuyển dụng') }}</a>
                                                    </div>
                                                    <div class="col-3">
                                                        <i class="fas fa-building"></i>
                                                    </div>
                                                    @break
                                                    @case(2)
                                                    <div class="col-9">
                                                        <a class="dropdown-item"
                                                            href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                                                    </div>
                                                    <div class="col-3">
                                                        <i class="fab fa-ubuntu"></i>
                                                    </div>
                                                    @break
                                                    @default
                                                    <div class="col-9">
                                                        <a class="dropdown-item"
                                                            href="{{ route('profiles.edit',['profile'=> Auth::user()->profile]) }}">{{ __('Ứng viên') }}</a>
                                                    </div>
                                                    <div class="col-3">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    @endswitch
                                                    <div class="col-9">
                                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                            {{ ('Đăng Xuất') }}
                                                        </a>
                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                    <div class="col-3">
                                                        <i class="fas fa-sign-out-alt"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="box-search">
                @yield('search')
            </div>
        </header>

        <main class="py-4 box-content bg-light">
            @yield('content')
        </main>

        <footer class="container-fluid mt-5 footer">
            <div class="row justify-content-center">
                {{-- <div class="col-sm-3">
                    <img src="{{asset('/storage/avatar/logo_jobport.png')}}" alt="" width="50px">
            </div> --}}
            <div class="col-sm-6">
                <div class="row justify-content-center">
                    <div class="col-sm-8">
                        <div class="col-sm-12 text-center">
                            <h6 class="h6">© 2020 Codegym. All rights reserved</h6>
                        </div>
                        <div class="col-sm-12 text-center social">
                            <i class="px-1 fab fa-facebook fa-3x"></i>
                            <i class="px-1 fab fa-twitter-square fa-3x"></i>
                            <i class="px-1 fab fa-instagram fa-3x"></i>
                            <i class="px-1 fab fa-google-plus-g fa-3x"></i>
                            <i class="px-1 fab fa-linkedin fa-3x"></i>
                            <i class="px-1 fab fa-pinterest-square fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    @stack('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}" defer></script>
</body>

</html>