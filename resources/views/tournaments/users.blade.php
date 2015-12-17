@extends('layouts.dashboard')

@section('content')

    <div class="container">
        <div class="row col-md-10 custyle">
            <table class="table table-striped custab">
                <thead>
                <a href="{!!   URL::action('UserController@create') !!}"
                   class="btn btn-primary btn-xs pull-right"><b>+</b> @lang('crud.addModel', ['currentModelName' => $currentModelName])
                </a>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">{{ trans('crud.username') }}</th>
                    <th class="text-center">{{ trans('crud.email') }}</th>
                    <th class="text-center">{{ trans('crud.confirmed') }}</th>
                    <th class="text-center">{{ trans('crud.avatar') }}</th>
                    <th class="text-center">{{ trans('crud.country') }}</th>
                    <th class="text-center">{{ trans('crud.action') }}</th>
                </tr>
                </thead>
                @foreach($users as $user)
                    <tr>
                        <td class="text-center"><a href="{!!   URL::action('UserController@show',  $user->id) !!}">{{ $user->id }}</a></td>
                        <td class="text-center"><a href="{!!   URL::action('UserController@show',  $user->id) !!}">{{ $user->name }}</a></td>
                        <td class="text-center">{{ $user->email }}</td>
                        <td class="text-center">
                            @if ($user->pivot->confirmed)
                                <a class=" text-success" href="#"><span class="glyphicon glyphicon-ok-sign" ></span></a>
                            @else
                                <a class=" text-danger text-center" href="#"><span class="glyphicon glyphicon-remove-sign"></span></a>
                            @endif

                        </td>
                        <td class="text-center">
                            <a href="{!!   URL::action('UserController@show',  $user->id) !!}"><img
                                        src="{{ $user->avatar }}" class="img-circle img-sm"/></a>
                        </td>

                        <td class="text-center"><img src="/images/flags/{{ $user->country->flag }}" alt="{{ $user->country->name }}"/></td>

                        <td class="text-center">
                            <a class=" text-danger "
                               href="{!! URL::action('UserController@destroy',  $user->id) !!}" data-method="delete"
                               data-token="{{csrf_token()}}">
                                <span class="glyphicon glyphicon-remove"></span></a>
                        </td>
                    </tr>

                @endforeach

            </table>
            <br/><br/>
            <div class="text-right">{{ $users->count() }} {{ Lang::get('crud.results')}}</div>

            {{--<div class="text-center">{!! $users->render() !!}</div>--}}

        </div>

    </div>

@stop

