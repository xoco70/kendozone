@extends('layouts.dashboard')
@section('scripts')
{{--    {!! Html::script('js/pages/header/categoryCreate.js') !!}--}}

@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('categories.create',$currentModelName) !!}
@stop
@section('content')

    @include("errors.list")

    <div class="container-fluid">

        {!! Form::open(['url'=>"categories"]) !!}

        @include("categories.form", ["submitButton" => trans('core.addModel',['currentModelName' => $currentModelName]) ])


        {!! Form::close()!!}

    </div>
@stop