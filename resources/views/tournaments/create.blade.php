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

            {!! Form::open(['url'=> URL::action('TournamentController@store') ]) !!}

            @include("tournaments.form", ["submitButton" => trans('core.addModel',['currentModelName' => $currentModelName]) ])


            {!! Form::close()!!}
            @include("modals.create_category");

    </div>
@stop
@section('scripts_footer')
    {!! Html::script('js/icheck.min.js') !!}
{{--    {!! Html::script('js/pages/footer/categoryCreateFooter.js') !!}--}}
    {!! Html::script('js/categoryCreate.js') !!}
@stop