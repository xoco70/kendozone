<ul class="nav nav-lg nav-tabs nav-tabs-bottom search-results-tabs">
    @include('layouts.displayMyEntityOnTop')
    <li {{ Request::is('federations*') ? 'class=active' : '' }}>
        <a href="{{ route('federations.index') }}">
            <i class="position-left"></i> {{trans_choice('structures.federation',2)}}
        </a>
    </li>
    <li {{ Request::is('associations*') ? 'class=active' : '' }}>
        <a href="{{ route('associations.index') }}">
            <i class="position-left"></i> {{trans_choice('structures.association',2)}}
        </a>
    </li>
    <li {{ Request::is('clubs*') ? 'class=active' : '' }}>
        <a href="{{ route('clubs.index') }}"><i class="position-left"></i> {{trans_choice('structures.club',2)}} </a>
    </li>
    <li {{ Request::is('users*') ? 'class=active' : '' }}>
        <a href="{{ route('users.index') }}"><i class="position-left"></i> {{trans_choice('core.user',2)}}</a>
    </li>


    @if (Route::getFacadeRoot()->current()->uri() == 'associations')
        @can('create', new App\Association)
            <span class="pl-10 pull-right">
                    <a id="addAssociation" href="{!!   URL::action('AssociationController@create') !!}"
                       class="btn btn-primary btn-xs "><b><i class="icon-plus22 mr-5"></i></b>
                        @lang('core.add') {{ trans_choice('structures.association',1) }}
                    </a>
                </span>
        @endcan

    @elseif (Route::getFacadeRoot()->current()->uri() == 'clubs')
        @can('create', new App\Club)
            <span class="pl-10 pull-right">
                    <a id="addClub" href="{!!   URL::action('ClubController@create') !!}"
                       class="btn btn-primary btn-xs "><b><i class="icon-plus22 mr-5"></i></b>
                        @lang('core.add') {{ trans_choice('structures.club',1) }}
                    </a>
                </span>
        @endcan

    @elseif (Route::getFacadeRoot()->current()->uri() == 'users')
        <span class="pl-10 pull-right">
                    <a href="{!!   URL::action('UserController@create') !!}" id="adduser"
                       class="btn btn-primary btn-xs "><b><i class="icon-plus22 mr-5"></i></b>
                        @lang('core.add') {{ trans('core.user') }}
                    </a>
                </span>
        <a href="{!!   URL::action('UserController@export') !!}"
           class="btn btn-success btn-xs pull-right">
            <i class="icon-file-excel position-left"></i>{{trans('core.export_excel')}}
        </a>
    @endif

</ul>

</ul>