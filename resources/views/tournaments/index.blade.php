@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/pagestournamentIndex.js') !!}
@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('tournaments.index') !!}

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
                                {{--@can('CanDeleteTournament')--}}
                                {{--<a id="delete" href="{!!   URL::action('TournamentController@create') !!}">@lang('crud.deleteAllElements')</a>--}}
                                {{--@endcan--}}

                                {{--@can('CanCreateTournament')--}}
                                <a href="{!!   URL::action('TournamentController@create') !!}"
                                   class="btn btn-primary btn-xs pull-right"><b><i
                                                class="icon-plus22 mr-5"></i></b> @lang('crud.addModel', ['currentModelName' => $currentModelName])
                                </a>
                                {{--@endcan--}}

                                <tr>
                                    {{--<th><input type="checkbox" id="checkAll"/></th>--}}
                                    <th data-hide="phone">#</th>
                                    <th data-toggle="true">{{ trans('crud.name') }}</th>
                                    {{--<th>{{ trans_choice('crud.place',1) }}</th>--}}
                                    <th data-hide="phone">{{ trans('crud.date') }}</th>
                                    {{--<th>{{ trans('crud.limitDateRegistration') }}</th>--}}
                                    <th data-hide="phone">{{ trans('crud.owner') }}</th>
                                    {{--@can('CanDeleteTournament')--}}
                                    <th class="text-center">{{ trans('crud.action') }}</th>
                                    {{--@endcan--}}
                                </tr>
                                </thead>
                                @foreach($tournaments as $tournament)
                                    <tr id="line">
                                        {{--                            <td>{!! Form::checkbox('ids_to_delete[]', $tournament->id, null) !!}                            </td>--}}
                                        <td>
                                            <a href="{!!   URL::action('TournamentController@edit',  $tournament->id) !!}">{{ $tournament->id }}</a>
                                        </td>
                                        <td><a
                                                    href="{!!   URL::action('TournamentController@edit',  $tournament->id) !!}">{{ $tournament->name }}</a>
                                        </td>
                                        {{--<td>{{ $tournament->place }}</td>--}}
                                        <td>{{ $tournament->date }}</td>
                                        <td>{{ $tournament->owner->name}}</td>
                                        <td class="text-center">
                                            {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteTourament', 'action' => ['TournamentController@destroy', $tournament->id]]) !!}
                                            {{--<input type="hidden" name="_Token" value="{!!  csrf_token()  !!}">--}}
                                            {!! Form::button( '<i class="glyphicon glyphicon-remove"></i>', ['type' => 'submit','class' => 'btn text-warning-600 btn-flat btnDeleteTournament', 'id'=>'delete_'.$tournament->id, 'data-id' => $tournament->id ] ) !!}
                                            {!! Form::close() !!}

                                            {{--<a class="btn btn-danger btn-xs" href="/tournaments/{{ $tournament->id }}" data-method="delete" data-token="{{csrf_token()}}">--}}
                                            {{--{{ Form::open(['route' => ['tournaments.destroy', $tournament->id], 'method' => 'delete', 'id' => 'formDeleteTourament']) }}--}}
                                            {{--<button id="delete" data-id="{{$tournament->id}}" type="submit"--}}
                                            {{--class=" ">--}}
                                            {{--<span class=""></span>--}}
                                            {{--</button>--}}
                                            {{--{!! Form::close() !!}--}}

                                        </td>
                                    </tr>

                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<tournaments></tournaments>--}}

    {{--<template id="tournaments-template">--}}
    {{--<ul>--}}
    {{--<li v-for="tournament in list.data">--}}
    {{--@{{ tournament.id }}--}}
    {{--<a href="{!!   URL::action('TournamentController@edit',  @{ tournament.id }} ) !!}">@{{ tournament.id }}</a>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--</template>--}}

    {{--<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.min.js"></script>--}}
    <script>

        $(function () {

            // Initialize responsive functionality
            $('.table-togglable').footable();
            $('.btnDeleteTournament').on('click', function (e) {
                e.preventDefault();
                var inputData = $('#formDeleteTourament').serialize();
                var dataId      =   $(this).data('id');
//                console.log(inputData);
                console.log(dataId);
                var $tr = $(this).closest('tr');
                $(this).find('i').removeClass();
                $(this).find('i').addClass('icon-spinner spinner');

                $.ajax(
                        {
                            type: 'POST',
                            url: '{{ url("/tournaments") }}' + '/' + dataId,
                            data: inputData,
                            success: function (data) {
                                if (data != null && data.status == 'success') {
                                    noty({
                                        layout: 'topRight',
                                        type: 'success',
                                        width: 200,
                                        dismissQueue: true,
                                        timeout: 3000,
                                        text: data.msg
                                    });
                                    $tr.remove();
                                } else {
                                    noty({
                                        layout: 'topRight',
                                        type: 'error',
                                        width: 200,
                                        dismissQueue: true,
                                        timeout: 3000,
                                        text: data.msg
                                    });
                                }


                            },
                            error: function (data) {
                                noty({
                                    layout: 'topRight',
                                    type: 'error',
                                    width: 200,
                                    dismissQueue: true,
                                    timeout: 3000,
                                    text: data.msg
                                });
                            }
                        }
                )

            });
        });

        //        Vue.component('tournaments', {
        //            template: '#tournaments-template',
        //            props: ['list'],
        //
        //            created(){
        ////                this.list = JSON.parse(this.list);
        //                $.getJSON('api/v1/tournaments', function (data) {
        //                    console.log(data);
        //                    this.list = data;
        //                }.bind(this))
        //            }
        //        });
        //        new Vue({
        //            el: 'body'
        //        });

        {{--$('#btnDeleteTournament').on('click', function (e) {--}}
        {{--var inputData = $('#formDeleteTourament').serialize();--}}
        {{--var dataId = $('#btnDeleteTournament').attr('data-id');--}}
        {{--var $tr = $(this).closest('tr');--}}
        {{--console.log('hola');--}}


        {{--return false;--}}
        {{--});--}}
    </script>

    @include("errors.list")
@stop

