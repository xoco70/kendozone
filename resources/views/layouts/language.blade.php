<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    @if (App::getLocale() =='es')
        <img src="/images/flags/MX.png" alt="Español">
    @else
        <img src="/images/flags/GB.png" alt="English">
    @endif
</a>
<ul class="dropdown-menu dropdown-menu-right">
    <li><a class="mexico" href="{{ URL::action('LanguageController@update', 'es') }}">
            <img src="/images/flags/MX.png" alt="Español"> Español</a></li>
    <li><a class="english" href="{{ URL::action('LanguageController@update', 'en') }}">
            <img src="/images/flags/GB.png" alt="English"> English</a></li>
</ul>