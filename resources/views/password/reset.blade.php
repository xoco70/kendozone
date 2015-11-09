@extends('master')

@section('title', 'Password Reset')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reset Password</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'Auth\PasswordController@postReset']) !!}
                        <fieldset>

                            @if (session()->has('flash_message'))
                                <div class="alert alert-success">
                                    {{ session()->get('flash_message') }}
                                </div>
                            @endif

                            @if (session()->has('error_message'))
                                <div class="alert alert-daner">
                                    {{ session()->get('error_message') }}
                                </div>
                            @endif

                            <!-- Email field -->
                            <div class="form-group">
                                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'required' => 'required'])!!}
                                {!! errors_for('email', $errors) !!}
                            </div>

                            <!-- Password field -->
                            <div class="form-group">
                                {!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control', 'required' => 'required'])!!}
                                {!! errors_for('password', $errors) !!}
                            </div>

                            <!-- Password confirmation field -->
                            <div class="form-group">
                                {!! Form::password('password_confirmation', ['placeholder' => 'Password confirmation','class' => 'form-control', 'required' => 'required'])!!}
                                {!! errors_for('password', $errors) !!}
                            </div>

                            <!-- Hidden Token field -->
                            {!! Form::hidden('token', $token )!!}


                            <!-- Submit field -->
                            <div class="form-group">
                                {!! Form::submit('Reset Password', ['class' => 'btn btn btn-lg btn-primary btn-block']) !!}
                            </div>
                        </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection