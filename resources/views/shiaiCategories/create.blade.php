@extends('layouts.dashboard')

@section('content')

    <h1>@lang('core.addModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>

    {!! Form::open(['url'=>"shiaiCategories"]) !!}
    @include("shiaiCategories.form", ["submitButton" => trans('core.addModel',['currentModelName' => $currentModelName]) ])


    {!! Form::close()!!}

    @include("errors.list")
@stop