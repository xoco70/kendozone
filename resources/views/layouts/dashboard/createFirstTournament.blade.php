<br/><br/><br/><br/><br/><br/>
<div class="row text-center">
    <div class="col-md-6 col-md-offset-3">
        {{--<div class="panel panel-body border-top-primary">--}}

            <h1 class="no-margin text-semibold">{{ trans('core.welcome') }}</h1>
            <p class="text-muted text-size-large">{{ trans('core.welcome_text') }}</p>

        <br/>
        <div class="row pt-20">
            <div class="col-md-6 text-right">
                <a href="{!! URL::action('TournamentController@create') !!}" type="button"
                   class="btn border-primary btn-flat text-primary disabled text-uppercase p-10 ">{{ trans('core.see_open_tournaments') }}
                    {{--( {{trans('core.soon')}} )--}}
                </a>
            </div>
            <div class="col-md-6 text-left">
                <a href="{!! URL::action('TournamentController@create') !!}" type="button"
                   class="btn btn-primary text-uppercase p-10">{{ trans('core.create_new_tournament') }}
                </a>

            </div>


        </div>


    </div>
</div>