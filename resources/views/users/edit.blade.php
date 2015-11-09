@extends('layouts.dashboard')
@section('content')

    <h1>@lang('crud.editModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    {!! Form::model($user, array('method'=>"PATCH",'route' => array('users.update', $user->id), 'enctype' => 'multipart/form-data')) !!}

    @include("users.form", ["submitButton" => "@lang('crud.updateModel', ['currentModelName' => $currentModelName])"])


    {!! Form::close()!!}


    @include("errors.list")
@stop