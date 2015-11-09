@extends('layouts.dashboard')

@section('content')

    <h1>@lang('crud.editModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    {!! Form::model($federation, ['method'=>"PATCH", "action" => ["FederationController@update", $federation->id]]) !!}

    @include("federations.form", ["submitButton" => "@lang('crud.updateModel', ['currentModelName' => $currentModelName])"])


    {!! Form::close()!!}

    @include("errors.list")
@stop