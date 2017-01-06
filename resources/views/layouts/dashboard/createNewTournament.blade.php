<div class="panel panel-nav">
    <div class="panel-heading">
        <h6 class="panel-title">{{ trans('core.create_new_tournament') }}</h6>
    </div>

    <div class="valign-parent h-300">
        <div class="valign-child">
            <p class="text-muted">{{ trans('core.no_tournament_created_yet') }}</p><br/>
            <a href="{!! URL::action('TournamentController@create') !!}" type="button"
               class="btn btn-primary text-uppercase p-10 ">{{ trans('core.letsgo') }}
            </a>
        </div>
    </div>

</div>