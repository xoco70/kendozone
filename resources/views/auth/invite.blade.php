<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{!!  getenv('APP_NAME')!!}</title>


    <!-- Global stylesheets -->

    {!! Html::style('css/icons/icomoon/styles.css')!!}
    {!! Html::style('https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900')!!}
    {!! Html::style('css/bootstrap.css')!!}
    {!! Html::style('css/core.css')!!}
    {!! Html::style('css/components.css')!!}
    {!! Html::style('css/colors.css')!!}
            <!-- /global stylesheets -->

    <!-- Core JS files -->
    {{--{!! Html::script('js/plugins/loaders/pace.min.js') !!}--}}
    {!! Html::script('js/core/libraries/jquery.min.js') !!}
    {!! Html::script('js/core/libraries/bootstrap.min.js') !!}
    {{--{!! Html::script('js/plugins/loaders/blockui.min.js') !!}--}}
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
                <a href="login_registration_advanced.html#">
                    <i class="icon-display4"></i> <span
                            class="visible-xs-inline-block position-right"> Go to website</span>
                </a>
            </li>

            <li>
                <a href="login_registration_advanced.html#">
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
                <!-- Registration form -->
                @include("errors.list")
                {!! Form::open(['url'=>URL::to('/auth/invite') , 'class'=> "form-signin"]) !!}
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        @include('layouts.flash')

                        <div class="panel">
                            <div class="panel-body">
                                <div class="text-center">

                                    <div class="icon-object border-success text-success"><i class="icon-plus3"></i>
                                    </div>
                                    <h5 class="content-group-lg">{{  Lang::get('auth.title_register') }}
                                        <small class="display-block">{{  Lang::get('core.all_fields_required') }}</small>
                                    </h5>
                                </div>


                                <div class="row">
                                    <div class="col-lg-6 col-lg-offset-3">
                                        <div class="form-group has-feedback">
                                            <input type="text" name="name" class="form-control" id=""
                                                   value="{{ old('name') }}"
                                                   placeholder="{{  Lang::get('auth.choose_username') }}">

                                            <div class="form-control-feedback">
                                                <i class="icon-user-plus text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!!   Form::hidden('token', $token) !!}


                                <div class="row">
                                    <div class="col-lg-6 col-lg-offset-3">
                                        <div class="form-group has-feedback">
                                            <input type="password" id="password" name="password"
                                                   placeholder="{{  Lang::get('auth.create_password') }}"
                                                   class="form-control">

                                            <div class="form-control-feedback">
                                                <i class="icon-user-lock text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-lg-offset-3">
                                        <div class="form-group has-feedback">
                                            <input type="password" id="password_confirmation"
                                                   name="password_confirmation"
                                                   placeholder="{{  Lang::get('auth.repeat_password') }}"
                                                   class="form-control">

                                            <div class="form-control-feedback">
                                                <i class="icon-user-lock text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--{!!   Form::hidden('roleId', $roleId) !!}--}}

                                <div class="text-right">
                                    <button type="submit"
                                            class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10">
                                        <b><i class="icon-plus3"></i></b>{{  Lang::get('auth.create_account') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {!! Form::close()!!}
                        <!-- /registration form -->


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