@extends('layouts.dashboard')

@section('content')

    @include("errors.list")

    <div class="container-fluid">

        {!! Form::model($tournament, ['method'=>"PATCH", 'class'=>'stepy-validation', "action" => ["TournamentController@update", $tournament->id]]) !!}


        <div class="content">

            <!-- Detached content -->
            <div class="container-detached">
                <div class="content-detached">

                    <!-- Simple panel 1 : General Data-->
                    <div class="panel panel-flat">
                        {{--<div class="panel-heading " >--}}
                        {{--<button type="submit" class="btn btn-warning">Borrar</button>--}}
                        {{--</div>--}}

                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="{{Lang::get('crud.general_data')}}">
                                    <legend class="text-semibold">{{Lang::get('crud.general_data')}}</legend>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!!  Form::label('name', trans('crud.name'),['class' => 'text-bold' ]) !!}
                                                <br/>
                                                {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}

                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            {!!  Form::label('date', trans('crud.eventDate'),['class' => 'text-bold' ]) !!}
                                            {{--<br/>--}}


                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                                {!!  Form::input('text', 'date', old('date'), ['class' => 'form-control datetournament']) !!}
                                            </div>


                                        </div>


                                        <div class="col-md-3">
                                            {!!  Form::label('limitRegistrationDate', trans('crud.limitDateRegistration'),['class' => 'text-bold' ]) !!}
                                            <br/>

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                                {!!  Form::input('text', 'registerDateLimit', old('registerDateLimit'), ['class' => 'form-control datelimit']) !!}

                                            </div>
                                            <br/>


                                        </div>
                                        <div class="col-md-3">


                                            {!!     Form::label('mustPay', trans('crud.pay4register'),['class' => 'text-bold' ])  !!}
                                            <br/>

                                            <div class="checkbox-switch">
                                                <label>
                                                    {!!     Form::hidden('mustPay', 0) !!}
                                                    {!!       Form::checkbox('mustPay', 1, $tournament->mustPay, ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}
                                                </label>
                                            </div>

                                        </div>
                                        <div class="col-md-3">

                                            <div class="checkbox-switch">
                                                <label>

                                                    {!!  Form::label('type', trans('crud.tournamentType'),['class' => 'text-bold' ]) !!}
                                                    <br/>
                                                    {!!   Form::hidden('type', 0) !!}
                                                    {!!   Form::checkbox('type', 1, $tournament->type, ['class' => 'switch', 'data-on-text'=>"Abierto", 'data-off-text'=>"Invitación"]) !!}

                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!!  Form::label('cost', trans('crud.cost'),['class' => 'text-bold' ]) !!}
                                                <br/>
                                                {!!  Form::input('number','cost', old('cost'), ['class' => 'form-control', 'size'=>'3','maxsize'=>'4']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!!  Form::label('fightingAreas', trans('crud.fightingAreas'),['class' => 'text-bold' ]) !!}
                                                <br/>
                                                {!!  Form::input('number','fightingAreas', old('fightingAreas'), ['class' => 'form-control']) !!}

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                {!!  Form::label('level_id', trans('crud.level'),['class' => 'text-bold' ]) !!}
                                                <br/>
                                                {!!  Form::select('level_id', $levels,null, ['class' => 'form-control']) !!}
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
                            <div align="right">
                                <button type="submit" class="btn btn-success">{{trans("core.save")}}</button>
                            </div>
                        </div>


                    </div>
                    <!-- /simple panel -->
                    <!-- Simple panel 2 : Venue -->

                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="Venue">
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


                                <script>$('#locationpicker-default').locationpicker({
                                        location: {latitude:{{$latitude }}  , longitude:{{$longitude }} },
                                        radius: 300,
                                        inputBinding: {
                                            latitudeInput: $('#latitude'),
                                            longitudeInput: $('#longitude'),
                                            radiusInput: $('#us2-radius'),
                                            locationNameInput: $('#city')
                                        }
                                    });
                                </script>


                            </div>
                            <div align="right">
                                <button type="submit" class="btn btn-success">{{trans("core.save")}}</button>
                            </div>
                        </div>


                    </div>
                    <!-- /simple panel -->
                    <div class="panel panel-flat">
                        {{--<div class="panel-heading " >--}}
                        {{--<button type="submit" class="btn btn-warning">Borrar</button>--}}
                        {{--</div>--}}

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
                                            <p class="coutent-group">Seleccione las categorias abiertas para su
                                                torneo</p>


                                            {!!  Form::select('category[]', $categories,$tournament->getCategoryList(), ['class' => 'form-control listbox-filter-disabled', "multiple"]) !!} <!-- Default 1st Dan-->
                                        </div>


                                    </div>


                                </div>
                                <div align="right">
                                    <button type="submit" class="btn btn-success">{{trans("core.save")}}</button>
                                </div>
                            </div>


                        </div>

                        <!-- /simple panel -->
                    </div>

                    <!-- /simple panel -->
                    <div class="panel panel-flat">
                        {{--<div class="panel-heading " >--}}
                        {{--<button type="submit" class="btn btn-warning">Borrar</button>--}}
                        {{--</div>--}}

                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="1">
                                    <legend class="text-semibold">{{Lang::get('crud.share')}}</legend>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group text-center">
                                                {!!  Form::label('share', trans('crud.share'),['class' => 'text-bold' ]) !!}
                                                <br/>
                                                <a href="#">Share tournament</a>
                                            </div>

                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- /detached content -->

                @include("layouts.tournament_menu")
            </div>
            <!-- /content area -->
            <?php
            $now = Carbon\Carbon::now();
            $year = $now->year;
            $month = $now->month;
            $day = $now->day;
            ?>

            <script>

                $(function () {
                    $('.listbox-filter-disabled').bootstrapDualListbox({
                        showFilterInputs: false
                    });

                    $(".switch").bootstrapSwitch();

                    $('.datetournament').pickadate({
                        min: [<?php echo e($year); ?>, <?php echo e($month); ?>, <?php echo e($day); ?>],
                        format: 'yyyy-mm-dd'
                    });
                    $('.datelimit').pickadate({
                        min: [<?php echo e($year); ?>, <?php echo e($month); ?>, <?php echo e($day); ?>],
                        format: 'yyyy-mm-dd'
                    });

                });
            </script>
        </div>


        {!! Form::close()!!}

    </div>
@stop