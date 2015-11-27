@extends('layouts.dashboard')
@section('content')

    <h1>@lang('crud.addModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    @include("errors.list")

    <div class="container">
        <div class="row col-md-8 custyle">

            {!! Form::open(['url'=>"users",'enctype' => 'multipart/form-data']) !!}

            @include("users.form", ["submitButton" => trans('crud.addModel',['currentModelName' => $currentModelName]) ])


            {!! Form::close()!!}
        </div>
    </div>

@stop

