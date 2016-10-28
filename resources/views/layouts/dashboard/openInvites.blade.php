<div class="panel panel-body">
    <fieldset title="{{trans('core.open_tournaments_in_your_country')}}">
        <legend class="text-semibold">{{ trans('core.open_tournaments_in_your_country') }}</legend>
    </fieldset>

    @if ($openTournaments->count() == 0)
        <div align="center">{{ trans('core.still_no_open_tournament') }}</div>
    @else
        <table width="100%">
            @foreach($openTournaments->sortByDesc('created_at')->take(3) as $openTournament)
                <tr class="dashboard-table">
                    <td width="30%">{{$openTournament->name}}</td>
                    <td width="20%" align="right">
                        <a class="btn border-success text-success btn-flat border-4 seeall pl-5 pr-5 "
                           href="{!! URL::action('TournamentController@register', $openTournament->slug) !!}"> {{  strtoupper(trans('auth.register')) }}</a>
                    </td>
                </tr>
            @endforeach

        </table>
        {{--<div align="right" class="mt-20 pt-20">--}}
            {{--<a class="btn border-primary text-primary btn-flat border-4 text-uppercase seeall "--}}
               {{--href="{!! URL::to('tournaments')!!}">{{trans('core.see_all')}}</a>--}}
        {{--</div>--}}
    @endif
</div>