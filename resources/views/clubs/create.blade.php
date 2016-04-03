@extends('layouts.dashboard')

@section('content')

    <h1>@lang('core.addModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    @include("errors.list")
    {!! Form::open(['url'=>"clubs"]) !!}
    @include("clubs.form", ["submitButton" => trans('core.addModel',['currentModelName' => $currentModelName])])

    {!! Form::close()!!}


@stop