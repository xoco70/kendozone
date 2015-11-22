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


<div class="form-group">
    <label class="col-lg-2 control-label text-semibold">Overwrite styles:</label>
    <div class="col-lg-10">
										<span class="file-input file-input-new"><div class="file-preview">
                                                <div class="close fileinput-remove text-right">×</div>
                                                <div class="file-preview-thumbnails"></div>
                                                <div class="clearfix"></div>   <div class="file-preview-status text-center text-success"></div>
                                                <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                            </div>
<div class="input-group ">
    <div tabindex="-1" class="form-control file-caption  kv-fileinput-caption" title="">
        <span class="icon-file-plus kv-caption-icon" style="display: none;"></span><div class="file-caption-name"></div>
    </div>
    <div class="input-group-btn">
        <button type="button" class="btn btn-danger fileinput-remove fileinput-remove-button"><i class="icon-cancel-square position-left"></i> Remove</button>
        <button type="submit" class="btn bg-teal-400 kv-fileinput-upload"><i class="icon-file-upload position-left"></i> Upload</button>
        <div class="btn bg-slate-700 btn-file"> <i class="icon-image2 position-left"></i> Select <input type="file" class="file-input-custom" accept="image/*" id="avatar" name="avatar"></div>
    </div>
</div></span>

    </div>
</div>


{{--<div class="form-group" >--}}
    {{--<div class="fileinput fileinput-new" data-provides="fileinput">--}}
        {{--<span class="btn btn-primary btn-file">--}}

			  	{{--<span class="fileinput-new">Upload Avatar Image</span><span class="fileinput-exists">Change</span>--}}

					{{--<input type="file" name="avatar">--}}

				{{--</span>--}}

            {{--<span class="fileinput-filename"></span>--}}
            {{--<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>--}}
        {{--</div>--}}
{{--    {!!   SiteHelpers::showUploadedFile(Auth::getUser()->avatar,'/images/avatar/') !!}--}}
    {{--</div>--}}

<div class="form-group">
    {!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
</div>

