<br/><br/><br/>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-body border-top-primary">
            <div class="text-center">
                <h6 class="no-margin text-semibold">{{ trans('core.welcome') }}</h6>
                <p class="content-group-sm text-muted">{{ trans('core.welcome_text') }}</p>
            </div>

            <div class="well well-lg mb-15 ">
                <div class="text-center">
                    <a href="{!! URL::action('TournamentController@create') !!}" type="button" class="btn btn-primary p-20 m-20 width-400">{{ trans('core.create_new_tournament') }}</a>
                    <div class="content-divider text-muted form-group"><span>{{  Lang::get('auth.signin_with') }}</span></div>
                    <a href="{!! URL::action('TournamentController@create') !!}" type="button" class="btn btn-primary p-20  width-400 disabled" >{{ trans('core.join_tournament') }} ( {{trans('core.soon')}} )</a>
                </div>
            </div>

        </div>
    </div>
</div>