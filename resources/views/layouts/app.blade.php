<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KeyMan</title>

    <!-- Styles -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/assets/css/vendor/tether.css">
    <link rel="stylesheet" href="/assets/css/vendor/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/vendor/select2.css">
     <link rel="stylesheet" href="/assets/css/layout.css">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/browse') }}">
                    <img src="/assets/images/KeymanLogo.png" style="height:60px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth::check())
                    	<li><a href="{{ url('/requests') }}">REQUESTS</a></li>
                    	<li><a href="{{ url('/customers') }}">CUSTOMERS</a></li>
                    	<li><a href="{{ url('/providers') }}">PROVIDERS</a></li>
                    @endif
                    @if (Auth::check() && Auth::user()->isAdmin())
                        <li><a href="{{ url('/types') }}">TYPES</a></li>
                    	<li><a href="{{ url('/users') }}">USERS</a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('flash::message')

                @yield('content')
            </div>
        </div>
    </div>
    <!-- JavaScripts -->
    <script src="/assets/js/vendor/jquery-2.2.3.js"></script>
    <script src="/assets/js/vendor/tether.js"></script>
    <script src="/assets/js/vendor/bootstrap.js"></script>
    <script src="/assets/js/vendor/select2.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('footer')
</body>
</html>
