@extends('layouts.dashboard')

@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                {{--<div class="row col-md-10 custyle">--}}
                <table class="table table-striped custab">
                    <thead>
                    @can('CanCreateTournament')
                    <a href="{!!   URL::action('TournamentController@create') !!}"
                       class="btn btn-primary btn-xs pull-right"><b>+</b> @lang('crud.addModel', ['currentModelName' => $currentModelName])
                    </a>
                    @endcan

                    <tr>
                        <th>ID</th>
                        <th>{{ trans('crud.name') }}</th>
                        <th>{{ trans_choice('crud.place',1) }}</th>
                        <th>{{ trans('crud.date') }}</th>
                        <th>{{ trans('crud.limitDateRegistration') }}</th>
                        @can('CanDeleteTournament')
                        <th class="text-center">{{ trans('crud.action') }}</th>
                        @endcan
                    </tr>
                    </thead>
                    @foreach($tournaments as $tournament)
                        <tr>
                            <td>@can('CanEditTournament')<a href="{!!   URL::action('TournamentController@edit',  $tournament->id) !!}">@endCan{{ $tournament->id }}@can('CanEditTournament')</a>@endCan</td>
                            <td>@can('CanEditTournament')<a href="{!!   URL::action('TournamentController@edit',  $tournament->id) !!}">@endCan{{ $tournament->name }}@can('CanEditTournament')</a>@endCan</td>
                            <td>{{ $tournament->place }}</td>
                            <td>{{ $tournament->tournamentDate }}</td>
                            <td>{{ $tournament->registerDateLimit }}</td>

                            <td class="text-center">
                                {{--<a class="btn btn-danger btn-xs" href="/tournaments/{{ $tournament->id }}" data-method="delete" data-token="{{csrf_token()}}">--}}
                                @can('CanDeleteTournament')
                                <a class=" text-danger "
                                   href="{!! URL::action('TournamentController@destroy',  $tournament->id) !!}" data-method="delete" data-token="{{csrf_token()}}">
                                    <span class="glyphicon glyphicon-remove"></span></a>
                                @endcan
                            </td>
                        </tr>

                    @endforeach

                </table>
            </div>
        </div>
    </div>
    @include("errors.list")
@stop

