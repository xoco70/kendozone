@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('categories.create',$currentModelName) !!}
@stop
@section('content')
    @include("errors.list")
    <div class="container-fluid">
        {!! Form::open(['url'=>URL::action('CategoryController@index')]) !!}
        @include("categories.form", ["submitButton" => trans('core.addModel',['currentModelName' => $currentModelName]) ])
        {!! Form::close()!!}
    </div>
@stop
@section('scripts_footer')
@stop