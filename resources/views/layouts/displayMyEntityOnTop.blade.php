@if (Auth::user()->isFederationPresident() && Auth::user()->federationOwned!=null)
    <li {{ Route::getCurrentRoute()->getActionName() == 'App\Http\Controllers\FederationController@edit' ? 'class=active' : '' }}>
        <a href="{{  URL::action('FederationController@edit', Auth::user()->federationOwned->id ) }}">
            <i class="position-left"></i>{{  Auth::user()->federationOwned->name }}
        </a>
    </li>
@elseif (Auth::user()->isAssociationPresident() && Auth::user()->associationOwned!=null)
    <li {{ Route::getCurrentRoute()->getActionName() == 'App\Http\Controllers\AssociationController@edit' ? 'class=active' : '' }}>
        <a href="{{  URL::action('AssociationController@edit', Auth::user()->associationOwned->id ) }}">
            <i class="position-left"></i>{{  Auth::user()->associationOwned->name }}
        </a>
    </li>
@elseif (Auth::user()->isClubPresident() && Auth::user()->clubOwned!=null)
    <li {{ Route::getCurrentRoute()->getActionName() == 'App\Http\Controllers\ClubController@edit' ? 'class=active' : '' }}>
        <a href="{{  URL::action('ClubController@edit', Auth::user()->clubOwned->id ) }}">
            <i class="position-left"></i>{{  Auth::user()->clubOwned->name }}
        </a>
    </li>
@endif