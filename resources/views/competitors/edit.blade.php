@extends('layouts.dashboard')

@section('content')

    <h1>@lang('crud.editModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    {!! Form::model($competitor, ['method'=>"PATCH", "action" => ["CompetitorController@update", $competitor->id]]) !!}

    @include("competitors.form", ["submitButton" => trans('crud.editModel',['currentModelName' => $currentModelName])])


    {!! Form::close()!!}

    @include("errors.list")
@stop