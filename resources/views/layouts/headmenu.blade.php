<div class="row  ">
        <nav style="margin-bottom: 0" role="navigation" class="navbar navbar-static-top gray-bg">
        <div class="navbar-header">
            <a href="javascript:void(0)" class="navbar-minimalize minimalize-btn btn btn-primary "><i class="fa fa-bars"></i> </a>

        </div>

            <ul class="nav navbar-top-links navbar-right">
            <li>

            </li>
		<!--
		<li  class="user dropdown"><a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-flag"></i><i class="caret"></i></a>
			 <ul class="dropdown-menu dropdown-menu-right icons-right">
				qqq
			</ul>
		</li>-->

		<li class="user dropdown"><a class="dropdown-toggle" href="javascript:void(0)"  data-toggle="dropdown"><i class="fa fa-desktop"></i> <span>{!! Lang::get('core.controlpanel') !!}</span><i class="caret"></i></a>
		  <ul class="dropdown-menu dropdown-menu-right icons-right">

		  	<li><a href="{!! URL::to('config')!!}"><i class="fa  fa-wrench"></i> {!! Lang::get('core.settings') !!}</a></li>


					<li><a href="{!! URL::to('users')!!}"><i class="fa fa-user"></i> {!! Lang::get('core.users') !!} </a></li>
					<li><a href="{!! URL::to('groups')!!}"><i class="fa fa-users"></i> {!! Lang::get('core.groups') !!} </a></li>
					<li><a href="{!! URL::to('config/blast')!!}"><i class="fa fa-envelope"></i> {!! Lang::get('core.blastmail') !!} </a></li>

			<li><a href="{!! URL::to('logs')!!}"><i class="fa fa-clock-o"></i> {!! Lang::get('core.logs') !!}</a></li>
			<!--<li class="divider"></li>-->

		  </ul>
		</li>
		<li class="user dropdown"><a class="dropdown-toggle" href="javascript:void(0)"  data-toggle="dropdown"><i class="fa fa-user"></i> <span>{!! Lang::get('core.myaccount') !!}</span><i class="caret"></i></a>
		  <ul class="dropdown-menu dropdown-menu-right icons-right">

{{--			<li><a href="{!! URL::to('users/'.Sentinel::getUser()->id) !!}"><i class="fa fa-user"></i> {!! Lang::get('core.profile') !!}</a></li>--}}
			<li><a href="{{ url('auth/logout') }}"><i class="fa fa-sign-out"></i> {!! Lang::get('core.logout') !!}</a></li>
		  </ul>
		</li>


            </ul>

        </nav>
        </div>