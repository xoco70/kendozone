@extends('layouts.dashboard')
@section('content')

    <h1>@lang('crud.addModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    {!! Form::open(['url'=>"users",'enctype' => 'multipart/form-data']) !!}

    @include("users.form", ["submitButton" => "@lang('crud.addModel', ['currentModelName' => $currentModelName])" ])


    {!! Form::close()!!}


    @include("errors.list")
@stop

