@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('users.index') !!}
@stop
@section('content')
    <!-- Tabs -->


    @include('layouts.displayMenuMyEntitiesOnTop')

    <!-- /tabs -->
    <div class="container-fluid">
        <div class="row">


            {{--<div class="row col-md-10 custyle">--}}
            <table class="table table-togglable table-hover">

                <thead>


                <tr>
                    <th data-hide="phone">{{ trans('core.avatar') }}</th>
                    <th data-hide="phone">ID</th>
                    <th data-toggle="true">{{ trans('core.username') }}</th>
                    <th data-hide="phone">{{ trans('core.email') }}</th>
                    <th data-hide="phone">{{ trans('core.role') }}</th>
                    <th data-hide="phone">{{ trans('core.country') }}</th>
                    <th data-hide="all">{{ trans_choice('core.federation',1) }}</th>
                    <th data-hide="all">{{ trans_choice('core.association',1) }}</th>
                    <th class="text-center">{{ trans('core.action') }}</th>
                </tr>
                </thead>
                @foreach($users as $user)
                    <tr>
                        <td>

                            <a href="{!!   URL::action('UserController@edit',  $user->slug) !!}">

                                <img class="img-circle img-sm"
                                     src="{{ $user->avatar ?? Avatar::create($user->email)->toBase64() }}"/>

                            </a>
                        </td>

                        <td>
                            <a href="{!!   URL::action('UserController@edit',  $user->slug) !!}">{{ $user->id }}</a>
                        </td>
                        <td>
                            <a href="{!!   URL::action('UserController@edit',  $user->slug) !!}">{{ $user->name }}</a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>

                        <td><img src="/images/flags/{{ $user->country->flag ?? "no_flag.png"}}"
                                 alt="{{ $user->country->name }}"/></td>

                        <td>{{ $user->federation != null ? trans($user->federation->name) : " - "}}</td>
                        <td>{{ $user->association != null ? trans($user->association->name) : " - " }}</td>
                        <td class="text-center">
                            <a href="{{URL::action('UserController@edit', $user->slug)}}">
                                <i class="icon icon-pencil7"></i></a>
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


@stop
@section("scripts_footer")
    <script>
        var url = "{{ route('users.index') }}";
        var url_restore = "{{ route('api.users.index') }}";
    </script>
    {!! Html::script('js/pages/header/footable.js') !!}
    {!! Html::script('js/pages/footer/userIndexFooter.js') !!}
@stop
