<div class="form-group">
    {!!  Form::label('name', trans('crud.user')) !!}
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
<div class="form-group">
    {!!  Form::label('countryId', trans('crud.country')) !!}
    {!!  Form::select('countryId', $countries,484, ['class' => 'form-control']) !!} <!-- 484 is Mexico Code -->
</div>
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

<div class="form-group" >
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <span class="btn btn-primary btn-file">

			  	<span class="fileinput-new">Upload Avatar Image</span><span class="fileinput-exists">Change</span>

					<input type="file" name="picture">

				</span>

            <span class="fileinput-filename"></span>
            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
        </div>
{{--    {!!   SiteHelpers::showUploadedFile(Auth::getUser()->picture,'/images/avatar/') !!}--}}
    </div>

<div class="form-group">
    {!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>

