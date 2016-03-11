@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}

@stop
@section('content')
    <?php $configurationNotFinished = false; ?>

    @if (sizeof(Auth::user()->tournaments) == 0)
        @include('layouts.dashboard.createFirstTournament')

    @elseif (sizeof(Auth::user()->tournaments) == 1 && $configurationNotFinished)
        @include('layouts.dashboard.configureTournament')
    @else
        {{-- Display widget for the latest 5 tournaments --}}
        {{--@foreach(Auth::user()->tournaments->sortByDesc('created_at')->take(5) as $tournament)--}}

            @include('layouts.dashboard.dashboard')
        {{--@endforeach--}}
    @endif
@stop