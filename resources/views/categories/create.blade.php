@extends('layouts.dashboard')
@section('scripts')


@stop
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
    {!! Html::script('js/icheck.min.js') !!}
    {!! Html::script('js/pages/footer/categoryCreateFooter.js') !!}
    {!! Html::script('/js/categoryCreate.js') !!}
@stop