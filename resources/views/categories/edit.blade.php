@extends('layouts.dashboard')
@section('content')

    @include("errors.list")

    <div class="container">
        <div class="row col-md-8 custyle">

            {!! Form::model($user, array('method'=>"PATCH",'route' => array('users.update', $user->id), 'enctype' => 'multipart/form-data')) !!}


            @include("users.form", ["submitButton" => trans('crud.updateModel',['currentModelName' => $currentModelName]) ])
            {!! Form::close()!!}

        </div>
    </div>
@stop