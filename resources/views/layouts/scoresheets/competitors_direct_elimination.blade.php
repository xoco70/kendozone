<u><p><strong>{{ trans('core.combat') }} nº {{ $group->fights[0]->id }}</strong></p></u>
<table align="center" width="100%">
    <tr>
        <td>{{trans('core.red')  }}</td>
        <td>{{trans('core.white')  }}</td>
    </tr>
    <tr>
        {{--        <td align="center" width="5%">{{  trans('core.points_abrev') }} </td>--}}
        <td align="center" width="5%">ID</td>
        <td align="center" width="20%">{{trans('core.name')  }}&nbsp;</td>
        <td align="center" width="10%">{{trans('core.penalization')  }}</td>

        <td align="center" width="5%">{{  trans('core.point') }} 1</td>
        <td align="center" width="5%">{{  trans('core.point') }} 2</td>
        <td align="center" width="5%">&nbsp;</td>
        <td align="center" width="5%">{{  trans('core.point') }} 2</td>
        <td align="center" width="5%">{{  trans('core.point') }} 1</td>
        <td align="center" width="10%">{{trans('core.penalization')  }}</td>
        <td align="center" width="20%">{{trans('core.name')  }}&nbsp;</td>
        <td align="center" width="5%">ID</td>
        <td align="center" width="10%">{{ trans('core.time') }}</td>
    </tr>
    {{--@foreach($group->fights as $fight)--}}
    <tr>
        <td align="center" width="5%">
            {!!  Form::text('id', $group->fights[0]->getFighter2ShortId($group), ['class' => 'form-control ']) !!}
        </td>
        <td align="center" width="20%">
            {!!  Form::text('name', $group->fights[0]->getFighter1Name($group), ['class' => 'form-control']) !!}
        </td>
        <td align="center" width="10%">
            {!!  Form::text('hansoku_c1', '', ['class' => 'form-control']) !!}
        </td>
        <td align="center" width="5%">
            {!!  Form::select('point1_c1', ['' => '', 'K' => "Kote",'M'=> "Men",'D' => "Do",'T' => "Tsuki",'H'=> "Hansoku"], '', ['class' => 'form-control  sheet_point ', 'align' => 'left']) !!}        </td>
        <td align="center" width="5%">
            {!!  Form::select('point2_c1', ['' => '', 'K' => "Kote",'M'=> "Men",'D' => "Do",'T' => "Tsuki",'H'=> "Hansoku"], '', ['class' => 'form-control  sheet_point ', 'align' => 'left']) !!}        </td>
        <td align="center" width="5%">
            -
        </td>
        <td align="center" width="5%">
            {!!  Form::select('point2_c2', ['' => '', 'K' => "Kote",'M'=> "Men",'D' => "Do",'T' => "Tsuki",'H'=> "Hansoku"], '', ['class' => 'form-control  sheet_point ', 'align' => 'left']) !!}        </td>

        <td align="center" width="5%">
            {!!  Form::select('point1_c2', ['' => '', 'K' => "Kote",'M'=> "Men",'D' => "Do",'T' => "Tsuki",'H'=> "Hansoku"], '', ['class' => 'form-control  sheet_point ', 'align' => 'left']) !!}
        </td>
        <td align="center" width="10%">
            {!!  Form::text('hansoku_c2', '', ['class' => 'form-control']) !!}
        </td>

        <td align="center" width="20%">
            {!!  Form::text('name', $group->fights[0]->getFighter2Name($group), ['class' => 'form-control']) !!}
        </td>

        <td align="center" width="5%">
            {!!  Form::text('time', '', ['class' => 'form-control ']) !!}
        </td>
        <td align="center" width="5%">
            {!!  Form::text('id', $group->fights[0]->getFighter2ShortId($group), ['class' => 'form-control ']) !!}
        </td>
    </tr>
    <tr class="spacer">
        <td colspan="7">&nbsp;</td>
    </tr>
    {{--@endforeach--}}
</table>
<div class="row">
    <div class="col-sm-4">
        {!!  Form::text('winner','', ['class' => 'form-control']) !!}
        {!!  Form::label('winner',  trans('core.winner'),['class' => 'text-bold']) !!}

    </div>

    <div class="col-sm-4 col-sm-offset-2">
        <div class="form-group">
            {!!  Form::text('leader','', ['class' => 'form-control']) !!}
            {!!  Form::label('leader',  trans('core.table_leader'),['class' => 'text-bold']) !!}
        </div>
    </div>
</div>
