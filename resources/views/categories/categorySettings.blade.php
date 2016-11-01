<?php
$setting = $tournament->championships->get($key)->settings;
$teamSize = isset($setting->teamSize) ? $setting->teamSize : 0;
$enchoQty = isset($setting->enchoQty) ? $setting->enchoQty : 0;
$fightingAreas = isset($setting->fightingAreas) ? $setting->fightingAreas : 0;

$fightDuration = (isset($setting->fightDuration) && $setting->fightDuration != "")
        ? $setting->fightDuration : config('constants.CAT_FIGHT_DURATION');

$enchoDuration = (isset($setting->enchoDuration) && $setting->enchoDuration != "")
        ? $setting->enchoDuration : config('constants.CAT_ENCHO_DURATION');


$categoryId = $championship->category->id;
if (is_null($setting)) {
    $disableEncho = $disableRoundRobin = "disabled";
} else {
    $disableEncho = $setting->hasEncho ? "" : "disabled";
    $disableRoundRobin = $setting->hasRoundRobin ? "" : "disabled";
}
$currency = Auth::user()->country->currency_code;
?>


<div class="panel">
    @if (is_null($setting))
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
                        {!!  Form::input('text','alias',trans($championship->category->buildName($grades)), ['class' => 'form-control alias','id' => 'alias'.$key]) !!}
                    </h6>
                </div>
            </a>
        </div>
        <div class="col-lg-5 col-xs-3 cat-status">
            <a data-toggle="collapse" data-parent="#accordion-styled"
               href="#accordion-styled-group{!! $key !!}">
                <div class="panel-heading">
                    @if (is_null($setting))
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


    <div id="accordion-styled-group{!! $key !!}"
         class="panel-collapse collapse {!! $key==0 ? "in" : "" !!} ">
        <div class="panel-body">
            <div class="tab-pane" id="category">
                <div class="row">
                    <div class="col-lg-2">
                        {!!  Form::label('fightingAreas', trans('categories.fightingAreas')) !!}
                        <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                           data-original-title="{{trans('categories.fightingAreaTooltip')}}"></i>
                        {!!  Form::select('fightingAreas', [1 => 1,2 => 2,4 => 4,8 => 8], old('fightingAreas'),['class' => 'form-control']) !!}
                    </div>
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
                        <div class="checkbox-switch ">
                            <label>

                                {!!  Form::label('hasRoundRobin', trans('categories.hasRoundRobin')) !!}
                                <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                                   data-original-title="{{trans('categories.hasRoundRobinTooltip')}}"></i>
                                <br/>
                                {!!   Form::hidden('hasRoundRobin', 0,['id'=>'hasRoundRobin'.$key ]) !!}
                                {!!   Form::checkbox('hasRoundRobin', 1, old('hasRoundRobin'),
                                                     ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No", 'id'=>'hasRoundRobin'.$key]) !!}

                            </label>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            {!!  Form::label('roundRobinGroupSize', trans('categories.roundRobinGroupSize')) !!}
                            <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                               data-original-title="{{trans('categories.roundRobinGroupSizeTooltip')}}"></i>

                            {!!  Form::select('roundRobinGroupSize', config('options.roundRobinGroupSize'), old('roundRobinGroupSize'),['class' => 'form-control',$disableRoundRobin]) !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!!  Form::label('roundRobinWinner', trans('categories.roundRobinWinner')) !!}
                            <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                               data-original-title="{{trans('categories.roundRobinWinnerTooltip')}}"></i>

                            {!!  Form::select('roundRobinWinner', config('options.roundRobinWinner'), old('roundRobinWinner'),['class' => 'form-control',$disableRoundRobin]) !!}
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
                                {!!   Form::checkbox('hasEncho', 1, old('hasEncho'),
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
                            {!!  Form::label('enchoTimeLimitless', trans('categories.enchoTimeLimitless')) !!}
                            <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                               data-original-title="{{trans('categories.enchoTimeLimitlessTooltip')}}"></i>

                            {!!  Form::select('enchoTimeLimitless', [0,1,2,3,4,5,6,7,8,9,10], old('enchoTimeLimitless'),['class' => 'form-control',$disableEncho]) !!}
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
                                {!!   Form::checkbox('hasHantei', 1,is_null($setting) ? 0 : $setting->hasHantei,
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