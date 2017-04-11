<div id="create_tournament_user" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">{{trans('core.add_competitor_to_category',['category' => ''])}}</h6>

            </div>
            {!! Form::open(['url'=>URL::action("CompetitorController@store",$tournament->slug), 'class' => 'form-horizontal']) !!}
            <div class="modal-body">
                <small class="text-muted">{{ trans('core.add_competitor_text1') }}</small>
                <br/><small class="text-muted">{{ trans('core.add_competitor_text2') }}</small>
                <br/><small class="text-muted">{{ trans('core.add_competitor_text3') }} <a href="{!! URL::action('InviteController@create',  $tournament->slug) !!}">{{ trans('core.invite_competitors_with_email') }}</a></small>
                <br/><br/>
                <div class="row">
                    <div class="col-md-12">

                        <div align="right"><a class="add_field_button btn-primary btn ">
                            <i class="icon-user-plus mr-10"></i>{{ trans('core.add_more_competitors') }}
                        </a></div>
                        <div class="input_fields_wrap">
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <input type="text" name="names[]" class="form-control mt-20"
                                           placeholder="{{ trans("core.competitor_name") }}"/>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" name="emails[]" class="form-control mt-20"
                                           placeholder="{{ trans("core.email") }} ( {{ trans("core.optional") }} )"/>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                {!!  Form::hidden('championshipId',null, ["id" => 'championshipId']) !!}
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ trans('categories.add_and_close') }}</button>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
