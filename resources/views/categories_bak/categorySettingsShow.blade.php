<div class="tab-pane" id="category">
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('isTeam', trans('core.isTeam')) !!} <br/>
                    {{ $setting->isTeam }}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            {!!  Form::label('teamSize', trans('core.teamSize')) !!}<br/>
            {{ $setting->teamSize }}
        </div>
        <div class="col-md-5">

            {!!  Form::label('fightDuration', trans('core.fightDuration')) !!}
            <br/>
            {{ $setting->fightDuration }}

        </div>
    </div>

    <div class="row">
        <div class="col-md-2">

            <label>

                {!!  Form::label('hasEncho', trans('core.hasEncho')) !!} <br/>
                {{ $setting->hasEncho }}

            </label>

        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('enchoQty', trans('core.enchoQty')) !!}
                <br/>
                {{ $setting->enchoQty }}
            </div>
        </div>
        <div class="col-md-5">

            {!!  Form::label('enchoDuration', trans('core.enchoDuration')) !!}
            <div class="input-group ">
                {{ $setting->enchoDuration }}
            </div>


        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('hasRoundRobin', trans('core.hasRoundRobin')) !!} <br/>
                    {{ $setting->hasRoundRobin }}


                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('roundRobinWinner', trans('core.roundRobinWinner')) !!}
                <br/>
                {{ $setting->roundRobinWinner }}

            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('cost', trans('core.cost')) !!}
                <br/>

                {{ $setting->cost }}

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch">
                <label>

                    {!!  Form::label('hasHantei', trans('core.hasHantei')) !!} <br/>
                    {{ $setting->hasHantei }}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="">
                {!!  Form::label('fightingAreas', trans('core.fightingAreas')) !!}
                <br/>
                {{ $setting->fightingAreas }}

            </div>

        </div>
    </div>

</div>
