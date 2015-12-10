@extends('layouts.dashboard')

@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-6 col-lg-offset-3">

            {{--<div class="row col-md-10 custyle">--}}
                <table class="table table-striped custab">
                    <thead>
                    {{--@can('CanDeleteTournament')--}}
                    {{--<a id="delete" href="{!!   URL::action('TournamentController@create') !!}">@lang('crud.deleteAllElements')</a>--}}
                    {{--@endcan--}}

                    @can('CanCreateTournament')
                    <a href="{!!   URL::action('TournamentController@create') !!}"
                       class="btn btn-primary btn-xs pull-right"><b>+</b> @lang('crud.addModel', ['currentModelName' => $currentModelName])
                    </a>
                    @endcan

                    <tr>
                        {{--<th><input type="checkbox" id="checkAll"/></th>--}}
                        <th>#</th>
                        <th>{{ trans('crud.name') }}</th>
                        {{--<th>{{ trans_choice('crud.place',1) }}</th>--}}
                        <th>{{ trans('crud.date') }}</th>
                        {{--<th>{{ trans('crud.limitDateRegistration') }}</th>--}}
                        <th>{{ trans('crud.owner') }}</th>
                        @can('CanDeleteTournament')
                        <th class="text-center">{{ trans('crud.action') }}</th>
                        @endcan
                    </tr>
                    </thead>
                    @foreach($tournaments as $tournament)
                        <tr>
{{--                            <td>{!! Form::checkbox('ids_to_delete[]', $tournament->id, null) !!}                            </td>--}}
                            <td>@can('CanEditTournament')<a href="{!!   URL::action('TournamentController@edit',  $tournament->id) !!}">@endCan{{ $tournament->id }}@can('CanEditTournament')</a>@endCan</td>
                            <td>@can('CanEditTournament')<a href="{!!   URL::action('TournamentController@edit',  $tournament->id) !!}">@endCan{{ $tournament->name }}@can('CanEditTournament')</a>@endCan</td>
                            {{--<td>{{ $tournament->place }}</td>--}}
                            <td>{{ $tournament->date }}</td>
{{--                            <td>{{ $tournament->registerDateLimit }}</td>--}}
                            <td>{{ $tournament->user->name}}</td>
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

