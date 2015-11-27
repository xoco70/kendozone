@extends('layouts.dashboard')
@section('content')

    <h1>@lang('crud.editModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    <div class="container">
        <div class="row col-md-8 custyle">
            @include("errors.list")

            {!! Form::model($place, array('method'=>"PATCH",'route' => array('places.update', $place->id))) !!}

            @include("places.form", ["submitButton" => trans('crud.updateModel',['currentModelName' => $currentModelName])])


            {!! Form::close()!!}
        </div>
    </div>
@stop