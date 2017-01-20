@if (Auth::check())
    <li><a href="{{  url('/logout') }}" id="logout">{!! Lang::get('core.logout') !!}</a></li>
@elseif (! Request::is('login'))
    <li><a href="{!! URL::action('Auth\LoginController@showLoginForm') !!}">{{  trans('auth.signin') }}</a></li>
@endif