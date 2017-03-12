@extends('layouts.scoreSheets.master')
@section('content')
    <h1 align="center">{{ $championship->tournament->name }}</h1>

    <hr/>
    <br/>
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

    {{--{{  Form::model($sheet, ["action" => [$sheet == null ?--}}
                                                {{--"ScoreSheetController@store" :--}}
                                                {{--"ScoreSheetController@update",--}}
     {{--$championship->slug], 'class' => 'class="form-horizontal'] ) }}--}}


    <div class="row">
        <div class="col-sm-5">
            <div class="form-group">
                {!!  Form::label('championship', trans('core.championship'),['class' => 'text-bold' ]) !!}:
                {!!  Form::text('championship', $championship->category->name , ['class' => 'form-control sheet_championship']) !!}
            </div>
        </div>
        <div class="col-sm-1">
            <div class="form-group">
                {!!  Form::label('shiajo', trans('core.shiajo'),['class' => 'text-bold' ]) !!}:
                {!!  Form::text('shiajo', $group->area, ['class' => 'form-control sheet_shiajo']) !!}
            </div>
        </div>
        <div class="col-sm-1">
            <div class="form-group">
                {!!  Form::label('group', trans('core.group'),['class' => 'text-bold' ]) !!}:
                {!!  Form::text('group', '1', ['class' => 'form-control sheet_group']) !!}
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                {!!  Form::label('writer', trans('core.writer'),['class' => 'text-bold' ]) !!}:
                {!!  Form::text('writer', '', ['class' => 'form-control sheet_writer']) !!}
            </div>
        </div>
    </div>

    <br/><br/><br/>
    <div class="row">
        {{--Competitors--}}
        <div class="col-sm-6">
            <div class="row">&nbsp;</div>
            <div class="row">&nbsp;</div>

            @foreach($fighters as $fighter )

                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-2">
                            {!!  Form::text('short_id[]', $fighter->short_id, ['class' => 'form-control sheet_shortid']) !!}
                        </div>
                        <div class="col-sm-10">
                            {!!  Form::text('name[]', $fighter->user != null ? $fighter->user->name : "BYE", ['class' => 'form-control competitor_name']) !!}
                        </div>
                    </div>
                </div>
                <br/>
                <br/>
                <br/>
                <br/>
            @endforeach


        </div>
        {{--End Competitors--}}
        {{--Points--}}
        <div class="col-sm-6">
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
                        <td align="center">Total</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">{{ trans('core.clasify') }}</td>
                    </tr>
                    @foreach($fighters as $fighter)
                        <tr>
                            <td align="center">&nbsp;</td>
                            @foreach($group->fights as $fight)
                                <td align="center" class="cell-group">
                                    {!!  Form::select('point1[]', ['' => '', 'K' => "Kote",'M'=> "Men",'D' => "Do",'T' => "Tsuki",'H'=> "Hansoku"], '', ['class' => 'form-control  sheet_point ', 'align' => 'right']) !!}

                                    <div class="form-group">
                                        {!!  Form::select('point1[]', ['' => '', 'K' => "Kote",'M'=> "Men",'D' => "Do",'T' => "Tsuki",'H'=> "Hansoku"], '', ['class' => 'form-control  sheet_point ', 'align' => 'left']) !!}
                                    </div>

                                </td>
                            @endforeach
                            <td align="center" class="total"></td>
                            <td align="center">&nbsp;</td>
                            <td align="center" class="clasify"></td>
                        </tr>
                        <tr class="spacer">
                            <td colspan="7">&nbsp;</td>
                        </tr>

                    @endforeach
                    <tr>
                        <td>{{ trans('core.time') }}</td>
                        @foreach($group->fights as $fight)
                            <td>{!!  Form::text('time[]', '', ['class' => 'form-control sheet_point']) !!}</td>
                        @endforeach
                        <td colspan="2">&nbsp;</td>
                    </tr>

                </table>

            </div>
        </div>
    </div>
    {{--End Points--}}
    <hr/>





    <h2 align="center">{{ trans('core.playoff') }}</h2>
    <table align="center" width="100%">
        <tr>
            <td align="center" width="5%">{{  trans('core.points_abrev') }} </td>
            <td align="center" width="20%">ID</td>
            <td align="center" width="5%">&nbsp;</td>
            <td align="center" width="20%">ID</td>
            <td align="center" width="5%">{{  trans('core.points_abrev') }} </td>
            <td align="center" width="5%">&nbsp;</td>
            <td align="center" width="5%">{{ trans('core.time') }}</td>
        </tr>
        @foreach($group->fights as $fight)
            <tr>
                <td align="center"
                    width="5%">{!!  Form::text('point', '', ['class' => 'form-control ']) !!}</td>
                <td align="center"
                    width="20%">{!!  Form::text('id', $fight->competitor1->short_id, ['class' => 'form-control']) !!}</td>
                <td align="center" width="5%"><strong>x</strong></td>
                <td align="center"
                    width="20%">{!!  Form::text('id', $fight->competitor2->short_id, ['class' => 'form-control']) !!}</td>
                <td align="center"
                    width="5%">{!!  Form::text('point', '', ['class' => 'form-control ']) !!}</td>
                <td align="center" width="5%">&nbsp;</td>
                <td align="center"
                    width="5%">{!!  Form::text('time', '', ['class' => 'form-control ']) !!}</td>

            </tr>
            <tr class="spacer">
                <td colspan="7">&nbsp;</td>
            </tr>
        @endforeach
    </table>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-6" align="right">
            <div class="form-group">
                {!!  Form::text(trans('core.table_leader'), '', ['class' => 'form-control']) !!}
                {!!  Form::label('leader',  trans('core.table_leader'),['class' => 'text-bold']) !!}
            </div>
        </div>
    </div>


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


