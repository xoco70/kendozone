@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/plugins/tables/footable/footable.min.js') !!}
@stop
@section('breadcrumbs')


@stop

@section('content')

    <table class="table table-togglable table-hover">
        <thead>
        <tr>
            <th data-toggle="true">ID</th>
            <th >{{ trans_choice('core.user',1) }}</th>
            <th >{{ trans('core.object_type') }}</th>
            <th >{{ trans('core.object_id') }}</th>
            <th >{{ trans('core.operation_type') }}</th>
            <th data-hide="all">{{ trans('core.old_value') }}</th>
            <th data-hide="all">{{ trans('core.new_value') }}</th>
            <th data-hide="phone">{{ trans('core.created_at') }}</th>
            <th data-hide="phone">{{ trans('core.updated_at') }}</th>
        </tr>
        </thead>
        @foreach($logs as $log)
            <tr>
                <td>{!! $log->id !!}</td>
                <td>{{ $log->user_id}}</td>
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
    <script>
        $('.table-togglable').footable()
    </script>
@stop