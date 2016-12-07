<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">

        <!-- Main navigation -->
        {{--<div class="sidebar-category sidebar-category-visible">--}}
            {{--<div class="category-content no-padding">--}}
                <ul class="navigation navigation-main">
                    <li {{ (Request::is('/') ? 'class=active' : '') }}>
                        <a href="{{ route('dashboard') }}" class="protip"
                           data-pt-title="Dashboard">
                            <i class="icon-display4 position-left sidemenu" title data-original-title="Main"></i>
                            <span>Dashboard</span>

                        </a>
                    </li>

                    {{--Link to directly edit your structure information--}}
                    @include('layouts.displayMyEntityOnLeftSide')


                    <li {{ (Request::is('tournaments') ? 'class=active' : '') }}>
                        <a class="protip" data-pt-title="{{ trans('core.tournaments_created') }}"
                           href="{!! route('tournaments.index') !!}"><i
                                    class="icon-trophy2 position-left sidemenu"></i><span>{{ trans('core.tournaments_created') }}</span>
                        </a>
                    </li>


                    <li {{ (Request::is('users/'.Auth::user()->slug.'/tournaments') ? 'class=active' : '') }}>
                        <a class="protip" data-pt-title="{{ trans('core.participations') }}"
                           href="{!! URL::action('UserController@getMyTournaments', Auth::user()->slug ) !!}">
                            <i class="icon-medal2 position-left sidemenu"></i><span>{{ trans('core.participations') }}</span>
                        </a>
                    </li>

                    @if (Auth::user()->isSuperAdmin() || Auth::user()->invites()->count() > 0)
                        <li {{ (Request::is('invites') ? 'class=active' : '') }}>
                            <a class="protip" data-pt-title="{{ trans_choice('core.invitation',2) }}"
                               href="{!! URL::action('InviteController@index') !!}"><i
                                        class="icon-envelop3 position-left sidemenu"></i><span>{{ trans_choice('core.invitation',2) }}</span>
                            </a>
                        </li>
                    @endif
                <li class="side_avatar">
                    <img src="{!! Auth::getUser()->avatar ?? Avatar::create(Auth::getUser()->email)->toBase64() !!}"
                         alt="kendozone_avatar" class="side_avatar">

                </li>
                </ul>
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>    width: 35px;

