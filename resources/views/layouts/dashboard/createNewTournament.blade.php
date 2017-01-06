<div class="panel panel-nav">
    <div class="panel-heading">
        <h6 class="panel-title">{{ trans('core.create_new_tournament') }}</h6>
    </div>

    <div class="valign-parent h-250">
        <div class="valign-child">
            <a href="{!! URL::action('TournamentController@create') !!}" type="button"
               class="btn btn-primary text-uppercase p-10 ">{{ trans('core.letsgo') }}
            </a>
        </div>
    </div>

</div>