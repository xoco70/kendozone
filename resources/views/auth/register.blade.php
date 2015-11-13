@extends('app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Conectate a Kendo Online</h1>

            <div class="account-wall">
                <div align="center">
                    {!! Html::image('images/logo.png', 'Logo Kendo Online', array( 'width' => 100, )) !!}
                </div>
                {!! Form::open(['url'=>URL::to('/auth/register') , 'class'=> "form-signin"]) !!}

                <fieldset>
                    <div id="legend">
                        <legend class="">Register</legend>
                    </div>
                    <div class="control-group">
                        <!-- Username -->
                        <label for="name">Nombre de usuario</label>

                        <div class="controls">
                            <input type="text" name="name" class="form-control" id="" value="{{ old('name') }}">

                            <p class="help-block">Username can contain any letters or numbers, without spaces</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- E-mail -->
                        <label class="control-label" for="email">E-mail</label>

                        <div class="controls">
                            <input type="email" id="email" name="email" placeholder="" class="form-control"
                                   value="{{ old('email') }}">

                            <p class="help-block">Please provide your E-mail</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Password-->
                        <label class="control-label" for="password">Password</label>

                        <div class="controls">
                            <input type="password" id="password" name="password" placeholder=""
                                   class="form-control">

                            <p class="help-block">Password should be at least 4 characters</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Password -->
                        <label class="control-label" for="password_confirmation">Password (Confirm)</label>

                        <div class="controls">
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder=""
                                   class="form-control">

                            <p class="help-block">Please confirm password</p>
                        </div>
                    </div>

                    <div class="form-group">
                        {!!  Form::label('countryId', trans('crud.country')) !!}
                        {!!  Form::select('countryId', $countries,484, ['class' => 'form-control']) !!} <!-- 484 is Mexico Code -->
                    </div>

                    <div class="form-group">
                        {!!  Form::label('gradeId', trans('crud.grade')) !!}
                        {!!  Form::select('gradeId', $grades,8, ['class' => 'form-control']) !!} <!-- Default 1st Dan-->
                    </div>

                    {!!   Form::hidden('roleId', $roleId) !!}


                    <div class="control-group">
                        <!-- Button -->
                        <div class="controls">
                            <button class="btn btn-success">Register</button>
                        </div>
                    </div>
                </fieldset>
                {!! Form::close()!!}
                @include("errors.list")
            </div>
        </div>
    </div>
@endsection