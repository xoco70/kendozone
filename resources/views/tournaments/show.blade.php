@extends('layouts.dashboard')

@section('content')

    @include("errors.list")


    <div class="content">

        <!-- Detached content -->
        <div class="container-detached">
            <div class="content-detached">

                <!-- Simple panel -->
                <div class="panel panel-flat">
                    <div class="panel-heading ">
                        <button type="submit" class="btn btn-info text-right">Editar</button>
                        {{--<button type="submit" class="btn btn-warning">Borrar</button>--}}
                    </div>

                    <div class="panel-body">
                        <div class="container-fluid">


                            <fieldset title="1">
                                <legend class="text-semibold">{{Lang::get('crud.general_data')}}</legend>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {!!  Form::label('name', trans('crud.name'),['class' => 'text-bold' ]) !!}<br/>
                                            {!!  Form::label('name', $tournament->name) !!}
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            {!!  Form::label('tournamentDate', trans('crud.eventDate'),['class' => 'text-bold' ]) !!}<br/>
                                            {!!  Form::label('tournamentDate', $tournament->tournamentDate) !!}
                                        </div>
                                    </div>


                                    <div class="col-md-3">

                                        <div class="input-group">
                                            {!!  Form::label('limitRegistrationDate', trans('crud.limitDateRegistration'),['class' => 'text-bold' ]) !!}<br/>
                                            {!!  Form::label('limitRegistrationDate', $tournament->registerDateLimit) !!}
                                        </div>
                                        <br/>


                                    </div>
                                    <div class="col-md-3">


                                        <div class="checkbox-switch">
                                            <label>
                                                {!!     Form::label('mustPay', trans('crud.pay4register'),['class' => 'text-bold' ])  !!} <br/>
                                                {!!  Form::label('mustPay', $tournament->mustPay ? "Si" : "No") !!}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="checkbox-switch">
                                            <label>

                                                {!!  Form::label('type', trans('crud.tournamentType'),['class' => 'text-bold' ]) !!} <br/>
                                                {!!  Form::label('type', $tournament->type ? "Abierto" : "Cerrado") !!}
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!!  Form::label('cost', trans('crud.cost'),['class' => 'text-bold' ]) !!}<br/>
                                            {!!  Form::label('mustPay',"$ ". $tournament->cost) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!!  Form::label('fightingAreas', trans('crud.fightingAreas'),['class' => 'text-bold' ]) !!}<br/>
                                            {!!  Form::label('mustPay', $tournament->fightingAreas) !!}
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            {!!  Form::label('level_id', trans('crud.level'),['class' => 'text-bold' ]) !!}<br/>
                                            {!!  Form::label('level_id', $tournament->level_id) !!}
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

                            <fieldset title="2">
                                <legend class="text-semibold">{{trans_choice('crud.place',1)}}</legend>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!!  Form::label('place', trans('crud.name'),['class' => 'text-bold' ]) !!}
                                        {!!  Form::label('place', $tournament->place) !!}

                                    </div>
                                    <div class="form-group">
                                        {!!  Form::label('latitude', trans('crud.latitude'),['class' => 'text-bold' ]) !!}
                                        {!!  Form::label('latitude', $tournament->latitude) !!}

                                    </div>
                                    <div class="form-group">
                                        {!!  Form::label('longitude', trans('crud.longitude'),['class' => 'text-bold' ]) !!}
                                        {!!  Form::label('longitude', $tournament->longitude) !!}

                                    </div>

                                    <div class="form-group">
                                        {!!  Form::label('country', trans('crud.country'),['class' => 'text-bold' ]) !!}
                                        {!!  Form::label('country', $tournament->country) !!}

                                    </div>
                                    {{--<div class="form-group">--}}
                                    {{--{!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}--}}
                                    {{--</div>--}}

                                </div>
                                {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                {{--{!!  Form::label('name', trans('crud.coords')) !!}--}}
                                {{--<div class="map-wrapper locationpicker-default" id="locationpicker-default"></div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<script>$('#locationpicker-default').locationpicker({--}}
                                {{--location: {latitude: 46.15242437752303, longitude: 2.7470703125},--}}
                                {{--radius: 300,--}}
                                {{--inputBinding: {--}}
                                {{--latitudeInput: $('#lat'),--}}
                                {{--longitudeInput: $('#lng'),--}}
                                {{--radiusInput: $('#us2-radius'),--}}
                                {{--locationNameInput: $('#city')--}}
                                {{--}--}}
                                {{--});--}}
                                {{--</script>--}}
                            </fieldset>

                            {{--<fieldset title="3">--}}
                            {{--<legend class="text-semibold">{{trans_choice('crud.category',2)}}</legend>--}}

                            {{--<div class="row">--}}
                            {{--<div class="col-md-12">--}}
                            {{--<div class="panel-body">--}}
                            {{--<p class="coutent-group">Seleccione las categorias abiertas para su torneo</p>--}}


                            {{--{!!  Form::select('category[]', $categories,$tournament->getCategoryList(), ['class' => 'form-control listbox-filter-disabled', "multiple", "disabled"]) !!} <!-- Default 1st Dan-->--}}
                            {{--</div>--}}


                            {{--</div>--}}
                            {{--<div class="row">--}}
                            {{--<div class="col-md-6">--}}




                            {{--EnchoQty 2--}}
                            {{--EnchoDuration 90--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</fieldset>--}}


                            {{--<button type="submit" class="btn btn-primary stepy-finish" id="block-panel">Submit <i class="icon-check position-right"></i>--}}
                            {{--</button>--}}


                            <?php
                            $now = Carbon\Carbon::now();
                            $year = $now->year;
                            $month = $now->month;
                            $day = $now->day;
                            ?>


                                    <!-- Theme JS files -->
                            <script>

                                $(function () {
                                    {{--$('.datetournament').pickadate({--}}
                                    {{--min: [{{$year}}, {{$month}}, {{$day}}],--}}
                                    {{--format: 'yyyy-mm-dd'--}}
                                    {{--});--}}
                                    {{--$('.datelimit').pickadate({--}}
                                    {{--min: [{{$year}}, {{$month}}, {{$day}}],--}}
                                    {{--format: 'yyyy-mm-dd'--}}
                                    {{--});--}}


                                    // Basic Dual select example
                                    // Disable filtering
                                    $('.listbox-filter-disabled').bootstrapDualListbox({
                                        showFilterInputs: false
                                    });

                                    // Stepy settings
                                    // Override defaults
//                $.fn.stepy.defaults.legend = false;
//                $.fn.stepy.defaults.transition = 'fade';
//                $.fn.stepy.defaults.duration = 150;
//                $.fn.stepy.defaults.backLabel = '<i class="icon-arrow-left13 position-left"></i> Back';
//                $.fn.stepy.defaults.nextLabel = 'Next <i class="icon-arrow-right14 position-right"></i>';
//                $(".stepy-validation").stepy({
//
//                });


                                    // Apply "Back" and "Next" button styling
//                $('.stepy-step').find('.button-next').addClass('btn btn-primary');
//                $('.stepy-step').find('.button-back').addClass('btn btn-default');
//                $(".switch").bootstrapSwitch();

                                    // Manipulating from callback
                                    // Basic functionality
                                    $('.locationpicker-default').locationpicker({
                                        radius: 150,
                                        scrollwheel: false,
                                        zoom: 10
                                    });


                                });
                            </script>


                        </div>                    </div>
                </div>
                <!-- /simple panel -->

            </div>
        </div>
        <!-- /detached content -->


        <!-- Detached sidebar -->
        <div class="sidebar-detached">
            <div class="sidebar sidebar-default">
                <div class="sidebar-content">

                    <!-- Sidebar search -->
                    <div class="sidebar-category">
                        <div class="category-title">
                            <span>Search</span>
                            <ul class="icons-list">
                                <li><a href="detached_right.html#" data-action="collapse"></a></li>
                            </ul>
                        </div>

                        <div class="category-content">
                            <form action="detached_right.html#">
                                <div class="has-feedback has-feedback-left">
                                    <input type="search" class="form-control" placeholder="Search">
                                    <div class="form-control-feedback">
                                        <i class="icon-search4 text-size-base text-muted"></i>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /sidebar search -->


                    <!-- Sub navigation -->
                    <div class="sidebar-category">
                        <div class="category-title">
                            <span>Navigation</span>
                            <ul class="icons-list">
                                <li><a href="detached_right.html#" data-action="collapse"></a></li>
                            </ul>
                        </div>

                        <div class="category-content no-padding">
                            <ul class="navigation navigation-alt navigation-accordion">
                                <li class="navigation-header">Category title</li>
                                <li><a href="detached_right.html#"><i class="icon-googleplus5"></i> Link</a></li>
                                <li><a href="detached_right.html#"><i class="icon-googleplus5"></i> Another link</a></li>
                                <li><a href="detached_right.html#"><i class="icon-portfolio"></i> Link with label <span class="label bg-success-400">Online</span></a></li>
                                <li class="navigation-divider"></li>
                                <li>
                                    <a href="detached_right.html#"><i class="icon-cog3"></i> Menu levels</a>
                                    <ul>
                                        <li><a href="detached_right.html#"><i class="icon-IE"></i> Second level</a></li>
                                        <li>
                                            <a href="detached_right.html#"><i class="icon-firefox"></i> Second level with child</a>
                                            <ul>
                                                <li><a href="detached_right.html#"><i class="icon-android"></i> Third level</a></li>
                                                <li>
                                                    <a href="detached_right.html#"><i class="icon-apple2"></i> Third level with child</a>
                                                    <ul>
                                                        <li><a href="detached_right.html#"><i class="icon-html5"></i> Fourth level</a></li>
                                                        <li><a href="detached_right.html#"><i class="icon-css3"></i> Fourth level</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="detached_right.html#"><i class="icon-windows"></i> Third level</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="detached_right.html#"><i class="icon-chrome"></i> Second level</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sub navigation -->


                    <!-- Form sample -->
                    <div class="sidebar-category">
                        <div class="category-title">
                            <span>Form example</span>
                            <ul class="icons-list">
                                <li><a href="detached_right.html#" data-action="collapse"></a></li>
                            </ul>
                        </div>

                        <form action="detached_right.html#" class="category-content">
                            <div class="form-group">
                                <label>Your name:</label>
                                <input type="text" class="form-control" placeholder="Username">
                            </div>

                            <div class="form-group">
                                <label>Your password:</label>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label>Your message:</label>
                                <textarea rows="3" cols="3" class="form-control" placeholder="Default textarea"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <button type="reset" class="btn btn-danger btn-block">Reset</button>
                                </div>
                                <div class="col-xs-6">
                                    <button type="submit" class="btn btn-info btn-block">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /form sample -->

                </div>
            </div>
        </div>
        <!-- /detached sidebar -->
    </div>
    <!-- /content area -->









@stop