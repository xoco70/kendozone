<!-- Theme JS files -->

<div class="form-group">
    {!!  Form::label('name', trans('crud.name')) !!}
    {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!!  Form::label('tournamentDate', trans('crud.eventDate')) !!}
    {!!  Form::input('date', 'tournamentDate', old('date'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!!  Form::label('limitRegistrationDate', trans('crud.fullLimitDateRegistration')) !!}
    {!!  Form::input('date', 'limitRegistrationDate', old('limitRegistrationDate'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!!  Form::label('placeId', trans('crud.place')) !!}
    {!!  Form::select('placeId', $places,null, ['class' => 'form-control']) !!}
</div>
<hr>
<div class="form-group">
    {!!  Form::label('teamSize', trans('crud.teamsize')) !!}
    {!!  Form::input('number','teamSize', old('teamSize'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!!  Form::label('fightingAreas', trans('crud.fightingAreas')) !!}
    {!!  Form::input('number','fightingAreas', old('fightingAreas'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <div class="checkbox checkbox-switchery">
        <label>
            <input type="checkbox" name="hasRoundRobin" value="{!! old('hasRoundRobin') !!}" id="hasRoundRobin"
                   class="switchery" checked="checked" data-switchery="true" style="display: none;">
                <span class="switchery switchery-default"
                      style="border-color: rgb(100, 189, 99); box-shadow: rgb(100, 189, 99) 0px 0px 0px 12px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s; background-color: rgb(100, 189, 99);"><small
                            style="left: 22px; transition: background-color 0.4s, left 0.2s; background-color: rgb(255, 255, 255);"></small></span>
            {!! trans('crud.hasRoundRobin') !!}
        </label>
    </div>
</div>

<div class="checkbox checkbox-switchery">
    <label>
        <input type="checkbox" class="switchery-primary" checked="checked" data-switchery="true" style="display: none;"><span class="switchery switchery-default" style="border-color: rgb(33, 150, 243); box-shadow: rgb(33, 150, 243) 0px 0px 0px 12px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s; background-color: rgb(33, 150, 243);"><small style="left: 22px; transition: background-color 0.4s, left 0.2s; background-color: rgb(255, 255, 255);"></small></span>
        Switch in <span class="text-semibold">primary</span> context
    </label>
</div>

<div class="form-group">
    {!!  Form::label('roundRobinWinner', trans('crud.roundRobinWinner')) !!}
    {!!  Form::input('number','roundRobinWinner', old('roundRobinWinner'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!!  Form::label('fightDuration', trans('crud.fightDuration')) !!}
    {!!  Form::input('number','fightDuration', old('fightDuration'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!!  Form::label('hasEncho', trans('crud.hasEncho')) !!}
    {!!  Form::checkbox('hasEncho',  old('hasEncho')) !!}
</div>
<div class="form-group">
    {!!  Form::label('type', trans('crud.tournamentType')) !!}
    {!!  Form::select('type',$types, old('type'),  ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>