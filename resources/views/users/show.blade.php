@extends('layouts.dashboard')
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

            <!-- Simple panel 1 : General Data-->
            <div class="row">
                <div class="col-md-6">

                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">

                                <fieldset title="{{Lang::get('core.general_data')}}">
                                    <legend class="text-semibold">{{Lang::get('core.general_data')}}</legend>
                                </fieldset>
                                <div class="text-center">
                                    <img src="{{ $user->avatar }}" class="img-circle" width="200" height="200"/>

                                    <div class="text-semibold text-uppercase pt-10"> {!!  $user->name !!}</div>
                                    <div class="text-grey">{{ $user->email }}</div>

                                    @if ($user->firstName !=null)
                                        <div><span class="text-semibold"> {{ trans('core.firstname') }}:</span></div>
                                        {!!  $user->firstName !!}
                                    @endif
                                    @if ($user->lastName !=null)
                                        <div><span class="text-semibold"> {{ trans('core.lastname') }}:</span></div>
                                        <div>{!!  $user->lastName !!}</div>
                                    @endif


                                    <hr/>
                                    <div><i class="icon-medal2 text-primary pr-5"  ></i>
                                        <span class="text-semibold"> {{ trans('core.grade') }}:</span>
                                    {!!  trans($user->grade->name)!!}
                                    </div>
                                    {{--<div><span class="text-bold"> {{ trans('core.role') }}:</span></div>--}}
                                    {{--{!!  trans($user->role->name)!!}--}}

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">
                                <fieldset title="{{Lang::get('core.location')}}">
                                    <legend class="text-semibold">{{Lang::get('core.location')}}</legend>
                                </fieldset>
                                <div>
                                    <span class="text-semibold"> {{ trans('core.country') }}:</span>
                                    <span class="text-grey">{!!  trans($user->country->name)!!}</span>
                                    <img src="/images/flags/{{$user->country->flag}}" class="ml-10"/>
                                </div>

                                <div class="mb-10"><span class="text-semibold"> {{ trans('core.city') }}:</span>
                                    <span class="text-grey">{!!  $user->city !!}</span>
                                </div>

                                <div class="map-container map-basic"></div>
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
    {!! Html::script('js/pages/header/userCreate.js') !!}
    {!! Html::script('https://maps.google.com/maps/api/js?key=AIzaSyDMbCISDkoc5G1AP1mw8K76MsaN0pyF64k') !!}
    {!! Html::script('js/pages/footer/userShowFooter.js') !!}
@stop
