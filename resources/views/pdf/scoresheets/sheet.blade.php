@extends('layouts.scoreSheets.master')
@section('content')
    <p align="center">{{ $championship->tournament->name }}</p>
    {{--        <p align="center">{{ $tournamentGroup->round }}</p>--}}

    {{  Form::model($sheet, ["action" => [$sheet == null ?
                                                "ScoreSheetController@store" :
                                                "ScoreSheetController@update",
     $championship->slug]]) }}


    <div class="row">
        <div class="col-md-5">
            {!!  Form::label('championship', trans('core.championship'),['class' => 'text-bold' ]) !!}:
            {!!  Form::text('championship', 'championship Name', ['class' => 'form-control sheet_championship']) !!}
        </div>
        <div class="col-md-1">
            {!!  Form::label('shiajo', trans('core.shiajo'),['class' => 'text-bold' ]) !!}:
            {!!  Form::text('shiajo', '1', ['class' => 'form-control sheet_shiajo']) !!}
        </div>
        <div class="col-md-1">
            {!!  Form::label('group', trans('core.group'),['class' => 'text-bold' ]) !!}:
            {!!  Form::text('group', '1', ['class' => 'form-control sheet_group']) !!}
        </div>
        <div class="col-md-5">
            {!!  Form::label('writer', trans('core.writer'),['class' => 'text-bold' ]) !!}:
            {!!  Form::text('writer', 'Pito Perez', ['class' => 'form-control sheet_writer']) !!}
        </div>
    </div>


    {{--<div class="row">--}}
    {{--<div class="col-md-6">--}}
    {{--{!!  Form::text('short_id_1', '1', ['class' => 'form-control']) !!}--}}
    {{--{!!  Form::text('name1', 'Competitor 1', ['class' => 'form-control sheet_shortid']) !!}<br/>--}}

    {{--{!!  Form::text('short_id_2', '1', ['class' => 'form-control']) !!}--}}
    {{--{!!  Form::text('name2', 'Competitor 2', ['class' => 'form-control sheet_shortid']) !!}<br/>--}}

    {{--{!!  Form::text('short_id_3', '1', ['class' => 'form-control']) !!}--}}
    {{--{!!  Form::text('name3', 'Competitor 3', ['class' => 'form-control sheet_shortid']) !!}<br/>--}}

    {{--</div>--}}
    {{--<div class="col-md-6">--}}
    {{--<small>{{ trans('sheet.points') . ( trans('sheet.points_abrev') ) }}</small>--}}
    {{--<table>--}}
    {{--<tr>--}}
    {{--<th>&nbsp;</th>--}}
    {{--<th>I</th>--}}
    {{--<th>II</th>--}}
    {{--<th>III</th>--}}
    {{--<th>Tot</th>--}}
    {{--<th>&nbsp;</th>--}}
    {{--<th>{{ trans('sheet.clasify') }}</th>--}}
    {{--</tr>--}}

    {{--<tr>--}}
    {{--<td>&nbsp;</td>--}}
    {{--<td>{!!  Form::select('point1_c1', 'K', ['K','M','D','T','H'], ['class' => 'form-control sheet_point']) !!}</td>--}}
    {{--<td>{!!  Form::select('point2_c1', 'K', ['K','M','D','T','H'], ['class' => 'form-control sheet_point']) !!}</td>--}}
    {{--<td>{!!  Form::select('point3_c1', 'K', ['K','M','D','T','H'], ['class' => 'form-control sheet_point']) !!}</td>--}}
    {{--<td>1</td>--}}
    {{--<td>&nbsp;</td>--}}
    {{--<td>Yes</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--<td>&nbsp;</td>--}}
    {{--<td>{!!  Form::select('point1_c2', 'K', ['K','M','D','T','H'], ['class' => 'form-control sheet_point']) !!}</td>--}}
    {{--<td>{!!  Form::select('point2_c2', 'K', ['K','M','D','T','H'], ['class' => 'form-control sheet_point']) !!}</td>--}}
    {{--<td>{!!  Form::select('point3_c2', 'K', ['K','M','D','T','H'], ['class' => 'form-control sheet_point']) !!}</td>--}}
    {{--<td>2</td>--}}
    {{--<td>&nbsp;</td>--}}
    {{--<td>No</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--<td>&nbsp;</td>--}}
    {{--<td>{!!  Form::select('point1_c3', 'K', ['K','M','D','T','H'], ['class' => 'form-control sheet_point']) !!}</td>--}}
    {{--<td>{!!  Form::select('point2_c3', 'K', ['K','M','D','T','H'], ['class' => 'form-control sheet_point']) !!}</td>--}}
    {{--<td>{!!  Form::select('point3_c3', 'K', ['K','M','D','T','H'], ['class' => 'form-control sheet_point']) !!}</td>--}}
    {{--<td>2</td>--}}
    {{--<td>&nbsp;</td>--}}
    {{--<td>No</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--<td>{{ trans('core.time') }}</td>--}}
    {{--<td>{!!  Form::text('time1', 'Competitor 1', ['class' => 'form-control sheet_shortid']) !!}</td>--}}
    {{--<td>{!!  Form::text('time2', 'Competitor 1', ['class' => 'form-control sheet_shortid']) !!}</td>--}}
    {{--<td>{!!  Form::text('time3', 'Competitor 1', ['class' => 'form-control sheet_shortid']) !!}</td>--}}
    {{--<td>&nbsp;</td>--}}
    {{--<td>&nbsp;</td>--}}
    {{--<td>&nbsp;</td>--}}
    {{--</tr>--}}
    {{--</table>--}}
    {{--</div>--}}
    {{--</div>--}}
    <div align="center">{{ trans('core.playoff') }}</div>
    {{--<div class="row">--}}
    {{--<div class="col-5">--}}
    {{--{!!  Form::label('point',  trans('sheet.points_abrev'),['class' => 'text-bold' ]) !!}<br/>--}}
    {{--</div>--}}
    {{--<div class="col-1"> X</div>--}}
    {{--<div class="col-5"></div>--}}
    {{--<div class="col-1"></div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-5">--}}
    {{--{!!  Form::text('point', '1', ['class' => 'form-control']) !!}--}}
    {{--{!!  Form::text('id', '1', ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--<div class="col-1"> X</div>--}}
    {{--<div class="col-5">--}}
    {{--{!!  Form::text('id', '1', ['class' => 'form-control']) !!}--}}
    {{--{!!  Form::text('point', '1', ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--<div class="col-1">--}}
    {{--{!!  Form::label('time',  trans('sheet.points_abrev'),['class' => 'text-bold' ]) !!}<br/>--}}
    {{--{!!  Form::text('time', '1', ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-5">--}}
    {{--{!!  Form::text('point', '1', ['class' => 'form-control']) !!}--}}
    {{--{!!  Form::text('id', '1', ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--<div class="col-1"> X</div>--}}
    {{--<div class="col-5">--}}
    {{--{!!  Form::text('id', '1', ['class' => 'form-control']) !!}--}}
    {{--{!!  Form::text('point', '1', ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--<div class="col-1">--}}
    {{--{!!  Form::label('time',  trans('sheet.points_abrev'),['class' => 'text-bold' ]) !!}<br/>--}}
    {{--{!!  Form::text('time', '1', ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
    {{--<div class="col-5">--}}
    {{--{!!  Form::text('point', '1', ['class' => 'form-control']) !!}--}}
    {{--{!!  Form::text('id', '1', ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--<div class="col-1"> X</div>--}}
    {{--<div class="col-5">--}}
    {{--{!!  Form::text('id', '1', ['class' => 'form-control']) !!}--}}
    {{--{!!  Form::text('point', '1', ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--<div class="col-1">--}}
    {{--{!!  Form::label('time',  trans('sheet.points_abrev'),['class' => 'text-bold' ]) !!}<br/>--}}
    {{--{!!  Form::text('time', '1', ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--</div>--}}


    {{--<div align="right">--}}
    {{--{!!  Form::text(trans('sheet.leader'), 'Maya', ['class' => 'form-control sheet_leader']) !!}--}}
    {{--{!!  Form::label('leader',  trans('sheet.leader'),['class' => 'text-bold' ]) !!}--}}
    {{--</div>--}}
    {{--@if ($championship->isPreliminary())--}}
    {{--@elseif ($championship->isDirectElimination())--}}
    {{--@elseif ($championship->isRoundRobin())--}}
    {{--@endif--}}


    {{--{{  Form::close() }}--}}
@stop
@section('footer')
    {{--@include('pdf.footer')--}}
@stop
@section('scripts_footer')
    {{--    {!! Html::style('css/pages/preliminary_trees.css')!!}--}}
@stop


