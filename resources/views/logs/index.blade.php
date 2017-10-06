@extends('layouts.dashboard')
@section('title')
    <title>{{ trans_choice('structures.association',2) }}</title>
@stop

@section('breadcrumbs')
@stop

@section('content')
    <ul class="nav nav-lg nav-tabs nav-tabs-bottom search-results-tabs">
        <li {{ Request::is('logs*') ? 'class=active' : '' }}>
            <a href="{{ route('logs.index') }}">
                <i class="position-left"></i> Logs
            </a>
        </li>
        <li {{ Request::is('debug*') ? 'class=active' : '' }}>
            <a href="{{ route('debug.index') }}">
                <i class="position-left"></i> Debug
            </a>
        </li>
    </ul>

    <table class="table table-togglable table-hover">
        <thead>
        <tr>
            <th data-toggle="true">ID</th>
            <th>{{ trans_choice('core.user',1) }}</th>
            <th>{{ trans('core.object_type') }}</th>
            <th>{{ trans('core.object_id') }}</th>
            <th>{{ trans('core.operation_type') }}</th>
            <th data-hide="all">{{ trans('core.old_value') }}</th>
            <th data-hide="all">{{ trans('core.new_value') }}</th>
            <th data-hide="phone">{{ trans('core.created_at') }}</th>
            <th data-hide="phone">{{ trans('core.updated_at') }}</th>
        </tr>
        </thead>
        @foreach($logs as $log)
            <tr>
                <td>{!! $log->id !!}</td>
                <td>@if ($log->user!= null) {{ $log->user->name }} @endif</td>
                <td>{{ $log->owner_type }}</td>
                <td>{{ $log->owner_id }}</td>
                <td>{{ $log->type }}</td>
                <td>{{ serialize($log->old_value) }}</td>
                <td>{{ serialize($log->new_value) }}</td>
                <td>{{ $log->created_at }}</td>
                <td>{{ $log->updated_at }}</td>
            </tr>

        @endforeach

    </table>
    <div class="text-center">{!! $logs->render() !!}</div>


@stop
@section("scripts_footer")
    {!! Html::script('js/plugins/tables/footable/footable.min.js') !!}
    <script>
        $('.table-togglable').footable()
    </script>
@stop