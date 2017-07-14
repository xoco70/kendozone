<div id="create_club" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">{{ trans('core.add_new_club') }}</h6>
            </div>

            <div class="panel-body">
                <div class="container-fluid">
                    <fieldset title="{{Lang::get('core.general_data')}}">

                        <span class="text-bold">{{  trans_choice('structures.federation',1)}}:</span>  @{{ federationSelectedText }}
                        <br/>
                        <br/>
                        <span class="text-bold">{{  trans_choice('structures.association',1)}}:</span>  @{{ associationSelectedText  }}
                        <br/>
                        <br/>
                        <div class="form-group">
                            {!!  Form::label('name', trans('core.name'),['class' => 'text-bold' ]) !!}
                            <br/>
                            {!!  Form::text('name', old('name'), ['class' => 'form-control', 'v-model' => 'form.name']) !!}

                        </div>
                        <br/>
                        <div class="form-group">
                            {!!  Form::label('address', trans('structures.club.address'),['class' => 'text-bold' ]) !!}
                            <div class="input-group">
                                {!!  Form::input('text', 'address', old('address'), ['class' => 'form-control address', 'v-model' => 'form.address']) !!}
                                <span class="input-group-addon"><i class="icon-envelop3"></i></span>

                            </div>
                        </div>

                        <br/>
                        <div class="form-group">
                            {!!  Form::label('phone', trans('structures.club.phone'),['class' => 'text-bold' ]) !!}
                            <div class="input-group">
                                {!!  Form::input('text', 'phone', old('phone'), ['class' => 'form-control phone', 'v-model' => 'form.phone']) !!}
                                <span class="input-group-addon"><i class="icon-phone"></i></span>
                            </div>
                        </div>

                    </fieldset>
                </div>
                <br/>
                <div align="right">
                    <button type="button" class="btn btn-success" id="save" v-on:click="storeClub()">
                        {{trans("core.save")}}
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>