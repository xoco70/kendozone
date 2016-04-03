@extends('layouts.dashboard')

@section('content')

    @include("errors.list")

    <div class="container-fluid">

            {!! Form::open(['url'=>"tournaments"]) !!}

            @include("tournaments.form", ["submitButton" => trans('core.addModel',['currentModelName' => $currentModelName]) ])


            {!! Form::close()!!}

    </div>
@stop