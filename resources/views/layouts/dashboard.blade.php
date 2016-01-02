<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ getenv('APP_NAME') }}</title>


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
    {!! Html::script('js/core/app.js') !!}


    {{--Slider libs--}}
    {{--{!! Html::script('js/core/libraries/jquery_ui/sliders.min.js') !!}--}}
    {{--{!! Html::script('js/core/libraries/jquery_ui/touch.min.js') !!}--}}
    {{--{!! Html::script('js/plugins/sliders/slider_pips.min.js') !!}--}}
    {!! Html::script('http://maps.google.com/maps/api/js') !!}
    {!! Html::script('js/plugins/pickers/location/location.js') !!}



    @if (Request::is("users/*"))
        {!! Html::script('js/plugins/uploaders/fileinput.min.js') !!}
        {!! Html::script('js/pages/uploader_bootstrap.js') !!}
    @endif


    {{--{!! Html::script('js/jquery.infinitescroll.min.js') !!}--}}


    {!! Html::script('js/plugins/forms/styling/switch.min.js') !!}
    {{--{!! Html::script('js/pages/form_checkboxes_radios.js') !!}--}}

    @if (Request::is("tournaments/*"))
        {{--{!! Html::script('js/plugins/forms/wizards/stepy.min.js') !!}--}}
        {!! Html::script('js/plugins/pickers/pickadate/picker.js') !!}
        {!! Html::script('js/plugins/pickers/pickadate/picker.date.js') !!}


    @endif
    {{--Dual Box select--}}
    {!! Html::script('js/plugins/forms/inputs/duallistbox.min.js') !!}
    {!! Html::script('http://maps.google.com/maps/api/js') !!}

    @if (Request::is("invites/*"))
        {!! Html::script('js/plugins/multiple-emails.js') !!}
        {!! Html::style('css/multiple-emails.css') !!}
    @endif


</head>

<body class="sidebar-xs has-detached-right">
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
                        <h1><span class="text-semibold">
                                @if (!Request::is("/") && !Request::is("/dashboard")
                                     && !Request::is("tournaments")
                                     && !Request::is("invites")
                                     && !Request::is("users")
                                     )
                                <a href="{!! URL::previous() !!}"><i class="icon-arrow-left8 text-default"></i></a>
                                @endif
                                    {!!  isset($currentModelName) ? $currentModelName :"" !!}
                            </span>
                        </h1>
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