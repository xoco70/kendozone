@extends('layouts.dashboard')
@section('title')
    <title>{{ trans('core.new') .' '.trans_choice('core.category',1) }}</title>
@stop

@section('breadcrumbs')
    {!! Breadcrumbs::render('categories.create',$currentModelName) !!}
@stop
@section('content')
    @include("errors.list")
    <div class="container-fluid">
        {!! Form::open(['url'=>URL::action('CategoryController@index')]) !!}
        $currentModelName = ;
        @include("categories.form", ["submitButton" => trans('core.add').' '.trans_choice("core.category", 1) ])
        {!! Form::close()!!}
    </div>
@stop
@section('scripts_footer')
@stop