@extends('layouts.dashboard')
@section('content')

    @include("errors.list")

    <div class="container">


            {!! Form::model($user, array('method'=>"PATCH",'route' => array('users.update', $user->id), 'enctype' => 'multipart/form-data')) !!}


            @include("users.form", ["submitButton" => trans('crud.updateModel',['currentModelName' => $currentModelName]) ])
            {!! Form::close()!!}

    </div>
@stop