@extends('layouts.guest')

@section('content')
<form id="login-form" class="login-form" method="POST" action="{!!   URL::to('/auth/login') !!}">

    {!! csrf_field() !!}
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
            <h5 class="content-group">{{  Lang::get('auth.login_to_your_account') }}
                <small class="display-block">{{  Lang::get('auth.credentials') }}</small>
            </h5>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input type="email" name="email" class="form-control" placeholder="Email" required autofocus
                   value="{{ old('email') }} " required>

            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input type="password" name="password" id="password" class="form-control"
                   placeholder="{{  Lang::get('auth.password') }}" required>

            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>

        <div class="form-group login-options">
            <div class="row">
                <div class="col-sm-6">
                    <label class="checkbox-inline">
                        <input type="checkbox" value="remember-me" class="styled" checked="checked">
                        {{  Lang::get('auth.remember') }}
                    </label>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{!! URL::to('password/email') !!}">{{  Lang::get('auth.lost_password') }}</a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn bg-blue btn-block">{{  Lang::get('auth.signin') }} <i
                        class="icon-arrow-right14 position-right"></i></button>
        </div>

        <div class="content-divider text-muted form-group"><span>{{  Lang::get('auth.signin_with') }}</span></div>
        <ul class="list-inline form-group list-inline-condensed text-center">
            <li><a href="{!! URL::to('/auth/login/facebook') !!}"
                   class="btn border-indigo text-indigo btn-flat btn-icon btn-rounded"><i
                            class="icon-facebook"></i></a></li>
            <li><a href="{!! URL::to('/auth/login/google') !!}"
                   class="btn border-danger text-danger btn-flat btn-icon btn-rounded"><i
                            class="icon-google"></i></a></li>
        </ul>

        <div class="content-divider text-muted form-group"><span>{{  Lang::get('auth.no_account') }}</span></div>
        <a href="{!! URL::to('auth/register') !!}"
           class="btn btn-default btn-block content-group">{{  Lang::get('auth.signup') }}</a>
        {{--<span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a--}}
        {{--href="login_advanced.html#">Terms &amp; Conditions</a> and <a--}}
        {{--href="login_advanced.html#">Cookie Policy</a></span>--}}
    </div>


</form>

<!-- /advanced login -->

@stop

