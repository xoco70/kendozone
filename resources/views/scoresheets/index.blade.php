@extends('layouts.dashboard')
@section('title')
    <title>{{ trans_choice('core.scoresheet',2) }}</title>
@stop

@section('breadcrumbs')
    {!! Breadcrumbs::render('scoresheet.index', $tournament) !!}
@stop
@section('content')
    <div class="container-fluid">
        <div class="content">
            @include('layouts.tree.topTree')
            <ul class="nav nav-tabs nav-tabs-solid nav-justified trees">
                @foreach($tournament->championships as $championship)
                    <li class={{ $loop->first ? "active" : "" }}>
                        <a href="#{{$championship->id}}" data-toggle="tab"
                           id="tab{{$championship->id}}">{{$championship->buildName()}}</a>
                    </li>

                @endforeach
            </ul>

            <div class="tab-content">
                @foreach($tournament->championships as $championship)
                    <?php
                    if ($championship->category->isTeam()) {
                        $fighters = $championship->teams;
                    } else {
                        $fighters = $championship->competitors;
                    }
                    $roundTitles = $championship->getRoundTitle(sizeof($fighters));
                    ?>
                    <div class="tab-pane {{ $loop->first ? "active" : "" }}" id="{{$championship->id}}">

                        <div style=" text-align: right; margin-bottom: 10px; ">
                            @if (! $championship->isPlayOffType() && sizeof($championship->fightersGroups)>0)
                                <a href="{{URL::action('PDFController@scoresheets', ['championship'=> $championship->id]) }}"
                                   target="_blank"
                                   class="btn bg-teal btn-xs btnPrint rightButton">
                                    <i class="icon-printer"></i>
                                </a>
                            @endif
                        </div>
                        @if (! $championship->isPlayOffType())
                            @include('layouts.scoresheets.sheets')
                        @else
                            <div class="panel panel-flat page_print">
                                <div class="panel-body">
                                    <div class="container-fluid">
                                        <h1 align="center">{{ trans('core.no_scoresheet_for_playoff') }}</h1>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <br/>

        </div>
    </div>

@stop
@section('scripts_footer')
@stop
