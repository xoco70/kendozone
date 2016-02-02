@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/tournamentCreate.js') !!}
    {{--{!! Html::script('js/plugins/pickers/pickadate/picker.js') !!}--}}
    {{--{!! Html::script('js/plugins/pickers/pickadate/picker.date.js') !!}--}}
@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('create_tournament',$currentModelName) !!}
@stop
@section('content')

    @include("errors.list")

    <div class="container-fluid">

            {!! Form::open(['url'=>"tournaments"]) !!}

            @include("tournaments.form", ["submitButton" => trans('crud.addModel',['currentModelName' => $currentModelName]) ])


            {!! Form::close()!!}

    </div>
@stop