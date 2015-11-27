<div class="col-md-12">
    <div class="form-group">
        {!!  Form::label('name', trans('crud.name')) !!}
        {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        {!!  Form::label('latitude', trans('crud.latitude'),'') !!}
        {!!  Form::text('latitude', old('latitude'), ['class' => 'form-control', 'id' => 'lat',  'disabled' => 'disabled']) !!}
    </div>
    <div class="form-group">
        {!!  Form::label('longitude', trans('crud.longitude'),'') !!}
        {!!  Form::text('longitude', old('longitude'), ['class' => 'form-control', 'id' => 'lng',  'disabled' => 'disabled']) !!}
    </div>

    <div class="form-group">
        {!!  Form::label('countryId', trans('crud.country')) !!}
        {!!  Form::select('countryId', $countries,old('countryId'), ['class' => 'form-control']) !!} <!-- 484 is Mexico Code -->
    </div>
    <div class="form-group">
        {!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
    </div>

</div>
<div class="col-md-6">
    <div class="form-group">
        {!!  Form::label('name', trans('crud.coords')) !!}
        <div class="map-wrapper locationpicker-default" id="locationpicker-default"></div>
        {!!  Form::hidden('coords',old('coords')) !!}
    </div>
</div>
<script>$('#locationpicker-default').locationpicker({
        location: {latitude: 46.15242437752303, longitude: 2.7470703125},
        radius: 300,
        inputBinding: {
            latitudeInput: $('#lat'),
            longitudeInput: $('#lng'),
            radiusInput: $('#us2-radius'),
            locationNameInput: $('#city')
        }
    });
</script>


