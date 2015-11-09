@extends('master')

@section('title', 'Login')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'sessions.store']) !!}
                        <fieldset>

                            @if (session()->has('flash_message'))
                                <div class="alert alert-success">
                                    {{ session()->get('flash_message') }}
                                </div>
                            @endif

                            @if (session()->has('error_message'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error_message') }}
                                </div>
                            @endif

                            <!-- Email field -->
                            <div class="form-group">
                                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'required' => 'required'])!!}

                            </div>

                            <!-- Password field -->
                            <div class="form-group">
                                {!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control', 'required' => 'required'])!!}

                            </div>

                            <div class="checkbox">
                                <!-- Remember me field -->
                                <div class="form-group">
                                    <label>
                                        {!! Form::checkbox('remember', 'remember') !!} Remember me
                                    </label>
                                </div>
                            </div>

                            <!-- Submit field -->
                            <div class="form-group">
                                {!! Form::submit('Login', ['class' => 'btn btn btn-lg btn-success btn-block']) !!}
                            </div>
                        </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div style="text-align:center">
                    <p><a href="{{ url('forgot_password') }}">Forgot Password?</a></p>

                    <p><strong>Standard User:</strong> user@user.com<br>
                    <strong>Standard User Password:</strong> sentineluser</p>

                    <p><strong>Admin User:</strong> admin@admin.com<br>
                    <strong>Admin Password:</strong> sentineladmin</p>
                </div>


            </div>
        </div>
    </div>

@endsection