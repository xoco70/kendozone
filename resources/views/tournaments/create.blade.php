@extends('layouts.dashboard')

@section('content')

    <h1>@lang('crud.addModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    @include("errors.list")

    <div class="container-fluid">

            {!! Form::open(['url'=>"tournaments", 'class'=>'stepy-basic']) !!}

            @include("tournaments.form", ["submitButton" => trans('crud.addModel',['currentModelName' => $currentModelName]) ])


            {!! Form::close()!!}

    </div>
@stop