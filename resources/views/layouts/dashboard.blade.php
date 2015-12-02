<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kendonline</title>


    <!-- Global stylesheets -->
    {!! Html::style('https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900')!!}
    {!! Html::style('css/icons/icomoon/styles.css')!!}
    {!! Html::style('css/bootstrap.css')!!}
    {!! Html::style('css/core.css')!!}
    {!! Html::style('css/components.css')!!}
    {!! Html::style('css/colors.css')!!}
            <!-- /global stylesheets -->

    <!-- Core JS files -->
    {!! Html::script('js/plugins/loaders/pace.min.js') !!}
    {!! Html::script('js/core/libraries/jquery.min.js') !!}
    {!! Html::script('js/core/libraries/bootstrap.min.js') !!}
    {!! Html::script('js/plugins/loaders/blockui.min.js') !!}
    {{--<!-- /core JS files -->--}}
    {{--<!-- Theme JS files -->--}}

    {{--{!! Html::script('js/core/libraries/jquery_ui/datepicker.min.js') !!}--}}
    {{--{!! Html::script('js/core/libraries/jquery_ui/effects.min.js') !!}--}}
    {{--{!! Html::script('js/plugins/notifications/jgrowl.min.js') !!}--}}
    {{--    {!! Html::script('js/plugins/pickers/anytime.min.js') !!}--}}
    {{--    {!! Html::script('js/plugins/pickers/pickadate/picker.time.js') !!}--}}
    {{--{!! Html::script('js/plugins/pickers/pickadate/legacy.js') !!}--}}

    {!! Html::script('js/plugins/ui/moment/moment.min.js') !!}
    {!! Html::script('js/plugins/pickers/daterangepicker.js') !!}

    {!! Html::script('js/plugins/pickers/pickadate/picker.js') !!}
    {!! Html::script('js/plugins/pickers/pickadate/picker.date.js') !!}
    {!! Html::script('js/pages/picker_date.js') !!}




    {!! Html::script('js/core/app.js') !!}


    @if (Request::is("/")
         || Request::is("admin")
         || Request::is("tournaments/*")
         )
    {!! Html::script('js/plugins/forms/wizards/stepy.min.js') !!}
    {!! Html::script('js/plugins/forms/selects/select2.min.js') !!}
    {!! Html::script('js/plugins/forms/styling/uniform.min.js') !!}
    {!! Html::script('js/pages/wizard_stepy.js') !!}
    @endif


            <!-- Theme JS files -->


    @if (Request::is("users/*"))
        {!! Html::script('js/plugins/uploaders/fileinput.min.js') !!}
        {!! Html::script('js/pages/uploader_bootstrap.js') !!}
    @endif





    {!! Html::script('js/plugins/forms/styling/switchery.min.js') !!}
    {!! Html::script('js/pages/form_checkboxes_radios.js') !!}

    @if (Request::is("tournaments/*"))
        {!! Html::script('http://maps.google.com/maps/api/js') !!}
        {!! Html::script('js/plugins/pickers/location/location.js') !!}
    @endif


</head>

<body>
@include('layouts.headmenu')


        <!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">
        @include('layouts.sidemenu')



                <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> -
                            {!! $modelPlural !!}</h4>
                    </div>
                </div>
            </div>
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

</body>
</html>