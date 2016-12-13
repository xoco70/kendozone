<div class="panel panel-body">
    <fieldset title="{{trans('core.tournaments_created')}}">
        <legend class="text-semibold">{{ trans('core.tournaments_created') }}</legend>
    </fieldset>

    <table width="100%">
        @foreach($tournamentsCreated->sortByDesc('created_at')->take(3) as $tournament)
        <tr class="dashboard-table">
            <td width="80%">{{$tournament->name}}</td>
            <td width="20%" align="right"><a
                    class="btn border-success text-success text-uppercase btn-flat border-3 seeall pl-20 pr-20 "
                    href="{!! URL::action('TournamentController@edit', $tournament->slug) !!}">{{trans('core.edit')}}</a>
            </td>
        </tr>
        @endforeach

    </table>
    <div align="right" class="mt-20 pt-20">
        <a class="btn border-primary text-primary btn-flat border-3 text-uppercase seeall "
           href="{!! URL::to('tournaments')!!}">{{trans('core.see_all')}}</a>
    </div>
</div>