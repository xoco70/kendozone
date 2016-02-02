@extends('layouts.dashboard')
@section('scripts')
{!! Html::script('js/userCreate.js') !!}
{!! Html::script('http://maps.google.com/maps/api/js') !!}

{{--    {!! Html::script('http://maps.google.com/maps/api/js') !!}--}}
{{--    {!! Html::script('js/pages/uploader_bootstrap.js') !!}--}}
@stop
@section('styles')
    {!! Html::script('css/userCreate.css') !!}
@stop
@section('content')

    @include("errors.list")

    <div class="container-fluid">

        @if (!is_null($user->id))
            {!! Form::model($user, array('method'=>"PATCH",'route' => array('users.update', $user->id), 'enctype' => 'multipart/form-data')) !!}
        @else
            {!! Form::open(['url'=>"users",'enctype' => 'multipart/form-data']) !!}
        @endif


        <div class="content">

            <!-- Detached content -->
            <div class="container-detached">
                <div class="content-detached">
                    <div class="row">
                        <div class="col-md-12 ">
                            <!-- Simple panel 1 : General Data-->
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <div class="container-fluid">


                                        <fieldset title="{{Lang::get('crud.general_data')}}">
                                            <legend class="text-semibold">{{Lang::get('crud.general_data')}}</legend>
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
                                                <div class="col-md-6">
                                                    {!!  Form::label('avatar', trans('crud.avatar')) !!}

                                                    <input type="file" id="avatar" name="avatar"
                                                           data-show-upload="false"
                                                           class="file-input-custom" accept="image/*">

                                                </div>
                                            </div>


                                            <div class="form-group">
                                            {!!  Form::label('countryId', trans('crud.country')) !!}
                                            {!!  Form::select('countryId', $countries,484, ['class' => 'form-control']) !!} <!-- 484 is Mexico Code -->
                                            </div>


                                        </fieldset>


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
                        <div class="col-md-12 ">

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
                                                {!!  Form::label('email', trans('crud.email')) !!}
                                                {!!  Form::email('email',old('email'), ['class' => 'form-control']) !!}
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
                                                    @if (Auth::user()->role_id == 1)
                                                        {{--{!!  Form::select('role_id', $roles,old('role_id'), ['class' => 'form-control']) !!}--}}
                                                    @else
                                                        {{--{!!  Form::label('role_id', $user->role->name, ['class' => 'form-control', "disabled"]) !!}--}}
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




            </div>



        </div>
        {!! Form::close()!!}
    </div>
@stop
