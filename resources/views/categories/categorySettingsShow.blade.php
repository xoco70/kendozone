<div class="tab-pane" id="category">
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('isTeam', trans('crud.isTeam')) !!} <br/>
                    {{ $setting->isTeam }}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            {!!  Form::label('teamSize', trans('crud.teamSize')) !!}<br/>
            {{ $setting->teamSize }}
        </div>
        <div class="col-md-5">

            {!!  Form::label('fightDuration', trans('crud.fightDuration')) !!}

            {{ $setting->fightDuration }}

        </div>
    </div>

    <div class="row">
        <div class="col-md-2">

            <label>

                {!!  Form::label('hasEncho', trans('crud.hasEncho')) !!} <br/>
                {{ $setting->hasEncho }}

            </label>

        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('enchoQty', trans('crud.enchoQty')) !!}
                {{ $setting->enchoQty }}
            </div>
        </div>
        <div class="col-md-5">

            {!!  Form::label('enchoDuration', trans('crud.enchoDuration')) !!}
            <div class="input-group ">
                {{ $setting->enchoDuration }}
            </div>


        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('hasRoundRobin', trans('crud.hasRoundRobin')) !!} <br/>
                    {{ $setting->hasRoundRobin }}


                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('roundRobinWinner', trans('crud.roundRobinWinner')) !!}
                {{ $setting->roundRobinWinner }}

            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('cost', trans('crud.cost')) !!}
                {{ $setting->cost }}

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch">
                <label>

                    {!!  Form::label('hasHantei', trans('crud.hasHantei')) !!} <br/>
                    {{ $setting->hasHantei }}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="">
                {!!  Form::label('fightingAreas', trans('crud.fightingAreas')) !!}
                {{ $setting->fightingAreas }}

            </div>

        </div>
    </div>

</div>
