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
                <li><a href="#tab3" data-toggle="tab">{{trans_choice('core.category',2)}}</a></li>
                <li><a href="#tab4" data-toggle="tab">{{trans_choice('core.categorySettings',2)}}</a></li>

            </ul>

            <div class="row">
                <div class="col-lg-12">

                    <!-- Simple panel 1 : General Data-->


                    <div class="tab-content">

                        <div class="tab-pane active" id="tab1">
                            {!! Form::model($tournament, ['method'=>"PATCH", 'id'=>'form', "action" => ["TournamentController@update", $tournament->slug]]) !!}
                            <div class="panel panel-flat">

                                <div class="panel-body">
                                    <div class="container-fluid">


                                        <fieldset title="{{trans('core.general_data')}}" class="mt-20 pt-20">


                                            <div class="row">
                                                <div class="col-md-2"></div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        {!!  Form::label('name', trans('core.name'),['class' => 'text-bold' ]) !!}
                                                        <br/>
                                                        {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}

                                                    </div>

                                                </div>
                                                <div class="col-md-2">
                                                    {!!  Form::label('dateIni', trans('core.eventDateIni'),['class' => 'text-bold' ]) !!}
                                                    {{--<br/>--}}


                                                    <div class="input-group">
                                                        <span class="input-group-addon">{{trans('core.from') }}</span>
                                                        {!!  Form::input('text', 'dateIni', old('dateIni'), ['class' => 'form-control dateIni']) !!}
                                                        <span class="input-group-addon"><i
                                                                    class="icon-calendar3"></i></span>

                                                    </div>

                                                </div>
                                                <div class="col-md-2">

                                                    {!!  Form::label('dateFin', trans('core.eventDateFin'),['class' => 'text-bold' ]) !!}
                                                    {{--<br/>--}}


                                                    <div class="input-group">
                                                        <span class="input-group-addon">{{trans('core.to') }}</span>
                                                        {!!  Form::input('text', 'dateFin', old('dateFin'), ['class' => 'form-control dateFin']) !!}
                                                        <span class="input-group-addon"><i
                                                                    class="icon-calendar3"></i></span>
                                                    </div>

                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-2">
                                                    {!!  Form::label('registerDateLimit', trans('core.limitDateRegistration'),['class' => 'text-bold' ]) !!}
                                                    <br/>

                                                    <div class="input-group">

                                                        {!!  Form::input('text', 'registerDateLimit', ($tournament->registerDateLimit == '0000-00-00') ? '' : old('registerDateLimit') , ['class' => 'form-control dateLimit']) !!}
                                                        <span class="input-group-addon"><i
                                                                    class="icon-calendar3"></i></span>
                                                    </div>
                                                    <br/>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        {!!  Form::label('level_id', trans('core.level'),['class' => 'text-bold' ]) !!}
                                                        <br/>
                                                        {!!  Form::select('level_id', $levels,null, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-2">

                                                    <div class="checkbox-switch">
                                                        <label>

                                                            {!!  Form::label('type', trans('core.tournamentType'),['class' => 'text-bold' ]) !!}
                                                            <br/>
                                                            {!!   Form::hidden('type', 0) !!}
                                                            {!!   Form::checkbox('type', 1, $tournament->type, ['class' => 'switch', 'data-on-text'=>trans('core.open'), 'data-off-text'=>trans_choice('core.invitation', 1)]) !!}

                                                        </label>
                                                    </div>

                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        {!!  Form::label('rule_id', trans('core.rules'),['class' => 'text-bold' ]) !!}
                                                        <br/>
                                                        {!!  Form::select('rule_id', $rules,null, ['class' => 'form-control']) !!}
                                                    </div>


                                                </div>

                                            </div>

                                        </fieldset>
                                    </div>
                                    <div align="right">
                                        <button type="submit" class="btn btn-success">
                                            {{trans("core.save")}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close()!!}
                        </div>
                        <div class="tab-pane" id="tab2">
                        {!! Form::model($tournament, ['method'=>"PATCH", 'id'=>'form', "action" => ["TournamentController@update", $tournament->slug]]) !!}
                        <!-- Simple panel 2 : Venue -->
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <div class="container-fluid">
                                        <div class="col-lg-12 mt-20" >
                                            <div class="form-group">
                                                {!!  Form::label('venue', trans('core.name'),['class' => 'text-bold' ]) !!}
                                                {!!  Form::text('venue', old('venue'), ['class' => 'form-control']) !!}
                                            </div>

                                            {!!  Form::hidden('latitude', old('latitude'), ['class' => 'form-control', 'id' =>'latitude']) !!}
                                            {!!  Form::hidden('longitude', old('longitude'), ['class' => 'form-control','id' =>'longitude']) !!}


                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                {!!  Form::label('name', trans('core.coords'),['class' => 'text-bold' ]) !!}
                                                <div class="map-wrapper locationpicker-default"
                                                     id="locationpicker-default"></div>
                                            </div>
                                        </div>
                                        <?php
                                        $userLat = Auth::getUser()->latitude;
                                        $userLng = Auth::getUser()->longitude;
                                        $oldLatitude = $tournament->latitude;
                                        $oldLongitude = $tournament->longitude;

                                        if (!isNullOrEmptyString($oldLongitude) && !isNullOrEmptyString($oldLongitude)) {
                                            $latitude = $oldLatitude;
                                            $longitude = $oldLongitude;

                                        } else if (!isNullOrEmptyString($userLat) && !isNullOrEmptyString($userLng)) {
                                            $latitude = $userLat;
                                            $longitude = $userLng;
                                        } else {
                                            //TODO Should popup for user localization
                                            $latitude = 0;
                                            $longitude = 0;
                                        }
                                        ?>


                                    </div>
                                    <div align="right">
                                        <button type="submit"
                                                class="btn btn-success btn-update-tour"><i></i>{{trans("core.save")}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close()!!}
                        </div>
                        <div class="tab-pane" id="tab3">
                        {!! Form::model($tournament, ['method'=>"PATCH", 'id'=>'form', "action" => ["TournamentController@update", $tournament->slug]]) !!}
                        <!-- Categorias Panel -->
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <div class="container-fluid">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="coutent-group">{{trans('core.select_tournament_categories')}}</p>
                                                {!!  Form::select('category[]', $categories,$tournament->getCategoryList(), ['class' => 'form-control listbox-filter-disabled', "multiple"]) !!} <!-- Default 1st Dan-->
                                                </div>
                                            </div>
                                            <div class="row text-uppercase">
                                                <div class="col-md-6">
                                    <span class="text-danger" v-cloak>
                                        @{{ error }}
                                    </span>
                                                </div>
                                                <div class="col-md-6 add_category">
                                                    <a href="#" data-toggle="modal" data-target="#create_category"
                                                       class="text-semibold text-black" @click="resetModalValues()">
                                                    + {{ trans('core.add_custom_category') }}</a>
                                                </div>
                                            </div>
                                            <div align="right">
                                                <button type="submit" class="btn btn-success btn-update-tour">
                                                    <i></i>{{trans("core.save")}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /simple panel -->
                            </div>
                            {!! Form::close()!!}

                        </div>
                        <div class="tab-pane" id="tab4">
                            <div class="panel panel-flat category-settings">
                                <div class="panel-body">
                                    <div class="container-fluid">
                                        <div class="panel-group" id="accordion-styled">
                                            @foreach($tournament->categoryTournaments as $key => $categoryTournament)
                                                {{--TODO This is making X query, have to cache it--}}
                                                <?php
                                                // Set defaults
                                                $setting = $tournament->categoryTournaments->get($key)->settings;
                                                $teamSize = isset($setting->teamSize) ? $setting->teamSize : 0;
                                                $enchoQty = isset($setting->enchoQty) ? $setting->enchoQty : 0;
                                                $fightingAreas = isset($setting->fightingAreas) ? $setting->fightingAreas : 0;

                                                $fightDuration = (isset($setting->fightDuration) && $setting->fightDuration != "")
                                                        ? $setting->fightDuration : Config::get('constants.CAT_FIGHT_DURATION');

                                                $enchoDuration = (isset($setting->enchoDuration) && $setting->enchoDuration != "")
                                                        ? $setting->enchoDuration : Config::get('constants.CAT_ENCHO_DURATION');


                                                ?>

                                                <div class="panel">
                                                    <div class="row">
                                                        <div class="col-lg-7 col-xs-5 cat-title">
                                                            <a data-toggle="collapse" data-parent="#accordion-styled"
                                                               href="#accordion-styled-group{!! $key !!}">

                                                                <div class="panel-heading">
                                                                    <h6 class="panel-title">

                                                                        {{trans($categoryTournament->category->buildName($grades))}}
                                                                    </h6>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-lg-5 col-xs-7 cat-status">
                                                            <a data-toggle="collapse" data-parent="#accordion-styled"
                                                               href="#accordion-styled-group{!! $key !!}">
                                                                <div class="panel-heading">
                                                                    @if (is_null($setting))
                                                                        <span class="text-orange-600">
                                                            <span class="cat-state">{{ trans('core.configure') }}</span>
                                                            <i class="glyphicon  glyphicon-exclamation-sign  status-icon"></i>
                                                        </span>
                                                                    @else

                                                                        <span class="text-success">

                                                            <span class="cat-state">{{ trans('core.configured_full') }}</span>
                                                            <i class="glyphicon text-success glyphicon-ok  status-icon"></i>
                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </a>
                                                        </div>

                                                    </div>
                                                    <div id="accordion-styled-group{!! $key !!}"
                                                         class="panel-collapse collapse {!! $key==0 ? "in" : "" !!} ">
                                                        <div class="panel-body">
                                                            {{--FORM--}}
                                                            @include('categories.categorySettings')
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div>


                                </div>
                                <!-- /simple panel -->
                            </div>
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
    $month = $now->month;
    $day = $now->day;
    ?>

@stop

@section('scripts_footer')
    <script>
        var url_base = "{{ URL::action('TournamentController@index') }}";
        var url_edit = url_base + '/' + "{{$tournament->slug}}";
        var longitude = "{{$longitude }}";
        var latitude = "{{$latitude }}";
        var configured = "{{ trans('core.configured_full') }}";
        var allCategoriesSize = '{!! $categorySize !!}';
        var dualListIds = [];
        var dualList;
    </script>
    {!! Html::script('js/pages/header/tournamentEdit.js') !!}
    {!! Html::script('https://maps.google.com/maps/api/js?key=AIzaSyDMbCISDkoc5G1AP1mw8K76MsaN0pyF64k') !!}
    {!! Html::script('js/categoryCreate.js') !!}

@stop