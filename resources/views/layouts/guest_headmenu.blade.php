<ul class="nav navbar-nav navbar-right">
    @if (Auth::check())
        <li><a href="{{  url('/logout') }}" id="logout">{!! Lang::get('core.logout') !!}</a></li>
    @elseif (! Request::is('login'))
        <li><a href="{!! URL::action('Auth\LoginController@showLoginForm') !!}">{{  trans('auth.signin') }}</a></li>
    @endif
    <li class="dropdown language-switch">
        @include('layouts.language')
    </li>
</ul>