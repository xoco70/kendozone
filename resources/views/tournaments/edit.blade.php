@extends('layouts.dashboard')
@section('scripts')
{!! Html::script('js/tournamentEdit.js') !!}
{!! Html::script('http://maps.google.com/maps/api/js') !!}
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
        {!! Form::model($tournament, ['method'=>"PATCH", 'id'=>'form', "action" => ["TournamentController@update", $tournament->id]]) !!}

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
                                    {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}

                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    {!!  Form::label('level_id', trans('crud.level'),['class' => 'text-bold' ]) !!}
                                    <br/>
                                    {!!  Form::select('level_id', $levels,null, ['class' => 'form-control']) !!}
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
                                {!!  Form::label('registerDateLimit', trans('crud.limitDateRegistration'),['class' => 'text-bold' ]) !!}
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
                            {{--<div class="col-md-6">--}}
                            {{--<div class="form-group">--}}
                            {{--{!!  Form::label('cost', trans('crud.cost'),['class' => 'text-bold' ]) !!}--}}
                            {{--<br/>--}}
                            {{--{!!  Form::input('number','cost', old('cost'), ['class' => 'form-control', 'size'=>'3','maxsize'=>'4']) !!}--}}
                            {{--</div>--}}
                            {{--</div>--}}


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
                    <button type="submit" class="btn btn-success"><i></i>{{trans("core.save")}}</button>
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
                    <button type="submit" class="btn btn-success"><i></i>{{trans("core.save")}}</button>
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
                                <p class="coutent-group">Seleccione las categorias abiertas para su
                                    torneo</p>


                                {!!  Form::select('category[]', $categories,$tournament->getCategoryList(), ['class' => 'form-control listbox-filter-disabled', "multiple"]) !!} <!-- Default 1st Dan-->
                            </div>


                        </div>


                    </div>
                    <div align="right">
                        <button type="submit" class="btn btn-success"><i></i>{{trans("core.save")}}</button>
                    </div>
                </div>


            </div>
            <!-- /simple panel -->
        </div>
        {!! Form::close()!!}

                <!-- /simple panel acordion -->
        <div class="panel panel-flat">
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

                                <!--                                --><?php //dd($tournament->categoryTournaments); ?>

                                @foreach($tournament->categoryTournaments as $key => $categoryTournament)
                                <?php

                                $setting = $tournament->categoryTournaments->get($key)->settings;
                                $teamSize = isset($setting->teamSize) ? $setting->teamSize : 0;
                                $enchoQty = isset($setting->enchoQty) ? $setting->enchoQty : 0;
                                $fightingAreas = isset($setting->fightingAreas) ? $setting->fightingAreas : 0;

                                ?>

                                <div class="panel ">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <a data-toggle="collapse" data-parent="#accordion-styled"
                                               href="#accordion-styled-group{!! $key !!}">

                                                <div class="panel-heading">
                                                    <h6 class="panel-title">
                                                        {{trans($categoryTournament->category->name)}}
                                                    </h6>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="panel-heading">
                                                @if (is_null($setting))
                                                    <i class="glyphicon  glyphicon-exclamation-sign text-orange-600"></i>
                                                @else
                                                    <i class="glyphicon glyphicon-ok text-success"></i>
                                                @endif
                                            </div>
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
                </div>


            </div>
            <!-- /simple panel -->
        </div>


        {{-- If open Tournament--}}
        @if ($tournament->type==1)

                <!-- /simple panel -->
        <div class="panel panel-flat">
            {{--<div class="panel-heading " >--}}
            {{--<button type="submit" class="btn btn-warning">Borrar</button>--}}
            {{--</div>--}}

            <div class="panel-body">
                <div class="container-fluid">


                    <fieldset title="1">
                        <legend class="text-semibold ">Invita competitodres con este link</legend>

                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="form-group text-center m">
                                    <br/>
                                    {{getenv('URL_BASE')}}tournaments/{{$tournament->id}}/register/
                                </h2>

                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        @endif
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

<script>

    $(function () {
        $('.btn-success').on('click', function (e) {
            e.preventDefault();
            var inputData = $('#form').serialize();
            var dataId = $(this).data('id');
//            console.log(dataId);
            $(this).find('i').addClass('icon-spinner spinner position-left');
            $(this).prop( "disabled", true );

            $.ajax(
                    {
                        type: 'PUT',
                        url: '{{ url("/tournaments/$tournament->id") }}',
                        data: inputData,
                        success: function (data) {
                            console.log(data);
                            if (data != null && data.status == 'success') {
                                noty({
                                    layout: 'topRight',
                                    type: 'success',
                                    width: 200,
                                    dismissQueue: true,
                                    timeout: 3000,
                                    text: data.msg
                                });
//                                console.log()
                                $('.btn-success').prop( "disabled", false );
                                $('.btn-success').find('i').removeClass('icon-spinner spinner position-left');

                            } else {
                                noty({
                                    layout: 'topRight',
                                    type: 'error',
                                    width: 200,
                                    dismissQueue: true,
                                    timeout: 3000,
                                    text: "1"
                                });
                                $(this).prop( "disabled", false );
                                $(this).find('i').removeClass('icon-spinner spinner position-left');

                            }

                        },
                        error: function (data) {
                            noty({
                                layout: 'topRight',
                                type: 'error',
                                width: 200,
                                dismissQueue: true,
                                timeout: 3000,
                                text: data.msg,

                            });
                            $(this).prop( "disabled", false );
                            $(this).find('i').removeClass('icon-spinner spinner position-left')

                        }
                    }
            )

        });

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

        $('#generate_tree').on('click', function () {
            swal({
                title: "{!! trans('core.information') !!}",
                text: "{!!   trans('crud.all_categories_not_configured') !!}",
                confirmButtonColor: "#2196F3",
                type: "info"
            });
        });
        $(".accordion-sortable").sortable({
            connectWith: '.accordion-sortable',
            items: '.panel',
            helper: 'original',
            cursor: 'move',
            handle: '[data-action=move]',
            revert: 100,
            containment: '.content',
            forceHelperSize: true,
            placeholder: 'sortable-placeholder',
            forcePlaceholderSize: true,
            tolerance: 'pointer',
            start: function (e, ui) {
                ui.placeholder.height(ui.item.outerHeight());
            }
        });


    });
</script>

@stop