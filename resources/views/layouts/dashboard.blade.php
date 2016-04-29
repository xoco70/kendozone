<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Kendozone is a online tournament Kendo Software. With Kendozone, you will be able to register tournaments, generate documentation, and score live with the future mobile app">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--TODO Put acion + model here--}}
    <title>{{ app()->environment()=='local' ? getenv('APP_NAME') : config('app.name') }} </title>


    <!-- Global stylesheets -->
    {!! Html::style('/css/icons/icomoon/styles.css')!!}

    {!! Html::script('js/app.js')!!}
    {!! Html::style('css/app.css')!!}


    @yield('scripts')
    @yield('styles')

</head>
{{--sidebar-xs should be out--}}
<body class="sidebar-xs  has-detached-right navbar-top" >
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

            <div class="content">
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
<script>
    $(document).ready(function(){
        $.protip(

        );
    });
</script>



@yield('scripts_footer')

</body>
</html>