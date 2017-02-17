@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('tournaments.users.index',$tournament) !!}
@stop
@section('content')
    <?php
    //    $countries = Countries::all();
    //    $link = "";
    //    if ($settingSize > 0 && $settingSize == $categorySize)
    //        $link = URL::action('TournamentController@generateTrees', ['tournamentId' => $tournament->slug]);
    //    else
    //        // For showing Modal
    $link = route('workingonit');

    ?>
    <!-- Detached content -->
    <div class="container-detached">
        <div class="content-detached">
            @foreach($tournament->championships as $championship)
                <div class="panel panel-flat">

                    <div class="panel-body">

                        <div class="container-fluid">

                            @can('edit',$tournament)
                                @if ($championship->category->isTeam)
                                    <a href="#championshipId={{$championship->id}}" data-toggle="modal"
                                       data-target="#create_tournament_team"
                                       class="btn btn-primary btn-xs pull-right open-modal-team"
                                       data-id="{!! $championship->id !!}"
                                       data-name="{!! $championship->category->buildName() !!}"><b><i
                                                    class="icon-plus22 mr-5"></i></b> @lang('core.addModel', ['currentModelName' => trans_choice('core.team',1)])
                                    </a>
                                @else

                                    <a href="#championshipId={{$championship->id}}" data-toggle="modal"
                                       data-target="#create_tournament_user"
                                       class="btn btn-primary btn-xs pull-right open-modal-user"
                                       data-id="{!! $championship->id !!}"
                                       data-name="{!! $championship->category->buildName() !!}"><b><i
                                                    class="icon-plus22 mr-5"></i></b> @lang('core.addModel', ['currentModelName' => trans_choice('core.competitor',1)])
                                    </a>
                                @endif
                                {{--{!! Form::model(null, ['method' => 'POST', 'id' => 'storeTree',--}}
                                {{--'action' => ['PreliminaryTreeController@store', $championship->id]]) !!}--}}

                                {{--<button type="button" @click="loadButton()"--}}
                                {{--class="btn bg-teal btn-xs pull-right mr-10">--}}
                                {{--<i v-cloak v-show="loading" class="icon-spinner spinner mr-5"></i>Generate Trees--}}

                                {{--</button>--}}
                                {{--{!! Form::close() !!}--}}

                                {!! Form::model(null, ['method' => 'POST', 'id' => 'storeTree', 'class' => 'pull-right',
'action' => ['TreeController@store', $championship->id]]) !!}

                                <button type="submit"
                                        class="btn bg-success btn-xs pull-right mr-10" id="generate">
                                    {{ trans_choice('core.generate_tree',1) }}

                                </button>


                                {!! Form::close() !!}



                            @endcan

                            <a name="{{ str_slug($championship->category->buildName(), "-") }}">
                                <legend class="text-semibold">{{ $championship->category->buildName() }} </legend>

                            </a>

                            @if ($championship->category->isTeam)
                                @include('layouts.tables.teams', ['$championship' => $championship])
                            @else
                                @include('layouts.tables.competitors', ['$championship' => $championship])
                            @endif
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
    @include("modals.add_tournament_team")
@stop
@section("scripts_footer")
    {!! Html::script('js/pages/header/competitorIndex.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\CompetitorRequest') !!}
    <script>


        var url = "{{ URL::action('TournamentController@show',$tournament->slug) }}";
        var url_team = "{{ URL::action('TeamController@index', $tournament->slug) }}";

        $(document).on("click", ".open-modal-user", function () {
            championshipId = $(this).data('id');
            championshipName = $(this).data('name');

            newUserName = $('#newUsername');
            newUserEmail = $('#newUserEmail');

            $("#championshipId").val(championshipId);
        });

        $(document).on("click", "open-modal-user-team", function () {
            championshipId = $(this).data('id');
            championshipName = $(this).data('name');

            newTeamName = $('#newTeamname');

            $("#championshipId").val(championshipId);
        });


    </script>
@stop
