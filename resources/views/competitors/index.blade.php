@extends('layouts.dashboard')

@section('content')

    <h1>{!! $currentModelName !!}es</h1>

    <hr/>
    <div class="container">
        <div class="row col-md-8 custyle">
            <table class="table table-striped custab">
                <thead>
                <a href="{!!   URL::action('CompetitorController@create') !!}" class="btn btn-primary btn-xs pull-right"><b>+</b> @lang('crud.addModel', ['currentModelName' => $currentModelName])</a>
                <tr>
                    <th>ID</th>
                    <th>{{ trans('crud.name') }}</th>
                    <th>{{ trans('crud.coords') }}</th>
                    {{--<th>{{ trans('crud.city') }}</th>--}}
                    {{--<th>{{ trans('crud.state') }}</th>--}}
                    {{--<th>{{ trans('crud.country') }}</th>--}}

                    <th class="text-center">{{ trans('crud.action') }}</th>
                </tr>
                </thead>
                @foreach($competitors as $competitor)
                    <tr>
                        <td>{{ $competitor->id }}</td>
                        <td>{{ $competitor->name }}</td>
                        <td>{{ $competitor->coords }}</td>
                        {{--<td>{{ $competitor->city }}</td>--}}
                        {{--<td>{{ $competitor->state }}</td>--}}
                        {{--<td>{{ $competitor->country }}</td>--}}

                        <td class="text-center">
                            <a class='btn btn-info btn-xs' href="{!!   URL::action('CompetitorController@edit',  $competitor->id) !!}">
                                <span class="glyphicon glyphicon-edit"></span> {{ trans('crud.edit') }}</a>
                            <a class="btn btn-danger btn-xs"
                               href="{!! URL::action('CompetitorController@destroy',  $competitor->id) !!}" data-method="delete" data-token="{{csrf_token()}}">
                                <span class="glyphicon glyphicon-remove"></span> {{ trans('crud.delete') }}</a>
                        </td>
                    </tr>
                    <a href="{{url('competitors', $competitor->id)}}"> </a></h2>

                @endforeach

            </table>
        </div>
    </div>

@stop