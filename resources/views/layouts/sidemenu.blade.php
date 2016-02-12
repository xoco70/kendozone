<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    @if(Auth::check())
                        <a href="{!!   URL::action('UserController@edit',  Auth::user()->id) !!}"
                           class="media-left"><img src="{!! Auth::user()->avatar !!}"
                                                   class="img-circle img-sm" alt=""></a>


                        <div class="media-body">

                            <span class="media-heading text-semibold">{!! Auth::getUser()->name !!}</span>

                            <div class="text-size-mini text-muted">
                                <i class="icon-pin text-size-small"></i>
                                @if (!is_null(Auth::user()->city ))
                                    {!!Auth::user()->city !!}, {!!Auth::user()->country->countryCode!!}
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li>
                                <a href="{!! URL::to('/settings')!!}"><i class="icon-cog3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Menu</span> <i class="icon-menu" title="Menu"></i></li>
                    <li {{ ((Request::is('admin') || Request::is('/')) ? 'class=active' : '') }}><a href="/admin"><i
                                    class="icon-home4"></i> <span>Dashboard</span></a></li>
                    <li {{ (Request::is('tournaments') ? 'class=active' : '') }}><a href="/tournaments"><i
                                    class="icon-trophy2"></i> <span>Torneos</span></a></li>
                    {{--                    <li {{ (Request::is('places') ? 'class=active' : '') }}><a href="/places"><i class="icon-location4"></i> <span>Lugares</span></a></li>--}}
                    <li {{ (Request::is('invites') ? 'class=active' : '') }}><a href="/invites"><i
                                    class="icon-envelop3"></i> <span>{{trans_choice('crud.invitation',2)}}</span></a>
                    </li>
                    <li class="navigation-divider"></li>

                    @if(Auth::check())
                    <li {{ (Request::is('users/'.Auth::getUser()->id.'/edit') ? 'class=active' : '') }}><a
                                href="{!! URL::to('users/'.Auth::getUser()->slug).'/edit' !!}"><i
                                    class="icon-user"></i> <span>{{trans('core.profile')}}</span></a></li>
                    @endif
                    {{--<li {{ (Request::is('settings') ? 'class=active' : '') }}><a href="/settings"><i--}}
                    {{--class="icon-cog"></i> <span>{{trans('core.settings')}}</span></a></li>--}}
                    <li><a href="{{ url('auth/logout') }}"><i
                                    class="icon-switch2"></i> <span>{{trans('core.logout')}}</span></a></li>


                </ul>
            </div>
        </div>
    </div>
</div>

