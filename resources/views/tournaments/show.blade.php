@extends('layouts.dashboard')
@section('scripts')
{!! Html::script('js/pages/header/tournamentEdit.js') !!}
{!! Html::script('http://maps.google.com/maps/api/js') !!}
@stop
@section('styles')
{!! Html::style('js/jquery.timepicker.css')!!}
@stop
@section('breadcrumbs')
{!! Breadcrumbs::render('tournaments.edit',$tournament) !!}

@stop
@section('content')


        <!-- Detached content -->
<div class="container-detached">
    <div class="content-detached">
        <div class="row">
            <div class="col-lg-11 col-lg-offset-1">

                <!-- Simple panel 1 : General Data-->


                <div class="panel panel-flat">

                    <div class="panel-body">
                        <div class="container-fluid">


                            <fieldset title="{{Lang::get('crud.general_data')}}">
                                <legend class="text-semibold">{{Lang::get('crud.general_data')}}</legend>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!!  Form::label('name', trans('crud.name'),['class' => 'text-bold' ]) !!}
                                            <br/>
                                            {{ $tournament->name }}


                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            {!!  Form::label('level_id', trans('crud.level'),['class' => 'text-bold' ]) !!}
                                            <br/>
                                            {{ $tournament->level->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        {!!  Form::label('date', trans('crud.eventDate'),['class' => 'text-bold' ]) !!}
                                        {{--<br/>--}}


                                        <div class="input-group">
                                            {{ $tournament->date }}
                                        </div>


                                    </div>


                                    <div class="col-md-3">
                                        {!!  Form::label('registerDateLimit', trans('crud.limitDateRegistration'),['class' => 'text-bold' ]) !!}
                                        <br/>

                                        <div class="input-group">

                                            {{ $tournament->registerDateLimit }}

                                        </div>
                                        <br/>


                                    </div>
                                    <div class="col-md-3">


                                        {!!     Form::label('mustPay', trans('crud.pay4register'),['class' => 'text-bold' ])  !!}
                                        <br/>

                                        {{ $tournament->mustPay == 1 ? trans('core.yes') : trans('core.no') }}


                                    </div>
                                    <div class="col-md-3">

                                        <div class="checkbox-switch">
                                            <label>

                                                {!!  Form::label('type', trans('crud.tournamentType'),['class' => 'text-bold' ]) !!}

                                                <br/>
                                                {{ $tournament->type == 1 ? trans('core.open') : trans_choice('crud.invitation', 1) }}

                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!!  Form::label('rules', trans('crud.rules'),['class' => 'text-bold' ]) !!}
                                            <br/>
                                            rules
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">


                                    </div>
                                    <div class="col-md-6">

                                    </div>

                                </div>


                            </fieldset>


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
                                    <legend class="text-semibold">{{Lang::get('crud.venue')}}
                                        : {{ $tournament->venue }}</legend>
                                </a>
                            </fieldset>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="map-container map-basic"></div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- /simple panel acordion -->
                <div class="panel panel-flat category-settings">
                    <div class="panel-body">
                        <div class="container-fluid">
                            <fieldset title="{{trans_choice('crud.categorySettings',2)}}">
                                <a name="categories">
                                    <legend class="text-semibold">{{trans_choice('crud.categorySettings',2)}}</legend>
                                </a>
                            </fieldset>


                            <div class="row">
                                <div class="col-md-12">

                                    <div class="panel-group" id="accordion-styled">


                                        @foreach($tournament->categoryTournaments as $key => $categoryTournament)
                                            <?php

                                            $setting = $tournament->categoryTournaments->get($key)->settings;
//                                            $teamSize = isset($setting->teamSize) ? $setting->teamSize : 0;
//                                            $enchoQty = isset($setting->enchoQty) ? $setting->enchoQty : 0;
//                                            $fightingAreas = isset($setting->fightingAreas) ? $setting->fightingAreas : 0;

                                            ?>

                                            <div class="panel ">
                                                <a data-toggle="collapse" data-parent="#accordion-styled"
                                                   href="#accordion-styled-group{!! $key !!}">

                                                    <div class="panel-heading">
                                                        <h6 class="panel-title">
                                                            {{trans($categoryTournament->category->name)}}
                                                        </h6>
                                                    </div>
                                                </a>
                                                <div id="accordion-styled-group{!! $key !!}"
                                                     class="panel-collapse collapse {!! $key==0 ? "in" : "" !!} ">
                                                    <div class="panel-body">
                                                        @if ($setting !=null)
                                                            @include('categories.categorySettingsShow')
                                                        @else
                                                            {{ trans('crud.category_not_configured') }}
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>


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

                    <legend class="text-semibold ">{{ trans('crud.invite_with_link') }}</legend>

                            <h2 class="form-group text-center m">
                                <br/>
                                {{getenv('URL_BASE')}}/tournaments/{{$tournament->slug}}/register/
                            </h2>


                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /detached content -->
</div>
@include("right-panel.tournament_menu_show")

        <!-- /content area -->

@stop

@section('scripts_footer')
    <script>

        var latitude = "{{ $tournament->latitude }}";
        var longitude = "{{ $tournament->longitude }}";
    </script>
    {!! Html::script('js/pages/footer/tournamentShowFooter.js') !!}
@stop