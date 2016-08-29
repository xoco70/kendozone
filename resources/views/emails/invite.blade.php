<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ trans('mail.invite') }}</title>
</head>
<?php
$appURL = (app()->environment()=='local' ? getenv('URL_BASE') : config('app.url'));
?>
<body>
<h2>{{ trans('mail.invite_to_tournament') }}: {{ $tournament->name }} </h2>

<p>{{ trans('mail.dear_kenshi') }}<br/>
    {{ $tournament->venue->longitude}}
    {{ trans('mail.you_are_invited_to_tournament') }}: {{ $tournament->name }} <BR/>

    @if ($tournament->venue != null)
        <strong>{{trans('core.venue')}}:</strong> {{ $tournament->venue->name }}<br/>
        <strong>{{trans('core.address')}}:</strong> {{ $tournament->venue->address }}<br/>
        {{--<a href="https://www.google.com/maps/preview/?q="{{ $tournament->venue->longitude  }},{{ $tournament->venue->latitude }},8z>{{ $tournament->venue->address }}</a><br/>--}}
    @endif
    <strong>{{trans('core.eventDateIni')}}:</strong> {{ $tournament->dateIni }}<br/>
    <strong>{{trans('core.eventDateFin')}}:</strong> {{ $tournament->dateFin }}<br/>
    @if ($tournament->cost != null) <strong>{{trans('core.cost')}}:</strong> {{ $tournament->cost }}<br/>@endif
    @if ($tournament->registerDateLimit != null && $tournament->registerDateLimit!= '0000-00-00')
        <strong>{{trans('core.limitDateRegistration')}}:</strong> {{ $tournament->registerDateLimit }}<br/>
    @endif
@if (isset($category))
    <P>{{ trans('mail.you_have_been_preregistered') }}</P>
    <ul>
            <li>{{$category}}</li>
    </ul>
@else
    {{trans('mail.please_clic_confirmation_link')}}: <br/>
    <a href='{{ URL::action('ChampionshipController@create', ['tournamentSlug' => $tournament->slug, 'token' => $code] ) }}'>{{ URL::action('ChampionshipController@create', ['tournamentSlug' => $tournament->slug, 'token' => $code] ) }}</a>
@endif

@if($password!=null)
    <p>{{trans('mail.your_connection_data')}}:</p>
    {{ trans('core.username') }}: {{ $email  }}
    {{ trans('core.password') }}: {{ $password }}
@endif

<p>{{trans('mail.dont_forget_to_pay')}}
    @if ($tournament->registerDateLimit != null && $tournament->registerDateLimit!= '0000-00-00')
        {{trans('mail.before_day')}} {{ $tournament->registerDateLimit }}.</p>
    @endif

<p>{{trans('core.thanks')}}</p>

<p>{{ $tournament->owner->name  }}</p>
</body>
</html>