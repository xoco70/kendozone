@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('scoresheet.index', $tournament) !!}
@stop
@section('style')
    {!! Html::style('css/pages/sheet.css')!!}
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
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="tab-content">
                            @foreach($tournament->championships as $championship)

                                <div class="tab-pane {{ $loop->first ? "active" : "" }}" id="{{$championship->id}}"
                                     @if($championship->isDirectEliminationType()) style="padding-bottom: {{ $championship->fights->count() *2 *65}}px" @endif >
                                    <h1> {{$championship->buildName()}}
                                        <a href="{{URL::action('PDFController@tree', ['championship'=> $championship->id]) }}"
                                           target="_blank"
                                           class="btn bg-teal btn-xs btnPrint pull-right ml-10 mt-5">
                                            <i class="icon-printer"></i>
                                        </a>

                                    </h1>

                                    @forelse($championship->fightersGroups as $group)
                                        @include('pdf.scoresheets.sheet', ['group' => $group])
                                    @empty
                                        {{ trans('core.still_no_scoresheet') }}
                                    @endforelse

                                </div>
                            @endforeach
                        </div>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    @include("right-panel.tournament_menu")--}}

@stop
@section('scripts_footer')
@stop
