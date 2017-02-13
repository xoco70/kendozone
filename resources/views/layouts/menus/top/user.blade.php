<ul class="dropdown-menu dropdown-menu-right">
    <li><a href="{{ URL::action('UserController@edit', Auth::user()->slug) }}  "><i
                    class="icon-user"></i> {!! Lang::get('core.profile') !!}</a></li>

    @if (Auth::user()->isSuperAdmin() || Auth::user()->tournamentsDeleted()->count() > 0)
        <li>
            <a href="{!! URL::action('TournamentController@getDeleted') !!}">
                <i class="icon-trash-alt"></i><span>{{ trans('core.tournaments_deleted') }}</span>
            </a>
        </li>
    @endif
    @if (Auth::user()->isSuperAdmin())
        <li><a href="{!! URL::to('logs')!!}">
                <i class="icon-file-text"></i> {!! Lang::get('core.logs') !!}
            </a>
        </li>
        <li><a href="{!! URL::to('auth/oauth')!!}">
                <i class="icon-lock5"></i>Tokens
            </a>
        </li>
    @endif
    {{--<li><a href="{!! URL::to('about')!!}">--}}
            {{--<i class="icon-help"></i>{{trans('core.about')}}--}}
        {{--</a>--}}
    {{--</li>--}}
    {{--====================================== Logout ======================================--}}
    <li class="divider"></li>
    <li><a href="{{  url('/logout') }}" id="logout"><i
                    class="icon-switch2"></i> {!! Lang::get('core.logout') !!}
        </a>
    </li>
</ul>