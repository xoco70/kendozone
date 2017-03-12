@extends('layouts.scoreSheets.master')
@section('content')
    <p align="center">{{ $championship->tournament->name }}</p>

    <?php
    $groups = $championship->fightersGroups;
    $group = $groups->get(0);
    if ($championship->category->isTeam()) {
        $fighters = $group->teams;
    } else {
        $fighters = $group->competitors;
    }

    ?>


    {{--        <p align="center">{{ $tournamentGroup->round }}</p>--}}

    {{  Form::model($sheet, ["action" => [$sheet == null ?
                                                "ScoreSheetController@store" :
                                                "ScoreSheetController@update",
     $championship->slug], 'class' => 'class="form-horizontal'] ) }}


    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('championship', trans('core.championship'),['class' => 'text-bold' ]) !!}:
                {!!  Form::text('championship', 'championship Name', ['class' => 'form-control sheet_championship']) !!}
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                {!!  Form::label('shiajo', trans('core.shiajo'),['class' => 'text-bold' ]) !!}:
                {!!  Form::text('shiajo', '1', ['class' => 'form-control sheet_shiajo']) !!}
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                {!!  Form::label('group', trans('core.group'),['class' => 'text-bold' ]) !!}:
                {!!  Form::text('group', '1', ['class' => 'form-control sheet_group']) !!}
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!!  Form::label('writer', trans('core.writer'),['class' => 'text-bold' ]) !!}:
                {!!  Form::text('writer', 'Pito Perez', ['class' => 'form-control sheet_writer']) !!}
            </div>
        </div>
    </div>

    <br/><br/><br/>
    <div class="row">
        {{--Competitors--}}
        <div class="col-md-6">
            <div class="row">&nbsp;</div>
            <div class="row">&nbsp;</div>

            @foreach($fighters as $fighter )

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-2">
                            {!!  Form::text('short_id[]', $fighter->short_id, ['class' => 'form-control sheet_shortid']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!  Form::text('name[]', $fighter->user != null ? $fighter->user->name : "BYE", ['class' => 'form-control competitor_name']) !!}
                        </div>
                    </div>
                </div>
                <br/>
            @endforeach


        </div>
        {{--End Competitors--}}
        {{--Points--}}
        <div class="col-md-6">
            <div class="row">
                <table>
                    <tr>
                        <td colspan="6" align="center">
                            <small>{{ trans('core.points') }} ( {{  trans('core.points_abrev') }} )</small>
                        </td>
                    </tr>
                    <tr class="lines">
                        <td align="center">&nbsp;</td>
                        <td align="center">I</td>
                        <td align="center">II</td>
                        <td align="center">III</td>
                        <td align="center">Tot</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">{{ trans('core.clasify') }}</td>
                    </tr>
                    @foreach($fighters as $fighter)
                        <tr>
                            <td align="center">&nbsp;</td>
                            @foreach($group->fights as $fight)
                                <td align="center">
                                    {!!  Form::select('point1[]', ['K' => "Kote",'M'=> "Men",'D' => "Do",'T' => "Tsuki",'H'=> "Hantei"], 'K', ['class' => 'form-control sheet_point']) !!}
                                </td>
                            @endforeach
                            <td align="center" class="total">11</td>
                            <td align="center">&nbsp;</td>
                            <td align="center" class="clasify">Si</td>
                        </tr>
                        <tr class="spacer">
                            <td colspan="7">&nbsp;</td>
                        </tr>

                    @endforeach
                    <tr>
                        <td>{{ trans('core.time') }}</td>
                        @foreach($group->fights as $fight)
                            <td>{!!  Form::text('time[]', '01:11', ['class' => 'form-control sheet_point']) !!}</td>
                        @endforeach
                        <td colspan="2">&nbsp;</td>
                    </tr>

                </table>

            </div>
        </div>
    </div>
    {{--End Points--}}






    {{--<p align="center">{{ trans('core.playoff') }}</p>--}}
    {{--<div class="row">--}}
    {{--<div class="col-5">--}}
    {{--{!!  Form::label('point',  trans('core.points_abrev'),['class' => 'text-bold' ]) !!}<br/>--}}
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
    {{--{!!  Form::label('time',  trans('core.points_abrev'),['class' => 'text-bold' ]) !!}<br/>--}}
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
    {{--{!!  Form::label('time',  trans('core.points_abrev'),['class' => 'text-bold' ]) !!}<br/>--}}
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
    {{--{!!  Form::label('time',  trans('core.points_abrev'),['class' => 'text-bold' ]) !!}<br/>--}}
    {{--{!!  Form::text('time', '1', ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--</div>--}}


    {{--<div align="right">--}}
    {{--{!!  Form::text(trans('core.leader'), 'Maya', ['class' => 'form-control sheet_leader']) !!}--}}
    {{--{!!  Form::label('leader',  trans('core.leader'),['class' => 'text-bold' ]) !!}--}}
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


