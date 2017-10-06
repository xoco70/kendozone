@extends('layouts.dashboard')
@section('title')
    <title>{{ trans_choice('core.tournament',2) }}</title>
@stop

@section('breadcrumbs')
    {!! Breadcrumbs::render('tournaments.index') !!}

@stop

@section('content')
    @include("layouts.tournamentList")
    @include("errors.list")
@stop
@section("scripts_footer")
    <script>

        var url ="{{ route('tournaments.index') }}";
        var url_restore ="{{ route('api.tournaments.index') }}";

    </script>
    {!! Html::script('js/pages/header/footable.js') !!}
    {!! Html::script('js/pages/footer/tournamentIndexFooter.js') !!}
@stop