<?php
$appName = (app()->environment() == 'local' ? getenv('APP_NAME') : config('app.name'));
?>

<title> {{ $appName  }} - {{  trans('core.competitors_register') }} </title>
<meta property="og:title" content="{{trans('core.competitors_register') }}"/>
<meta name=" twitter:title" content="{{trans('core.competitors_register')}}"/>
<meta name="description" content="Registrate en el torneo {{ $tournament->name }}"/>
<meta property="og:description" content="Registrate en el torneo {{ $tournament->name }}"/>
<meta name="twitter:card" content="summary"/>
<meta name="twitter:description" content="Registrate en el torneo {{ $tournament->name }}"/>
<meta property="og:locale" content="{{ App::getLocale() }}"/>
<meta property="og:type" content="website"/>
<meta property="og:image" content="https://kendozone.com/wp-content/uploads/2016/04/home.jpg"/>
<meta property="og:image:secure_url" content="https://kendozone.com/wp-content/uploads/2016/04/home.jpg"/>
<meta name="twitter:image" content="https://kendozone.com/wp-content/uploads/2016/04/home.jpg"/>


