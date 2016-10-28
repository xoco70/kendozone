@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}

@stop
@section('content')
    <?php
    //    Configuration has not finished:
    //            - category Settings size == 0
    //            - 0 users added
    $configurationNotFinished = false;
    $tournaments = Auth::user()->tournaments;
    ?>

    @if (sizeof($tournaments) == 0)
        @include('layouts.dashboard.createFirstTournament')

    @elseif (sizeof($tournaments) == 1)
        <?php
            $tournament = $tournaments->first();
            $settingSize = $tournament->championshipSettings()->count();
            $categorySize = $tournament->championships()->count();
            $competitorsSize = $tournament->competitors()->count();

            if ($settingSize != $categorySize || $competitorsSize == 0)
                $configurationNotFinished = true;



        ?>
        @if ($configurationNotFinished)
            @include('layouts.dashboard.configureTournament')
        @else
            {{-- Display widget for the latest 5 tournaments --}}
            {{--@foreach(Auth::user()->tournaments->sortByDesc('created_at')->take(5) as $tournament)--}}

            @include('layouts.dashboard.dashboard')
            {{--@endforeach--}}
        @endif
    @else
        @include('layouts.dashboard.dashboard')
    @endif
@stop