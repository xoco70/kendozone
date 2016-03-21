@extends('layouts.dashboard')
@section('scripts')
{!! Html::script('js/pages/header/tournamentEdit.js') !!}
{!! Html::script('https://maps.google.com/maps/api/js') !!}
@stop
@section('styles')
{!! Html::style('js/jquery.timepicker.css')!!}
@stop
@section('breadcrumbs')
{!! Breadcrumbs::render('tournaments.edit',$tournament) !!}

@stop
@section('content')
@include("errors.list")


        <!-- Detached content -->
<div class="container-detached">
    <div class="content-detached">
        <div class="row">
            <div class="col-lg-11 col-lg-offset-1">
                {!! Form::model($tournament, ['method'=>"PATCH", 'id'=>'form', "action" => ["TournamentController@update", $tournament->slug]]) !!}

                        <!-- Simple panel 1 : General Data-->


                <div class="panel panel-flat">

                    <div class="panel-body">
                        <div class="container-fluid">


                            <fieldset title="{{Lang::get('crud.general_data')}}">
                                <legend class="text-semibold">{{Lang::get('crud.general_data')}}</legend>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!!  Form::label('name', trans('crud.name'),['class' => 'text-bold' ]) !!}
                                            <br/>
                                            {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}

                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        {!!  Form::label('dateIni', trans('crud.eventDateIni'),['class' => 'text-bold' ]) !!}
                                        {{--<br/>--}}


                                        <div class="input-group">
                                            <span class="input-group-addon">{{trans('crud.from') }}</span>
                                            {!!  Form::input('text', 'dateIni', old('dateIni'), ['class' => 'form-control datetournament']) !!}
                                            <span class="input-group-addon"><i class="icon-calendar3"></i></span>

                                        </div>

                                    </div>
                                    <div class="col-md-4">

                                        {!!  Form::label('dateFin', trans('crud.eventDateFin'),['class' => 'text-bold' ]) !!}
                                        {{--<br/>--}}


                                        <div class="input-group">
                                            <span class="input-group-addon">{{trans('crud.to') }}</span>
                                            {!!  Form::input('text', 'dateFin', old('dateFin'), ['class' => 'form-control datetournament']) !!}
                                            <span class="input-group-addon"><i class="icon-calendar3"></i></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!!  Form::label('level_id', trans('crud.level'),['class' => 'text-bold' ]) !!}
                                            <br/>
                                            {!!  Form::select('level_id', $levels,null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        {!!  Form::label('registerDateLimit', trans('crud.limitDateRegistration'),['class' => 'text-bold' ]) !!}
                                        <br/>

                                        <div class="input-group">

                                            {!!  Form::input('text', 'registerDateLimit', old('registerDateLimit'), ['class' => 'form-control datelimit']) !!}
                                            <span class="input-group-addon"><i class="icon-calendar3"></i></span>
                                        </div>
                                        <br/>


                                    </div>
                                </div>

                                <div class="row">
                                    {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group">--}}
                                    {{--{!!  Form::label('cost', trans('crud.cost'),['class' => 'text-bold' ]) !!}--}}
                                    {{--<br/>--}}
                                    {{--{!!  Form::input('number','cost', old('cost'), ['class' => 'form-control', 'size'=>'3','maxsize'=>'4']) !!}--}}
                                    {{--</div>--}}
                                    {{--</div>--}}


                                </div>
                                <legend class="text-semibold">{{Lang::get('crud.competitors_register')}}</legend>

                                <div class="row">
                                    <div class="col-md-3">


                                        {!!     Form::label('mustPay', trans('crud.pay4register'),['class' => 'text-bold' ])  !!}
                                        <br/>

                                        <div class="checkbox-switch">
                                            <label>
                                                {!!     Form::hidden('mustPay', 0) !!}
                                                {!!       Form::checkbox('mustPay', 1, $tournament->mustPay, ['class' => 'switch', 'data-on-text'=>trans('core.yes'), 'data-off-text'=>trans('core.no')]) !!}
                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-md-3">

                                        <div class="checkbox-switch">
                                            <label>

                                                {!!  Form::label('type', trans('crud.tournamentType'),['class' => 'text-bold' ]) !!}
                                                <br/>
                                                {!!   Form::hidden('type', 0) !!}
                                                {!!   Form::checkbox('type', 1, $tournament->type, ['class' => 'switch', 'data-on-text'=>trans('core.open'), 'data-off-text'=>trans_choice('crud.invitation', 1)]) !!}

                                            </label>
                                        </div>

                                    </div>


                                </div>


                            </fieldset>


                        </div>
                        <div align="right">
                            <button type="submit" class="btn btn-success btn-update-tour"><i></i>{{trans("core.save")}}
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /simple panel -->
                <!-- Simple panel 2 : Venue -->

                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="container-fluid">


                            <fieldset title="{{Lang::get('crud.venue')}}">
                                <a name="place">
                                    <legend class="text-semibold">{{Lang::get('crud.venue')}}</legend>
                                </a>
                            </fieldset>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!!  Form::label('venue', trans('crud.name'),['class' => 'text-bold' ]) !!}
                                    {!!  Form::text('venue', old('venue'), ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!!  Form::label('latitude', trans('crud.latitude'),['class' => 'text-bold' ]) !!}
                                    {!!  Form::text('latitude', old('latitude'), ['class' => 'form-control']) !!}

                                </div>
                                <div class="form-group">
                                    {!!  Form::label('longitude', trans('crud.longitude'),['class' => 'text-bold' ]) !!}
                                    {!!  Form::text('longitude', old('longitude'), ['class' => 'form-control']) !!}

                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!!  Form::label('name', trans('crud.coords')) !!}
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
                                // Should popup for user localization
                                $latitude = 0;
                                $longitude = 0;
                            }
                            ?>


                        </div>
                        <div align="right">
                            <button type="submit" class="btn btn-success btn-update-tour"><i></i>{{trans("core.save")}}
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /simple panel -->
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="container-fluid">
                            <fieldset title="{{trans_choice('crud.category',2)}}">
                                <a name="categories">
                                    <legend class="text-semibold">{{trans_choice('crud.category',2)}}</legend>
                                </a>
                            </fieldset>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-body">
                                        <p class="coutent-group">{{trans('crud.select_tournament_categories')}}</p>


                                        {!!  Form::select('category[]', $categories,$tournament->getCategoryList(), ['class' => 'form-control listbox-filter-disabled', "multiple"]) !!} <!-- Default 1st Dan-->
                                    </div>


                                </div>


                            </div>
                            <div align="right">
                                <button type="submit" class="btn btn-success btn-update-tour">
                                    <i></i>{{trans("core.save")}}
                                </button>
                            </div>
                        </div>


                    </div>
                    <!-- /simple panel -->
                </div>
                {!! Form::close()!!}

                        <!-- /simple panel acordion -->
                <div class="panel panel-flat category-settings">
                    <div class="panel-body">
                        <div class="container-fluid">
                            <fieldset title="{{trans_choice('crud.categorySettings',2)}}">
                                <a name="categories">
                                    <legend class="text-semibold">{{trans_choice('crud.categorySettings',2)}}</legend>
                                </a>
                            </fieldset>


                            <div class="panel-group" id="accordion-styled">

                                @foreach($tournament->categoryTournaments as $key => $categoryTournament)
                                <?php

                                $setting = $tournament->categoryTournaments->get($key)->settings;
                                $teamSize = isset($setting->teamSize) ? $setting->teamSize : 0;
                                $enchoQty = isset($setting->enchoQty) ? $setting->enchoQty : 0;
                                $fightingAreas = isset($setting->fightingAreas) ? $setting->fightingAreas : 0;

                                ?>

                                <div class="panel">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-5 cat-title">
                                            <a data-toggle="collapse" data-parent="#accordion-styled"
                                               href="#accordion-styled-group{!! $key !!}">

                                                <div class="panel-heading">
                                                    <h6 class="panel-title">
                                                        {{trans($categoryTournament->category->name)}}
                                                    </h6>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-5 col-md-7 cat-status">
                                            <a data-toggle="collapse" data-parent="#accordion-styled"
                                               href="#accordion-styled-group{!! $key !!}">
                                                <div class="panel-heading">
                                                    @if (is_null($setting))
                                                        <span class="text-orange-600">
                                                            <span class="cat-state">{{ trans('crud.configure') }}</span>
                                                            <i class="glyphicon  glyphicon-exclamation-sign  status-icon"></i>
                                                        </span>
                                                    @else

                                                        <span class="text-success">

                                                            <span class="cat-state">{{ trans('crud.configured') }}</span>
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


                {{-- If open Tournament--}}
                @if ($tournament->type==1)

                        <!-- /simple panel -->
                <div class="panel panel-flat" id="share_tournament">
                    <div class="panel-body">
                        <div class="container-fluid">


                            <fieldset title="1">
                                <legend class="text-semibold ">{{ trans('crud.invite_with_link') }}</legend>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="form-group text-center m">
                                            <br/>
                                            {{getenv('URL_BASE')}}tournaments/{{$tournament->slug}}/register/
                                        </h2>

                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /detached content -->
</div>
@include("right-panel.tournament_menu")

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
        var url_base = "{{ url('/tournaments/') }}";
        var url_edit = url_base + '/' + "{{$tournament->slug}}";
        var longitude = "{{$longitude }}";
        var latitude = "{{$latitude }}";
        var configured = "{{ trans('crud.configured') }}";


    </script>

    {!! Html::script('js/pages/footer/tournamentEditFooter.js') !!}
@stop