@extends('layouts.dashboard')
@section('scripts')

@stop
@section('breadcrumbs')
{!! Breadcrumbs::render('tournaments.users.index',$tournament) !!}
@stop
@section('content')
<?php
$countries = Countries::all();
$link = "";
if ($settingSize > 0 && $settingSize == $categorySize)
    $link = URL::action('TournamentController@generateTrees', ['tournamentId' => $tournament->slug]);
else
    // For showing Modal
    $link = "#";
?>
        <!-- Detached content -->
<div class="container-detached">
    <div class="content-detached">
        @foreach($tournament->categoryTournaments as $categoryTournament)
            <div class="panel panel-flat">

                <div class="panel-body">

                    <div class="container-fluid">

                        @if (Auth::user()->canEditTournament($tournament))
                            {{--<a href="{!!   $link !!}" id="generate_tree{!! $categoryTournament->id !!}"--}}
                            {{--class="btn bg-teal btn-xs pull-right ml-20"><b><i--}}
                            {{--class="icon-tree7 mr-5"></i>{{ trans('core.generate_trees') }}</b>--}}
                            {{--</a>--}}
                            <a href="#?categoryTournamentId={{$categoryTournament->id}}" data-toggle="modal"
                               data-target="#create_tournament_user"
                               class="btn btn-primary btn-xs pull-right open-modal"
                               data-id="{!! $categoryTournament->id !!}"
                               data-name="{!! $categoryTournament->category->buildName($grades) !!}"><b><i
                                            class="icon-plus22 mr-5"></i></b> @lang('core.addModel', ['currentModelName' => trans_choice('core.competitor',2)])
                            </a>
                        @endif

                        <a name="{{ $categoryTournament->category->buildName($grades) }}">
                            <legend class="text-semibold">{{ $categoryTournament->category->buildName($grades) }}</legend>
                        </a>

                        <table class="table datatable-responsive" id="table{{ $categoryTournament->id }}">
                            <thead>
                            <tr>
                                <th class="min-tablet text-center " data-hide="phone">{{ trans('core.avatar') }}</th>
                                <th class="all">{{ trans('core.username') }}</th>
                                <th class="phone">{{ trans('core.email') }}</th>
                                <th align="center" class="phone">{{ trans_choice('core.category',1) }}</th>
                                <th align="center" class="phone">{{ trans('core.confirmed') }}</th>
                                <th class="phone">{{ trans('core.country') }}</th>
                                @if (Auth::user()->canEditTournament($tournament))
                                    <th class="all">{{ trans('core.action') }}</th>
                                @endif
                            </tr>
                            </thead>


                            @foreach($categoryTournament->users as $user)
                                <?php
                                $arr_country = $countries->where('id', $user->country_id)->all();
                                $country = array_first($arr_country, null);
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <a href="{!!   URL::action('UserController@show',  $user->slug) !!}"><img
                                                    src="{{ $user->avatar }}" class="img-circle img-sm"/></a>
                                    </td>
                                    <td>
                                        @if (Auth::user()->canEditTournament($tournament))
                                            <a href="{!!   URL::action('UserController@edit',  ['users'=>$user->slug] ) !!}">{{ $user->name }}</a>
                                        @else
                                            <a href="{!!   URL::action('UserController@show',  ['users'=>$user->slug] ) !!}">{{ $user->name }}</a>
                                        @endif


                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center">{{ trans($categoryTournament->category->name)}}</td>

                                    <td class="text-center">
                                        @if ($user->pivot->confirmed)
                                            <?php $class = "glyphicon glyphicon-ok-sign text-success";?>
                                        @else
                                            <?php $class = "glyphicon glyphicon-remove-sign text-danger ";?>
                                        @endif

                                        @if (Auth::user()->canEditTournament($tournament))
                                            {!! Form::open(['method' => 'PUT', 'id' => 'formConfirmTCU',
                                        'action' => ['TournamentUserController@confirmUser', $tournament->slug, $categoryTournament->id,$user->slug  ]]) !!}


                                            <button type="submit"
                                                    class="btn btn-flat btnConfirmTCU"
                                                    id="confirm_{!! $tournament->slug !!}_{!! $categoryTournament->id !!}_{!! $user->slug !!}"
                                                    data-tournament="{!! $tournament->slug !!}"
                                                    data-category="{!! $categoryTournament->id !!}"
                                                    data-user="{!! $user->slug !!}">
                                                <i class="{!! $class  !!} "></i>
                                            </button>
                                            {!! Form::close() !!}
                                        @else
                                            <i class="{!! $class  !!} "></i>


                                        @endif


                                    </td>


                                    <td class="text-center"><img src="/images/flags/{{ $country->flag }}"
                                                                 alt="{{ $country->name }}"/></td>

                                    @if (Auth::user()->canEditTournament($tournament))
                                        <td class="text-center">

                                            {!! Form::model(null, ['method' => 'DELETE', 'id' => 'formDeleteTCU',
                                         'action' => ['TournamentUserController@deleteUser', $tournament->slug, $categoryTournament->id,$user->slug  ]]) !!}

                                            <button type="submit"
                                                    class="btn text-warning-600 btn-flat btnDeleteTCU"
                                                    id="delete_{!! $tournament->slug !!}_{!! $categoryTournament->id !!}_{!! $user->slug !!}"
                                                    data-tournament="{!! $tournament->slug !!}"
                                                    data-category="{!! $categoryTournament->id !!}"
                                                    data-user="{!! $user->slug !!}">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </td>
                                    @endif
                                </tr>

                            @endforeach

                        </table>
                        <br/>


                    </div>
                    <br/><br/>

                </div>

            </div>
        @endforeach
    </div>
</div>

@include("right-panel.users_menu")
@include("modals.add_tournament_user")
@stop
@section("scripts_footer")
    {!! Html::script('js/pages/header/tournamentUserIndex.js') !!}
    {!! Html::script('js/pages/footer/tournamentUserIndexFooter.js') !!}
    <script>
//        var link_avatar = null;

        var url = "{{ URL::action('TournamentController@show',$tournament->slug) }}";
        {{--var url_add_user = "{{ URL::action('TournamentUserController@store',$tournament->slug) }}";--}}
//        var categoryTournamentId;
//
//        var newUserName;
//        var newUserEmail;
        {{--var tournamentSlug = "{{ $tournament->slug }}";--}}
//        var form = null;
//
//
        {{--@if (Auth::user()->canEditTournament($tournament))--}}
                {{--link_avatar = '<a href="{!!   URL::action('UserController@edit',  ['users'=>$user->slug] ) !!}">{{ $user->name }}</a>';--}}
        {{--@else--}}
                {{--link_avatar = '<a href="{!!   URL::action('UserController@show',  ['users'=>$user->slug] ) !!}">{{ $user->name }}</a>';--}}
        {{--@endif--}}
{{----}}
{{----}}

        $(document).on("click", ".open-modal", function () {
            categoryTournamentId = $(this).data('id');
            categoryTournamentName = $(this).data('name');

            newUserName = $('#newUsername');
            newUserEmail = $('#newUserEmail');
            $("#categoryTournamentId").val(categoryTournamentId);
        });
        {{--$(document).on("click", "#addTournamentUser", function (e) {--}}
            {{--e.preventDefault();--}}
            {{--form = $(this).parents('form:first');--}}
            {{--var inputData = form.serialize();--}}

            {{--// AJAX Request to save user--}}
            {{--$.ajax(--}}
                    {{--{--}}
                        {{--type: 'POST',--}}
                        {{--url: url_add_user,--}}
                        {{--data: inputData,--}}
                        {{--success: function (data) {--}}
                            {{--// console.log(data.msg);--}}
                            {{--if (data != null && data.status == 'success') {--}}
                                {{--noty({--}}
                                    {{--layout: 'bottomLeft',--}}
                                    {{--theme: 'kz',--}}
                                    {{--type: 'success',--}}
                                    {{--width: 200,--}}
                                    {{--dismissQueue: true,--}}
                                    {{--timeout: 13000,--}}
                                    {{--text: data.msg,--}}
                                    {{--template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-trophy2 "></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'--}}

                                {{--});--}}

                                {{--// Get Table reference--}}

                                {{--// Add User to footable--}}
                                {{--var t = $('#table' + categoryTournamentId).DataTable();--}}
{{--//            console.log(t);--}}
                                {{--var row = t.row.add([--}}
                                    {{--'<img src="/images/avatar/avatar.png" class="img-circle img-sm">',--}}
                                    {{--newUserName.val(),--}}
                                    {{--newUserEmail.val(),--}}
                                    {{--categoryTournamentName,--}}
                                    {{--'<i class="glyphicon text-danger glyphicon-remove-sign"></i>',--}}
                                    {{--'&nbsp;',--}}
                                    {{--'<button type="submit" class="btn text-warning-600 btn-flat btnDeleteTCU" id="delete_{{$tournament->slug}}_"+categoryTournamentId+"_root" data-tournament="fake-tournoi" data-category="2" data-user="root"><i class="glyphicon glyphicon-remove"></i> </button>',--}}
                                {{--]).draw(false);--}}


                                {{--$('#addTournamentUser').prop("disabled", false);--}}
                                {{--$('#addTournamentUser').find('i').removeClass('icon-spinner spinner position-left');--}}


                            {{--} else {--}}
                                {{--noty({--}}
                                    {{--layout: 'bottomLeft',--}}
                                    {{--theme: 'kz',--}}
                                    {{--type: 'error',--}}
                                    {{--width: 200,--}}
                                    {{--dismissQueue: true,--}}
                                    {{--timeout: 5000,--}}
                                    {{--text: url_add_user,--}}
                                    {{--template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'--}}
                                {{--});--}}
                                {{--$('#addTournamentUser').prop("disabled", false);--}}
                                {{--$('#addTournamentUser').find('i').removeClass('icon-spinner spinner position-left');--}}
                            {{--}--}}

                        {{--},--}}
                        {{--error: function (data) {--}}
                            {{--var json = data.responseText;--}}
                            {{--var obj = jQuery.parseJSON(json);--}}
                            {{--// console.log(obj);--}}
                            {{--noty({--}}
                                {{--layout: 'bottomLeft',--}}
                                {{--theme: 'kz',--}}
                                {{--type: 'error',--}}
                                {{--width: 200,--}}
                                {{--dataType: 'json',--}}
                                {{--dismissQueue: true,--}}
                                {{--timeout: 5000,--}}
                                {{--text: data.responseText,--}}
                                {{--template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'--}}

                            {{--});--}}
                            {{--$('#addTournamentUser').prop("disabled", false);--}}
                            {{--$('#addTournamentUser').find('i').removeClass('icon-spinner spinner position-left');--}}

                        {{--}--}}
                    {{--}--}}
            {{--);--}}

        {{--});--}}


        //

    </script>
@stop
