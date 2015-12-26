
<div class="tab-pane" id="category">
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('isTeam', trans('core.isTeam')) !!} <br/>
                    {!!   Form::hidden('isTeam', 0) !!}
                    {!!   Form::checkbox('isTeam', 1, old('isTeam') !=null ? old('isTeam') : $defaultSettings->isTeam , ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No" ]) !!}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            {!!  Form::label('teamSize', trans('crud.teamSize')) !!}
            {{--<div class="ui-slider-labels" name="teamSize"></div>--}}
            {!!  Form::input('number','teamSize', old('teamSize'), ['class' => 'form-control','size', 'placeholder' => $defaultSettings->teamSize]) !!}
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('fightDuration', trans('crud.fightDuration')) !!}
                {!!  Form::input('number','fightDuration', old('fightDuration'), ['class' => 'form-control', 'placeholder' => $defaultSettings->fightDuration]) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch">
                <label>

                    {!!  Form::label('hasEncho', trans('crud.hasEncho')) !!} <br/>
                    {!!   Form::hidden('hasEncho', 0) !!}
                    {!!   Form::checkbox('hasEncho', 1, old('hasEncho') !=null ? old('hasEncho') : $defaultSettings->hasEncho,
                                         ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('enchoQty', trans('crud.enchoQty')) !!}
                {!!  Form::input('number','enchoQty', old('enchoQty'), ['class' => 'form-control', 'placeholder' => $defaultSettings->enchoQty]) !!}
                <small class="display-block">0 para infinito</small>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('enchoDuration', trans('crud.enchoDuration')) !!}
                {!!  Form::input('number','enchoDuration', old('enchoDuration'), ['class' => 'form-control', 'placeholder' => $defaultSettings->enchoDuration]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('hasRoundRobin', trans('crud.hasRoundRobin')) !!} <br/>
                    {!!   Form::hidden('hasRoundRobin', 0) !!}
                    {!!   Form::checkbox('hasRoundRobin', 1, old('hasRoundRobin') !=null ? old('hasRoundRobin') : $defaultSettings->hasRoundRobin,
                                         ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('roundRobinWinner', trans('crud.roundRobinWinner')) !!}
                {!!  Form::input('number','roundRobinWinner', old('roundRobinWinner'), ['class' => 'form-control', 'placeholder' => $defaultSettings->roundRobinWinner]) !!}
            </div>
        </div>
    </div>


    <div class="checkbox-switch">
        <label>

            {!!  Form::label('hasHantei', trans('crud.hasHantei')) !!} <br/>
            {!!   Form::hidden('hasHantei', 0) !!}
            {!!   Form::checkbox('hasHantei', 1, old('hasHantei') !=null ? old('hasHantei') : $defaultSettings->hasHantei,
                                 ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}

        </label>
    </div>

    {{--{!!   Form::hidden('tournament_id', $tournamentId) !!}--}}
    {{--{!!   Form::hidden('category_id', $categoryId) !!}--}}

    <div class="form-group">
        {!!  Form::submit("Submit", ['class' => 'btn btn-primary form-control']) !!}
    </div>

</div>