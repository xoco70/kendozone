@extends('layouts.dashboard')

@section('content')

    <h1>@lang('crud.editModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>

    {!! Form::model($tournament, ['method'=>"PATCH", "action" => ["TournamentController@update", $tournament->id]]) !!}

    @include("users.form", ["submitButton" => trans('crud.updateModel',['currentModelName' => $currentModelName]) ])

    {!! Form::close()!!}

    @include("errors.list")
@stop