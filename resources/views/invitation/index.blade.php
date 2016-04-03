@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/header/invitationIndex.js') !!}
@stop
@section('content')



    <div class="container-fluid">

        @if (sizeof($invites)==0)
            @include('layouts.joinFirstTournament')
        @else
            <div class="row">

                <div class="col-md-12 col-lg-6 col-lg-offset-3">



                    <table class="table table-togglable table-hover">
                        <thead>
                        <tr>

                            <th class="text-center" data-toggle="true">{{ trans_choice('crud.tournament',1) }}</th>
                            <th class="text-center" data-hide="phone">{{ trans('crud.organizer') }}</th>
                            <th class="text-center" data-hide="phone">{{ trans('core.type') }}</th>

                            <th class="text-center">{{ trans('crud.used') }}</th>

                        </tr>
                        </thead>
                        @foreach($invites as $invite)
                            <tr>
                                <td align="center"><a href="{!!   URL::action('TournamentController@show',  $invite->tournament->slug) !!}">{{ $invite->tournament->name }}</a></td>sh
                                <td align="center">{{ $invite->tournament->owner->name }}</td>
                                <td align="center">{{ $invite->tournament->type == 1 ? trans('core.open') : trans_choice('crud.invitation',1) }}</td>
                                <td align="center">{!!  $invite->used ?
                                        '<span class=" text-success glyphicon glyphicon-ok"></span>' :
                                        '<span class=" text-warning glyphicon glyphicon-remove"></span>'!!}</td>

                            </tr>

                        @endforeach



                    </table>
                </div>
            </div>
            <script>
                $(function() {

                    // Initialize responsive functionality
                    $('.table-togglable').footable();

                });
            </script>
        @endif


    </div>

    @include("errors.list")
@stop

