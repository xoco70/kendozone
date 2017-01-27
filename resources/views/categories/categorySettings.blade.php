<?php
$setting = $championship->settings ?? new \App\ChampionshipSettings(config('options.default_settings'));

$treeType = $setting->treeType;
$hasPreliminary = $setting->hasPreliminary;
$hasEncho = $setting->hasEncho;
$teamSize = $setting->teamSize;
$enchoQty = $setting->enchoQty;
$fightingAreas = $setting->fightingAreas; // 0

$fightDuration = $setting->fightDuration;
$enchoDuration = $setting->enchoDuration;


$categoryId = $championship->category->id;
$disableEncho = $hasEncho ? "" : "disabled";
$disablePreliminary = $hasPreliminary ? "" : "disabled";

$currency = Auth::user()->country->currency_code;
?>


<div class="panel">
    @if (is_null($championship->settings))
        {!! Form::open([
                     'action' => ['ChampionshipSettingsController@store',
                                    $championship->id
                                 ],
                     'id' => 'form_'.$key,
                     'data-championship' => $championship->id,
                     'class' => 'form-settings',

    ]) !!}
    @else
        {!! Form::model($setting,
                    ['method'=>"PATCH",
                    'class' => 'form-settings',
                     'id' => 'form_'.$key,
                     'data-championship' => $championship->id,
                     'data-setting' => $setting->id,
                     "action" => ["ChampionshipSettingsController@update",
                                   'data-championship' => $championship->id,$setting->id]]) !!}

    @endif

    <div class="row">
        <div class="col-lg-7 col-xs-9 cat-title">
            <a data-toggle="collapse" data-parent="#accordion-styled"
               href="#accordion-styled-group{!! $key !!}">

                <div class="panel-heading">

                    <h6 class="panel-title">
                        {!!  Form::input('text','alias',trans($championship->category->buildName()), ['class' => 'form-control alias','id' => 'alias'.$key]) !!}
                    </h6>
                </div>
            </a>
        </div>
        <div class="col-lg-5 col-xs-3 cat-status">
            <a data-toggle="collapse" data-parent="#accordion-styled"
               href="#accordion-styled-group{!! $key !!}">
                <div class="panel-heading">
                    @if (is_null($championship->settings))
                        <span class="text-orange-600">
                            <span class="cat-state">{{ trans('core.configure') }}</span>
                            <i class="glyphicon  glyphicon-exclamation-sign  status-icon"></i>
                        </span>
                    @else
                        <span class="text-success">
                            <span class="cat-state">{{ trans('core.configured_full') }}</span>
                            <i class="glyphicon text-success glyphicon-ok  status-icon"></i>
                        </span>
                    @endif
                </div>
            </a>
        </div>
    </div>

    {{--First Line--}}
    <div id="accordion-styled-group{!! $key !!}"
         class="panel-collapse collapse {!! $key==0 ? "in" : "" !!} ">
        <div class="panel-body">
            <div class="tab-pane" id="category">
                <div class="row">

                    <div class="col-lg-2">
                        {!!  Form::label('fightDuration', trans('categories.fightDuration')) !!}
                        <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                           data-original-title="{{trans('categories.fightDurationTooltip')}}"></i>

                        <div class="input-group">
                            {!!  Form::input('text','fightDuration',$fightDuration, ['class' => 'form-control fightDuration','id' => 'fightDuration'.$key]) !!}
                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            {!!  Form::label('cost', trans('categories.cost'). ' ('. $currency  .')' ) !!}
                            <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                               data-original-title="{{trans('categories.costTooltip')}}"></i>
                            {!!  Form::input('number','cost',old('cost'), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    @if ($tournament->championships->get($key)->category->isTeam())

                        <div class="col-lg-3">
                            {!!  Form::label('teamSize', trans('categories.teamSize')) !!}
                            <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                               data-original-title="{{trans('categories.teamsizeTooltip')}}"></i>
                            {!!  Form::select('teamSize', config('options.teamSize'),old('teamSize'), ['class' => 'form-control']) !!}
                        </div>


                    @endif

                </div>
                <hr/>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="checkbox-switch ">
                            <label>

                                {!!  Form::label('hasPreliminary', trans('categories.hasPreliminary')) !!}
                                <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                                   data-original-title="{{trans('categories.hasPreliminaryTooltip')}}"></i>
                                <br/>

                                {!!   Form::hidden('hasPreliminary', 0,['id'=>'hasPreliminary'.$key ]) !!}
                                {!!   Form::checkbox('hasPreliminary', 1, $setting->hasPreliminary,
                                                     ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No", 'id'=>'hasPreliminary'.$key]) !!}

                            </label>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            {!!  Form::label('preliminaryGroupSize', trans('categories.preliminaryGroupSize')) !!}
                            <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                               data-original-title="{{trans('categories.preliminaryGroupSizeTooltip')}}"></i>

                            {!!  Form::select('preliminaryGroupSize', config('options.preliminaryGroupSize'), old('preliminaryGroupSize'),['class' => 'form-control',$disablePreliminary]) !!}
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            {!!  Form::label('preliminaryWinner', trans('categories.preliminaryWinner')) !!}
                            <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                               data-original-title="{{trans('categories.preliminaryWinnerTooltip')}}"></i>

                            {!!  Form::select('preliminaryWinner', config('options.preliminaryWinner'), old('preliminaryWinner'),['class' => 'form-control',$disablePreliminary]) !!}
                        </div>
                    </div>

                </div>
                <hr/>
                <div class="row">
                    <div class="col-lg-3">
                        {!!  Form::label('treeType', trans('categories.treeType')) !!}
                        {!!  Form::select('treeType', [0 => trans('categories.roundRobin'),1 => trans('categories.direct_elimination')], $treeType ,['class' => 'form-control']) !!}
                    </div>

                    <div class="col-lg-2">
                        {!!  Form::label('fightingAreas', trans_choice('categories.fightingArea',2)) !!}
                        <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                           data-original-title="{{trans('categories.fightingAreaTooltip')}}"></i>
                        {!!  Form::select('fightingAreas', [1 => 1,2 => 2,4 => 4,8 => 8], old('fightingAreas'),['class' => 'form-control']) !!}
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            {!!  Form::label('limitByEntity', trans('categories.limitByEntity')) !!}
                            <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                               data-original-title="{{trans('categories.limitByEntityTooltip')}}"></i>
                            {!!  Form::select('limitByEntity', config('options.limitByEntity'), old('limitByEntity'),['class' => 'form-control']) !!}

                        </div>
                    </div>

                </div>
                <hr/>


                <div class="row">
                    <div class="col-lg-2">
                        <div class="checkbox-switch">
                            <label>

                                {!!  Form::label('hasEncho', trans('categories.hasEncho')) !!}
                                <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                                   data-original-title="{{trans('categories.hasEnchoTooltip')}}"></i>
                                <br/>
                                {!!   Form::hidden('hasEncho', 0,['id'=>'hasEncho'.$key ]) !!}
                                {!!   Form::checkbox('hasEncho', 1, $setting->hasEncho, // $hasPreliminary
                                                     ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No", 'id'=>'hasEncho'.$key]) !!}

                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!!  Form::label('enchoQty', trans('categories.enchoQty')) !!}
                            <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                               data-original-title="{{trans('categories.enchoQtyTooltip')}}"></i>

                            {!!  Form::select('enchoQty', config('options.enchoQty'), old('enchoQty'),['class' => 'form-control',$disableEncho]) !!}
                            <small class="display-block">{{ trans('categories.encho_infinite') }}</small>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        {!!  Form::label('enchoDuration', trans('categories.enchoDuration')) !!}
                        <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                           data-original-title="{{trans('categories.enchoDurationTooltip')}}"></i>
                        <div class="input-group ">
                            {!!  Form::input('text','enchoDuration', $enchoDuration, ['class' => 'form-control enchoDuration','id' => 'enchoDuration'.$key, $disableEncho]) !!}
                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            {!!  Form::label('enchoGoldPoint', trans('categories.enchoGoldPoint')) !!}
                            <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                               data-original-title="{{trans('categories.enchoGoldPointTooltip')}}"></i>

                            {!!  Form::select('enchoGoldPoint', [0,1,2,3,4,5,6,7,8,9,10], old('enchoGoldPoint'),['class' => 'form-control',$disableEncho]) !!}
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="checkbox-switch">
                            <label>

                                {!!  Form::label('hasHantei', trans('categories.hasHantei')) !!}
                                <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                                   data-original-title="{{trans('categories.hasHanteiTooltip')}}"></i>
                                <br/>
                                {!!   Form::hidden('hasHantei', 0,['id'=>'hasHantei'.$key ]) !!}
                                {!!   Form::checkbox('hasHantei', 1,$setting->hasHantei,
                                                     ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No", 'id'=>'hasHantei'.$key]) !!}
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="checkbox-switch">
                            <label>

                                {!!  Form::label('hanteiLimit', trans('categories.hanteiLimit')) !!}
                                <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                                   data-original-title="{{trans('categories.hanteilimitTooltip')}}"></i><br/>
                                {!!  Form::select('hanteiLimit', $hanteiLimit , old('hanteiLimit'),['class' => 'form-control']) !!}

                            </label>
                        </div>
                    </div>

                </div>


                <div align="right">
                    <button type="submit" class="btn btn-success save_category" id="save{{$key}}">
                        <i></i>{{trans("core.save")}}
                    </button>
                </div>
            </div>
        </div>

    </div>
    {!! Form::close()!!}
</div>