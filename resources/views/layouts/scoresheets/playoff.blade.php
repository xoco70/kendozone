<h2 align="center" class="playoff">{{ trans('core.playoff') }}</h2>
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
