@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/tournamentIndex.js') !!}
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
                                    <th  data-hide="phone">#</th>
                                    <th data-toggle="true">{{ trans('crud.name') }}</th>
                                    {{--<th>{{ trans_choice('crud.place',1) }}</th>--}}
                                    <th  data-hide="phone">{{ trans('crud.date') }}</th>
                                    {{--<th>{{ trans('crud.limitDateRegistration') }}</th>--}}
                                    <th  data-hide="phone">{{ trans('crud.owner') }}</th>
                                    {{--@can('CanDeleteTournament')--}}
                                    <th class="text-center">{{ trans('crud.action') }}</th>
                                    {{--@endcan--}}
                                </tr>
                                </thead>
                                @foreach($tournaments as $tournament)
                                    <tr>
                                        {{--                            <td>{!! Form::checkbox('ids_to_delete[]', $tournament->id, null) !!}                            </td>--}}
                                        <td><a
                                                    href="{!!   URL::action('TournamentController@edit',  $tournament->id) !!}">{{ $tournament->id }}</a>
                                        </td>
                                        <td><a
                                                    href="{!!   URL::action('TournamentController@edit',  $tournament->id) !!}">{{ $tournament->name }}</a>
                                        </td>
                                        {{--<td>{{ $tournament->place }}</td>--}}
                                        <td>{{ $tournament->date }}</td>
                                        {{--                            <td>{{ $tournament->registerDateLimit }}</td>--}}
                                        <td>{{ $tournament->owner->name}}</td>
                                        <td class="text-center">
                                            {{--<a class="btn btn-danger btn-xs" href="/tournaments/{{ $tournament->id }}" data-method="delete" data-token="{{csrf_token()}}">--}}
{{--                                            {{ Form::open(['route' => ['tournaments.destroy', $tournament->id], 'method' => 'delete']) }}--}}
                                            <button id="delete_{!! $tournament->id !!}" class="btn text-warning-600 btn-flat btn-icon btn-rounded"  v-on="click: deleteItem({{ $tournament->id }})">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
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
    <script>
    $(function() {

    // Initialize responsive functionality
    $('.table-togglable').footable();

    });
    </script>
    {{--<script type="text/javascript">--}}
    {{--$("#checkAll").change(function () {--}}
    {{--$("input:checkbox").prop('checked', $(this).prop("checked"));--}}
    {{--});--}}
    {{--var checkboxes = $("input[type='checkbox']");--}}
    {{--checkboxes.click(function() {--}}
    {{--$('#delete').attr("show", !checkboxes.is(":checked"));--}}
    {{--});--}}
    {{--</script>--}}
    @include("errors.list")
@stop

