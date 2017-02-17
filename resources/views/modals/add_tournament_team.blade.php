<div id="create_tournament_team" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">@lang('core.addModel', ['currentModelName' => trans_choice('core.team',1)])</h6>
            </div>
            {!! Form::open(['url'=>URL::action("TeamController@store",$tournament->slug)]) !!}
            <div class="modal-body">
                <div class="row tex">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            {!!  Form::label('name', trans('core.name')) !!}
                            {!!  Form::text('name',null, ['class' => 'form-control', 'id' => 'newTeamName']) !!}
                        </div>
                    </div>
                </div>
                <br/>
                <br/>
                {!!  Form::hidden('championship_id',null, ["class" => 'championshipId']) !!}
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ trans('categories.add_and_close') }}</button>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
