<?php Auth::check() ? $currency = Auth::user()->country->currency_code : $currency = "" ?>

<div class="tab-pane" id="category">
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('isTeam', trans('categories.isTeam')) !!} <br/>
                    {{ $setting->isTeam }}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            {!!  Form::label('teamSize', trans('categories.teamSize')) !!}<br/>
            {{ $setting->teamSize }}
        </div>
        <div class="col-md-5">

            {!!  Form::label('fightDuration', trans('categories.fightDuration')) !!}
            <br/>
            {{ $setting->fightDuration }}

        </div>
    </div>

    <div class="row">
        <div class="col-md-2">

            <label>

                {!!  Form::label('hasEncho', trans('categories.hasEncho')) !!} <br/>
                {{ $setting->hasEncho }}

            </label>

        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('enchoQty', trans('categories.enchoQty')) !!}
                <br/>
                {{ $setting->enchoQty }}
            </div>
        </div>
        <div class="col-md-5">

            {!!  Form::label('enchoDuration', trans('categories.enchoDuration')) !!}
            <div class="input-group ">
                {{ $setting->enchoDuration }}
            </div>


        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('hasPreliminary', trans('categories.hasPreliminary')) !!} <br/>
                    {{ $setting->hasPreliminary }}


                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('preliminaryWinner', trans('categories.preliminaryWinner')) !!}
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

    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch">
                <label>

                    {!!  Form::label('hasHantei', trans('categories.hasHantei')) !!} <br/>
                    {{ $setting->hasHantei }}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="">
                {!!  Form::label('fightingAreas', trans_choice('categories.fightingArea',2)) !!}
                <br/>
                {{ $setting->fightingAreas }}

            </div>

        </div>
    </div>

</div>
