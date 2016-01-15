


<div class="tab-pane" id="category">
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('isTeam', trans('core.isTeam')) !!} <br/>
                    {!!   Form::hidden('isTeam', 0) !!}
                    {!!   Form::checkbox('isTeam', 1, old('isTeam')  , ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No" ]) !!}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            {!!  Form::label('teamSize', trans('crud.teamSize')) !!}<br/>
            {{--<div class="ui-slider-labels" name="teamSize"></div>--}}
            <div class="teamSize"></div>
{{--            {!!  Form::input('number','teamSize', old('teamSize')) !!}--}}
        </div>
        <div class="col-md-5">

            {!!  Form::label('fightDuration', trans('crud.fightDuration')) !!}
            <div class="input-group">
                {!!  Form::input('text','fightDuration', old('fightDuration'), ['class' => 'form-control','id' => 'fightDuration']) !!}
                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch">
                <label>

                    {!!  Form::label('hasEncho', trans('crud.hasEncho')) !!} <br/>
                    {!!   Form::hidden('hasEncho', 0) !!}
                    {!!   Form::checkbox('hasEncho', 1, old('hasEncho'),
                                         ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('enchoQty', trans('crud.enchoQty')) !!}
{{--                {!!  Form::input('number','enchoQty', old('enchoQty'), ['class' => 'form-control']) !!}--}}
                <div class="enchoQty"></div>
                <small class="display-block">0 para infinito</small>
            </div>
        </div>
        <div class="col-md-5">

            {!!  Form::label('enchoDuration', trans('crud.enchoDuration')) !!}
            <div class="input-group ">
                {!!  Form::input('number','enchoDuration', old('enchoDuration'), ['class' => 'form-control','id' => 'enchoDuration']) !!}
                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
            </div>


        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch ">
                <label>

                    {!!  Form::label('hasRoundRobin', trans('crud.hasRoundRobin')) !!} <br/>
                    {!!   Form::hidden('hasRoundRobin', 0) !!}
                    {!!   Form::checkbox('hasRoundRobin', 1, old('hasRoundRobin'),
                                         ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}

                </label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('roundRobinWinner', trans('crud.roundRobinWinner')) !!}
                {!!  Form::input('number','roundRobinWinner', old('roundRobinWinner'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('cost', trans('crud.cost')) !!}
                {!!  Form::input('number','cost', old('cost'), ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="checkbox-switch">
                <label>

                    {!!  Form::label('hasHantei', trans('crud.hasHantei')) !!} <br/>
                    {!!   Form::hidden('hasHantei', 0) !!}
                    {!!   Form::checkbox('hasHantei', 1, old('hasHantei'),
                                         ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}

                </label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="">
                {!!  Form::label('fightingAreas', trans('crud.fightingAreas')) !!}
                <br/>
                <div class="fightingAreas"></div>

{{--                {!!  Form::input('number','fightingAreas', old('fightingAreas'), ['class' => 'form-control']) !!}--}}

            </div>

        </div>
    </div>
    {{--{!!   Form::hidden('tournament_id', $tournamentId) !!}--}}
    {{--{!!   Form::hidden('category_id', $categoryId) !!}--}}


    <div align="right">
        <button type="submit" class="btn btn-success">{{trans("core.save")}}</button>
    </div>

</div>
<script>

    $(function () {
        $(".switch").bootstrapSwitch();
        $('#fightDuration').timepicker(('option',

        {
            'minTime': '2:00',
            'maxTime': '5:00',
            'timeFormat': 'H:i',
            'step': '15'
        }));

        $('#enchoDuration').timepicker(('option',

        {
            'minTime': '0:00',
            'maxTime': '5:00',
            'timeFormat': 'H:i',
            'step': '15'
        }));

        $(".teamSize").slider({
            max: 10,
            value: 6
        });
        $(".teamSize").slider("pips");
        $(".teamSize").slider("float");
        //--------------------------

        $(".enchoQty").slider({
            max: 5,
            value: 2
        });
        $(".enchoQty").slider("pips");
        $(".enchoQty").slider("float");
        //--------------------------

        $(".fightingAreas").slider({
            max: 5,
            value: 1
        });
        $(".fightingAreas").slider("pips");
        $(".fightingAreas").slider("float");
        //--------------------------






    });
</script>
