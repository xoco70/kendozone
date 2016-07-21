<div class="container-fluid">
    <div class="row text-center">
        <div class="col-xs-12 col-lg-8 col-lg-offset-2">
            <br/><br/><br/><br/><br/><br/>

            <h1 class="no-margin text-semibold">{{ trans_choice('core.team',2) }}</h1>

            <p class="text-muted text-size-large mt-20">{{ trans('core.no_team_yet') }}</p>
            <br/>
            <div align="center" class="mt-20 pt-20">

                <a href="{!! URL::action('TeamController@create', $tournament->slug) !!}" type="button"
                   class="btn btn-primary text-uppercase p-10 " id="addTeam">{{ trans('core.add_new_team') }}
                </a>
            </div>

        </div>
    </div>
</div>