
<div class="panel panel-nav">
    <div class="panel-heading">
        <h6 class="panel-title">{{ trans('core.open_tournaments_in_your_country') }}</h6>
    </div>

    <div class="panel-body h-300">
        @if ($openTournaments->count() == 0)
            <div align="center">{{ trans('core.still_no_open_tournament') }}</div>
        @else
            <table width="100%">
                @foreach($openTournaments->sortByDesc('created_at')->take(3) as $openTournament)
                    <tr class="dashboard-table">
                        <td width="30%">{{$openTournament->name}}</td>
                        <td width="20%" align="right">
                            @if (Auth::user()->isRegisteredTo($openTournament))
                                <a class="btn border-success bg-success border-3 pl-5 pr-5 "
                                   href="{!! URL::action('TournamentController@show', $openTournament->slug) !!}"> {{  strtoupper(trans('auth.registered')) }}</a>

                            @else
                                <a class="btn border-success text-success btn-flat border-3 seeall pl-5 pr-5 "
                                   href="{!! URL::action('TournamentController@register', $openTournament->slug) !!}"> {{  strtoupper(trans('auth.register')) }}</a>

                            @endif
                        </td>
                    </tr>
                @endforeach

            </table>
            <div align="right">
                <a class="text-uppercase text-nav align-bottom-right-15"
                   href="{!! URL::to('tournaments')!!}">+ {{trans('core.see_more')}}</a>
            </div>
        @endif
    </div>
</div>
