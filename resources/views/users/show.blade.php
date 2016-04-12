@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('https://maps.google.com/maps/api/js?key=AIzaSyDMbCISDkoc5G1AP1mw8K76MsaN0pyF64k') !!}
@stop
@section('breadcrumbs')
    @if (isset($tournament) && !is_null($tournament))
        {{ "ok" }}
        {!! Breadcrumbs::render('tournaments.users.show',$tournament, $user) !!}
    @else
        {!! Breadcrumbs::render('users.show',$user) !!}
    @endif
@stop
@section('content')

    <div class="container">
        <div class="row col-md-10 custyle">
            <div class="panel panel-flat">


                <div class="panel-body">
                    <div class="container-fluid">


                        <fieldset title="{{Lang::get('core.general_data')}}">
                            <legend class="text-semibold">{{Lang::get('core.general_data')}}</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                {!!  Form::label('name', trans('core.username'), ['class' => 'text-bold']) !!}
                                                <BR/>
                                                {!!  $user->name !!}


                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!!  Form::label('grade_id', trans('core.grade'), ['class' => 'text-bold']) !!}
                                                <BR/>
                                                {!!  trans($user->grade->name)!!}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                {!!  Form::label('name', trans('core.firstname'), ['class' => 'text-bold']) !!}
                                                <BR/>
                                                {!!  $user->firstName !!}


                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!!  Form::label('grade_id', trans('core.lastname'), ['class' => 'text-bold']) !!}
                                                <BR/>
                                                {!!  $user->lastName!!}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!!  Form::label('email', trans('core.email'), ['class' => 'text-bold']) !!}
                                            <BR/>
                                            {!!  $user->email !!}
                                        </div>
                                        <div class="col-md-6">
                                            {!!  Form::label('role', trans('core.role'), ['class' => 'text-bold']) !!}
                                            <BR/>
                                            {!!  $user->role->name !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ">

                                    <img align="center" src="{{ $user->avatar }}" width="200" height="200"/>
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


                        <fieldset title="{{Lang::get('core.location')}}">
                            <legend class="text-semibold">{{Lang::get('core.location')}}</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">

                                        {!!  Form::label('name', trans('core.city'), ['class' => 'text-bold']) !!}
                                        <BR/>
                                        {!!  $user->city !!}


                                    </div>
                                    <br/>
                                    <div class="row">

                                        {!!  Form::label('country', trans('core.country'), ['class' => 'text-bold']) !!}
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


@stop

@section('scripts_footer')
    <script>

        var latitude = "{{ $user->latitude }}";
        var longitude = "{{ $user->longitude }}";
    </script>
    {!! Html::script('js/pages/footer/userShowFooter.js') !!}
@stop