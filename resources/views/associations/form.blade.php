<div class="form-group">
    {!!  Form::label('name', trans('core.name')) !!}
    {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>
