<?php
$tournamentsCreatedQuery = Auth::user()->tournaments();
$tournamentsCreated = $tournamentsCreatedQuery->get();
$tournamentsParticipatedQuery = Auth::user()->myTournaments();
$tournamentsParticipated = $tournamentsParticipatedQuery->get();

//dd($tournamentsParticipatedQuery->where('dateFin','<', new \DateTime('today'))->getQuery()->toSql());
//dd(new \DateTime('today'));
?>
<div class="row">
    <div class="col-md-6">
        <div class="row ml-5 mr-10">
            <div class="panel panel-body">
                <fieldset title="{{Lang::get('core.venue')}}">
                    <legend class="text-semibold">{{ trans('core.tournaments_created') }}</legend>
                </fieldset>

                <table width="100%">
                    @foreach($tournamentsCreated->sortByDesc('created_at')->take(3) as $tournament)
                        <tr class="dashboard-table">
                            <td width="80%">{{$tournament->name}}</td>
                            <td width="20%" align="right"><a
                                        class="btn border-success text-success btn-flat border-4 seeall pl-20 pr-20 "
                                        href="{!! URL::action('TournamentController@edit', $tournament->slug) !!}">EDIT</a>
                            </td>
                        </tr>
                    @endforeach

                </table>
                <div align="right" class="mt-20 pt-20">
                    <a class="btn border-primary text-primary btn-flat border-4 text-uppercase seeall "
                       href="{!! URL::to('tournaments')!!}">{{trans('core.see_all')}}</a>
                </div>


            </div>
        </div>
        <div class="row ml-5 mr-10">
            <div class="panel panel-body">
                <fieldset title="{{ trans('core.tournaments_registered') }}">
                    <legend class="text-semibold">{{ trans('core.tournaments_registered') }}</legend>
                </fieldset>
                @if (sizeof($tournamentsParticipated) == 0)
                    <div class="mt-20 mb-20 pt-20 pb-20 text-center">{{ trans('core.no_tournament_registered_yet') }}</div>
                    <div class="text-center pb-20">
                        <a href="{!! URL::action('TournamentController@create') !!}" type="button"
                           class="btn border-primary btn-flat text-primary disabled text-uppercase p-10 ">{{ trans('core.see_open_tournaments') }}
                            {{--( {{trans('core.soon')}} )--}}
                        </a>
                    </div>

                @else
                    <table width="100%">


                        @foreach($tournamentsParticipated as $tournament)

                            <tr class="dashboard-table" height="100px" valign="middle">
                                <td width="80%">{{$tournament->name}}</td>
                                <td width="20%" align="right">
                                    <a class="btn border-success text-success btn-flat border-4 seeall pl-20 pr-20 "
                                    @can('edit',$tournament)
                                       href="{!! URL::action('TournamentController@edit', $tournament->slug) !!}">EDIT</a>
                                    @else
                                        {{--TODO Permission problems--}}
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
                @endif


            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="row">
            <div class="panel panel-body">
                <fieldset title="{{ trans('core.numbers') }}">
                    <legend class="text-semibold">{{ trans('core.numbers') }}</legend>
                </fieldset>
                <div class="row">
                    <div class="col-lg-6 col-md-6">

                        <div class="square bg-nav">{{ $tournamentsCreated->count() }}
                            <div class="text-size-large text-uppercase">{{ trans('core.created') }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="square bg-secondary">{{ $tournamentsParticipated->count()  }}
                            <div class="text-size-large text-uppercase">{{ trans('core.participations') }}</div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="square bg-primary">{{ $tournamentsParticipated->where('dateFin','<', new \DateTime('today'))->count() }}
                            <div class="text-size-large text-uppercase">{{ trans('core.past') }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="square bg-success">{{ $tournamentsParticipated->where('dateFin','>=', new \DateTime('today'))->count() }}
                            <div class="text-size-large text-uppercase">{{ trans('core.next') }}</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>