<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ getenv('APP_NAME') }}</title>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-72767410-1', 'auto');
        ga('send', 'pageview');

    </script>
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
    {!! Html::script('js/plugins/notifications/pnotify.min.js') !!}

    {{--Slider libs--}}
    {{--{!! Html::script('js/core/libraries/jquery_ui/sliders.min.js') !!}--}}
    {{--{!! Html::script('js/core/libraries/jquery_ui/touch.min.js') !!}--}}
    {{--{!! Html::script('js/plugins/sliders/slider_pips.min.js') !!}--}}
    {!! Html::script('js/plugins/forms/styling/switch.min.js') !!}

    @if (Request::is("tournaments") || Request::is("invites"))
        {!! Html::script('js/plugins/tables/footable/footable.min.js') !!}
    @endif
    @if (Request::is("tournaments/create"))
        {!! Html::script('js/plugins/forms/inputs/duallistbox.min.js') !!}
        {!! Html::script('js/plugins/pickers/pickadate/picker.js') !!}
        {!! Html::script('js/plugins/pickers/pickadate/picker.date.js') !!}

    @endif

    @if (Request::is("users/*"))
        {!! Html::script('http://maps.google.com/maps/api/js') !!}
        {!! Html::script('js/plugins/uploaders/fileinput.min.js') !!}
        {!! Html::script('js/pages/uploader_bootstrap.js') !!}
    @endif
    {{--{!! Html::script('js/jquery.infinitescroll.min.js') !!}--}}



    {{--{!! Html::script('js/pages/form_checkboxes_radios.js') !!}--}}

    {{--EDIT TOURNAMENT PAGE--}}
    @if (strpos(Request::url(),'tournaments') && strpos(Request::url(),'edit')
            && !strpos(Request::url(),'users')
            && !strpos(Request::url(),'categories')
            && !strpos(Request::url(),'settings')
            )
        {!! Html::script('js/plugins/ui/nicescroll.min.js') !!}
        {!! Html::script('js/sidebar_detached_sticky_custom.js') !!}
        {!! Html::script('js/plugins/forms/inputs/duallistbox.min.js') !!}
        {!! Html::script('js/plugins/pickers/location/location.js') !!}
        {!! Html::script('http://maps.google.com/maps/api/js') !!}
        {!! Html::script('js/plugins/pickers/pickadate/picker.js') !!}
        {!! Html::script('js/plugins/pickers/pickadate/picker.date.js') !!}
        {!! Html::script('js/plugins/notifications/sweet_alert.min.js') !!}
{{--        {!! Html::script('bower/clipboard/dist/clipboard.min.js') !!}--}}


    @endif

    @if (strpos(Request::url(),'tournaments') && strpos(Request::url(),'users') && !strpos(Request::url(),'edit'))
        {!! Html::script('js/plugins/ui/nicescroll.min.js') !!}
        {!! Html::script('js/sidebar_detached_sticky_custom.js') !!}
        {!! Html::script('js/plugins/notifications/sweet_alert.min.js') !!}


    @endif
    @if (strpos(Request::url(),'tournaments') && strpos(Request::url(),'categories') && strpos(Request::url(),'settings'))
        {{--{!! Html::style('css/clockpicker.css')!!}--}}
        {{--{!! Html::script('js/clockpicker.js') !!}--}}

        {!! Html::style('js/jquery.infinitescroll.min.js')!!}
        {!! Html::style('js/jquery.timepicker.css')!!}
        {!! Html::script('js/jquery.timepicker.js') !!}
        {!! Html::script('js/core/libraries/jquery_ui/sliders.min.js') !!}
        {!! Html::script('js/core/libraries/jquery_ui/touch.min.js') !!}
        {!! Html::script('js/plugins/sliders/slider_pips.min.js') !!}
        {!! Html::script('js/plugins/sliders/nouislider.min.js') !!}


    @endif

    @if (strpos(Request::url(),'tournaments') && strpos(Request::url(),'users') && !strpos(Request::url(),'edit')  )
        {!! Html::script('js/plugins/tables/datatables/datatables.min.js') !!}
        {!! Html::script('js/plugins/tables/datatables/extensions/responsive.min.js') !!}
        {!! Html::script('js/plugins/forms/selects/select2.min.js') !!}

    @endif


    @if (strpos(Request::url(),'tournaments') && strpos(Request::url(),'invite'))
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
                                @if (!Request::is("/") && !Request::is("admin")
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