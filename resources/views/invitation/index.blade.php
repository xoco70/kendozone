@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('invites.index') !!}

@stop

@section('content')



    <div class="container-fluid">

        @if (sizeof($invites)==0)
            @include('layouts.noInvites')
        @else
            <div class="row">

                <div class="col-md-12 col-lg-6 col-lg-offset-3">



                    <table class="table table-togglable table-hover">
                        <thead>
                        <tr>

                            <th class="text-center" data-toggle="true">{{ trans_choice('core.tournament',1) }}</th>
                            <th class="text-center" data-hide="phone">{{ trans('core.organizer') }}</th>
                            <th class="text-center" data-hide="phone">{{ trans('core.type') }}</th>

                            <th class="text-center">{{ trans('core.used') }}</th>

                        </tr>
                        </thead>
                        @foreach($invites as $invite)
                            <tr>
                                <td align="center"><a href="{!!   URL::action('TournamentController@show',  $invite->object->slug) !!}">{{ $invite->object->name }}</a></td>
                                <td align="center">{{ $invite->object->owner->name }}</td>
                                <td align="center">{{ $invite->object->type == 1 ? trans('core.open') : trans_choice('core.invitation',1) }}</td>
                                <td align="center">{!!  $invite->used ?
                                        '<span class=" text-success glyphicon glyphicon-ok"></span>' :
                                        '<span class=" text-warning glyphicon glyphicon-remove"></span>'!!}</td>

                            </tr>

                        @endforeach



                    </table>
                </div>
            </div>
        @endif


    </div>

    @include("errors.list")
@stop
@section('scripts_footer')
    {!! Html::script('js/pages/header/footable.js') !!}
    <script>
        $(function() {

            // Initialize responsive functionality
            $('.table-togglable').footable();

        });
    </script>

@stop
