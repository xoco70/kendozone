@extends('layouts.dashboard')

@section('content')

    <h1>@lang('core.editModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    @include("errors.list")
    {!! Form::model($federation, ['method'=>"PATCH", "action" => ["FederationController@update", $federation->id]]) !!}

    @include("federations.form", ["submitButton" => "@lang('core.updateModel', ['currentModelName' => $currentModelName])"])


    {!! Form::close()!!}


@stop