@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('scoresheet.index', $tournament) !!}
@stop
@section('styles')
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

            <div class="tab-content">
                @foreach($tournament->championships as $championship)

                    <div class="tab-pane {{ $loop->first ? "active" : "" }}" id="{{$championship->id}}">

                        <div style=" text-align: right; margin-bottom: 10px; ">

                            <a href="{{URL::action('PDFController@scoresheets', ['championship'=> $championship->id]) }}"
                               target="_blank"
                               class="btn bg-teal btn-xs btnPrint rightButton">
                                <i class="icon-printer"></i>
                            </a>
                        </div>
                        @include('layouts.scoresheets.sheets', ['championship' => $championship])

                    </div>
                @endforeach
            </div>
            <br/>

        </div>
    </div>

@stop
@section('scripts_footer')
@stop
