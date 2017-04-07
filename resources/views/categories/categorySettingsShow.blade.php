<?php Auth::check() ? $currency = Auth::user()->country->currency_code : $currency = "" ?>

<div class="tab-pane" id="category">
    <div class="row">
        @if ($championship->category->isTeam)
            <div class="col-md-2">
                <strong>{{ trans('categories.teamSize') }}</strong>
                {{ $setting->teamSize }}
            </div>
        @endif
        <div class="col-md-2">
            <strong>{{ trans('categories.fightDuration') }}</strong>
            <br/>
            {{ $setting->fightDuration }}

        </div>
        <div class="col-md-5">
            <strong>{{  trans_choice('categories.fightingArea',2) }}</strong>
            <br/>
            {{ $setting->fightingAreas }}

        </div>
    </div>
    <hr/>

    <div class="row">
        <div class="col-md-2">
            <strong>{{ trans('categories.hasEncho') }}</strong>
            {{ $setting->hasEncho ? trans('core.yes') : trans('core.no') }}
        </div>
        <div class="col-md-5">
            <strong>{{ trans('categories.enchoQty') }}</strong>
            <br/>
            {{ $setting->enchoQty }}
        </div>
        <div class="col-md-5">
            <strong>{{ trans('categories.enchoDuration') }}</strong>

            {{ $setting->enchoDuration }}


        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-2">
            <strong>{{ trans('categories.hasPreliminary') }}</strong>
            <br/>
            {{ $setting->hasPreliminary ? trans('core.yes') : trans('core.no')}}
        </div>
        <div class="col-md-5">
            <strong>{{ trans('categories.preliminaryWinner') }}</strong>
            <br/>
            {{ $setting->preliminaryWinner }}
        </div>
        <div class="col-md-5">
            <strong>{{ trans('categories.cost') }}</strong>
            <br/>
            {{ $setting->cost }}
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-2">
            <strong>{{ trans('categories.hasHantei') }}</strong>
            {{ $setting->hasHantei ? trans('core.yes') : trans('core.no')}}
        </div>

    </div>

</div>
