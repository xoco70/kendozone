@extends('app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">{{  Lang::get('auth.title_register') }}</h1>

            <div class="account-wall">
                <div align="center">
                    {!! Html::image('images/logo.png', 'Logo Kendo Online', array( 'width' => 100, )) !!}
                </div>
                {!! Form::open(['url'=>URL::to('/auth/register') , 'class'=> "form-signin"]) !!}

                <fieldset>
                    <div id="legend">
                        <legend class="">{{  Lang::get('auth.register') }}</legend>
                    </div>
                    <div class="control-group">
                        <!-- Username -->
                        <label for="name"> {{  Lang::get('crud.username') }}</label>

                        <div class="controls">
                            <input type="text" name="name" class="form-control" id="" value="{{ old('name') }}">

                            <p class="help-block">{{  Lang::get('auth.username_tip') }}</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- E-mail -->
                        <label class="control-label" for="email">{{  Lang::get('crud.email') }}</label>

                        <div class="controls">
                            <input type="email" id="email" name="email" placeholder="" class="form-control" value="{{ old('email') }}">
                            <p class="help-block">{{  Lang::get('auth.email_tip') }}</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Password-->
                        <label class="control-label" for="password">{{  Lang::get('crud.password') }}</label>

                        <div class="controls">
                            <input type="password" id="password" name="password" placeholder=""
                                   class="form-control">

                            <p class="help-block">{{  Lang::get('auth.username_tip') }}</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Password -->
                        <label class="control-label" for="password_confirmation">{{  Lang::get('auth.password_confirmation') }}</label>

                            <div class="controls">
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder=""
                                   class="form-control">

                            <p class="help-block">{{  Lang::get('auth.password_confirmation2') }}</p>
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
                            <button class="btn btn-success">{{  Lang::get('auth.create_account') }}</button>
                        </div>
                    </div>
                </fieldset>
                {!! Form::close()!!}
                @include("errors.list")
            </div>
        </div>
    </div>
@endsection