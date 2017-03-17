
@extends('layouts.guest_banner')
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
    $venue = $venue->setDefaultLocation($tournament, $venue->latitude, $venue->longitude);
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

@stop