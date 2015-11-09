@extends('layouts.dashboard')

@section('content')

    <h1>{!! $currentModelName !!}es</h1>

    <hr/>
    <div class="container">
        <div class="row col-md-8 custyle">
            <table class="table table-striped custab">
                <thead>
                <a href="{!!   URL::action('PlaceController@create') !!}" class="btn btn-primary btn-xs pull-right"><b>+</b> @lang('crud.addModel', ['currentModelName' => $currentModelName])</a>
                <tr>
                    <th>ID</th>
                    <th>{{ trans('crud.name') }}</th>
                    <th>{{ trans('crud.coords') }}</th>
                    <th>{{ trans('crud.city') }}</th>
                    <th>{{ trans('crud.state') }}</th>
                    <th>{{ trans('crud.country') }}</th>

                    <th class="text-center">{{ trans('crud.action') }}</th>
                </tr>
                </thead>
                @foreach($places as $place)
                    <tr>
                        <td>{{ $place->id }}</td>
                        <td>{{ $place->name }}</td>
                        <td>{{ $place->coords }}</td>
                        <td>{{ $place->city }}</td>
                        <td>{{ $place->state }}</td>
                        <td>{{ $place->country }}</td>

                        <td class="text-center">
                            <a class='btn btn-info btn-xs' href="{!!   URL::action('PlaceController@edit',  $place->id) !!}">
                                <span class="glyphicon glyphicon-edit"></span> {{ trans('crud.edit') }}</a>
                            <a class="btn btn-danger btn-xs"
                               href="{!! URL::action('PlaceController@destroy',  $place->id) !!}" data-method="delete" data-token="{{csrf_token()}}">
                                <span class="glyphicon glyphicon-remove"></span> {{ trans('crud.delete') }}</a>
                        </td>
                    </tr>
                            <a href="{{url('places', $place->id)}}"> </a></h2>

                @endforeach

            </table>
        </div>
    </div>

@stop

