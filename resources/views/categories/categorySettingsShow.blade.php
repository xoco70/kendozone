<?php Auth::check() ? $currency = Auth::user()->country->currency_code : $currency = "" ?>

<div class="tab-pane" id="category">
    <div class="row">
        @if ($championship->category->isTeam)
            <div class="col-md-2">
                {!!  Form::label('teamSize', trans('categories.teamSize'),['class' => 'text-bold ' ]) !!}<br/>
                {{ $setting->teamSize }}
            </div>
        @endif
        <div class="col-md-2">

            {!!  Form::label('fightDuration', trans('categories.fightDuration'),['class' => 'text-bold ' ]) !!}
            <br/>
            {{ $setting->fightDuration }}

        </div>
        <div class="col-md-5">
            <div class="">
                {!!  Form::label('fightingAreas', trans_choice('categories.fightingArea',2),['class' => 'text-bold ' ]) !!}
                <br/>
                {{ $setting->fightingAreas }}

            </div>

        </div>
    </div>
    <hr/>

    <div class="row">
        <div class="col-md-2">

            <label>

                {!!  Form::label('hasEncho', trans('categories.hasEncho'),['class' => 'text-bold ' ]) !!} <br/>
                {{ $setting->hasEncho ? trans('core.yes') : trans('core.no') }}

            </label>

        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('enchoQty', trans('categories.enchoQty'),['class' => 'text-bold ' ]) !!}
                <br/>
                {{ $setting->enchoQty }}
            </div>
        </div>
        <div class="col-md-5">

            {!!  Form::label('enchoDuration', trans('categories.enchoDuration'),['class' => 'text-bold ' ]) !!}
            <div class="input-group ">
                {{ $setting->enchoDuration }}
            </div>


        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group   ">
                <label>

                    {!!  Form::label('hasPreliminary', trans('categories.hasPreliminary'),['class' => 'text-bold ' ]) !!}
                    <br/>
                    {{ $setting->hasPreliminary ? trans('core.yes') : trans('core.no')}}


                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('preliminaryWinner', trans('categories.preliminaryWinner'),['class' => 'text-bold ' ]) !!}
                <br/>
                {{ $setting->preliminaryWinner }}

            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('cost', trans('categories.cost'). ' ('. $currency  .')' ) !!}
                <br/>

                {{ $setting->cost }}

            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group  ">
                <label>

                    {!!  Form::label('hasHantei', trans('categories.hasHantei'),['class' => 'text-bold ' ]) !!} <br/>
                    {{ $setting->hasHantei ? trans('core.yes') : trans('core.no')}}

                </label>
            </div>
        </div>

    </div>

</div>
