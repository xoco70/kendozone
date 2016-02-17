@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/header/userIndex.js') !!}
@stop

@section('breadcrumbs')
    {!! Breadcrumbs::render('users.index') !!}
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
                                    <span class="pl-10 pull-right">
                                    <a href="{!!   URL::action('UserController@create') !!}"
                                       class="btn btn-primary btn-xs "><b><i
                                                    class="icon-plus22 mr-5"></i></b> @lang('crud.addModel', ['currentModelName' => $currentModelName])
                                    </a>

                                    </span>
                                    <a href="{!!   URL::action('UserController@exportUsersExcel') !!}"
                                       class="btn btn-success btn-xs pull-right"><i
                                                class="icon-file-excel position-left"></i>Export
                                        to Excel</a>

                                    <tr>
                                        <th data-hide="phone">ID</th>
                                        <th data-toggle="true">{{ trans('crud.username') }}</th>
                                        <th data-hide="phone">{{ trans('crud.email') }}</th>
                                        <th data-hide="phone">{{ trans('crud.role') }}</th>
                                        <th data-hide="phone">{{ trans('crud.avatar') }}</th>
                                        <th data-hide="phone">{{ trans('crud.country') }}</th>
                                        <th class="text-center">{{ trans('crud.action') }}</th>
                                    </tr>
                                </thead>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <a href="{!!   URL::action('UserController@edit',  $user->slug) !!}">{{ $user->id }}</a>
                                        </td>
                                        <td>
                                            <a href="{!!   URL::action('UserController@edit',  $user->slug) !!}">{{ $user->name }}</a>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>
                                            <a href="{!!   URL::action('UserController@edit',  $user->slug) !!}"><img
                                                        src="{{ $user->avatar }}" class="img-circle img-sm"/></a>
                                        </td>

                                        <td><img src="/images/flags/{{ $user->country->flag }}"
                                                 alt="{{ $user->country->name }}"/></td>

                                        <td class="text-center">
                                            {{ Form::open(['route' => ['users.destroy', $user->slug], 'method' => 'delete']) }}
                                            <button id="delete_{{$user->slug}}" type="submit"
                                                    class="btn text-warning-600 btn-flat btn-icon btn-rounded">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>

                                @endforeach

                            </table>
                            <br/><br/>
                            <div class="text-center">{!! $users->render() !!}</div>

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

@stop
@section("scripts_footer")
    <script>
        var url = "{{ url("/tournaments") }}";

    </script>
    {!! Html::script('js/pages/footer/userIndexFooter.js') !!}
@stop
