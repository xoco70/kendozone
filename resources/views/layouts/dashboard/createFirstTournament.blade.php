<br/><br/>
<div class="row text-center">
    <h1 class="no-margin text-semibold">{{ trans('core.welcome') }}</h1>
    @if ($openTournaments->count() == 0)
        <p class="text-muted text-size-large">{{ trans('core.welcome_text1') }}</p>
    @else
        <p class="text-muted text-size-large">{{ trans('core.welcome_text2') }}</p>
    @endif
    <br/>
</div>


<div class="row text-center">
    <div class="col-sm-4 col-sm-offset-1">
        @include('layouts.dashboard.openInvites')
    </div>
    <div class="col-sm-2 valign-parent h-200">

        <div class="valign-child">
            <div class="wrapper">
                <div class="line"></div>
                <div class="wordwrapper">
                    <div class="word">{{ trans('core.or') }} </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        @include('layouts.dashboard.createNewTournament')
    </div>
</div>
