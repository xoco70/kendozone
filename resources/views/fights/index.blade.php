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
                    <div class="container-fluid">

                        @foreach($tournament->championships as $championship)
                            <h1> {{$championship->category->buildName($grades)}}</h1>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("right-panel.tournament_menu")

@stop
@section('scripts_footer')
    {{--{!! Html::script('js/pages/header/footable.js') !!}--}}
    {{--<script>--}}
        {{--$(function () {--}}

            {{--// Initialize responsive functionality--}}
            {{--$('.table-togglable').footable();--}}

        {{--});--}}
    {{--</script>--}}

@stop
