@extends('layouts.dashboard')
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
        $link = "";

    ?>
    <!-- Detached content -->
    <div class="container-detached">
        <div class="content-detached">
            @foreach($tournament->categoryTournaments as $categoryTournament)
                <div class="panel panel-flat">

                    <div class="panel-body">

                        <div class="container-fluid">

                            @can('edit',$tournament)
                                <a href="#categoryTournamentId={{$categoryTournament->id}}" data-toggle="modal"
                                   data-target="#create_tournament_user"
                                   class="btn btn-primary btn-xs pull-right open-modal"
                                   data-id="{!! $categoryTournament->id !!}"
                                   data-name="{!! $categoryTournament->category->buildName($grades) !!}"><b><i
                                                class="icon-plus22 mr-5"></i></b> @lang('core.addModel', ['currentModelName' => trans_choice('core.competitor',2)])
                                </a>
                            @endcan

                            <a name="{{ str_slug($categoryTournament->category->buildName($grades), "-") }}">
                                <legend class="text-semibold">{{ $categoryTournament->category->buildName($grades) }}</legend>
                            </a>

                            <table class="table datatable-responsive" id="table{{ $categoryTournament->id }}">
                                <thead>
                                <tr>
                                    <th class="min-tablet text-center "
                                        data-hide="phone">{{ trans('core.avatar') }}</th>
                                    <th class="all">{{ trans('core.username') }}</th>
                                    <th class="phone">{{ trans('core.email') }}</th>
                                    <th align="center" class="phone">{{ trans_choice('core.category',1) }}</th>
                                    <th align="center" class="phone">{{ trans('core.confirmed') }}</th>
                                    <th class="phone">{{ trans('core.country') }}</th>
                                    @can('edit',$tournament)
                                        <th class="all">{{ trans('core.action') }}</th>
                                    @endcan
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
                                            @can('edit',$tournament)
                                                <a href="{!!   URL::action('UserController@edit',  ['users'=>$user->slug] ) !!}">{{ $user->name }}</a>
                                            @else
                                                <a href="{!!   URL::action('UserController@show',  ['users'=>$user->slug] ) !!}">{{ $user->name }}</a>
                                            @endcan


                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">{{ $categoryTournament->category->buildName($grades)}}</td>

                                        <td class="text-center">
                                            @if ($user->pivot->confirmed)
                                                <?php $class = "glyphicon glyphicon-ok-sign text-success";?>
                                            @else
                                                <?php $class = "glyphicon glyphicon-remove-sign text-danger ";?>
                                            @endif

                                            @can('edit',$tournament)
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


                                            @endcan


                                        </td>


                                        <td class="text-center"><img src="/images/flags/{{ $country->flag }}"
                                                                     alt="{{ $country->name }}"/></td>

                                        @can('edit',$tournament)
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
                                        @endcan
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

    {!! JsValidator::formRequest('App\Http\Requests\TournamentUserRequest') !!}
    <script>


        var url = "{{ URL::action('TournamentController@show',$tournament->slug) }}";

        $(document).on("click", ".open-modal", function () {
            categoryTournamentId = $(this).data('id');
            categoryTournamentName = $(this).data('name');

            newUserName = $('#newUsername');
            newUserEmail = $('#newUserEmail');

            $("#categoryTournamentId").val(categoryTournamentId);
        });


    </script>
@stop
