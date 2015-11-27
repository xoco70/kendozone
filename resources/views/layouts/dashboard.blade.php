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
    {{--{!! Html::script('js/plugins/forms/styling/uniform.min.js') !!}--}}
    {!! Html::script('js/core/app.js') !!}
    {{--{!! Html::script('js/pages/dashboard.js') !!}--}}


            <!-- Theme JS files -->
    {{--{!! Html::script('js/plugins/visualization/d3/d3.min.js') !!}--}}
    {{--{!! Html::script('js/plugins/visualization/d3/d3_tooltip.js') !!}--}}
    {{--{!! Html::script('js/plugins/forms/styling/switchery.min.js') !!}--}}
    {{--{!! Html::script('js/plugins/forms/styling/switch.min.js') !!}--}}
    {{--{!! Html::script('js/pages/form_checkboxes_radios.js') !!}--}}

    {{--{!! Html::script('js/plugins/forms/styling/uniform.min.js') !!}--}}
    {{--{!! Html::script('js/plugins/forms/selects/bootstrap_multiselect.js') !!}--}}
    {{--{!! Html::script('js/plugins/ui/moment/moment.min.js') !!}--}}
    {{--{!! Html::script('js/plugins/pickers/daterangepicker.js') !!}--}}

    @if (Request::is("users/*"))
        {!! Html::script('js/plugins/uploaders/fileinput.min.js') !!}
        {!! Html::script('js/pages/uploader_bootstrap.js') !!}
    @endif

    @if (Request::is("places/*"))
        {!! Html::script('http://maps.google.com/maps/api/js?sensor=false&amp;libraries=places') !!}
        {!! Html::script('js/core/libraries/jquery_ui/autocomplete.min.js') !!}
        {!! Html::script('js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') !!}
        {!! Html::script('js/plugins/pickers/location/typeahead_addresspicker.js') !!}
        {!! Html::script('js/plugins/pickers/location/autocomplete_addresspicker.js') !!}
        {!! Html::script('js/plugins/pickers/location/location.js') !!}
        {!! Html::script('js/plugins/ui/prism.min.js') !!}
        {!! Html::script('js/pages/picker_location.js') !!}
    @endif
    @if (Request::is("/") || Request::is("admin"))
    {!! Html::script('js/plugins/forms/wizards/stepy.min.js') !!}
    {!! Html::script('js/plugins/forms/selects/select2.min.js') !!}
    {!! Html::script('js/plugins/forms/styling/uniform.min.js') !!}
    {!! Html::script('js/core/libraries/jasny_bootstrap.min.js') !!}
    {!! Html::script('js/plugins/forms/validation/validate.min.js') !!}
    {!! Html::script('js/pages/wizard_stepy.js') !!}
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