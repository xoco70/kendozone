<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <li {{ (Request::is('/') ? 'class=active' : '') }}>
                        <a href="{{ route('dashboard') }}" class="protip"
                           data-pt-title="Dashboard">
                            <i class="icon-display4 position-left sidemenu" title data-original-title="Main"></i>
                            <span>Dashboard</span>

                        </a>
                    </li>

                    {{--Link to directly edit your structure information--}}
                    @if (Auth::user()->isFederationPresident() && Auth::user()->federationOwned!=null)
                        <li>
                            <a class="protip" data-pt-title="{{ Auth::user()->federationOwned->name }}"
                               href="{{  URL::action('FederationController@edit', Auth::user()->federationOwned->id ) }}">
                                <i class="icon-starburst"></i><span>{{  Auth::user()->federationOwned->name }}</span>
                            </a>
                        </li>
                    @endif



                    @if (Auth::user()->isAssociationPresident() && Auth::user()->associationOwned!=null)
                        <li>
                            <a class="protip" data-pt-title="{{ Auth::user()->associationOwned->name  }}"
                                href="{{  URL::action('AssociationController@edit', Auth::user()->associationOwned->id ) }}">
                                <i class="icon-starburst"></i><span>{{  Auth::user()->associationOwned->name }}</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->isClubPresident() && Auth::user()->clubOwned!=null)
                        <li>
                            <a class="protip" data-pt-title="{{ Auth::user()->clubOwned->name  }}">
                                href="{{  URL::action('ClubController@edit', Auth::user()->clubOwned->id ) }}">
                                <i class="icon-starburst"></i><span>{{  Auth::user()->clubOwned->name }}</span>
                            </a>
                        </li>
                    @endif

                    {{--@if (Auth::user()->isSuperAdmin())--}}
                        {{--<li>--}}
                            {{--<a class="protip" data-pt-title="{{ trans_choice('core.federation',2) }}"--}}
                               {{--href="{!! route('federations.index') !!}" id="federations">--}}
                                {{--<i class="icon-earth position-left sidemenu"></i>--}}
                                {{--<span>{{ trans_choice('core.federation',2) }}</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--@endif--}}

                    {{--@if (Auth::user()->isSuperAdmin() || Auth::user()->isFederationPresident())--}}
                        {{--<li>--}}
                            {{--<a class="protip" data-pt-title="{{ trans_choice('core.association',2) }}"--}}
                               {{--id="associations"--}}
                               {{--href="{!! URL::action('AssociationController@index') !!}">--}}
                                {{--<i class="icon-flag7 position-left sidemenu"></i>--}}
                                {{--<span>{{ trans_choice('core.association',2) }}</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--@endif--}}
                    {{--@if (!Auth::user()->isUser() && !Auth::user()->isClubPresident())--}}
                        {{--<li>--}}
                            {{--<a class="protip" data-pt-title="{{ trans_choice('core.club',2) }}"--}}
                               {{--id="associations"--}}
                               {{--href="{!! URL::action('ClubController@index') !!}">--}}
                                {{--<i class="icon-bookmark2 position-left sidemenu"></i>--}}
                                {{--<span>{{ trans_choice('core.club',2) }}</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--@endif--}}

{{--                    @if(Auth::user()->isSuperAdmin() || Auth::user()->tournaments()->count())--}}
                        <li {{ (Request::is('tournaments') ? 'class=active' : '') }}>
                            <a class="protip" data-pt-title="{{ trans('core.tournaments_created') }}"
                               href="{!! route('tournaments.index') !!}"><i
                                        class="icon-trophy2 position-left sidemenu"></i><span>{{ trans('core.tournaments_created') }}</span>
                            </a>
                        </li>

                    {{--@endif--}}

{{--                    @if (Auth::user()->isSuperAdmin() || Auth::user()->myTournaments()->count() > 0)--}}
                        <li {{ (Request::is('users/'.Auth::user()->slug.'/tournaments') ? 'class=active' : '') }}>
                            <a class="protip" data-pt-title="{{ trans('core.participations') }}"
                               href="{!! URL::action('UserController@getMyTournaments', Auth::user()->slug ) !!}">
                                <i class="icon-medal2 position-left sidemenu"></i><span>{{ trans('core.participations') }}</span>
                            </a>
                        </li>
                    {{--@endif--}}

                    @if (Auth::user()->isSuperAdmin() || Auth::user()->invites()->count() > 0)
                        <li {{ (Request::is('invites') ? 'class=active' : '') }}>
                            <a class="protip" data-pt-title="{{ trans_choice('core.invitation',2) }}"
                               href="{!! URL::action('InviteController@index') !!}"><i
                                        class="icon-envelop3 position-left sidemenu"></i><span>{{ trans_choice('core.invitation',2) }}</span>
                            </a>
                        </li>
                    @endif


                </ul>
            </div>
        </div>
    </div>
</div>

