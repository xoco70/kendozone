@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/header/userCreate.js') !!}
    {!! Html::script('https://maps.google.com/maps/api/js?key=AIzaSyDMbCISDkoc5G1AP1mw8K76MsaN0pyF64k') !!}

@stop
@section('styles')
    {!! Html::style('css/pages/userCreate.css') !!}
@stop
@section('breadcrumbs')
    @if (!is_null($user->id))
        {!! Breadcrumbs::render('users.edit', $user) !!}
    @else
        {!! Breadcrumbs::render('users.create') !!}

    @endif
@stop
@section('content')

    @include("errors.list")

    <div class="container">
        <div class="content">
            <!-- Detached content -->
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 col-xs-12 col-sm-12">
                    <!-- Simple panel 1 : General Data-->
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="{{Lang::get('core.general_data')}}">
                                    <legend class="text-semibold">{{Lang::get('core.general_data')}}</legend>
                                </fieldset>

                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <span class="text-bold"> {{ trans('core.username') }}
                                                    :</span> {!!  $user->name !!}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <span class="text-bold"> {{ trans('core.firstname') }}:</span>
                                                {!!  $user->firstName !!}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <span class="text-bold"> {{ trans('core.lastname') }}:</span>
                                                {!!  $user->lastName !!}


                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <span class="text-bold"> {{ trans('core.grade') }}:</span>
                                                {!!  trans($user->grade->name)!!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <span class="text-bold"> {{ trans('core.email') }}:</span>
                                                {!!  trans($user->email)!!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <span class="text-bold"> {{ trans('core.role') }}:</span>
                                                {!!  trans($user->role->name)!!}
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-xs-12 col-md-6  text-center">
                                        <img src="{{ $user->avatar }}" width="200" height="200"/>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="panel panel-flat">


                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="{{Lang::get('core.location')}}">
                                    <legend class="text-semibold">{{Lang::get('core.location')}}</legend>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="row">
                                                <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <span class="text-bold"> {{ trans('core.city') }}
                                                    :</span> {!!  $user->city !!}
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <span class="text-bold"> {{ trans('core.country') }}
                                                    :</span> {!!  trans($user->country->name)!!} <img
                                                            src="/images/flags/{{$user->country->flag}}"/>
                                                </div>
                                                <br/>


                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6  ">
                                            <div class="map-container map-basic"></div>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('scripts_footer')
    <script>

        var latitude = "{{ $user->latitude }}";
        var longitude = "{{ $user->longitude }}";
    </script>
    {!! Html::script('js/pages/footer/userShowFooter.js') !!}
@stop
