@extends('layouts.guest')

@section('content')
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3  col-xs-12">
        <!-- Password recovery -->
        {!! Form::open(['action' => 'Auth\PasswordController@postReset']) !!}


        <div class="panel panel-body login-form">
            <div class="text-center">
                <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                <h5 class="content-group">{{  Lang::get('auth.enter_new_passwords') }}
                    <small class="display-block">{{  Lang::get('auth.enter_new_passwords_description') }}</small>
                </h5>
            </div>
            <div class="form-group">
                {!! Form::hidden('email', $email)!!}
            </div>

            <!-- Password field -->
            <div class="form-group">
                {!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control', 'required' => 'required'])!!}
            </div>

            <!-- Password confirmation field -->
            <div class="form-group">
                {!! Form::password('password_confirmation', ['placeholder' => 'Password confirmation','class' => 'form-control', 'required' => 'required'])!!}
            </div>

            <!-- Hidden Token field -->
            {!! Form::hidden('token', $token )!!}

            <button type="submit" class="btn bg-blue btn-block">{{  Lang::get('auth.reset_password') }} <i
                        class="icon-arrow-right14 position-right"></i></button>
        </div>
    {!! Form::close() !!}
    <!-- /password recovery -->

    </div>
@stop