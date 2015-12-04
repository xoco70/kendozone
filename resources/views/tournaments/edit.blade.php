@extends('layouts.dashboard')

@section('content')

    @include("errors.list")

    <div class="container-fluid">

    {!! Form::model($tournament, ['method'=>"PATCH", "action" => ["TournamentController@update", $tournament->id]]) !!}

    @include("tournaments.form", ["submitButton" => trans('crud.updateModel',['currentModelName' => $currentModelName]) ])

    {!! Form::close()!!}

    </div>
@stop