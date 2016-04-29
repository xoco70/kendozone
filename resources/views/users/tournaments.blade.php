@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('users.tournaments',Auth::user()) !!}

@stop

@section('content')
    @include("layouts.tournamentList")
    @include("errors.list")
@stop
@section("scripts_footer")
    <script>
        var url = "{{ url("/tournaments") }}";

    </script>
    {!! Html::script('js/pages/header/tournamentIndex.js') !!}
    {!! Html::script('js/pages/footer/tournamentIndexFooter.js') !!}
@stop