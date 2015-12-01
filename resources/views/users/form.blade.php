<div class="form-group">
    {!!  Form::label('name', trans('crud.username')) !!}
    {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!} <!-- ,'disabled' => 'disabled' -->
</div>
<div class="form-group">
    {!!  Form::label('email', trans('crud.email')) !!}
    {!!  Form::email('email',old('email'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!!  Form::label('firstname', trans('crud.firstname')) !!}
    {!!  Form::text('firstname', old('firstname'), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!!  Form::label('lastname', trans('crud.lastname')) !!}
    {!!  Form::text('lastname', old('lastname'), ['class' => 'form-control']) !!}
</div>
{{--<div class="form-group">--}}
    {{--{!!  Form::label('countryId', trans('crud.country')) !!}--}}
    {{--{!!  Form::select('countryId', $countries,484, ['class' => 'form-control']) !!} <!-- 484 is Mexico Code -->--}}
{{--</div>--}}
<div class="form-group">
    {!!  Form::label('gradeId', trans('crud.grade')) !!}
    {!!  Form::select('gradeId', $grades ,null, ['class' => 'form-control']) !!}
</div>
@can('CanChangeRole')
<div class="form-group">
    {!!  Form::label('roleId', trans('crud.role')) !!}
    {!!  Form::select('roleId', $roles,old('roleId'), ['class' => 'form-control']) !!}
</div>
@endcan
<div class="form-group">
    {!!  Form::label('password', trans('crud.password')) !!}
    {!!  Form::password('password', ['class' => 'form-control']) !!}
    <p class="help-block">{{  Lang::get('crud.left_password_blank') }}</p>
</div>

<div class="form-group">
    {!!  Form::label('password_confirmation', trans('auth.password_confirmation')) !!}
    {!!  Form::password('password_confirmation', ['class' => 'form-control']) !!}
    <p class="help-block">{{  Lang::get('crud.left_password_blank') }}</p>
</div>
<input type="file"  id="avatar" name="avatar" data-show-upload="false"  class="file-input-custom" accept="image/*">

<div class="form-group">
    {!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>

