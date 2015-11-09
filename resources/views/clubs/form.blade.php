<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!!  Form::input('name', 'name', old('name'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('asocId', 'AsocId:') !!}
    {!!  Form::input('asocId', 'asocId', old('asocId'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>
