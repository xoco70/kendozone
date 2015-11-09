@extends('layouts.dashboard')

@section('content')

    <h1>Editar Club</h1>
    <hr/>
    {!! Form::model($club, ['method'=>"PATCH", "action" => ["ClubController@update", $club->id]]) !!}

    @include("clubs.form", ["submitButton" => trans('crud.editModel',['currentModelName' => $currentModelName])])

    {!! Form::close()!!}

    @include("errors.list")
@stop