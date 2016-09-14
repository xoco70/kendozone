<div class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::action('DashboardController@index') }}"><img src="/images/logored.png"
                                                                                           alt=""></a>
        @if(Auth::check())
            <ul class="nav navbar-nav visible-xs-block mt-15">
                <li><a data-toggle="collapse" data-target="#navbar-second-toggle">
                        @include('layouts.avatar')
                    </a>
                </li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3 mobile-menu"></i></a></li>
            </ul>
        @endif
    </div>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav breadcrumbs">
            @yield('breadcrumbs')
        </ul>

        <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
                <li class="head_create_tournament"><a href="{{ URL::action('TournamentController@create') }}"
                                                      class="navbar-right btn border-primary text-primary btn-flat border-4">{{ trans('core.createTournament') }}</a>
                </li>

                <li>
                    <ul class="dropdown-menu dropdown-menu-right icons-right">
                        <li><a href="{!! URL::to('/settings')!!}"><i
                                        class="fa  fa-wrench"></i> {!! Lang::get('core.settings') !!}</a></li>
                        <li><a href="{!! URL::to('logs')!!}"><i
                                        class="fa fa-clock-o"></i> {!! Lang::get('core.logs') !!}
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="dropdown language-switch">
                <a class="dropdown-toggle pl-20 pr-20 " data-toggle="dropdown" aria-expanded="false">
                    @if (App::getLocale() =='es')
                        <img src="/images/flags/MX.png" class="position-left" alt="">
                    @else
                        <img src="/images/flags/GB.png" class="position-left" alt="">
                    @endif


                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="mexico" href="{{ URL::action('LanguageController@update', 'es') }}">
                            <img src="/images/flags/MX.png" alt="Español"> Español</a></li>
                    <li><a class="english" href="{{ URL::action('LanguageController@update', 'en') }}">
                            <img src="/images/flags/GB.png" alt="English"> English</a></li>
                </ul>
            </li>
            @if(Auth::check())
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown" id="dropdown-user">
                        @if(Auth::check())
                            @include('layouts.avatar')
                            <span>{!! Auth::getUser()->name !!}</span>
                            <i class="caret"></i>
                        @endif
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">


                        @if (!Auth::user()->isUser())
                            <li>
                                <a href="{{ route('users.index') }}" id="users">
                                    <i class="icon-users"></i>{!!trans_choice('core.user',2) !!}
                                </a>
                            </li>
                        @endif

                        <li><a href="{{ URL::action('UserController@edit', Auth::getUser()->slug) }}  "><i
                                        class="icon-user"></i> {!! Lang::get('core.profile') !!}</a></li>



                        @if (Auth::user()->isSuperAdmin() || Auth::user()->tournamentsDeleted()->count() > 0)
                            <li {{ (Request::is('tournaments/deleted') ? 'class=active' : '') }}>
                                <a class="protip" data-pt-title="{{ trans('core.tournaments_deleted') }}"
                                   href="{!! URL::action('TournamentController@getDeleted') !!}"><i
                                            class="icon-trash-alt position-left sidemenu"></i><span>{{ trans('core.tournaments_deleted') }}</span>
                                </a>
                            </li>
                        @endif

                        {{--====================================== Logout ======================================--}}
                        <li class="divider"></li>
                        <li><a href="{{  url('/logout') }}" id="logout"><i
                                        class="icon-switch2"></i> {!! Lang::get('core.logout') !!}
                            </a>
                        </li>


                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
<!-- /second navbar -->