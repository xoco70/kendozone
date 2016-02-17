@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/header/tournamentIndex.js') !!}
@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('tournaments.index') !!}

@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-8 col-lg-offset-2">
                <div class="panel panel-flat">

                    <div class="panel-body">
                        <div class="container-fluid">

                            {{--<div class="row col-md-10 custyle">--}}
                            <table class="table table-togglable table-hover">
                                <thead>
                                <a href="{!!   URL::action('TournamentController@create') !!}"
                                   class="btn btn-primary btn-xs pull-right"><b><i
                                                class="icon-plus22 mr-5"></i></b> @lang('crud.addModel', ['currentModelName' => $currentModelName])
                                </a>

                                <tr>
                                    <th data-toggle="true">{{ trans('crud.name') }}</th>
                                    <th data-hide="phone">{{ trans('crud.date') }}</th>
                                    <th data-hide="phone">{{ trans('crud.owner') }}</th>
                                    <th class="text-center">{{ trans('crud.action') }}</th>
                                </tr>
                                </thead>
                                @foreach($tournaments as $tournament)
                                    <tr id="{!! $tournament->slug !!}">
                                        <td><a
                                                    href="{!!   URL::action('TournamentController@edit',  $tournament->slug) !!}">{{ $tournament->name }}</a>
                                        </td>
                                        <td>{{ $tournament->date }}</td>
                                        <td>{{ $tournament->owner->name}}</td>
                                        <td class="text-center">
                                            {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteTourament', 'action' => ['TournamentController@destroy', $tournament->slug]]) !!}
                                            {!! Form::button( '<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit','class' => 'btn text-warning-600 btn-flat btnDeleteTournament', 'id'=>'delete_'.$tournament->slug, 'data-id' => $tournament->slug ] ) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>

                                @endforeach

                            </table>
                            <div class="text-center">{!! $tournaments->render() !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--@include("errors.list")--}}
@stop
@section("scripts_footer")
    <script>
        var url = "{{ url("/tournaments") }}";

    </script>
{!! Html::script('js/pages/footer/tournamentIndexFooter.js') !!}
@stop