@extends('layouts.dashboard')

@section('content')

    <h1>@lang('crud.editModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    {!! Form::model(association, ['method'=>"PATCH", "action" => ["AssociationController@update", $association->id]]) !!}

    @include("associations.form", ["submitButton" => trans('crud.updateModel',['currentModelName' => $currentModelName])])


    {!! Form::close()!!}

    @include("errors.list")
@stop