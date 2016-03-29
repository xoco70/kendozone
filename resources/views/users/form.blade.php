@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/header/userCreate.js') !!}
    {!! Html::script('http://maps.google.com/maps/api/js') !!}

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
                <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12">
                    <!-- Simple panel 1 : General Data-->
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="{{Lang::get('crud.general_data')}}">
                                    <legend class="text-semibold">{{Lang::get('crud.general_data')}}</legend>
                                </fieldset>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group">
                                                {!!  Form::label('name', trans('crud.username')) !!}
                                                {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}


                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                {!!  Form::label('firstname', trans('crud.firstname')) !!}
                                                {!!  Form::text('firstname', old('firstname'), ['class' => 'form-control']) !!}


                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                {!!  Form::label('lastname', trans('crud.lastname')) !!}
                                                {!!  Form::text('lastname', old('lastname'), ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                {!!  Form::label('grade_id', trans('crud.grade')) !!}
                                                {!!  Form::select('grade_id', $grades ,null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                    </div>
                                    {{--<div class="col-md-3">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<br/>--}}
                                    {{--@if ($user->avatar)--}}
                                    {{--<img src="{!! $user->avatar !!}"--}}
                                    {{--class="img-thumbnail center-block"/>--}}
                                    {{--@endif--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!!  Form::label('avatar', trans('crud.avatar')) !!}
                                            <div id="fileInput" class="dropzone">
                                                <div class="fallback">
                                                    <input name="file" type="file"/>
                                                </div>
                                            </div>

                                        </div>


                                        {{--<input type="file" id="avatar" name="avatar"--}}
                                        {{--data-show-upload="false"--}}
                                        {{--class="file-input-custom" accept="image/*">--}}

                                    </div>
                                </div>


                                <div class="form-group">
                                    {!!  Form::label('countryId', trans('crud.country')) !!}
                                    {!!  Form::select('countryId', $countries,484, ['class' => 'form-control']) !!} <!-- 484 is Mexico Code -->
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
                <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12">

                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="Venue">
                                    <a name="place">
                                        <legend class="text-semibold">{{Lang::get('crud.account')}}</legend>
                                    </a>
                                </fieldset>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!!  Form::label('email', trans('crud.email')) !!}
                                            {!!  Form::email('email',old('email'), ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!!  Form::label('password', trans('crud.password')) !!}
                                            {!!  Form::password('password', ['class' => 'form-control']) !!}
                                            <p class="help-block">{{  Lang::get('crud.left_password_blank') }}</p>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            {!!  Form::label('role_id', trans('crud.role')) !!}
                                            @if (Auth::user()->isSuperAdmin())
                                                {!!  Form::select('role_id', $roles,old('role_id'), ['class' => 'form-control']) !!}
                                            @else
                                                {!!  Form::label('role_id', $user->role->name, ['class' => 'form-control', "disabled"]) !!}
                                            @endif

                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!!  Form::label('password_confirmation', trans('auth.password_confirmation')) !!}
                                            {!!  Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                            <p class="help-block">{{  Lang::get('crud.left_password_blank') }}</p>
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
        {{--<script>--}}
        {{--Dropzone.options.fileInput = { // The camelized version of the ID of the form element--}}

        {{--// The configuration we've talked about above--}}
        {{--autoProcessQueue: false,--}}
        {{--uploadMultiple: true,--}}
        {{--parallelUploads: 100,--}}
        {{--maxFiles: 100,--}}

        {{--// The setting up of the dropzone--}}
        {{--init: function () {--}}
        {{--var myDropzone = this;--}}

        {{--// First change the button to actually tell Dropzone to process the queue.--}}
        {{--this.element.querySelector("button[type=submit]").addEventListener("click", function (e) {--}}
        {{--// Make sure that the form isn't actually being sent.--}}
        {{--e.preventDefault();--}}
        {{--e.stopPropagation();--}}
        {{--myDropzone.processQueue();--}}
        {{--});--}}

        {{--// Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead--}}
        {{--// of the sending event because uploadMultiple is set to true.--}}
        {{--this.on("sendingmultiple", function () {--}}
        {{--// Gets triggered when the form is actually being sent.--}}
        {{--// Hide the success button or the complete form.--}}
        {{--});--}}
        {{--this.on("successmultiple", function (files, response) {--}}
        {{--// Gets triggered when the files have successfully been sent.--}}
        {{--// Redirect user or notify of success.--}}
        {{--});--}}
        {{--this.on("errormultiple", function (files, response) {--}}
        {{--// Gets triggered when there was an error sending the files.--}}
        {{--// Maybe show form again, and notify user of error--}}
        {{--});--}}
        {{--}--}}

        {{--}--}}
        {{--        </script>--}}


        <script>

            Dropzone.options.MyTest = {
                thumbnailWidth:"250",
                thumbnailHeight:"250"
            };
            Dropzone.autoDiscover = false;
            $(document).ready(function () {
                var initialPic = "{{ Auth::user()->avatar }}";
                console.log(initialPic);
                new Dropzone('#fileInput', {
                    autoProcessQueue: false,
                    uploadMultiple: false,
                    parallelUploads: 100,
                    thumbnailWidth: 200,
                    thumbnailHeight: 200,
//                    dictRemoveFile:'Remove',
//                    dictDefaultMessage:'Upload file',
                    createImageThumbnails: true,
                    addRemoveLinks:'dictRemoveFile',
                    url: "#",
                    maxFiles: 1,

                    init: function () {
                        var myDropzone = this;
                        var mockFile = {name: "avatar.png", size: 2000};
                        myDropzone.emit("addedfile", mockFile);

                        // And optionally show the thumbnail of the file:
                        if (initialPic.indexOf('http') >= 0)
                            myDropzone.emit("thumbnail", mockFile, initialPic);
                        else
                        // Or if the file on your server is not yet in the right
                        // size, you can let Dropzone download and resize it
                        // callback and crossOrigin are optional.
                            myDropzone.createThumbnailFromUrl(mockFile, initialPic);
                                {{--"{{url(Config::get('constants.AVATAR_PATH')."avatar.png")}}",--}}
                                {{--"{{url(Config::get('constants.AVATAR_PATH')."avatar.png")}}", null, null);--}}

                        // Make sure that there is no progress bar, etc...
                        myDropzone.emit("complete", mockFile);

                        // If you use the maxFiles option, make sure you adjust it to the
                        // correct amount:
                        var existingFileCount = 0; // The number of files already uploaded
                        myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;
                        {{--myDropzone.options.addedfile.call(myDropzone, mockFile);--}}
                        {{--myDropzone.options.thumbnail.call(myDropzone, mockFile, "{{ url(Config::get('constants.AVATAR_PATH')."avatar.png")}}");--}}
                        myDropzone.on("addedfile", function () {
                            if (this.files[1] != null) {
                                this.removeFile(this.files[0]);
                            }
                        });

                        $(".btn-success").click(function (e) {
                            e.preventDefault();
                            myDropzone.processQueue();
                        });
                        myDropzone.on('success', function () {
                            myDropzone.removeAllFiles();

                        });
                    },
                    maxfilesexceeded: function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    },
                    sending: function (file, xhr, formData) {
                        formData.append("name", 'Julien');
                    },

                })
            })
        </script>
        {!! JsValidator::formRequest('App\Http\Requests\UserRequest') !!}

    </div>
@stop
