@extends('layouts.dashboard')
@section('styles')
    {!! Html::style('js/jquery.timepicker.css')!!}
@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('tournaments.edit',$tournament) !!}

@stop
@section('content')
    <?php
    $appURL = (app()->environment() == 'local' ? getenv('URL_BASE') : config('app.url'));
    ?>


    <!-- Detached content -->
    <div class="container-detached">
        <div class="content-detached">
            <div class="row">
                <div class="col-lg-11 col-lg-offset-1">

                    <!-- Simple panel 1 : General Data-->


                    <div class="panel panel-flat">

                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="{{Lang::get('core.general_data')}}">
                                    <legend class="text-semibold">{{Lang::get('core.general_data')}}</legend>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!!  Form::label('name', trans('core.name'),['class' => 'text-bold ' ]) !!}
                                                <br/>
                                                {{ $tournament->name }}


                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                {!!  Form::label('level_id', trans('core.level'),['class' => 'text-bold' ]) !!}
                                                <br/>
                                                {{ $tournament->level->name }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            {!!  Form::label('date', trans('core.eventDate'),['class' => 'text-bold' ]) !!}
                                            {{--<br/>--}}


                                            <div class="input-group">
                                                {{ $tournament->dateIni }} / {{ $tournament->dateFin }}
                                            </div>


                                        </div>


                                        <div class="col-md-3">
                                            @if ($tournament->registerDateLimit!= null && $tournament->registerDateLimit!= '0000-00-00')
                                                {!!  Form::label('registerDateLimit', trans('core.limitDateRegistration'),['class' => 'text-bold' ]) !!}
                                                <br/>

                                                <div class="input-group">

                                                    {{ $tournament->registerDateLimit }}

                                                </div>
                                                <br/>
                                            @endif

                                        </div>

                                        <div class="col-md-3">

                                            <div class="checkbox-switch">
                                                <label>

                                                    {!!  Form::label('type', trans('core.tournamentType'),['class' => 'text-bold' ]) !!}

                                                    <br/>
                                                    {{ $tournament->type == 1 ? trans('core.open') : trans_choice('core.invitation', 1) }}

                                                </label>
                                            </div>

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


                                <fieldset title="{{Lang::get('core.venue')}}">
                                    <a name="place">
                                        <legend class="text-semibold">{{Lang::get('core.venue')}}
                                            : {{ $tournament->venue != null ? $tournament->venue->venue_name : ""}}</legend>
                                    </a>
                                </fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!!  Form::label('address', trans('core.address'),['class' => 'text-bold' ]) !!}
                                            <br/>
                                            {{ $tournament->venue != null ? $tournament->venue->address :""}}


                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            {!!  Form::label('details', trans('core.details'),['class' => 'text-bold' ]) !!}
                                            <br/>
                                            {{ $tournament->venue != null ? $tournament->venue->details : ""}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!!  Form::label('state', trans('core.state'),['class' => 'text-bold' ]) !!}
                                            <br/>
                                            {{ $tournament->venue != null ? $tournament->venue->state :""}}


                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            {!!  Form::label('country', trans('core.country'),['class' => 'text-bold' ]) !!}
                                            <br/>
                                            @if ($tournament->venue != null)
                                                {{ $tournament->venue->country->name }}&nbsp; <img
                                                        src="/images/flags/{{ $tournament->venue->country->flag }}"
                                                        alt="{{ $tournament->venue->country->name }}"/>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if ($tournament->venue!=null)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="map-container map-basic"></div>
                                        </div>
                                    </div>
                                @endif


                            </div>
                        </div>
                    </div>

                    <!-- /simple panel acordion -->
                    <div class="panel panel-flat category-settings">
                        <div class="panel-body">
                            <div class="container-fluid">
                                <fieldset title="{{trans_choice('categories.categorySettings',2)}}">
                                    <a name="categories">
                                        <legend class="text-semibold">{{trans_choice('categories.categorySettings',2)}}</legend>
                                    </a>
                                </fieldset>


                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="panel-group" id="accordion-styled">


                                            @foreach($tournament->championships as $key => $championship)
                                                <?php
                                                $setting = $tournament->championships->get($key)->settings;
                                                ?>

                                                <div class="panel ">
                                                    <a data-toggle="collapse" data-parent="#accordion-styled"
                                                       href="#accordion-styled-group{!! $key !!}">

                                                        <div class="panel-heading">
                                                            <h6 class="panel-title">
                                                                {{trans($championship->category->buildName($grades))}}
                                                            </h6>
                                                        </div>
                                                    </a>
                                                    <div id="accordion-styled-group{!! $key !!}"
                                                         class="panel-collapse collapse {!! $key==0 ? "in" : "" !!} ">
                                                        <div class="panel-body">
                                                            @if ($setting !=null)
                                                                @include('categories.categorySettingsShow')
                                                            @else
                                                                {{ trans('categories.category_not_configured') }}
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

                    <!-- Simple panel 2 : Venue -->

                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="{{trans_choice('core.team',2)}}">
                                    <a name="teams">
                                        <legend class="text-semibold">{{trans_choice('core.team',2)}}</legend>
                                    </a>
                                </fieldset>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ trans('core.registered_team') }}
                                        {{ $teams }}


                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                {{-- If open Tournament--}}
                @if ($tournament->type==1)

                    <!-- /simple panel -->
                        <div class="panel panel-flat" id="share_tournament">

                            <div class="panel-body">

                                <legend class="text-semibold ">{{ trans('core.invite_with_link') }}</legend>

                                <h2 class="form-group text-center m">
                                    <br/>
                                    {{$appURL}}/tournaments/{{$tournament->slug}}/register/
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
    {!! Html::script('js/pages/header/tournamentShow.js') !!}
    {!! Html::script('https://maps.google.com/maps/api/js?key=AIzaSyDMbCISDkoc5G1AP1mw8K76MsaN0pyF64k') !!}
@stop