<!-- Second navbar  -->
<div class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="/"><img src="/images/logored.png" alt=""></a>
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
            <li class="head_create_tournament"><a href="{!! URL::to('tournaments/create') !!}"
                   class="navbar-right btn border-primary text-primary btn-flat border-4">{{ trans('crud.createTournament') }}</a></li>
            {{--<ul class="dropdown-menu dropdown-menu-right icons-right">--}}
            {{--<li><a href="{!! URL::to('/settings')!!}"><i--}}
            {{--class="fa  fa-wrench"></i> {!! Lang::get('core.settings') !!}</a></li>--}}
            {{--<li><a href="{!! URL::to('logs')!!}"><i class="fa fa-clock-o"></i> {!! Lang::get('core.logs') !!}</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}

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
                        <li><a href="{!! URL::to('users')!!}"><i class="icon-users"></i> {!! Lang::get('core.users') !!}
                            </a></li>
                    @endif
                    <li><a href="{!! URL::to('tournaments')!!}"> <i
                                    class="icon-trophy3"></i> {!! trans('crud.admin_tournaments') !!}</a></li>
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
<!-- /second navbar -->