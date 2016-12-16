<div class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('dashboard') }}"><img src="/images/logored.png"
                                                                     alt=""></a>

        <ul class="nav navbar-nav visible-xs-block mt-15">
            <li class="dropdown language-switch-mobile">
                <a data-toggle="collapse" data-target="#navbar-second-toggle">
                    @include('layouts.language')
                </a>
            </li>
            <li><a data-toggle="collapse" data-target="#navbar-second-toggle">
                    @include('layouts.avatar')
                </a>
            </li>
            <li>
                <a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3 mobile-menu"></i></a>
            </li>


        </ul>

    </div>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav breadcrumbs">
            @yield('breadcrumbs')
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="head_create_tournament mr-20">
                <a href="{{ URL::action('TournamentController@create') }}"
                   class="navbar-right btn border-primary text-primary btn-flat border-3 p-10 mt-7">{{ trans('core.createTournament') }}
                </a>
            </li>
            <li class="dropdown language-switch-desktop">
                @include('layouts.language')
            </li>
            <li class="dropdown dropdown-user mt-7">
                <a class="dropdown-toggle" data-toggle="dropdown" id="dropdown-user">
                    @include('layouts.avatar')
                    <span>{!! Auth::getUser()->name !!}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{ URL::action('UserController@edit', Auth::getUser()->slug) }}  "><i
                                    class="icon-user"></i> {!! Lang::get('core.profile') !!}</a></li>

                    @if (Auth::user()->isSuperAdmin() || Auth::user()->tournamentsDeleted()->count() > 0)
                        <li {{ (Request::is('tournaments/deleted') ? 'class=active' : '') }}>
                            <a class="protip" data-pt-title="{{ trans('core.tournaments_deleted') }}"
                               href="{!! URL::action('TournamentController@getDeleted') !!}"><i
                                        class="icon-trash-alt  sidemenu"></i><span>{{ trans('core.tournaments_deleted') }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->isSuperAdmin())
                        <li><a href="{!! URL::to('logs')!!}">
                                <i class="icon-file-text"></i> {!! Lang::get('core.logs') !!}
                            </a>
                        </li>
                        <li><a href="{!! URL::to('auth/oauth')!!}">
                                <i class="icon-lock5"></i>Tokens
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
        </ul>
    </div>
</div>
<!-- /second navbar -->