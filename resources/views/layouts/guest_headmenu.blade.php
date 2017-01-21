<ul class="nav navbar-nav navbar-right">
    @if (Auth::check())
        <li><a href="{{  url('/logout') }}" id="logout">{!! Lang::get('core.logout') !!}</a></li>
    @elseif (! Request::is('login'))
        <li><a href="{!! URL::action('Auth\LoginController@showLoginForm') !!}">{{  trans('auth.signin') }}</a></li>
    @endif
    <li class="dropdown language-switch">
        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            @if (App::getLocale() =='es')
                <img src="/images/flags/MX.png" alt="">
            @else
                <img src="/images/flags/GB.png" alt="">
            @endif
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="mexico" href="{{ URL::action('LanguageController@update', 'es') }}">
                    <img src="/images/flags/MX.png" alt="Español"> Español</a></li>
            <li><a class="english" href="{{ URL::action('LanguageController@update', 'en') }}">
                    <img src="/images/flags/GB.png" alt="English"> English</a></li>
        </ul>
    </li>
</ul>