<div class="panel panel-body ">

    <fieldset title="{{trans('core.open_tournaments_in_your_country')}}">
        <legend class="text-semibold">{{ trans('core.create_new_tournament') }}</legend>
    </fieldset>
    <div class="valign-parent h-150">
        <div class="valign-child">
            <a href="{!! URL::action('TournamentController@create') !!}" type="button"
               class="btn btn-primary text-uppercase p-10 ">{{ trans('core.letsgo') }}
            </a>
        </div>

        {{--<div align="right" class="mt-20 pt-20">--}}
        {{--<a class="btn border-primary text-primary btn-flat border-4 text-uppercase seeall "--}}
        {{--href="{!! URL::to('tournaments')!!}">{{trans('core.see_all')}}</a>--}}
        {{--</div>--}}
    </div>
</div>