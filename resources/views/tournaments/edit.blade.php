@extends('layouts.dashboard')

@section('content')

    <h1>@lang('crud.editModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    <div class="container">
        <div class="row col-md-8 custyle">
    {!! Form::model($tournament, ['method'=>"PATCH", "action" => ["TournamentController@update", $tournament->id]]) !!}

    @include("tournament.form", ["submitButton" => trans('crud.updateModel',['currentModelName' => $currentModelName]) ])

    {!! Form::close()!!}
        </div>
    </div>
    @include("errors.list")
@stop