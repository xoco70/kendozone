@extends('layouts.dashboard')

@section('content')

    @include("errors.list")

    <div class="container-fluid">

            {!! Form::open(['url'=>URL::action('Auth\TournamentController@store')]) !!}

            @include("tournaments.form", ["submitButton" => trans('core.addModel',['currentModelName' => $currentModelName]) ])


            {!! Form::close()!!}

    </div>
@stop