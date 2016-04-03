@extends('layouts.dashboard')

@section('content')

    <h1>@lang('core.addModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    @include("errors.list")
    <div class="container">
        <div class="row col-md-8 custyle">

            {!! Form::open(['url'=>"places"]) !!}
            @include("places.form", ["submitButton" => trans('core.addModel',['currentModelName' => $currentModelName]) ])


            {!! Form::close()!!}
        </div>
    </div>


@stop

