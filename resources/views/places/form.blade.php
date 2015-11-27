<div class="form-group">
    {!!  Form::label('name', trans('crud.name')) !!}
    {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!!  Form::label('name', trans('crud.coords')) !!}
    <div class="map-wrapper locationpicker-default"></div>
    {!!  Form::hidden('coords',old('coords')) !!}
</div>

<div class="form-group">
    {!!  Form::label('city', trans('crud.city')) !!}
    {!!  Form::text('city', old('city'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!!  Form::label('state', trans('crud.state'),'') !!}
    {!!  Form::text('state', old('state'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
{!!  Form::label('countryId', trans('crud.country')) !!}
{!!  Form::select('countryId', $countries,old('countryId'), ['class' => 'form-control']) !!} <!-- 484 is Mexico Code -->
</div>
<div class="form-group">
    {!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>
