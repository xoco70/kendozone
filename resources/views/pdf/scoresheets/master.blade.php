<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! Html::style('css/app.css')!!}
    {!! Html::style('css/pages/sheet.css')!!}
</head>
<body>
<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">


            <!-- Content area -->

            <div class="content">
                @yield('content')

            </div>

            <!-- /content area -->

        </div>

        <!-- /main content -->

    </div>

    <!-- /page content -->

</div>
@yield('footer')
@yield('scripts_footer')
<!-- /page container -->

</body>
</html>