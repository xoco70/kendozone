<br/><br/>
<div class="row text-center">
    <div class="col-md-6 col-md-offset-3">
        {{--<div class="panel panel-body border-top-primary">--}}

        <h1 class="no-margin text-semibold">{{ trans('core.welcome') }}</h1>
        <p class="text-muted text-size-large">{{ trans('core.welcome_text') }}</p>

        <br/>
        @include('layouts.dashboard.openInvites')
        <div align="center" class="mt-20 pt-20">

            <a href="{!! URL::action('TournamentController@create') !!}" type="button"
               class="btn btn-primary text-uppercase p-10 ">{{ trans('core.create_new_tournament') }}
            </a>
        </div>

    </div>
</div>