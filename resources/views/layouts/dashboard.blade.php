<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ getenv('APP_NAME') }}</title>


    <!-- Global stylesheets -->
    {!! Html::style('/css/icons/icomoon/styles.css')!!}
    {!! Html::style('https://fonts.googleapis.com/css?family=Nunito:400,300,100,500,700,900')!!}

    {!! Html::script('js/app.js')!!}
    {!! Html::style('css/app.css')!!}

    @yield('scripts')
    @yield('styles')

</head>
{{--sidebar-xs should be out--}}
<body class="sidebar-xs  has-detached-right navbar-top">
@if (Auth::check())
@include('layouts.headmenu')
@endif


        <!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">
        @if (Auth::check())
        @include('layouts.sidemenu')
        @endif

                <!-- Main content -->
        <div class="content-wrapper">


            <!-- Content area -->

            <div class="content" id="content">
                @include('layouts.flash')
                @yield('content')

                @include('layouts.footer')
            </div>

            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

{!! Html::script('js/analytics.js') !!}

@yield('scripts_footer')

</body>
</html>