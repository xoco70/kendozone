<div class="navbar navbar-default navbar-fixed-top">
    <!-- Menu Mobile -->
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="/images/logored.png" alt="Logo Kendozone"></a>
        <ul class="nav navbar-nav visible-xs-block mt-15">
            <li class="dropdown language-switch-mobile">
                @include('layouts.language')
            </li>
            <li class="dropdown">
                @include('layouts.mobile.avatar')
            </li>
            <li>
                <a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3 mobile-menu"></i></a>
            </li>
        </ul>
        <!-- Fin Menu Mobile -->
    </div>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav breadcrumbs">
            @yield('breadcrumbs')
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="head_create_tournament mr-20">
                <a href="{{ URL::action('TournamentController@create') }}"
                   class="navbar-right btn border-primary text-primary btn-flat border-3 p-10 mt-7">{{ trans('core.createTournament') }}
                </a>
            </li>
            <li class="dropdown language-switch-desktop">
                @include('layouts.language')
            </li>
            <li class="dropdown dropdown-user mt-5">
                <a class="dropdown-toggle" data-toggle="dropdown" id="dropdown-user">
                    @include('layouts.avatar')
                    <span>{!! Auth::user()->name !!}</span>
                </a>
                @include('layouts.menus.top.user')
            </li>
        </ul>
    </div>
</div>
<!-- /second navbar -->