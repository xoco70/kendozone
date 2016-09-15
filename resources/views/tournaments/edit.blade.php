@extends('layouts.dashboard')
@section('styles')
    {!! Html::style('js/jquery.timepicker.css')!!}
@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('tournaments.edit',$tournament) !!}

@stop
@section('content')
    @include("errors.list")
    <?php
    $appURL = (app()->environment() == 'local' ? getenv('URL_BASE') : config('app.url'));
    ?>


    <!-- Detached content -->
    <div class="container-detached">

        <div class="content-detached">
            <ul class="nav nav-tabs nav-tabs-solid nav-justified">
                <li class="active"><a href="#tab1" data-toggle="tab">{{trans('core.general_data')}}</a></li>
                <li><a href="#tab2" data-toggle="tab" id="menu2">{{trans('core.venue')}}</a></li>
                <li><a href="#tab3" data-toggle="tab">{{trans_choice('categories.category',2)}}</a></li>
                <li><a href="#tab4" data-toggle="tab">{{trans_choice('categories.categorySettings',2)}}</a></li>

            </ul>

            <div class="row">
                <div class="col-lg-12">

                    <!-- Simple panel 1 : General Data-->


                    <div class="tab-content">

                        <div class="tab-pane active" id="tab1">
                            @include("layouts.tournament.general")
                        </div>
                        <div class="tab-pane" id="tab2">
                            @include("layouts.tournament.venue")
                        </div>
                        <div class="tab-pane" id="tab3">
                            @include("layouts.tournament.categories")

                        </div>
                        <div class="tab-pane" id="tab4">
                            @include("layouts.tournament.categories_settings")
                        </div>
                    </div>
                </div>


                <!-- /simple panel acordion -->


            </div>
        </div>
        <!-- /detached content -->
    </div>
    @include("right-panel.tournament_menu")
    @include("modals.create_category")

    <!-- /content area -->
    <?php
    $now = Carbon\Carbon::now();
    $year = $now->year;
    $month = $now->month-1; // Javascript dates are zero-indexed https://github.com/amsul/pickadate.js/issues/768
    $day = $now->day;

    $userLat = Auth::getUser()->latitude;
    $userLng = Auth::getUser()->longitude;
    $venueLat = $venue->latitude;
    $venueLong = $venue->longitude;

    if (!isNullOrEmptyString($venueLong) && !isNullOrEmptyString($venueLong)) {
        $latitude = $venueLat;
        $longitude = $venueLong;

    } else if (!isNullOrEmptyString($userLat) && !isNullOrEmptyString($userLng)) {
        $latitude = $userLat;
        $longitude = $userLng;
    } else {
        //TODO Should popup for user localization
        $latitude = 0;
        $longitude = 0;
    }
    ?>

@stop

@section('scripts_footer')
    <script>
        var url_base = "{{ route('tournaments.index') }}";
        var url_api_base = "{{ route('tournaments.api') }}";
        var url_api_root = "{{ route('api.root') }}";
        var url_edit = "{{ URL::action('TournamentController@update', $tournament->slug) }}";
        var longitude = "{{$longitude }}";
        var latitude = "{{$latitude }}";
        var configured = "{{ trans('core.configured_full') }}";
        var allCategoriesSize = '{!! $categorySize !!}';
        var dualListIds = [];
        var dualList;
        var venue = "{!! addcslashes($venue, '"') !!}";
        venue = JSON.parse(venue);
    </script>
    {!! Html::script('js/pages/header/tournamentEdit.js') !!}
    {!! Html::script('https://maps.google.com/maps/api/js?key=AIzaSyDMbCISDkoc5G1AP1mw8K76MsaN0pyF64k&libraries=places') !!}
    {!! Html::script('js/categoryCreate.js') !!}

@stop