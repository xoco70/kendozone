<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="/"><img src="/images/logo_light.png" alt=""></a>

        {{--<ul class="nav navbar-nav no-border visible-xs-block">--}}
            {{--<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>--}}
        {{--</ul>--}}

        <ul class="nav navbar-nav visible-xs-block">
            <li><a class="sidebar-mobile-main-toggle" data-target="#navbar-mobile"><i class="icon-paragraph-justify3"></i></a></li>
            {{--<ul>--}}
            {{--<li {{ (Request::is('/') ? 'class=active' : '') }}><a href="/"><span>Home</span></a></li>--}}
            {{--<li {{ (Request::is('invites') ? 'class=active' : '') }}><a href="/invites"><span>Torneos</span></a></li>--}}
            {{--</ul>--}}
        </ul>
    </div>


    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li {{ (Request::is('/') ? 'class=active' : '') }}><a href="/"><span>Home</span></a></li>
            <li {{ (Request::is('invites') ? 'class=active' : '') }}><a href="/invites"><span>Torneos</span></a></li>
            {{--<i class="icon-trophy2"></i>--}}

            {{--<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a>--}}
            {{--</li>--}}

        </ul>

        {{--<p class="navbar-text"><span class="label bg-success-400">Online</span></p>--}}

        <ul class="nav navbar-nav navbar-right">

            <li class="user dropdown"><a class="dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"><i
                            class="icon-cog"></i> </a>
                <ul class="dropdown-menu dropdown-menu-right icons-right">

                    {{--<li><a href="{!! URL::to('/settings')!!}"><i--}}
                                    {{--class="fa  fa-wrench"></i> {!! Lang::get('core.settings') !!}</a></li>--}}



                    <li><a href="{!! URL::to('users')!!}"><i class="fa fa-user"></i> {!! Lang::get('core.users') !!}</a></li>
                    <li><a href="{!! URL::to('tournaments')!!}"><i class="fa fa-user"></i> {!! Lang::get('crud.admin_tournaments') !!}</a></li>


                    @can('CanSeeLogs')
                    <li><a href="{!! URL::to('logs')!!}"><i class="fa fa-clock-o"></i> {!! Lang::get('core.logs') !!}
                        </a></li>@endcan
                            <!--<li class="divider"></li>-->

                </ul>
            </li>

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    @if(Auth::check())
                        <img src="{!! Auth::getUser()->avatar !!}" alt="">
                        <span>{!! Auth::getUser()->name !!}</span>
                        <i class="caret"></i>
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{!! URL::to('users/'.Auth::getUser()->slug).'/edit' !!}"><i
                                    class="icon-user"></i> {!! Lang::get('core.profile') !!}</a></li>
                    {{--<li><a href="index.html#"><i ></i> My profile</a></li>--}}
                    {{--<li><a href="index.html#"><i class="icon-coins"></i> My balance</a></li>--}}
                    {{--<li><a href="index.html#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>--}}
                    <li class="divider"></li>
                    {{--<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>--}}
                    <li><a href="{{ url('auth/logout') }}"><i class="icon-switch2"></i> {!! Lang::get('core.logout') !!}
                        </a></li>

                </ul>
            </li>
        </ul>
    </div>
</div>