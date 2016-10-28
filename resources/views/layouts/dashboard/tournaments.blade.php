<div class="panel panel-body">
    <fieldset title="{{ trans('core.tournaments_registered') }}">
        <legend class="text-semibold">{{ trans('core.tournaments_registered') }}</legend>
    </fieldset>

    @include('layouts.dashboard.tournamentsRegistered')
    <table width="100%">


        @foreach($tournamentsParticipated as $tournament)

            <tr class="dashboard-table" height="100px" valign="middle">
                <td width="80%">{{$tournament->name}}</td>
                <td width="20%" align="right">
                    <a class="btn border-success text-success btn-flat border-4 seeall pl-20 pr-20 "
                       @can('edit',$tournament)
                       href="{!! URL::action('TournamentController@edit', $tournament->slug) !!}">EDIT</a>
                    @else
                        href="{!! URL::action('TournamentController@show', $tournament->slug) !!}
                        ">VER</a>
                    @endcan
                </td>
            </tr>

        @endforeach
    </table>

    <div align="right" class="mt-20 pt-20">
        <a class="btn border-primary text-primary btn-flat border-4 text-uppercase seeall"
           href="{!! URL::action('UserController@getMyTournaments', Auth::user()->slug) !!}"
        >{{trans('core.see_all')}}</a>
    </div>
</div>