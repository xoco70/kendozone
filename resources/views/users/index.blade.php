@extends('layouts.dashboard')

@section('content')

    <div class="container">
        <div class="row col-md-10 custyle">
            <table class="table table-striped custab">
                <thead>
                <span class="pl-10 pull-right">
                                    <a href="{!!   URL::action('UserController@create') !!}"
                                       class="btn btn-primary btn-xs "><b><i class="icon-plus22 mr-5" ></i></b> @lang('crud.addModel', ['currentModelName' => $currentModelName])
                                    </a>

</span>
                <a href="{!!   URL::action('UserController@exportUsersExcel') !!}" class="btn btn-success btn-xs pull-right"><i class="icon-file-excel position-left"></i>Export
                    to Excel</a>

                <tr>
                    <th>ID</th>
                    <th>{{ trans('crud.username') }}</th>
                    <th>{{ trans('crud.email') }}</th>
                    <th>{{ trans('crud.role') }}</th>
                    <th>{{ trans('crud.avatar') }}</th>
                    <th>{{ trans('crud.country') }}</th>
                    <th class="text-center">{{ trans('crud.action') }}</th>
                </tr>
                </thead>
                @foreach($users as $user)
                    <tr>
                        <td><a href="{!!   URL::action('UserController@edit',  $user->id) !!}">{{ $user->id }}</a></td>
                        <td><a href="{!!   URL::action('UserController@edit',  $user->id) !!}">{{ $user->name }}</a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>
                            <a href="{!!   URL::action('UserController@edit',  $user->id) !!}"><img
                                        src="{{ $user->avatar }}" class="img-circle img-sm"/></a>
                        </td>

                        <td><img src="/images/flags/{{ $user->country->flag }}" alt="{{ $user->country->name }}"/></td>

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
            <div class="text-center">{!! $users->render() !!}</div>

        </div>

    </div>

@stop

