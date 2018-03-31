<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        window.Laravel = {
            csrfToken: "{{ csrf_token() }}"
        };

    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Kendozone is a online tournament Kendo Software. With Kendozone, you will be able to register tournaments, generate documentation, and score live with the future mobile app">
    <link rel="shortcut icon" href="/favicon_kz-01.png" />
    <link rel="apple-touch-icon" href="/favicon_kz-01.png" />

    <title>{{ app()->environment()=='local' ? getenv('APP_NAME') : config('app.name') }}</title>
    <!-- Global stylesheets -->
    {!! Html::style('css/app.css')!!}
    {!! Html::script('js/app.js') !!}

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! Html::script('js/bootstrap.js')!!}

</head>

<body>
<div align="right">
    @include('layouts.guest_headmenu')
</div>
<!-- Page container -->
<div class="page-container login-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">
                <!-- Advanced login -->
                @include('layouts.flash')
                @include('errors.list')

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