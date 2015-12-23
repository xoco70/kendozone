@extends('layouts.dashboard')

@section('content')

    @if (is_null($settings))
        {!! Form::open(['url'=>"settings"]) !!}
        <?php $settings = new App\Settings; ?>
    @else
        {!! Form::model($settings, ['method'=>"PATCH", 'class'=>'stepy-validation', "action" => ["SettingsController@update", $settings->id]]) !!}
    @endif

    <div class="tabbable">

        <ul class="nav nav-tabs nav-tabs-bottom bottom-divided nav-justified">
            <li class="active"><a href="#general" data-toggle="tab">General</a></li>
            <li><a href="#category" data-toggle="tab">{{trans_choice('crud.category',2)}}</a></li>
            <li><a href="#bottom-justified-divided-tab3" data-toggle="tab">{{Lang::get('core.social_networks')}}</a>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                <div class="tab-content">
                    <div class="tab-pane active" id="general">
                        To use in tabs with equal widths add <code>.nav-justified .nav-tabs-bottom
                            .bottom-divided</code>
                        classes.
                    </div>
                    <!-- TAB CATEGORIES DEFAULT SETTING -->
                    <div class="tab-pane" id="category">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                {!!  Form::label('cat_teamsize', trans('crud.teamsize')) !!}
                                {{--<div class="ui-slider-labels" name="teamSize"></div>--}}
                                {!!  Form::input('number','cat_teamsize', old('cat_teamSize'), ['class' => 'form-control','size']) !!}
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                {!!  Form::label('cat_fightDuration', trans('crud.fightDuration')) !!}
                                {!!  Form::input('number','cat_fightDuration', old('cat_fightDuration'), ['class' => 'form-control']) !!}
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="checkbox-switch">
                                    <label>

                                        {!!  Form::label('cat_hasEncho', trans('crud.hasEncho')) !!} <br/>
                                        {!!   Form::hidden('cat_hasEncho', 0) !!}
                                        {!!   Form::checkbox('cat_hasEncho', 1, $settings->cat_hasEncho, ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    {!!  Form::label('cat_encho_qty', trans('crud.encho_qty')) !!}
                                    {!!  Form::input('number','cat_encho_qty', old('cat_encho_qty'), ['class' => 'form-control', 'placeholder' => trans('crud.encho_infinite')]) !!}
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    {!!  Form::label('cat_encho_duration', trans('crud.encho_duration')) !!}
                                    {!!  Form::input('number','cat_encho_duration', old('cat_encho_duration'), ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="checkbox-switch ">
                                    <label>

                                        {!!  Form::label('cat_hasRoundRobin', trans('crud.hasRoundRobin')) !!} <br/>
                                        {!!   Form::hidden('cat_hasRoundRobin', 0) !!}
                                        {!!   Form::checkbox('cat_hasRoundRobin', 1, $settings->cat_hasRoundRobin, ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    {!!  Form::label('cat_roundRobinWinner', trans('crud.roundRobinWinner')) !!}
                                    {!!  Form::input('number','cat_roundRobinWinner', old('cat_roundRobinWinner'), ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>


                        <div class="checkbox-switch">
                            <label>

                                {!!  Form::label('cat_hasHantei', trans('crud.hasHantei')) !!} <br/>
                                {!!   Form::hidden('cat_hasHantei', 0) !!}
                                {!!   Form::checkbox('cat_hasHantei', 1, $settings->cat_hasHantei, ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}

                            </label>
                        </div>

                        <div class="form-group">
                            {!!  Form::submit("Submit", ['class' => 'btn btn-primary form-control']) !!}
                        </div>

                    </div>
                    <!-- END TAB CATEGORIES DEFAULT SETTING -->
                    <div class="tab-pane" id="bottom-justified-divided-tab3">
                        DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
                    </div>

                </div>
            </div>
            <script>
                $(".switch").bootstrapSwitch();
            </script>

            @include("errors.list")
        </div>
    </div>
    {{--<script>--}}
    {{--// Label with pips--}}
    {{--$(".ui-slider-labels").slider({--}}
    {{--max: 8,--}}
    {{--value: 4--}}
    {{--});--}}
    {{--$(".ui-slider-labels").slider("pips", {--}}
    {{--rest: "label"--}}
    {{--});--}}

    {{--</script>--}}
@stop

