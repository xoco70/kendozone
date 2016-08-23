<div id="create_tournament_user" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">{{trans('core.add_competitor_to_category',['category' => ''])}}</h6>
            </div>
            {!! Form::open(['url'=>URL::action("CompetitorController@store",$tournament->slug)]) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!!  Form::label('username', trans('core.username')) !!}
                            {!!  Form::text('username',null, ['class' => 'form-control', 'id' => 'newUsername']) !!}
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="form-group">

                        <div class="col-md-6">
                            {!!  Form::label('email', trans('core.email')) !!}
                            {!!  Form::email('email',null, ['class' => 'form-control', 'id' => 'newUserEmail']) !!}
                        </div>
                    </div>
                </div>
                <br/>
                {!!  Form::hidden('championshipId',null, ["id" => 'championshipId']) !!}
                {!!  Form::hidden('championshipName',null, ["id" => 'championshipName']) !!}
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ trans('categories.add_and_close') }}</button>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
