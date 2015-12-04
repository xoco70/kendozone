@extends('layouts.dashboard')

@section('content')

    @include("errors.list")
    {!! Form::open(['url'=>"competitors"]) !!}
    @include("competitors.form", ["submitButton" => trans('crud.addModel',['currentModelName' => $currentModelName])])

    {!! Form::close()!!}


@stop