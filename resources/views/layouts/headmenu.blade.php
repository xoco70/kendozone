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

                        @if (Auth::user()->isSuperAdmin())

                            <li>
                                <a class="protip" data-pt-title="{{ trans_choice('core.federation',2) }}"
                                   href="{!! route('federations.index') !!}" id="federations"><i
                                            class="icon-earth position-left sidemenu"></i><span>{{ trans_choice('core.federation',2) }}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->isSuperAdmin() || Auth::user()->isFederationPresident())
                            <li>
                                <a class="protip" data-pt-title="{{ trans_choice('core.association',2) }}"
                                   id="associations"
                                   href="{!! URL::action('AssociationController@index') !!}"><i
                                            class="icon-flag7 position-left sidemenu"></i><span>{{ trans_choice('core.association',2) }}</span>
                                </a>
                            </li>
                        @endif
                        @if (!Auth::user()->isUser() && !Auth::user()->isClubPresident())
                            <li>
                                <a id="clubs" class="protip" data-pt-title="{{ trans('core.clubs') }}"
                                   href="{!! URL::action('ClubController@index') !!}"><i
                                            class="icon-bookmark2 position-left sidemenu"></i><span>{{ trans_choice('core.club',2) }}</span>
                                </a>
                            </li>
                        @endif
                        @if (!Auth::user()->isUser())
                            <li>
                                <a href="{{ URL::action('UserController@index') }}" id="users">
                                    <i class="icon-users"></i>{!!trans_choice('core.user',2) !!}
                                </a>
                            </li>
                        @endif

                        <li><a href="{{ URL::action('UserController@edit', Auth::getUser()->slug) }}  "><i
                                        class="icon-user"></i> {!! Lang::get('core.profile') !!}</a></li>


                        {{--Link to directly edit your structure information--}}
                        @if (Auth::user()->isFederationPresident() && Auth::user()->federationOwned!=null)
                            <li>
                                <a href="{{  URL::action('FederationController@edit', Auth::user()->federationOwned->id ) }}">
                                    <i
                                            class="icon-starburst"></i>{{  Auth::user()->federationOwned->name }}
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->isAssociationPresident() && Auth::user()->associationOwned!=null)
                            <li>
                                <a href="{{  URL::action('AssociationController@edit', Auth::user()->associationOwned->id ) }}">
                                    <i
                                            class="icon-starburst"></i>{{  Auth::user()->associationOwned->name }}
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->isClubPresident() && Auth::user()->clubOwned!=null)
                            <li>
                                <a href="{{  URL::action('ClubController@edit', Auth::user()->clubOwned->id ) }}">
                                    <i
                                            class="icon-starburst"></i>{{  Auth::user()->clubOwned->name }}
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