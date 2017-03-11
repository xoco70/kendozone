@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('teams.index', $tournament) !!}
@stop
@section('styles')
    {!! Html::style('/css/dragula.css')!!}
@stop
@section('content')
    <div class="container-detached">
        <div class="content-detached">
            <ul class="nav nav-tabs nav-tabs-solid nav-justified trees">
                @foreach($tournament->championships as $championship)
                    @if ($championship->category->isTeam)
                        <li class={{ $loop->first ? "active" : "" }}>
                            <a href="#{{$championship->id}}" data-toggle="tab"
                               id="tab{{$championship->id}}">{{$championship->buildName()}}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="tab-content" id="dragula_top">
                            @foreach($tournament->championships as $championship)
                                <div class="tab-pane {{ $loop->first ? "active" : "" }}" id="{{$championship->id}}">

                                    {!! Form::model($tournament, ["action" => ["TeamController@store", $championship->slug]]) !!}
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h1> {{$championship->buildName()}}
                                                <span class="text-size-small ml-20">{{  trans('help.drag_competitors_name_into_team') }}</span>
                                            </h1>
                                        </div>
                                        <div class="col-md-2" align="right">
                                            <button type="submit" class="btn btn-success" id="saveTournament">
                                                {{trans("core.updateModel", ['currentModelName' => trans_choice('core.team',2) ]) }}
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row">

                                        @if (sizeof($championship->teams)==0)
                                            <div class="col-md-8 col-md-offset-2">
                                                @include('layouts.noTeams')
                                            </div>
                                        @else

                                            {{--@can('create', [App\Team::class, $tournament])--}}
                                            {{--<span class="pl-10 pull-right">--}}
                                            {{--<a href="{!!   URL::action('TeamController@create', $tournament->slug) !!}" id="addTeam"--}}
                                            {{--class="btn btn-primary btn-xs "><b><i class="icon-plus22 mr-5"></i></b>--}}
                                            {{--@lang('core.addModel', ['currentModelName' => $currentModelName])--}}
                                            {{--</a>--}}
                                            {{--</span>--}}
                                            {{--@endcan--}}

                                            @include('layouts.teams.panels')
                                        @endif

                                    </div>
                                    {!! Form::close()!!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $arrCompetitors = $championship->competitors->map(function ($competitor) {
        return ["id" => $competitor->user->id, "name" => $competitor->user->name, "competitors" => []];
    })->toArray();

    $arrTeams = $championship->teams->map(function ($team) {
        return ["id" => $team->id, "name" => $team->name];
    })->toArray();
    ?>


    @include("right-panel.tournament_menu")
    @include("errors.list")
@stop
@section('scripts_footer')
    {!! Html::script('js/pages/header/footable.js') !!}

    <script>
        var url = "{{ URL::action('TeamController@index', $tournament->slug) }}";
        var names = JSON.parse('{!!   json_encode($arrCompetitors) !!}');
        var myTeams = JSON.parse('{!!   json_encode($arrTeams   ) !!}');
    </script>
    {!! Html::script('js/pages/footer/teamIndexFooter.js') !!}
    {!! Html::script('js/addFighterToTeam.js')!!}
@stop
