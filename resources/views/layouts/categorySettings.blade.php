
<div class="tab-pane" id="category">
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('isTeam', trans('core.isTeam')) !!} <br/>
                    {!!   Form::hidden('isTeam', 0) !!}
                    {!!   Form::checkbox('isTeam', 1, old('isTeam'), ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            {!!  Form::label('teamsize', trans('crud.teamsize')) !!}
            {{--<div class="ui-slider-labels" name="teamSize"></div>--}}
            {!!  Form::input('number','teamsize', old('teamSize'), ['class' => 'form-control','size']) !!}
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('fightDuration', trans('crud.fightDuration')) !!}
                {!!  Form::input('number','fightDuration', old('fightDuration'), ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch">
                <label>

                    {!!  Form::label('hasEncho', trans('crud.hasEncho')) !!} <br/>
                    {!!   Form::hidden('hasEncho', 0) !!}
                    {!!   Form::checkbox('hasEncho', 1, old('hasEncho'), ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('encho_qty', trans('crud.encho_qty')) !!}
                {!!  Form::input('number','encho_qty', old('encho_qty'), ['class' => 'form-control', 'placeholder' => trans('crud.encho_infinite')]) !!}
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('encho_duration', trans('crud.encho_duration')) !!}
                {!!  Form::input('number','encho_duration', old('encho_duration'), ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('hasRoundRobin', trans('crud.hasRoundRobin')) !!} <br/>
                    {!!   Form::hidden('hasRoundRobin', 0) !!}
                    {!!   Form::checkbox('hasRoundRobin', 1, old('hasRoundRobin'), ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('roundRobinWinner', trans('crud.roundRobinWinner')) !!}
                {!!  Form::input('number','roundRobinWinner', old('roundRobinWinner'), ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>


    <div class="checkbox-switch">
        <label>

            {!!  Form::label('hasHantei', trans('crud.hasHantei')) !!} <br/>
            {!!   Form::hidden('hasHantei', 0) !!}
            {!!   Form::checkbox('hasHantei', 1, old('hasHantei'), ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}

        </label>
    </div>

    <div class="form-group">
        {!!  Form::submit("Submit", ['class' => 'btn btn-primary form-control']) !!}
    </div>

</div>