@extends('layouts.dashboard')
@section('title')
    @if (is_null($user->id))
        <title>{{ trans('core.create') .' '.trans_choice('core.user',1) }}</title>
    @else
        <title>{{ trans('core.edit') .' '.trans_choice('core.user',1) }}</title>
    @endif
@stop

@section('styles')
    {!! Html::style('css/pages/userCreate.css') !!}
@stop
@section('breadcrumbs')
    @if (is_null($user->id))
        {!! Breadcrumbs::render('users.create') !!}
    @else
        {!! Breadcrumbs::render('users.edit', $user) !!}
    @endif
@stop
@section('content')
    @include("errors.list")

    <div class="container" id="container">
        <div class="content">
        @if (!is_null($user->id))
            {!! Form::model($user, ['method'=>"PATCH",
                                    'route' => array('users.update', $user->slug),
                                    'enctype' => 'multipart/form-data',
                                    'id' => 'form']) !!}

        @else

            {!! Form::open(['url'=>URL::action('UserController@store'),'enctype' => 'multipart/form-data']) !!}

        @endif

        <!-- Detached content -->
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 col-xs-12 col-sm-12">
                    <!-- Simple panel 1 : General Data-->
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="{{Lang::get('core.general_data')}}">
                                    <legend class="text-semibold">{{Lang::get('core.general_data')}}</legend>
                                </fieldset>

                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <div class="form-group">
                                                    {!!  Form::label('name', trans('core.username'),['class' => 'text-bold']) !!}
                                                    {!!  Form::text('name', $user->name, ['class' => 'form-control' ]) !!}
                                                    @if (strpos($user->avatar, 'http') !== false)
                                                        {!!  Form::hidden('avatar',$user->avatar) !!}
                                                    @else
                                                        {!!  Form::hidden('avatar',basename($user->avatar)) !!}
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <div class="form-group">
                                                    {!!  Form::label('firstname', trans('core.firstname'),['class' => 'text-bold']) !!}
                                                    {!!  Form::text('firstname', old('firstname'), ['class' => 'form-control']) !!}


                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <div class="form-group">
                                                    {!!  Form::label('lastname', trans('core.lastname'),['class' => 'text-bold']) !!}
                                                    {!!  Form::text('lastname', old('lastname'), ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <div class="form-group">
                                                    {!!  Form::label('grade_id', trans('core.grade'),['class' => 'text-bold']) !!}
                                                    {!!  Form::select('grade_id', $grades ,null, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-md-6  ">
                                        <div class="form-group">
                                            {!!  Form::label('avatar', trans('core.avatar')) !!}
                                            <div id="fileInput" class="dropzone text-center">
                                                <div class="fallback">
                                                    <input name="file" type="file"/>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                        <div class="form-group">
                                        {!!  Form::label('country_id', trans('core.country'),['class' => 'text-bold']) !!}
                                        {!!  Form::select('country_id', $countries,$user->country_id ?? Auth::user()->country_id, ['class' => 'form-control']) !!} <!-- 484 is Mexico Code -->
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div align="right">
                                <button type="submit" id="save1" class="btn btn-success">{{trans("core.save")}}</button>
                            </div>
                        </div>


                        <!-- /simple panel -->
                        <!-- Simple panel 2 : Fed / Asoc / Club -->
                    </div>


                    <!-- /detached content -->
                </div>
                <div class="col-lg-10 col-lg-offset-1 col-xs-12 col-sm-12">

                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">
                                <fieldset title="dojo">
                                    <a name="dojo">
                                        <legend class="text-semibold">{{Lang::get('structures.where_do_you_practice')}}</legend>
                                    </a>
                                </fieldset>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            {!!  Form::label('federation_id', trans_choice('structures.federation',1),['class' => 'text-bold']) !!}
                                            <select name="federation_id" v-model="federationSelected" id="federation_id"
                                                    class="form-control" @change="getAssociations(federationSelected)"
                                                    v-cloak>
                                                @if (Auth::user()->isSuperAdmin())
                                                    <option value="0"> -</option>
                                                @endif
                                                <option v-for="federation in federations"
                                                        v-bind:value="federation.value"
                                                        v-cloak>
                                                    @{{ federation.text }}
                                                </option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 mt-5">
                                        <br/>{{trans('core.federation_not_in_list')}}<br/>

                                        <a href="mailto:contact@kendozone.com" class="text-semibold text-black">
                                            {{ trans('core.contact_us') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            {!!  Form::label('association_id', trans_choice('structures.association',1),['class' => 'text-bold']) !!}

                                            <select name="association_id" v-model="associationSelected"
                                                    id="association_id" class="form-control"
                                                    @change="getClubs(federationSelected, associationSelected)"
                                                    v-cloak>
                                                <option value="0"> {{ trans('structures.no_association')  }}</option>
                                                <option v-for="association in associations"
                                                        v-bind:value="association.value">
                                                    @{{ association.text }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mt-5" v-if="federationSelected!=0" v-cloak>
                                        <br/>{{trans('core.association_not_in_list')}}<br/>

                                        <a href="#" data-toggle="modal" data-target="#create_association"
                                           class="text-semibold text-black">
                                            {{ trans('structures.add_new_association') }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            {!!  Form::label('club_id', trans_choice('structures.club',1),['class' => 'text-bold']) !!}

                                            <select name="club_id" v-model="clubSelected" class="form-control"
                                                    id="club_id" v-cloak>
                                                <option v-for="club in clubs" v-bind:value="club.value">
                                                    @{{ club.text }}
                                                </option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-lg-4 mt-5" v-if="federationSelected!=0" v-cloak>
                                        <br/>{{trans('core.club_not_in_list')}}<br/>
                                        <a href="#" data-toggle="modal" data-target="#create_club"
                                           class="text-semibold text-black">
                                            {{ trans('core.add_new_club') }}</a>
                                    </div>
                                </div>
                            </div>

                            <div align="right">
                                <button type="submit" id="save2" class="btn btn-success">{{trans("core.save")}}</button>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="col-lg-10 col-lg-offset-1 col-xs-12 col-sm-12">

                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="Venue">
                                    <a name="place">
                                        <legend class="text-semibold">{{Lang::get('core.account')}}</legend>
                                    </a>
                                </fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">

                                                <div class="form-group">
                                                    @if (!is_null($user->id))
                                                        {!!  Form::label('email', trans('core.email'),['class' => 'text-bold']) !!}
                                                        {!!  Form::label('email', $user->email, ['class' => 'form-control', "disabled" ]) !!}
                                                        {!!  Form::hidden('email', $user->email) !!}
                                                    @else
                                                        {!!  Form::label('email', trans('core.email'),['class' => 'text-bold']) !!}
                                                        {!!  Form::email('email',old('email'), ['class' => 'form-control']) !!}

                                                    @endif

                                                    <p class="help-block">{{  Lang::get('core.email_desc') }}</p>

                                                </div>
                                            </div>
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">
                                                <div class="form-group">
                                                    {!!  Form::label('role_id', trans('core.role'),['class' => 'text-bold']) !!}
                                                    @if (Auth::user()->isSuperAdmin())
                                                        @if (!is_null($user->id))
                                                            {!!  Form::select('role_id', $roles,old('role_id'), ['class' => 'form-control']) !!}
                                                        @else
                                                            {!!  Form::select('role_id', $roles,Config::get('constants.ROLE_USER'), ['class' => 'form-control']) !!}
                                                        @endif
                                                    @else
                                                        @if (!is_null($user->id))
                                                            {!!  Form::label('role_id', $user->role->name, ['class' => 'form-control', "disabled"]) !!}
                                                            {!!  Form::hidden('role_id', $user->role->id) !!}
                                                        @else
                                                            {!!  Form::label('role_id', \App\Role::find(Config::get('constants.ROLE_USER'))->name, ['class' => 'form-control', "disabled"]) !!}
                                                            {!!  Form::hidden('role_id', Config::get('constants.ROLE_USER')) !!}

                                                        @endif

                                                    @endif

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0 ">
                                                <div class="form-group">
                                                    {!!  Form::label('password', trans('core.password'),['class' => 'text-bold']) !!}
                                                    {!!  Form::password('password', ['class' => 'form-control']) !!}
                                                    <p class="help-block">{{  Lang::get('core.left_password_blank') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0">

                                                <div class="form-group">
                                                    {!!  Form::label('password_confirmation', trans('auth.password_confirmation'),['class' => 'text-bold']) !!}
                                                    {!!  Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                                    <p class="help-block">{{  Lang::get('core.left_password_blank') }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div align="right">
                                    <button type="submit" id="save2"
                                            class="btn btn-success">{{trans("core.save")}}</button>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>

        </div>
        {!! Form::close()!!}
        @include("modals.create_association")
        @include("modals.create_club")
    </div>


@stop
@section('scripts_footer')
    <?php


    ?>



    <script>
        let federationId = "{{ Auth::user()->federation_id }}";
        let associationId = "{{ Auth::user()->association_id }}";
        let clubId = "{{ Auth::user()->club_id}}";
        let user = "{{ Auth::user()->slug }}";

        let currentFederationId = "{{$user->federation_id ?? Auth::user()->federation_id }}";
        let currentAssociationId = "{{$user->association_id ?? Auth::user()->association_id}}";
        let currentClubId = "{{ $user->club_id ?? Auth::user()->club_id }}";


    </script>
    {!! Html::script('js/pages/header/userCreate.js') !!}
    {!! Html::script('js/userForm.js') !!}

    {!! Html::script('https://maps.google.com/maps/api/js?key=AIzaSyDMbCISDkoc5G1AP1mw8K76MsaN0pyF64k') !!}
    {!! JsValidator::formRequest('App\Http\Requests\UserRequest') !!}

    <script>
        let maxImageWidth = 100, maxImageHeight = 100;

        Dropzone.autoDiscover = false;
        $(document).ready(function () {

            let initialPic = "{{ $user->avatar ?? Avatar::create($user->email)->toBase64() }}";

            let onlyPic = initialPic.substring(initialPic.lastIndexOf('/') + 1);

            // TODO if root is creating user, how should I upload an avatar in a still non created user
            let uploadUrl = "{{ URL::action('UserAvatarController@store',$user->slug ?? 'tmp') }}";
            let avatarHiddenField = $('input[name=avatar]');

            new Dropzone('#fileInput', {
                autoProcessQueue: true,
                uploadMultiple: false,
                parallelUploads: 100,
                acceptedFiles: "image/jpeg,image/png,image/gif",

                dictRemoveFile: '{{ trans('core.remove') }}',
                dictDefaultMessage: 'Upload file',
                addRemoveLinks: 'dictRemoveFile',
                url: uploadUrl,
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                maxFiles: 1,

                init: function () {
                    let myDropzone = this;
                    let mockFile = {name: onlyPic, size: 2000};
                    myDropzone.emit("addedfile", mockFile);
                    myDropzone.emit("thumbnail", mockFile, initialPic);
                    myDropzone.emit("complete", mockFile);
                    myDropzone.files.push(mockFile);
                    let existingFileCount = 0; // The number of files already uploaded
                    myDropzone.options.maxFiles = myDropzone.options.maxFiles - existingFileCount;

                    myDropzone.on("thumbnail", function (file) {
                        if (file.width < maxImageWidth || file.height < maxImageHeight) {
                            file.rejectDimensions();
                        }
                        else {
                            file.acceptDimensions();
                        }
                    });


                    myDropzone.on("addedfile", function () {
                        if (this.files[1] != null) {
                            this.removeFile(this.files[0]);
                        }
                    });

                    myDropzone.on('success', function (file, response) {
                        avatarHiddenField.val(response['avatar']);
                    });


                },
                accept: function (file, done) {
                    file.acceptDimensions = done;
                    file.rejectDimensions = function () {
                        done("Invalid dimension.");
                    };
                    // Of course you could also just put the `done` function in the file
                    // and call it either with or without error in the `thumbnail` event
                    // callback, but I think that this is cleaner.
                },
                removedfile: function (file) {
                    avatarHiddenField.val('');
                    let _ref;
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                },
                maxfilesexceeded: function (file) {
                    this.removeAllFiles();
                    this.addFile(file);
                },

            })
        })
    </script>
@stop
