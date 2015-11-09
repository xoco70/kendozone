<div class="form-group">
    {!! Form::label('userId', 'UserId:') !!}
    {!!  Form::input('userId', 'userId', old('userId'), ['class' => 'form-control']) !!}

</div>

<div class="form-group">
    {!! Form::label('shiaiCategoryId', 'ShiaiCategoryId:') !!}
    {!!  Form::input('shiaiCategoryId', 'shiaiCategoryId', old('shiaiCategoryId'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('clubId', 'ClubId:') !!}
    {!!  Form::input('clubId', 'clubId', old('clubId'), ['class' => 'form-control']) !!}

</div>
<div class="form-group">
    {!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>
