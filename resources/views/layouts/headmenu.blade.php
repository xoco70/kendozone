<!-- Main navbar -->
<div class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="#"><img src="/images/logo_light.png" alt=""></a>

		<ul class="nav navbar-nav visible-xs-block">
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		<ul class="nav navbar-nav">
			<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

		</ul>

		{{--<p class="navbar-text"><span class="label bg-success-400">Online</span></p>--}}

		<ul class="nav navbar-nav navbar-right">

            <li class="user dropdown"><a class="dropdown-toggle" href="javascript:void(0)"  data-toggle="dropdown"><i class="icon-cog"></i> </a>
                <ul class="dropdown-menu dropdown-menu-right icons-right">

                    <li><a href="{!! URL::to('config')!!}"><i class="fa  fa-wrench"></i> {!! Lang::get('core.settings') !!}</a></li>


                    @can('CanRegisterUser')<li><a href="{!! URL::to('users')!!}"><i class="fa fa-user"></i> {!! Lang::get('core.users') !!} </a></li>@endcan
                    @can('CanSeeGroups')<li><a href="{!! URL::to('groups')!!}"><i class="fa fa-users"></i> {!! Lang::get('core.groups') !!} </a></li>@endcan
                    @can('CanInviteCompetitor')<li><a href="{!! URL::to('config/blast')!!}"><i class="fa fa-envelope"></i> {!! Lang::get('core.blastmail') !!} </a></li>@endcan

                    @can('CanSeeLogs')<li><a href="{!! URL::to('logs')!!}"><i class="fa fa-clock-o"></i> {!! Lang::get('core.logs') !!}</a></li>@endcan
                            <!--<li class="divider"></li>-->

                </ul>
            </li>

			<li class="dropdown dropdown-user">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<img src="{!! Auth::getUser()->avatar !!}" alt="">
					<span>{!! Auth::getUser()->name !!}</span>
					<i class="caret"></i>
				</a>

				<ul class="dropdown-menu dropdown-menu-right">
                    @can('CanEditProfile')<li><a href="{!! URL::to('users/'.Auth::getUser()->id).'/edit' !!}"><i class="icon-user"></i> {!! Lang::get('core.profile') !!}</a></li>@endcan
					{{--<li><a href="index.html#"><i ></i> My profile</a></li>--}}
					{{--<li><a href="index.html#"><i class="icon-coins"></i> My balance</a></li>--}}
					{{--<li><a href="index.html#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>--}}
					<li class="divider"></li>
					<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
					<li><a href="{{ url('auth/logout') }}"><i class="icon-switch2"></i> {!! Lang::get('core.logout') !!}</a></li>

                </ul>
			</li>
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