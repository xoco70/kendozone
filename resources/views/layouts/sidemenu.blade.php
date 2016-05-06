<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <li {{ (Request::is('/') ? 'class=active' : '') }}>
                        <a href="{{ URL::action('DashboardController@index') }}" class="protip" data-pt-title="Dashboard"><i class="icon-display4 position-left sidemenu" title data-original-title="Main pages"></i>
                            <span>Dashboard</span>

                        </a>
                    </li>

                    <li {{ (Request::is('tournaments') ? 'class=active' : '') }}>
                        <a class="protip" data-pt-title="{{ trans('core.tournaments_created') }}" href="{!! URL::action('TournamentController@index') !!}"><i
                                    class="icon-trophy2 position-left sidemenu"></i><span>{{ trans('core.tournaments_created') }}</span>
                        </a>
                    </li>
                    <li {{ (Request::is('users/'.Auth::user()->slug.'/tournaments') ? 'class=active' : '') }}>
                        <a class="protip" data-pt-title="{{ trans('core.participations') }}" href="{!! URL::action('UserController@getMyTournaments', Auth::user()->slug ) !!}">
                            <i class="icon-medal2 position-left sidemenu"></i><span>{{ trans('core.participations') }}</span>
                        </a>
                    </li>
                    <li {{ (Request::is('invites') ? 'class=active' : '') }}>
                        <a class="protip" data-pt-title="{{ trans_choice('core.invitation',2) }}" href="{!! URL::action('InviteController@index') !!}"><i
                                    class="icon-envelop3 position-left sidemenu"></i><span>{{ trans_choice('core.invitation',2) }}</span>
                        </a>
                    </li>
                    <li {{ (Request::is('tournaments/deleted') ? 'class=active' : '') }}>
                        <a class="protip" data-pt-title="{{ trans('core.tournaments_deleted') }}" href="{!! URL::action('TournamentController@getDeleted') !!}"><i
                                    class="icon-trash-alt position-left sidemenu"></i><span>{{ trans('core.tournaments_deleted') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

