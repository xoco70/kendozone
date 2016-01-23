<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="/"><img src="/images/logo_light.png" alt=""></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a>
            </li>

        </ul>

        {{--<p class="navbar-text"><span class="label bg-success-400">Online</span></p>--}}

        <ul class="nav navbar-nav navbar-right">
            @if (Auth::user()!=null && Auth::user()->isSuperAdmin())
            <li class="user dropdown"><a class="dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"><i
                            class="icon-cog"></i> </a>
                <ul class="dropdown-menu dropdown-menu-right icons-right">




                    <li><a href="{!! URL::to('users')!!}"><i class="fa fa-user"></i> {!! Lang::get('core.users') !!}
                        </a></li>
                    {{--@can('CanSeeGroups')--}}
                    {{--<li><a href="{!! URL::to('groups')!!}"><i class="fa fa-users"></i> {!! Lang::get('core.groups') !!}--}}
                        {{--</a></li>@endcan--}}
                    {{--@can('CanInviteCompetitor')--}}
                    {{--<li><a href="{!! URL::to('config/blast')!!}"><i--}}
                                    {{--class="fa fa-envelope"></i> {!! Lang::get('core.blastmail') !!} </a></li>@endcan--}}

                    @can('CanSeeLogs')
                    <li><a href="{!! URL::to('logs')!!}"><i class="fa fa-clock-o"></i> {!! Lang::get('core.logs') !!}
                        </a></li>@endcan
                            <!--<li class="divider"></li>-->

                </ul>
            </li>
            @endif
        </ul>
    </div>
</div>
<!-- /main navbar -->


{{--<div class="row  ">--}}
{{--<nav style="margin-bottom: 0" role="navigation" class="navbar navbar-static-top gray-bg">--}}
{{--<div class="navbar-header">--}}
{{--<a href="javascript:void(0)" class="navbar-minimalize minimalize-btn btn btn-primary "><i class="fa fa-bars"></i> </a>--}}

{{--</div>--}}

{{--<ul class="nav navbar-top-links navbar-right">--}}
{{--<li>--}}

{{--</li>--}}
{{--<!----}}
{{--<li  class="user dropdown"><a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-flag"></i><i class="caret"></i></a>--}}
{{--<ul class="dropdown-menu dropdown-menu-right icons-right">--}}
{{--qqq--}}
{{--</ul>--}}
{{--</li>-->--}}

{{--<li class="user dropdown"><a class="dropdown-toggle" href="javascript:void(0)"  data-toggle="dropdown"><i class="fa fa-user"></i> <span>{!! Lang::get('core.myaccount') !!}</span><i class="caret"></i></a>--}}
{{--<ul class="dropdown-menu dropdown-menu-right icons-right">--}}
{{--@can('CanEditProfile')<li><a href="{!! URL::to('users/'.Auth::getUser()->id).'/edit' !!}"><i class="fa fa-user"></i> {!! Lang::get('core.profile') !!}</a></li>@endcan--}}
{{--</ul>--}}
{{--</li>--}}


{{--</ul>--}}

{{--</nav>--}}
{{--</div>--}}