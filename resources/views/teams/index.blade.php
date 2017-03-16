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
            <ul class="nav nav-tabs nav-tabs-solid nav-justified">
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
                                @if ($championship->category->isTeam)


                                    <div class="tab-pane {{ $loop->first ? "active" : "" }}" id="{{$championship->id}}">


                                        <div class="row">
                                            <div class="col-md-10">
                                                <h1> {{$championship->buildName()}}
                                                    <span class="text-size-small ml-20">{{  trans('help.drag_competitors_name_into_team') }}</span>
                                                </h1>
                                            </div>

                                        </div>

                                        <div class="row">
                                            @include('layouts.teams.panels')

                                        </div>

                                    </div>

                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("right-panel.tournament_menu")
    @include("errors.list")

    <?php
    $arrChampionshipsWithTeamsAndCompetitors = $tournament->championships->map(function ($championship) {
        $competitors = $championship->competitors->map(function ($competitor) {
            return ["id" => $competitor->id, "name" => $competitor->user->name];
        })->toArray();
        $teams = $championship->teams->map(function ($team) {
            return ["id" => $team->id, "name" => $team->name, 'isVisible' => 1, 'competitors' => $team->competitorsWithUser];
        })->toArray();
        return ['championship' => $championship->id, 'competitors' => $competitors, 'teams' => $teams];
    })->toArray();

    if (session()->has('activeTab')) {
        $activeTab = session('activeTab');
    }
    ?>
@stop
@section('scripts_footer')
    {!! Html::script('js/pages/header/footable.js') !!}



    <script>
        var url = "{{ URL::action('TeamController@index', $tournament->slug) }}";
        var url_root_api = "{{ route("api.root")}}";
        var arrChampionshipsWithTeamsAndCompetitors = JSON.parse('{!!   json_encode($arrChampionshipsWithTeamsAndCompetitors) !!}');

                @if (isset($activeTab))
        var activeTab = "{{ $activeTab }}";
        @endif

    </script>
    {!! Html::script('js/pages/footer/teamIndexFooter.js') !!}
    {!! Html::script('js/addFighterToTeam.js')!!}
@stop
