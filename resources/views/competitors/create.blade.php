@extends('layouts.dashboard')

@section('content')

    @include("errors.list")
    {!! Form::open(['url'=>"competitors"]) !!}
    @include("competitors.form", ["submitButton" => trans('core.addModel',['currentModelName' => $currentModelName])])

    {!! Form::close()!!}


@stop