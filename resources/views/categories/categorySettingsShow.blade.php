<div class="tab-pane" id="category">
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('isTeam', trans('CATEGORIES.isTeam')) !!} <br/>
                    {{ $setting->isTeam }}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            {!!  Form::label('teamSize', trans('CATEGORIES.teamSize')) !!}<br/>
            {{ $setting->teamSize }}
        </div>
        <div class="col-md-5">

            {!!  Form::label('fightDuration', trans('CATEGORIES.fightDuration')) !!}
            <br/>
            {{ $setting->fightDuration }}

        </div>
    </div>

    <div class="row">
        <div class="col-md-2">

            <label>

                {!!  Form::label('hasEncho', trans('CATEGORIES.hasEncho')) !!} <br/>
                {{ $setting->hasEncho }}

            </label>

        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('enchoQty', trans('CATEGORIES.enchoQty')) !!}
                <br/>
                {{ $setting->enchoQty }}
            </div>
        </div>
        <div class="col-md-5">

            {!!  Form::label('enchoDuration', trans('CATEGORIES.enchoDuration')) !!}
            <div class="input-group ">
                {{ $setting->enchoDuration }}
            </div>


        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('hasRoundRobin', trans('CATEGORIES.hasRoundRobin')) !!} <br/>
                    {{ $setting->hasRoundRobin }}


                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('roundRobinWinner', trans('CATEGORIES.roundRobinWinner')) !!}
                <br/>
                {{ $setting->roundRobinWinner }}

            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('cost', trans('CATEGORIES.cost')) !!}
                <br/>

                {{ $setting->cost }}

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch">
                <label>

                    {!!  Form::label('hasHantei', trans('CATEGORIES.hasHantei')) !!} <br/>
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
