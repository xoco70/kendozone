
@extends('layouts.guest_banner')
@section('styles')
    {!! Html::style('js/jquery.timepicker.css')!!}
    {!! Html::style('css/pages/jquery_trees.css')!!}
@stop
@section('content')
    <?php
    $appURL = (app()->environment() == 'local' ? getenv('URL_BASE') : config('app.url'));
    ?>

    @include('layouts.tournament.show.top')


    <div class="row">


        <!-- Simple panel 1 : General Data-->


        <div class="tab-content">

            <div class="tab-pane active" id="general">
                @include("layouts.tournament.show.general")
            </div>
            <div class="tab-pane" id="competitors">
                @include("layouts.tournament.show.competitors")
            </div>
            <div class="tab-pane" id="trees">
                @include("layouts.tournament.show.trees")

            </div>
            <div class="tab-pane" id="rules">
                @include("layouts.tournament.show.rules")
            </div>
        </div>

    </div>

    <!-- Detached content -->

    <?php
    $venue = $venue->setDefaultLocation($venue->latitude, $venue->longitude);
    ?>
    <!-- /content area -->

@stop

@section('scripts_footer')
    <script>

        let latitude = "{{ $venue->latitude }}";
        let longitude = "{{ $venue->longitude }}";
    </script>
    {!! Html::script('js/pages/header/tournamentShow.js') !!}
    {!! Html::script('https://maps.google.com/maps/api/js?key=AIzaSyDMbCISDkoc5G1AP1mw8K76MsaN0pyF64k') !!}
    <?php
    $championshipWithBrackets = $tournament->championships
        ->filter(function ($championship, $key) {
            return ($championship->isDirectEliminationType() && !$championship->hasPreliminary());
        })->map(function ($championship, $key) {
            return $championship->id;
        })->toArray();


    ?>

    {!! Html::script('js/pages/footer/trees_show.js')!!}
    <script>

        @foreach($championshipWithBrackets as $championshipId)
             $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $('#brackets_{{ $championshipId }}').bracket({
                init: minimalData_{{ $championshipId }}, /* data to initialize the bracket with */
                teamWidth: 100,
            })
        });
        @endforeach
    </script>

@stop