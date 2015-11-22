<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kendonline</title>

    <!-- Global stylesheets -->

    {!! Html::style('css/icons/icomoon/styles.css')!!}
    {!! Html::style('https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900')!!}
    {!! Html::style('css/bootstrap.css')!!}
    {!! Html::style('css/core.css')!!}
    {!! Html::style('css/components.css')!!}
    {!! Html::style('css/colors.css')!!}
            <!-- /global stylesheets -->

    <!-- Core JS files -->
    {!! Html::script('js/plugins/loaders/pace.min.js') !!}
    {!! Html::script('js/core/libraries/jquery.min.js') !!}
    {!! Html::script('js/core/libraries/bootstrap.min.js') !!}
    {!! Html::script('js/plugins/loaders/blockui.min.js') !!}
            {{--<!-- /core JS files -->--}}
    {{--<!-- Theme JS files -->--}}
    {!! Html::script('js/plugins/forms/styling/uniform.min.js') !!}
    {!! Html::script('js/core/app.js') !!}
    {!! Html::script('js/pages/login.js') !!}
            <!-- /theme JS files -->


</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html"><img src="/images/logo_light.png" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="login_advanced.html#">
                    <i class="icon-display4"></i> <span
                            class="visible-xs-inline-block position-right"> Go to website</span>
                </a>
            </li>

            <li>
                <a href="login_advanced.html#">
                    <i class="icon-user-tie"></i> <span
                            class="visible-xs-inline-block position-right"> Contact admin</span>
                </a>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-cog3"></i>
                    <span class="visible-xs-inline-block position-right"> Options</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container login-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">
                <!-- Advanced login -->
                <form id="login-form" class="login-form" method="POST" action="{!!   URL::to('/auth/login') !!}">
                    @include('layouts.flash')

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
                            <li><a href="{!! URL::to('/auth/login/twitter') !!}"
                                   class="btn border-info text-info btn-flat btn-icon btn-rounded"><i
                                            class="icon-twitter"></i></a></li>
                        </ul>

                        <div class="content-divider text-muted form-group"><span>{{  Lang::get('auth.no_account') }}</span></div>
                        <a href="{!! URL::to('auth/register') !!}" class="btn btn-default btn-block content-group">{{  Lang::get('auth.signup') }}</a>
                        {{--<span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a--}}
                                    {{--href="login_advanced.html#">Terms &amp; Conditions</a> and <a--}}
                                    {{--href="login_advanced.html#">Cookie Policy</a></span>--}}
                    </div>
                    @include('errors.list')

                </form>

                        <!-- /advanced login -->


                @include('layouts.footer')

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>

