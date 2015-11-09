<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title') - Basic Auth Sentinel</title>
    <meta name="description" content="Basic Authentication with Sentinel and Laravel">
    <meta name="author" content="Andre Madarang">

    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Favicon and Apple Icons -->
    <link rel="shortcut icon" href="img/favicon.ico">

</head>
<body>

    <header>

        <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ url('/') }}">Basic Auth Sentinel</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li ><a href="{{ url('/') }}">Home</a></li>
                <li ><a href="{{ url('about') }}">About</a></li>
                <li ><a href="{{ url('contact') }}">Contact</a></li>
                <li ><a href="{{ url('userProtected') }}">Registered Users Only</a></li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                @if (!Sentinel::check())
                    <li ><a href="{{ url('register') }}">Register</a></li>
                    <li ><a href="{{ url('login') }}">Login</a></li>
                @else
                    <li ><a href="{{ url('profiles') }}/{{Sentinel::getUser()->id}}">My Profile</a></li>
                    <li><a href="{{ url('logout') }}">Logout</a></li>
                @endif
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

    </header>

    <div class="container">
        @yield('content')
    </div>


<!-- JavaScript -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body>
</html>