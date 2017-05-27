@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('fights.index', $tournament) !!}
@stop
@section('content')
    <div class="container-detached">
        <div class="content-detached">
            @include('layouts.tree.topTree')
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="container-fluid" align="center">

                        @forelse($tournament->championships as $championship)
                            <h1> {{$championship->buildName()}}</h1>
                            @include('kendo-tournaments::partials.fights')
                        @empty
                            {{ trans('core.no_fight_list') }}
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("right-panel.tournament_menu")

@stop
@section('scripts_footer')
@stop
