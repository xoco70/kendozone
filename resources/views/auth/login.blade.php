@extends('layouts.guest')

@section('content')
    {{--<div class="row">--}}


        <div class="col-md-4 col-md-offset-2 col-sm-6 col-sm-offset-3  col-xs-12">
            <form id="login-form" class="login-form" method="POST"
                  action="{!!   URL::action('Auth\LoginController@login') !!}">

                {!! csrf_field() !!}
                <div class="panel panel-body login-form">
                    <div class="text-center pt-10 pb-20">
                        <div class="pb-10"><img src="/images/logo_kendozone_guest_beta.png" width=200"/></div>

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
                               placeholder="{{  trans('auth.password') }}" required>

                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group login-options">
                        <div class="row">
                            <div class="col-xs-6">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="remember-me" class="styled" checked="checked">
                                    {{  trans('auth.remember') }}
                                </label>
                            </div>

                            <div class="col-xs-6 text-right">
                                <a href="{!! URL::action('Auth\ForgotPasswordController@showLinkRequestForm') !!}">{{  trans('auth.lost_password') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="login"
                                class="btn bg-success btn-block p-10">{{  trans('auth.signin') }}
                            <i
                                    class="icon-arrow-right14 position-right"></i></button>
                    </div>

                    <div class="content-divider text-muted form-group"><span>{{  trans('auth.signin_with') }}</span>
                    </div>
                    <ul class="list-inline form-group list-inline-condensed text-center">
                        <li><a href="{!! URL::action('Auth\LoginController@getSocialAuth','facebook') !!}"
                               class="btn border-indigo text-indigo btn-flat btn-icon btn-rounded" id="fb"><i
                                        class="icon-facebook"></i></a></li>
                        <li><a href="{!! URL::action('Auth\LoginController@getSocialAuth', 'google') !!}"
                               class="btn border-danger text-danger btn-flat btn-icon btn-rounded" id="google"><i
                                        class="icon-google"></i></a></li>
                    </ul>

                    <div class="content-divider text-muted form-group"><span>{{  trans('auth.no_account') }}</span>
                    </div>

                    <div class="mt-20">
                        <a class="btn full-width text-primary border-primary border-4 text-uppercase "
                           href="{!! URL::action('Auth\RegisterController@showRegistrationForm') !!}">{{  trans('auth.signup') }}</a>
                    </div>
                </div>


            </form>
        </div>
        <div class="col-md-4 col-md-offset-1 col-md-pull-1 hidden-xs hidden-sm">

            <div class="panel panel-nav">
                <div class="panel-heading">
                    <h6 class="panel-title">{{ trans('help.contribute') }}!</h6>
                </div>
                <div class="panel-body">

                    <p>{{ trans('help.contribute_text_1') }}:
                        <a href="https://github.com/xoco70/laravel-tournaments" target="_blank">
                            <div class="pb-10 " align="center"><img src="/images/brands/github.png" width=200"/></div>
                        </a></p>
                    <p><strong>{{ trans('help.translate_kz') }}</strong> </p>
                    <p>{{ trans('help.translate_kz_text_1') }}
                    <ul>
                        <li>{{ trans('core.english') }} ({{ intval($langStats['en'] * 100 / $langStats['es']) }}%)</li>
                        <li>{{ trans('core.spanish') }} ({{ intval($langStats['es'] * 100 / $langStats['es']) }}%)</li>
                        <li>{{ trans('core.french') }} ({{intval($langStats['fr'] * 100 / $langStats['es']) }}%)</li>
                        <li>{{ trans('core.japonese') }} ({{intval($langStats['ja'] * 100 / $langStats['es']) }}%)</li>
                    </ul>
                    <p class="text-muted"><strong>{{ trans('help.note') }}</strong>: {{ trans('help.translate_kz_note') }}.
                    {{ trans('help.translate_kz_note2') }}</p>
                </div>
            </div>
        </div>
    {{--</div>--}}
    <!-- /advanced login -->
@stop
