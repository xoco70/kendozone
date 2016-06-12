@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('users.index') !!}
@stop
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="panel panel-flat">

                    <div class="panel-body">
                        <div class="container-fluid">

                            {{--<div class="row col-md-10 custyle">--}}
                            <span class="pl-10 pull-right">
                                        <a href="{!!   URL::action('UserController@create') !!}" id="adduser"
                                           class="btn btn-primary btn-xs "><b><i class="icon-plus22 mr-5"></i></b>
                                            @lang('core.addModel', ['currentModelName' => $currentModelName])
                                        </a>

                            </span>
                            <a href="{!!   URL::action('UserController@exportUsersExcel') !!}"
                               class="btn btn-success btn-xs pull-right">
                                <i class="icon-file-excel position-left"></i>Export to Excel
                            </a>
                            <table class="table table-togglable table-hover">

                                <thead>


                                <tr>
                                    <th data-hide="phone">{{ trans('core.avatar') }}</th>
                                    <th data-hide="phone">ID</th>
                                    <th data-toggle="true">{{ trans('core.username') }}</th>
                                    <th data-hide="phone">{{ trans('core.email') }}</th>
                                    <th data-hide="phone">{{ trans('core.role') }}</th>
                                    <th data-hide="phone">{{ trans('core.country') }}</th>
                                    <th class="text-center">{{ trans('core.action') }}</th>
                                </tr>
                                </thead>
                                @foreach($users as $user)
                                    <tr>
                                        <td>

                                            <a href="{!!   URL::action('UserController@edit',  $user->slug) !!}"><img
                                                        src="{{ $user->avatar }}" class="img-circle img-sm"/></a>
                                        </td>

                                        <td>
                                            <a href="{!!   URL::action('UserController@edit',  $user->slug) !!}">{{ $user->id }}</a>
                                        </td>
                                        <td>
                                            <a href="{!!   URL::action('UserController@edit',  $user->slug) !!}">{{ $user->name }}</a>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name }}</td>

                                        <td><img src="/images/flags/{{ $user->country->flag }}"
                                                 alt="{{ $user->country->name }}"/></td>

                                        <td class="text-center">
                                            <a href="{{URL::action('UserController@edit', $user->slug)}}"><i class="icon icon-pencil7"></i></a>
                                            {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteUser', 'action' => ['UserController@destroy', $user->slug], 'style'=>"display: inline-block"]) !!}
                                            {!! Form::button( '<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit','class' => 'btn text-warning-600 btn-flat btnDeleteUser', 'id'=>'delete_'.$user->slug, 'data-id' => $user->slug ] ) !!}
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
        var url = "{{ URL::action('UserController@index') }}";
    </script>
    {!! Html::script('js/pages/header/footable.js') !!}
    {!! Html::script('js/pages/footer/userIndexFooter.js') !!}
@stop
