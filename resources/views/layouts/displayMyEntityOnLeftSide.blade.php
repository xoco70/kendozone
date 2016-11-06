@if (Auth::user()->isFederationPresident() && Auth::user()->federationOwned!=null)
    <li>
        <a class="protip" data-pt-title="{{ Auth::user()->federationOwned->name }}"
           href="{{  URL::action('FederationController@edit', Auth::user()->federationOwned->id ) }}">
            <i class="icon-address-book position-left sidemenu"></i><span>{{ trans('core.my_federation') }}</span>
        </a>
    </li>
@elseif (Auth::user()->isAssociationPresident() && Auth::user()->associationOwned!=null)
    <li>
        <a class="protip" data-pt-title="{{ Auth::user()->associationOwned->name  }}"
           href="{{  URL::action('AssociationController@edit', Auth::user()->associationOwned->id ) }}">
            <i class="icon-address-book position-left sidemenu"></i><span>{{ trans('core.my_association') }}</span>
        </a>
    </li>
@elseif (Auth::user()->isClubPresident() && Auth::user()->clubOwned!=null)
    <li>
        <a class="protip" data-pt-title="{{ Auth::user()->clubOwned->name  }}"
           href="{{  URL::action('ClubController@edit', Auth::user()->clubOwned->id ) }}">
            <i class="icon-address-book position-left sidemenu"></i><span>{{ trans('core.my_club') }}</span>
        </a>
    </li>
@elseif(Auth::user()->isSuperAdmin())
    <li>
        <a class="protip" data-pt-title="{{ trans_choice('core.federation',2)  }}"
           href="{{  route('federations.index') }}">
            <i class="icon-address-book position-left sidemenu"></i><span>{{ trans_choice('core.federation',2)  }}</span>
        </a>
@endif