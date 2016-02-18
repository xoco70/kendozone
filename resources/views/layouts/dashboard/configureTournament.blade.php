<?php
$tournament = Auth::user()->tournaments->first();
$settingSize = sizeof($tournament->settings());
$categorySize = sizeof($tournament->categories);

?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-body border-top-primary">
            <div class="text-center">
                <h6 class="no-margin text-semibold">{{ trans('core.welcome') }}</h6>
                <p class="content-group-sm text-muted">{{ trans('core.welcome_text') }}</p>
            </div>

            <div class="well well-lg mb-15">
                <del class="text-muted">{{ trans('core.create_new_tournament') }}</del>
            </div>

            <div class="well well-lg mb-15">
                @if ($settingSize > 0 && $settingSize == $categorySize)
                    <del class="text-muted">
                        {{ trans('core.congigure_categories') }}
                    </del>
                @else
                    <a href="{!! URL::action('TournamentController@edit', $tournament->slug) !!}#categories">{{ trans('core.congigure_categories') }}</a>
                @endif
            </div>

            <div class="well well-lg">
                <a href="{!! URL::action('InviteController@inviteUsers', $tournament->slug) !!}">{{ trans('crud.invite_competitors') }}</a>
            </div>
        </div>
    </div>


</div>