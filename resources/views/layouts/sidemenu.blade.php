<nav role="navigation" class="navbar-default navbar-static-side">
    <div class="sidebar-collapse">
        <ul id="sidemenu" class="nav expanded-menu">
            <li class="logo-header">
                <a class="navbar-brand" href="{{ URL::to('dashboard')}}">

                </a>
            </li>
            <li class="nav-header">
                <div class="dropdown profile-element" style="text-align:center;">
                    <a href="{!! URL::to('users/'.Auth::user()->id).'/edit' !!}">
                        <img src="{{ URL::to(Config::get('constants.AVATAR_PATH'). Auth::user()->picture) }}"
                             class="profile_pic"/>
				<span class="clear">
                    <span class="block m-t-xs">
                        <strong class="font-bold">{{  Auth::user()->email }}</strong>

				 <br/>
                        {{--We could put UserType here--}}
                        {{--{{ Lang::get('core.lastlogin') }} : <br />--}}
                        {{--<small>{{ date("H:i F j, Y", strtotime(Session::get('ll'))) }}</small>				--}}
				 </span> 
				 </span>
                    </a>
                </div>
                <div class="photo-header ">
                    <a href="{!! URL::to('users/'.Auth::user()->id).'/edit' !!}">
                        <img src="{{ URL::to(Config::get('constants.AVATAR_PATH'). Auth::user()->picture) }}"
                                class="mini_profile_pic"/>
                    </a>
                </div>

            </li>
            @can('CanSeeTournaments')
            <li>
                <a href="{!!   URL::action('TournamentController@index') !!}">
                    <div align="center"><i class="fa fa-trophy"></i></div>

                    <div class="nav-label" align="center">{{ trans('crud.tournament') }}</div>
                </a>
            </li>
            @endcan
            @can('CanSeePlaces')
            <li>
                <a href="{!!   URL::action('PlaceController@index') !!}" class="expand level-closed active">
                    <div align="center"><i class="fa fa-map-marker"></i></div>

                    <div class="nav-label" align="center">{{ trans('crud.place') }}</div>
                </a>
            </li>
            @endcan
            @can('CanSeeCompetitor')
            <li>
                <a href="{!!   URL::action('CompetitorController@index') !!}" class="expand level-closed ">
                    <div align="center"><i class="fa fa-user"></i></div>
                    <div class="nav-label" align="center">{{ trans('crud.competitor') }}</div>
                </a>
            </li>
            @endcan
            @can('CanSeeStatistics')
            <li>
                <a href="#" class="expand level-closed ">
                    <div align="center"><i class="fa fa-line-chart "></i></div>
                    <div class="nav-label" align="center">{{ trans('core.statistics') }}</div>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</nav>	  
	  
