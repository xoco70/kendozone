@extends('layouts.dashboard')

@section('content')

    <h1>@lang('crud.editModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    {!! Form::model($place, array('method'=>"PATCH",'route' => array('places.update', $place->id))) !!}

    @include("places.form", ["submitButton" => trans('crud.updateModel',['currentModelName' => $currentModelName])])


    {!! Form::close()!!}

    @include("errors.list")
@stop