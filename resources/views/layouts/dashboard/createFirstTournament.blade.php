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

@if ($openTournaments->count() != 0)
    <div class="row text-center">
        <div class="col-lg-3 col-lg-offset-2">
            @include('layouts.dashboard.openInvites')
        </div>
        <div class="col-lg-2 valign-parent h-200">

            <div class="valign-child">
                <div class="wrapper">
                    <div class="line"></div>
                    <div class="wordwrapper">
                        <div class="word">{{ trans('core.or') }} </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            @include('layouts.dashboard.createNewTournament')
        </div>
    </div>
@else
    <div align="center" class="mt-20 pt-20">

        <a href="{!! URL::action('TournamentController@create') !!}" type="button"
           class="btn btn-primary text-uppercase p-10 ">{{ trans('core.create_new_tournament') }}
        </a>
    </div>
@endif