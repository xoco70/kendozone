@extends('layouts.dashboard')
@section('content')

    <h1>@lang('crud.editModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    <div class="container">
        <div class="row col-md-8 custyle">

            {!! Form::model($user, array('method'=>"PATCH",'route' => array('users.update', $user->id), 'enctype' => 'multipart/form-data')) !!}


            @include("users.form", ["submitButton" => trans('crud.updateModel',['currentModelName' => $currentModelName]) ])
            {!! Form::close()!!}

        </div>
    </div>
    @include("errors.list")
@stop