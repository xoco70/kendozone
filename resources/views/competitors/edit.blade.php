@extends('layouts.dashboard')

@section('content')

    @include("errors.list")
    {!! Form::model($competitor, ['method'=>"PATCH", "action" => ["CompetitorController@update", $competitor->id]]) !!}

    @include("competitors.form", ["submitButton" => trans('crud.editModel',['currentModelName' => $currentModelName])])


    {!! Form::close()!!}


@stop