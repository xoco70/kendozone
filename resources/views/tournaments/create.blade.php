@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/header/tournamentCreate.js') !!}

@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('tournaments.create',$currentModelName) !!}
@stop
@section('content')

    @include("errors.list")

    <div class="container-fluid">

            {!! Form::open(['url'=> URL::action('TournamentController@index') ]) !!}

            @include("tournaments.form", ["submitButton" => trans('core.addModel',['currentModelName' => $currentModelName]) ])


            {!! Form::close()!!}

    </div>
@stop