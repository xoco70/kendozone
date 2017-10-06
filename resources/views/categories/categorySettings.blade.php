<?php

$setting = $championship->getSettings();
$currency = Auth::user()->country->currency_code;
?>

<div class="panel">
    {{--@if (is_null($championship->settings))--}}
        {{--{!! Form::open([--}}
                     {{--'action' => ['ChampionshipSettingsController@store',--}}
                                    {{--$championship->id--}}
                                 {{--],--}}
                     {{--'id' => 'form_'.$key,--}}
                     {{--'data-championship' => $championship->id,--}}
                     {{--'class' => 'form-settings',--}}

    {{--]) !!}--}}
    {{--@else--}}
        {{--{!! Form::model($setting,--}}
                    {{--['method'=>"PATCH",--}}
                    {{--'class' => 'form-settings',--}}
                     {{--'id' => 'form_'.$key,--}}
                     {{--'data-championship' => $championship->id,--}}
                     {{--'data-setting' => $setting->id,--}}
                     {{--"action" => ["ChampionshipSettingsController@update",--}}
                                   {{--'data-championship' => $championship->id,$setting->id]]) !!}--}}

    {{--@endif--}}
    <?php
    $translations = [
        'see_more' => trans('core.see_more'),
        'save' => trans("core.save"),
        'configured_full' => trans('core.configured_full'),
        'configure' => trans('core.configure'),
        'yes' => trans('core.yes'),
        'no' => trans('core.no'),
        'fightDuration' => trans('categories.fightDuration'),
        'fightDurationTooltip' => trans('categories.fightDurationTooltip'),
        'costTooltip' => trans('categories.costTooltip'),
        'fightingAreaTooltip' => trans('categories.fightingAreaTooltip'),
        'hasPreliminaryTooltip' => trans('categories.hasPreliminaryTooltip'),
        'preliminaryGroupSize' => trans('categories.preliminaryGroupSize'),
        'preliminaryGroupSizeTooltip' => trans('categories.preliminaryGroupSizeTooltip'),
        'preliminaryWinner' => trans('categories.preliminaryWinner'),
        'preliminaryWinnerTooltip' => trans('categories.preliminaryWinnerTooltip'),
        'playOff' => trans('categories.playOff'),
        'direct_elimination' => trans('categories.direct_elimination'),
        'treeType' => trans('categories.treeType'),
        'limitByEntity' => trans('categories.limitByEntity'),
        'limitByEntityTooltip' => trans('categories.limitByEntityTooltip'),
        'hasPreliminary' => trans('categories.hasPreliminary'),
        'fightingAreas' => trans_choice('categories.fightingArea', 2),
        'cost' => trans('categories.cost'),
        'currency' => $currency,
        'teamSize' => trans('categories.teamSize'),
    ];
    $limitByEntity = config('options.limitByEntity');
    ?>
    <kendo-settings
            :translations="{{   json_encode($translations) }}"
            :setting="{{  json_encode($setting) }}"
            :championship="{{ json_encode($championship) }}"
            :num="{{ $key }}"
    ></kendo-settings>
    {{--{!! Form::close()!!}--}}
</div>





