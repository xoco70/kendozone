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
    {!!  Form::label('hasRoundRobin', trans('crud.hasRoundRobin')) !!}
    {!!  Form::checkbox('hasRoundRobin', old('hasRoundRobin')) !!}
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