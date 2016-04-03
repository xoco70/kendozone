@extends('layouts.dashboard')

@section('content')

    <h1>@lang('core.editModel', ['currentModelName' => $currentModelName])</h1>
    <hr/>
    {!! Form::model($shiaiCategory, ['method'=>"PATCH", "action" => ["PlaceController@update", $shiaiCategory->id]]) !!}
    @include("shiaiCategories.form", ["submitButton" => trans('core.updateModel',['currentModelName' => $currentModelName]) ])

    {!! Form::close()!!}

    @include("errors.list")
@stop