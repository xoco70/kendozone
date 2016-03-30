<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">

        <!-- User menu -->
        {{--<div class="sidebar-user" id="sidemenu">--}}
        {{--<div class="category-content">--}}
        {{--<div class="media">--}}
        {{--@if(Auth::check())--}}
        {{--<a href="{!!   URL::action('UserController@edit',  Auth::user()->id) !!}"--}}
        {{--class="media-left"><img src="{!! Auth::user()->avatar !!}"--}}
        {{--class="img-circle img-sm" alt=""></a>--}}


        {{--<div class="media-body">--}}

        {{--<span class="media-heading text-semibold">{!! Auth::getUser()->name !!}</span>--}}

        {{--<div class="text-size-mini text-muted">--}}
        {{--<i class="icon-pin text-size-small"></i>--}}
        {{--@if (!is_null(Auth::user()->city ))--}}
        {{--{!!Auth::user()->city !!}, {!!Auth::user()->country->countryCode!!}--}}
        {{--@endif--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--@endif--}}
        {{--<div class="media-right media-middle">--}}
        {{--<ul class="icons-list">--}}
        {{--<li>--}}
        {{--<a href="{!! URL::to('/settings')!!}"><i class="icon-cog3"></i></a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
                <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <li {{ (Route::getCurrentRoute()->getActionName() == null ? 'class=active' : '') }}>
                        <a href="/"><i class="icon-display4 position-left sidemenu"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li {{ (Route::getCurrentRoute()->getActionName() == 'invites.index' ? 'class=active' : '') }}>
                        <a href="{!! URL::action('InviteController@index') !!}"><i
                                    class="icon-trophy2 position-left sidemenu"></i><span>{{ trans_choice('crud.tournament',2) }}</span>
                        </a>
                    </li>
                    <li {{ (Route::getCurrentRoute()->getActionName() == 'users.tournaments' ? 'class=active' : '') }}>
                        <a href="{!! URL::action('UserController@getMyTournaments', Auth::user()->slug ) !!}">
                            <i class="icon-medal2 position-left sidemenu"></i><span>{{ trans_choice('crud.tournament',2) }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

