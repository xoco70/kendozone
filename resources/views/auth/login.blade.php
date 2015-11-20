<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>Webarch - Responsive Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <script type="text/javascript">
        //<![CDATA[
        try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"4792121b0dfcd7990f241706dab87e44",petok:"c8ccfa4a02698ed21050687fb886a4acad44c07d-1448043986-1800",zone:"revox.io",rocket:"0",apps:{"ga_key":{"ua":"UA-56895490-1","ga_bs":"1"}},sha2test:0}];!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="//ajax.cloudflare.com/cdn-cgi/nexp/dok3v=247a80cdfa/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
        //]]>
    </script>
    {!! Html::style('plugins/pace/pace-theme-flash.css',['media' => 'screen'])!!}
    {!! Html::style('plugins/boostrapv3/css/bootstrap.min.css')!!}
    {!! Html::style('plugins/font-awesome/css/font-awesome.css')!!}
    {!! Html::style('css/animate.min.css')!!}
    {!! Html::style('css/style.css')!!}
    {!! Html::style('css/animate.min.css')!!}
    {!! Html::style('css/responsive.css')!!}
    {!! Html::style('css/custom-icon-set.css')!!}



    {!! Html::script('js/plugins/jquery.min.js') !!}





    <script type="text/javascript">
        /* <![CDATA[ */
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-56895490-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

        /* ]]> */
    </script>
</head>


<body class="error-body no-top">
<div class="container">
    <div class="row login-container column-seperation">
        <div class="col-md-5 col-md-offset-1">
            <div align="center">
                {!! Html::image('images/logo.png', 'Logo Kendo Online', array( 'width' => 100, )) !!}
            </div>

            <h2>Sign in to webarch</h2>
            <p>Use Facebook, Twitter or your email to sign in.<br>
                <a href="{!! URL::to('auth/register') !!}">Sign up Now!</a> for a webarch account,It's free and always will be..</p>
            <br>
            <button class="btn btn-block btn-info col-md-8" type="button">
                <span class="pull-left"><i class="icon-facebook"></i></span>
                <span class="bold">Login with Facebook</span> </button>
            <button class="btn btn-block btn-success col-md-8" type="button">
                <span class="pull-left"><i class="icon-twitter"></i></span>
                <span class="bold">Login with Twitter</span>
            </button>
        </div>
        <div class="col-md-5 "> <br>

            <form id="login-form" class="login-form" method="POST" action="{!!   URL::to('/auth/login') !!}">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="form-group col-md-10">
                        <label class="form-label">Username</label>
                        <div class="controls">
                            <div class="input-with-icon  right">
                                <i class=""></i>
                                <input type="email" name="email" class="form-control" placeholder="Email" required autofocus value="{{ old('email') }} " required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-10">
                        <label class="form-label">Password</label>
                        <span class="help"></span>
                        <div class="controls">
                            <div class="input-with-icon  right">
                                <i class=""></i>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="control-group  col-md-10">
                        <div class="checkbox checkbox check-success"> <a href="{!! URL::to('password/email') !!}">{{  Lang::get('auth.lost_password') }}</a>&nbsp;&nbsp;
                            <input type="checkbox" value="remember-me">
                            <label for="checkbox">{{  Lang::get('auth.remember') }} </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <button class="btn btn-primary btn-cons pull-right" type="submit">{{  Lang::get('auth.signin') }}</button>
                    </div>
                </div>
            </form>

        </div>
        @include('errors.list')
    </div>
</div>


{!! Html::script('plugins/jquery-1.8.3.min.js') !!}
{!! Html::script('plugins/bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('plugins/pace/pace.min.js') !!}
{!! Html::script('plugins/jquery-validation/js/jquery.validate.min.js') !!}
{!! Html::script('js/login.js') !!}

</body>
</html>



{{--@extends('app')--}}

{{--@section('content')--}}

        {{--<!-- resources/views/auth/login.blade.php -->--}}
{{--<div class="row">--}}
    {{--<div class="col-sm-6 col-md-4 col-md-offset-4">--}}
        {{--<h1 class="text-center login-title">{{  Lang::get('auth.title_login') }}</h1>--}}
        {{--<div class="account-wall">--}}
        {{--</div>--}}
        {{--<a href="{!! URL::to('auth/register') !!}" class="text-center new-account">{{  Lang::get('auth.create_account') }} </a>--}}
		{{--<!--<a href="/password/email" class="text-center new-account">Forgot Your Password?</a>-->--}}
    {{--</div>--}}
{{--</div>--}}
{{--@include('errors.list')--}}
{{--@endsection--}}