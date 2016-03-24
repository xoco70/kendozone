@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('http://maps.google.com/maps/api/js') !!}
@stop
@section('breadcrumbs')
    @if (isset($tournament) && !is_null($tournament))
        {{ "ok" }}
        {!! Breadcrumbs::render('tournaments.users.show',$tournament, $user) !!}
    @else
        {{--{!! Breadcrumbs::render('users.show',$user) !!}--}}
        {{--TODO Put Breadcrumbs here--}}
    @endif
@stop
@section('content')

    <div class="container">
        <div class="row col-md-10 custyle">
            <div class="panel panel-flat">


                <div class="panel-body">
                    <div class="container-fluid">


                        <fieldset title="{{Lang::get('crud.general_data')}}">
                            <legend class="text-semibold">{{Lang::get('crud.general_data')}}</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                {!!  Form::label('name', trans('crud.username'), ['class' => 'text-bold']) !!}
                                                <BR/>
                                                {!!  $user->name !!}


                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!!  Form::label('grade_id', trans('crud.grade'), ['class' => 'text-bold']) !!}
                                                <BR/>
                                                {!!  trans($user->grade->name)!!}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                {!!  Form::label('name', trans('crud.firstname'), ['class' => 'text-bold']) !!}
                                                <BR/>
                                                {!!  $user->firstName !!}


                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!!  Form::label('grade_id', trans('crud.lastname'), ['class' => 'text-bold']) !!}
                                                <BR/>
                                                {!!  $user->lastName!!}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!!  Form::label('email', trans('crud.email'), ['class' => 'text-bold']) !!}
                                            <BR/>
                                            {!!  $user->email !!}
                                        </div>
                                        <div class="col-md-6">
                                            {!!  Form::label('role', trans('crud.role'), ['class' => 'text-bold']) !!}
                                            <BR/>
                                            {!!  $user->role->name !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <img src="{{ $user->avatar }}" width="200" height="200"/>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>


                <!-- /simple panel -->
                <!-- Simple panel 2 : Account Settings -->
            </div>
            <div class="panel panel-flat">


                <div class="panel-body">
                    <div class="container-fluid">


                        <fieldset title="{{Lang::get('crud.location')}}">
                            <legend class="text-semibold">{{Lang::get('crud.location')}}</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">

                                        {!!  Form::label('name', trans('crud.city'), ['class' => 'text-bold']) !!}
                                        <BR/>
                                        {!!  $user->city !!}


                                    </div>
                                    <br/>
                                    <div class="row">

                                        {!!  Form::label('country', trans('crud.country'), ['class' => 'text-bold']) !!}
                                        <BR/>
                                        {!!  trans($user->country->name)!!} <img
                                                src="/images/flags/{{$user->country->flag}}"/></div>

                                </div>
                                <div class="col-md-6">
                                    <div class="map-container map-basic"></div>

                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <script>

        $(function () {

            // Setup map
            function initialize() {

                // Set coordinates
                var myLatlng = new google.maps.LatLng("{{$user->latitude}}, {{$user->longitude}}");

                // Options
                var mapOptions = {
                    zoom: 5,
                    center: myLatlng
                };

                // Apply options
                var map = new google.maps.Map($('.map-basic')[0], mapOptions);


                // Add marker
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map
                });

                // Attach click event
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });

            }

            // Initialize map on window load
            google.maps.event.addDomListener(window, 'load', initialize);

        });

    </script>

@stop

