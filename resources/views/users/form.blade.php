@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/header/userCreate.js') !!}
    {!! Html::script('https://maps.google.com/maps/api/js?key=AIzaSyDMbCISDkoc5G1AP1mw8K76MsaN0pyF64k') !!}

@stop
@section('styles')
    {!! Html::style('css/pages/userCreate.css') !!}
@stop
@section('breadcrumbs')
    @if (!is_null($user->id))
        {!! Breadcrumbs::render('users.edit', $user) !!}
    @else
        {!! Breadcrumbs::render('users.create') !!}

    @endif
@stop
@section('content')

    @include("errors.list")

    <div class="container-fluid">

        @if (!is_null($user->id))
            {!! Form::model($user, ['method'=>"PATCH",
                                    'route' => array('users.update', $user->slug),
                                    'enctype' => 'multipart/form-data',
                                    'id' => 'MyTest']) !!}
        @else
            {!! Form::open(['url'=>"users",
                            'enctype' => 'multipart/form-data']) !!}
        @endif


        <div class="content">

            <!-- Detached content -->
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 col-xs-12 col-sm-12">
                    <!-- Simple panel 1 : General Data-->
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="{{Lang::get('crud.general_data')}}">
                                    <legend class="text-semibold">{{Lang::get('crud.general_data')}}</legend>
                                </fieldset>

                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    {!!  Form::label('name', trans('crud.username')) !!}
                                                    {!!  Form::label('name', $user->name, ['class' => 'form-control', "disabled"]) !!}
                                                    {!!  Form::hidden('name', $user->name) !!}
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    {!!  Form::label('firstname', trans('crud.firstname')) !!}
                                                    {!!  Form::text('firstname', old('firstname'), ['class' => 'form-control']) !!}


                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    {!!  Form::label('lastname', trans('crud.lastname')) !!}
                                                    {!!  Form::text('lastname', old('lastname'), ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    {!!  Form::label('grade_id', trans('crud.grade')) !!}
                                                    {!!  Form::select('grade_id', $grades ,null, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{--<div class="col-xs-3">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<br/>--}}
                                    {{--@if ($user->avatar)--}}
                                    {{--<img src="{!! $user->avatar !!}"--}}
                                    {{--class="img-thumbnail center-block"/>--}}
                                    {{--@endif--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-xs-12 col-md-6  ">
                                        <div class="form-group">
                                            {!!  Form::label('avatar', trans('crud.avatar')) !!}
                                            <div id="fileInput" class="dropzone text-center">
                                                <div class="fallback">
                                                    <input name="avatar" type="file"/>
                                                </div>
                                            </div>

                                        </div>


                                        {{--<input type="file" id="avatar" name="avatar"--}}
                                        {{--data-show-upload="false"--}}
                                        {{--class="file-input-custom" accept="image/*">--}}

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            {!!  Form::label('countryId', trans('crud.country')) !!}
                                            {!!  Form::select('countryId', $countries,484, ['class' => 'form-control']) !!} <!-- 484 is Mexico Code -->
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div align="right">
                                <button type="submit" class="btn btn-success">{{trans("core.save")}}</button>
                            </div>
                        </div>


                        <!-- /simple panel -->
                        <!-- Simple panel 2 : Venue -->
                    </div>


                    <!-- /detached content -->
                </div>
                <div class="col-lg-10 col-lg-offset-1 col-xs-12 col-sm-12">

                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="Venue">
                                    <a name="place">
                                        <legend class="text-semibold">{{Lang::get('crud.account')}}</legend>
                                    </a>
                                </fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    {!!  Form::label('email', trans('crud.email')) !!}
                                                    {!!  Form::email('email',old('email'), ['class' => 'form-control']) !!}
                                                    <p class="help-block">{{  Lang::get('crud.email_desc') }}</p>

                                                </div>
                                            </div>
                                            <div class="col-xs-12 col">
                                                <div class="form-group">
                                                    {!!  Form::label('role_id', trans('crud.role')) !!}
                                                    @if (Auth::user()->isSuperAdmin())
                                                        {!!  Form::select('role_id', $roles,old('role_id'), ['class' => 'form-control']) !!}
                                                    @else
                                                        {!!  Form::label('role_id', $user->role->name, ['class' => 'form-control', "disabled"]) !!}
                                                    @endif

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-xs-12 ">
                                                <div class="form-group">
                                                    {!!  Form::label('password', trans('crud.password')) !!}
                                                    {!!  Form::password('password', ['class' => 'form-control']) !!}
                                                    <p class="help-block">{{  Lang::get('crud.left_password_blank') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">

                                                <div class="form-group">
                                                    {!!  Form::label('password_confirmation', trans('auth.password_confirmation')) !!}
                                                    {!!  Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                                    <p class="help-block">{{  Lang::get('crud.left_password_blank') }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div align="right">
                                    <button type="submit"
                                            class="btn btn-success">{{trans("core.save")}}</button>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
                {{--@include("right-panel.users_menu")--}}
            </div>


        </div>
        {!! Form::close()!!}

        <script>

            Dropzone.autoDiscover = false;
            $(document).ready(function () {
                var initialPic = "{{ Auth::user()->avatar }}";
                var onlyPic = initialPic.substring(initialPic.lastIndexOf('/') + 1);
                var uploadUrl = "{{ url('users/'.Auth::user()->slug.'/uploadAvatar') }}";

//                console.log(uploadUrl);
                new Dropzone('#fileInput', {
                    autoProcessQueue: false,
                    uploadMultiple: false,
                    parallelUploads: 100,
                    acceptedFiles: "image/jpeg,image/png,image/gif",

//                    thumbnailWidth: 200,
//                    thumbnailHeight: 200,
//                    dictRemoveFile:'Remove',
//                    dictDefaultMessage:'Upload file',
//                    createImageThumbnails: true,
                    addRemoveLinks: 'dictRemoveFile',
                    url: uploadUrl,
                    maxFiles: 1,

                    init: function () {
                        var myDropzone = this;
                        var mockFile = {name: onlyPic, size: 2000};
                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.emit("thumbnail", mockFile, initialPic);
                        myDropzone.emit("complete", mockFile);
                        var existingFileCount = 0; // The number of files already uploaded
                        myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;
                        myDropzone.on("addedfile", function () {
                            if (this.files[1] != null) {
                                this.removeFile(this.files[0]);
                            }
                        });

                        $(".btn-success").click(function (e) {
                            myDropzone.processQueue();
                        });
//                        myDropzone.on('success', function () {
//
//                        });
                    },
                    maxfilesexceeded: function (file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    },
//                    sending: function (file, xhr, formData) {
//                        formData.append("name", 'Julien');
//                    },

                })
            })
        </script>
        {!! JsValidator::formRequest('App\Http\Requests\UserRequest') !!}

    </div>
@stop
