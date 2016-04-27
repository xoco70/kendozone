<div class="row mt-20 pt-20">
    <div class="col-md-4 col-md-offset-4 mt-20 pt-10">

        <div class="text-center">
            <h1 class="no-margin text-semibold">{{ trans('core.welcome') }}</h1>
            <h6 class="content-group-sm text-muted">{{ trans('core.welcome_text') }}</h6>
        </div>

        <div class="well dash well-lg mb-15 success">
            <div class="btn success btn-rounded btn-flat dash mr-20">
                <span class="letter-icon">1</span>
            </div>
            <span class="text-muted">{{ trans('core.create_new_tournament') }}</span>
        </div>


        @if ($settingSize > 0 && $settingSize == $categorySize)
            <div class="well dash well-lg mb-15 success">
                <div class="btn success btn-rounded btn-flat dash mr-20">
                    <span class="letter-icon">2</span>
                </div>
                <span class="text-muted">
                    {{ trans('core.congigure_categories') }}
                </span>
            </div>
        @else
            <div class="well dash well-lg mb-15 error">
                <div class="btn error btn-rounded btn-flat dash mr-20">
                    <span class="letter-icon">2</span>
                </div>
                <a href="{!! URL::action('TournamentController@edit', $tournament->slug) !!}#categories">{{ trans('core.congigure_categories') }}</a>
            </div>
        @endif


        <div class="well dash well-lg error">
            <div class="btn error btn-rounded btn-flat dash mr-20">
                <span class="letter-icon">3</span>
            </div>
            <a href="{!! URL::action('InviteController@inviteUsers', $tournament->slug) !!}">{{ trans('core.invite_competitors') }}</a>
        </div>
    </div>


</div>