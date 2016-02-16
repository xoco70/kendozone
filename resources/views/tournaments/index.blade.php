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
                                {{--@can('CanDeleteTournament')--}}
                                {{--<a id="delete" href="{!!   URL::action('TournamentController@create') !!}">@lang('crud.deleteAllElements')</a>--}}
                                {{--@endcan--}}

                                {{--@can('CanCreateTournament')--}}
                                <a href="{!!   URL::action('TournamentController@create') !!}"
                                   class="btn btn-primary btn-xs pull-right"><b><i
                                                class="icon-plus22 mr-5"></i></b> @lang('crud.addModel', ['currentModelName' => $currentModelName])
                                </a>
                                {{--@endcan--}}

                                <tr>
                                    {{--<th><input type="checkbox" id="checkAll"/></th>--}}
                                    <th data-toggle="true">{{ trans('crud.name') }}</th>
                                    {{--<th>{{ trans_choice('crud.place',1) }}</th>--}}
                                    <th data-hide="phone">{{ trans('crud.date') }}</th>
                                    {{--<th>{{ trans('crud.limitDateRegistration') }}</th>--}}
                                    <th data-hide="phone">{{ trans('crud.owner') }}</th>
                                    {{--@can('CanDeleteTournament')--}}
                                    <th class="text-center">{{ trans('crud.action') }}</th>
                                    {{--@endcan--}}
                                </tr>
                                </thead>
                                @foreach($tournaments as $tournament)
                                    <tr id="{!! $tournament->slug !!}">
                                        {{--                            <td>{!! Form::checkbox('ids_to_delete[]', $tournament->id, null) !!}                            </td>--}}
                                        <td><a
                                                    href="{!!   URL::action('TournamentController@edit',  $tournament->slug) !!}">{{ $tournament->name }}</a>
                                        </td>
                                        {{--<td>{{ $tournament->place }}</td>--}}
                                        <td>{{ $tournament->date }}</td>
                                        <td>{{ $tournament->owner->name}}</td>
                                        <td class="text-center">
                                            {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteTourament', 'action' => ['TournamentController@destroy', $tournament->slug]]) !!}
                                            {{--<input type="hidden" name="_Token" value="{!!  csrf_token()  !!}">--}}
                                            {!! Form::button( '<i class="glyphicon glyphicon-remove"></i>', ['type' => 'submit','class' => 'btn text-warning-600 btn-flat btnDeleteTournament', 'id'=>'delete_'.$tournament->slug, 'data-id' => $tournament->slug ] ) !!}
                                            {!! Form::close() !!}

                                            {{--<a class="btn btn-danger btn-xs" href="/tournaments/{{ $tournament->id }}" data-method="delete" data-token="{{csrf_token()}}">--}}
                                            {{--{{ Form::open(['route' => ['tournaments.destroy', $tournament->id], 'method' => 'delete', 'id' => 'formDeleteTourament']) }}--}}
                                            {{--<button id="delete" data-id="{{$tournament->id}}" type="submit"--}}
                                            {{--class=" ">--}}
                                            {{--<span class=""></span>--}}
                                            {{--</button>--}}
                                            {{--{!! Form::close() !!}--}}

                                        </td>
                                    </tr>

                                @endforeach

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">DarkSlateBlue deleted</div>
        <div class="col-lg-4" align="right">
            <a class="undo" href="#"><span class="undo_link">UNDO</span> </a>
        </div>
    </div>

    @include("errors.list")
@stop
@section("scripts_footer")
    <script>
        var url = "{{ url("/tournaments") }}";

    </script>
{!! Html::script('js/pages/footer/tournamentIndexFooter.js') !!}
@stop