<div class="row sheet-competitors">
    {{--Competitors--}}
    <div class="col-xs-4 col-md-6 fighters">

        @foreach($fighters as $fighter )


            <div class="row row-fighter">

                    <table>
                        <tr>
                            <td width="20%">
                                <div class="form-group form-group-sheets ">
                                    {!!  Form::text('short_id[]', $fighter->short_id, ['class' => 'form-control sheet_shortid']) !!}
                                </div>
                            </td>
                            <td width="80%">
                                <div class="form-group form-group-sheets">
                                    {!!  Form::text('name[]', $fighter->user != null ? $fighter->user->name : "BYE", ['class' => 'form-control competitor_name']) !!}
                                </div>
                            </td>
                        </tr>
                    </table>

            </div>
        @endforeach


    </div>
    {{--End Competitors--}}
    {{--Points--}}
    <div class="col-sm-4 col-md-6">
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

                                <div class="form-group form-group-sheets">
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
