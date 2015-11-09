@extends('app')

@section('content')

        <!-- resources/views/auth/login.blade.php -->
<div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
        <h1 class="text-center login-title">Conectate a Kendo Online</h1>
        <div class="account-wall">
            <div align="center">
                {!! Html::image('images/logo.png', 'Logo Kendo Online', array( 'width' => 100, )) !!}
            </div>
            <form class="form-signin" method="POST" action="{!!   URL::to('/auth/login') !!}">
                {!! csrf_field() !!}
                <input type="email" name="email" class="form-control" placeholder="Email" required autofocus value="{{ old('email') }}">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
                <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                <a href="{!! URL::to('password/email') !!}" class="pull-right need-help">Lost password? </a><span class="clearfix"></span>
            </form>
        </div>
        <a href="{!! URL::to('auth/register') !!}" class="text-center new-account">Create an account </a>
		<!--<a href="/password/email" class="text-center new-account">Forgot Your Password?</a>-->
    </div>
</div>
@include('errors.list')
@endsection