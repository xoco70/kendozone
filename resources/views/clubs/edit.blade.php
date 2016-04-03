@extends('layouts.dashboard')

@section('content')

    <h1>Editar Club</h1>
    <hr/>
    @include("errors.list")
    {!! Form::model($club, ['method'=>"PATCH", "action" => ["ClubController@update", $club->id]]) !!}

    @include("clubs.form", ["submitButton" => trans('core.editModel',['currentModelName' => $currentModelName])])

    {!! Form::close()!!}


@stop