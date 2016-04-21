@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/header/tournamentIndex.js') !!}
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

        var url ="{{ URL::action('TournamentController@index') }}";

    </script>
    {!! Html::script('js/pages/footer/tournamentIndexFooter.js') !!}
@stop