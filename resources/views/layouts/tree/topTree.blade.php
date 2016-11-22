<ul class="nav nav-lg nav-tabs nav-tabs-bottom search-results-tabs">
    <li {{ Request::is('*/trees') ? 'class=active' : '' }}>
        <a href="{{ route('indexTree', $tournament->slug) }}">
            <i class="position-left"></i> {{trans_choice('core.tree',2)}}
        </a>
    </li>
    <li {{ Request::is('*/fights') ? 'class=active' : '' }}>
        <a href="{{ route('workingonit') }}">
            <i class="position-left"></i> {{trans_choice('core.fight',2)}}
        </a>
    </li>
    <li {{ Request::is('federations*') ? 'class=active' : '' }}>
        <a href="{{ route('workingonit') }}">
            <i class="position-left"></i> {{trans_choice('core.document',2)}}
        </a>
    </li>
</ul>