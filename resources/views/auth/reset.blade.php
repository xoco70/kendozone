<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ getenv('APP_NAME') }}</title>

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
                <a href="login_password_recover.html#">
                    <i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
                </a>
            </li>

            <li>
                <a href="login_password_recover.html#">
                    <i class="icon-user-tie"></i> <span class="visible-xs-inline-block position-right"> Contact admin</span>
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

                <!-- Password recovery -->
                {!! Form::open(['action' => 'Auth\PasswordController@postReset']) !!}


                <div class="panel panel-body login-form">
                    @include('layouts.flash')
                    <div class="text-center">
                        <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                        <h5 class="content-group">{{  Lang::get('auth.password_recovery') }} <small class="display-block">{{  Lang::get('auth.we_will_send_instructions') }}</small></h5>
                    </div>

                    <!-- Email field -->
                    <div class="form-group">
                        {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'required' => 'required'])!!}
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

                    <button type="submit" class="btn bg-blue btn-block">{{  Lang::get('auth.send_password') }} <i class="icon-arrow-right14 position-right"></i></button>
                </div>
                {!! Form::close() !!}
                        <!-- /password recovery -->


                <!-- Footer -->
                <div class="footer text-muted">
                    &copy; 2015. <a href="login_advanced.html#">{{ getenv('APP_NAME') }}</a> by <a href="mailto:contact@kendonline.com" target="_blank">Juliatzin</a>
                </div>
                <!-- /footer -->

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