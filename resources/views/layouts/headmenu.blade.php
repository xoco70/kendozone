<!-- Second navbar  -->
<div class="navbar navbar-default navbar-fixed-top" id="navbar-second">
    <div class="navbar-header">
        <a class="navbar-brand" href="/"><img src="/images/logo_dark.png" alt=""></a>
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-right collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i
                            class="icon-paragraph-justify3"></i></a></li>
        </ul>

    </div>


    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            <li {{ (Request::is('/') ? 'class=active' : '') }}><a href="/"><i class="icon-display4 position-left"></i>
                    Dashboard</a></li>
            <li {{ (Request::is('invites') ? 'class=active' : '') }}><a href="/invites"><i
                            class="icon-trophy2 position-left"></i>{{trans_choice('crud.tournament',2)}}</a></li>

        </ul>

        <ul class="nav navbar-nav navbar-right">


            <ul class="dropdown-menu dropdown-menu-right icons-right">

                {{--<li><a href="{!! URL::to('/settings')!!}"><i--}}
                {{--class="fa  fa-wrench"></i> {!! Lang::get('core.settings') !!}</a></li>--}}

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
                    <li><a href="{!! URL::to('users')!!}"><i class="icon-users"></i> {!! Lang::get('core.users') !!}</a></li>
                    <li><a href="{!! URL::to('tournaments')!!}"> <i class="icon-trophy3"></i>  {!! trans('crud.admin_tournaments') !!}</a></li>
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