<div class="row sheet-header">
    <div class="col-xs-5">
        <div class="form-group">
            {!!  Form::label('championship', trans('core.championship'),['class' => 'text-bold' ]) !!}
            {!!  Form::text('championship', $championship->category->name , ['class' => 'form-control sheet_championship']) !!}
        </div>
    </div>
    <div class="col-xs-1">
        <div class="form-group">
            {!!  Form::label('shiajo', trans('core.shiajo'),['class' => 'text-bold' ]) !!}
            {!!  Form::text('shiajo', $group->area, ['class' => 'form-control sheet_shiajo']) !!}
        </div>
    </div>
    @if ($group->fights->count() >2)
        <div class="col-xs-1">
            <div class="form-group">
                {!!  Form::label('group', trans('core.group'),['class' => 'text-bold' ]) !!}
                {!!  Form::text('group', $group->order, ['class' => 'form-control sheet_group']) !!}
            </div>
        </div>
    @endif
    <div class="col-xs-5">
        <div class="form-group">
            {!!  Form::label('writer', trans('core.writer'),['class' => 'text-bold' ]) !!}
            {!!  Form::text('writer', '', ['class' => 'form-control sheet_writer']) !!}
        </div>
    </div>
</div>