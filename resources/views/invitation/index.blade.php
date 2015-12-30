@extends('layouts.dashboard')

@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-6 col-lg-offset-3">

            {{--<div class="row col-md-10 custyle">--}}
                <table class="table table-striped custab">
                    <thead>
                    <tr>
                        {{--<th><input type="checkbox" id="checkAll"/></th>--}}
                        <th >#</th>
                        <th class="text-center">{{ trans_choice('crud.tournament',1) }}</th>
                        {{--<th>{{ trans_choice('crud.place',1) }}</th>--}}
                        <th class="text-center">{{ trans('crud.organizer') }}</th>
                        <th class="text-center">{{ trans('crud.used') }}</th>

                        {{--<th>{{ trans('crud.limitDateRegistration') }}</th>--}}
                    </tr>
                    </thead>
                    @foreach($invites as $invite)
                        <tr>
                            <td><a href="/invite/register/{{$invite->code}}">{{ $invite->id }}</a></td>
                            <td align="center"><a href="/invite/register/{{$invite->code}}">{{ $invite->tournament->name }}</a></td>
                            <td align="center">{{ $invite->tournament->owner->name }}</td>
                            <td align="center">{!!  $invite->used ?
                                        '<span class=" text-success glyphicon glyphicon-ok"></span>' :
                                        '<span class=" text-warning glyphicon glyphicon-remove"></span>'!!}</td>

                        </tr>

                    @endforeach

                </table>
            </div>
        </div>
    </div>

    @include("errors.list")
@stop

