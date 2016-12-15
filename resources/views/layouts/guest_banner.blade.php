<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Kendozone is a online tournament Kendo Software. With Kendozone, you will be able to register tournaments, generate documentation, and score live with the future mobile app">
    <title>{{ app()->environment()=='local' ? getenv('APP_NAME') : config('app.name') }}</title>
    <!-- Global stylesheets -->
    {!! Html::style('css/app.css')!!}
    {!! Html::style('https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900')!!}

    {!! Html::style('css/icons/icomoon/styles.css')!!}
    {!! Html::script('js/app.js') !!}
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>


</head>

<body>

<div align="right" {{ Route::currentRouteName() ==  'tournaments.show' ? "class=banner-switcher" : "" }}>
    @include('layouts.languageSwitcher')
</div>
<div class="header">
    {{ HTML::image('images/banners/KZ-04.jpg', "Kendozone Banner", ['class' => 'banner']) }}
</div>

@include('layouts.flash')

@yield('content')



{!! Html::script('js/analytics.js') !!}

@yield('scripts_footer')

</body>
</html>