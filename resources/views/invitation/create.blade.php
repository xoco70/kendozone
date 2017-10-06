@extends('layouts.dashboard')
@section('title')
    <title>{{ trans('core.invitation') .' '.trans_choice('core.competitor',2) }}</title>
@stop

@section('content')
    @include("errors.list")
    <div class="container-fluid">
        {!! Form::open(['url'=>URL::action('Auth\TournamentController@store')]) !!}
        @include("tournaments.form", ["submitButton" => trans('core.add').' '.trans_choice('core.competitor',2) ])
        {!! Form::close()!!}
    </div>
@stop