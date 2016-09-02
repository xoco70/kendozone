<ul class="nav navbar-nav navbar-right">
    <li class="dropdown language-switch">
        <a class="dropdown-toggle pl-20 pr-20 " data-toggle="dropdown" aria-expanded="false">
            @if (App::getLocale() =='es')
                <img src="/images/flags/MX.png" class="position-left" alt="">
            @else
                <img src="/images/flags/GB.png" class="position-left" alt="">
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