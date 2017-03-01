@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('teams.index', $tournament) !!}
@stop
@section('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop
@section('content')
    <?php

    ?>
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
                        <div class="tab-content">
                            @foreach($tournament->championships as $championship)
                                <div class="tab-pane {{ $loop->first ? "active" : "" }}" id="{{$championship->id}}">
                                    <h1> {{$championship->buildName()}}</h1>


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
                                </div>
                            @endforeach
                        </div>

                    </div>
                    @include("right-panel.tournament_menu")
                    @include("errors.list")
                    @stop
                    @section('scripts_footer')
                        {!! Html::script('js/pages/header/footable.js') !!}

                        <script>
                            var url = "{{ URL::action('TeamController@index', $tournament->slug) }}";
                        </script>
                        {!! Html::script('js/pages/footer/teamIndexFooter.js') !!}

                        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                        <script>
                            $(function () {


                                $(".sortable").sortable({
                                    revert: true
                                });

                                @foreach($championship->competitors as $competitor)
                                $(".draggable").draggable({
                                    connectToSortable: ".sortable",
                                    revert: "invalid"
                                });
                                @endforeach



                                $("ul, li").disableSelection();
                            });
                        </script>
@stop
