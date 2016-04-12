<!-- Second navbar  -->
<div class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::action('DashboardController@index') }}"><img src="/images/logored.png" alt=""></a>
        <ul class="nav navbar-nav visible-xs-block mt-15">
            <li><a data-toggle="collapse" data-target="#navbar-second-toggle"><img src="{!! Auth::getUser()->avatar !!}" width="28" alt="kendozone_avatar"></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav breadcrumbs">
            @yield('breadcrumbs')
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="head_create_tournament"><a href="{{ URL::action('TournamentController@create') }}"
                   class="navbar-right btn border-primary text-primary btn-flat border-4">{{ trans('core.createTournament') }}</a></li>
            {{--<ul class="dropdown-menu dropdown-menu-right icons-right">--}}
            {{--<li><a href="{!! URL::to('/settings')!!}"><i--}}
            {{--class="fa  fa-wrench"></i> {!! Lang::get('core.settings') !!}</a></li>--}}
            {{--<li><a href="{!! URL::to('logs')!!}"><i class="fa fa-clock-o"></i> {!! Lang::get('core.logs') !!}</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            <li class="dropdown language-switch">
                <a class="dropdown-toggle pl-20 pr-20 " data-toggle="dropdown" aria-expanded="false">
                    @if (LaravelLocalization::getCurrentLocale() =='en')
                        <img src="/images/flags/GB.png" class="position-left" alt="">
                    @elseif (LaravelLocalization::getCurrentLocale() =='es')
                        <img src="/images/flags/MX.png" class="position-left" alt="">
                    @else
                        <img src="/images/flags/{{LaravelLocalization::getCurrentLocale()}}.png" class="position-left" alt="">
                    @endif


                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="mexico" href="{{  LaravelLocalization::getLocalizedURL('es', Request::url()) }}"><img src="/images/flags/MX.png" alt=""> Español</a></li>
                    <li><a class="english" href="{{  LaravelLocalization::getLocalizedURL('en', Request::url()) }}"><img src="/images/flags/GB.png" alt=""> English</a></li>

                    {{--<li><a class="mexico" href="{{  LaravelLocalization::getLocalizedURL(LaravelLocalization::setLocale('es'), LaravelLocalization::getNonLocalizedURL(Request::url())) }}"><img src="/images/flags/MX.png" alt=""> Español</a></li>--}}
                    {{--<li><a class="english" href="{{  LaravelLocalization::getLocalizedURL(LaravelLocalization::setLocale('en'), LaravelLocalization::getNonLocalizedURL(Request::url())) }}"><img src="/images/flags/GB.png" alt=""> English</a></li>--}}
                </ul>
            </li>

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    @if(Auth::check())
                        <img src="{!! Auth::getUser()->avatar !!}" alt="kendozone_avatar">
                        <span>{!! Auth::getUser()->name !!}</span>
                        <i class="caret"></i>
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-right">

                    @if (Auth::user()->isSuperAdmin())

                        <li><a href="{{ URL::action('UserController@index') }} "><i class="icon-users"></i> {!! trans_choice('core.user',2) !!}
                            </a></li>
                    @endif
                    <li><a href="{{ URL::action('UserController@edit', Auth::getUser()->slug) }}  "><i class="icon-user"></i> {!! Lang::get('core.profile') !!}</a></li>
                    <li class="divider"></li>
                    <li><a href="{{  URL::action('Auth\AuthController@getLogout') }}"><i class="icon-switch2"></i> {!! Lang::get('core.logout') !!}
                        </a></li>

                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /second navbar -->