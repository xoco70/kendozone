<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    @if (App::getLocale() =='es')
        <img src="/images/flags/MX.png" alt="Español">
    @elseif (App::getLocale() =='ja')
        <img src="/images/flags/JP.png" alt="Japonese">
    @elseif (App::getLocale() =='fr')
        <img src="/images/flags/FR.png" alt="Français">
    @elseif (App::getLocale() =='de')
        <img src="/images/flags/DE.png" alt="Deutch">
    @else
        <img src="/images/flags/GB.png" alt="English">
    @endif
</a>
<ul class="dropdown-menu dropdown-menu-right">
    <li><a class="mexico" href="{{ URL::action('LanguageController@update', 'es') }}">
            <img src="/images/flags/MX.png" alt="Español"> Español</a></li>
    <li><a class="french" href="{{ URL::action('LanguageController@update', 'fr') }}">
            <img src="/images/flags/FR.png" alt="Français"> Français</a></li>
    <li><a class="english" href="{{ URL::action('LanguageController@update', 'en') }}">
            <img src="/images/flags/GB.png" alt="English"> English</a></li>
    <li><a class="deutch" href="{{ URL::action('LanguageController@update', 'de') }}">
            <img src="/images/flags/DE.png" alt="Deutch">Deutch</a></li>
    <li>
    <li><a class="japonese" href="{{ URL::action('LanguageController@update', 'ja') }}">
            <img src="/images/flags/JP.png" alt="Japonese">Japonese</a></li>
    <div align="center">
        <a target="_blank" href="https://lokalise.co/signup/9206592359c17cdcafd822.29517217/all/">
            {{ trans('help.help_translate') }}
        </a>
    </div>
    </li>
</ul>