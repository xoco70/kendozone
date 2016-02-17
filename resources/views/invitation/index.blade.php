@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/invitationIndex.js') !!}
@stop
@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-6 col-lg-offset-3">

            {{--<div class="row col-md-10 custyle">--}}
                <table class="table table-togglable table-hover">
                    <thead>
                    <tr>
                        {{--<th><input type="checkbox" id="checkAll"/></th>--}}
                        {{--<th data-hide="phone">#</th>--}}
                        <th class="text-center" data-toggle="true">{{ trans_choice('crud.tournament',1) }}</th>
                        {{--<th>{{ trans_choice('crud.place',1) }}</th>--}}
                        <th class="text-center" data-hide="phone">{{ trans('crud.organizer') }}</th>
                        <th class="text-center" data-hide="phone">{{ trans('core.type') }}</th>

                        <th class="text-center">{{ trans('crud.used') }}</th>

                        {{--<th>{{ trans('crud.limitDateRegistration') }}</th>--}}
                    </tr>
                    </thead>
                    @foreach($invites as $invite)
                        <tr>
                            {{--<td><a href="/invite/register/{{$invite->code}}">{{ $invite->id }}</a></td>--}}
                            <td align="center"><a href="/invite/register/{{$invite->code}}">{{ $invite->tournament->name }}</a></td>
                            <td align="center">{{ $invite->tournament->owner->name }}</td>
                            <td align="center">{{ $invite->tournament->type == 0 ? trans('core.open') : trans_choice('crud.invitation',1) }}</td>
                            <td align="center">{!!  $invite->used ?
                                        '<span class=" text-success glyphicon glyphicon-ok"></span>' :
                                        '<span class=" text-warning glyphicon glyphicon-remove"></span>'!!}</td>

                        </tr>

                    @endforeach

                </table>
            </div>
        </div>
    </div>
    <script>
        $(function() {

            // Initialize responsive functionality
            $('.table-togglable').footable();

        });
    </script>
    @include("errors.list")
@stop

