@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}

@stop
@section('content')


    @if (sizeof(Auth::user()->tournaments) == 0)
    @include('layouts.dashboard.createFirstTournament')

    @elseif (sizeof(Auth::user()->tournaments) == 1)
        @include('layouts.dashboard.configureTournament')

    @endif
@stop