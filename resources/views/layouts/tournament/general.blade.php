{!! Form::model($tournament, ['method'=>"PATCH", 'id'=>'form1', "action" => ["TournamentController@update", $tournament->slug]]) !!}
<div class="panel panel-flat">

    <div class="panel-body">
        <div class="container-fluid">


            <fieldset title="{{trans('core.general_data')}}" class="mt-20 pt-20">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!  Form::label('name', trans('core.name'),['class' => 'text-bold' ]) !!}
                            <br/>
                            {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        <div class="checkbox-switch">
                            <label>

                                {!!  Form::label('type', trans('core.tournamentType'),['class' => 'text-bold' ]) !!}
                                <br/>
                                {!!   Form::hidden('type', 0) !!}
                                {!!   Form::checkbox('type', 1, $tournament->type, ['class' => 'switch', 'data-on-text'=>trans('core.open'), 'data-off-text'=>trans_choice('core.invitation', 1)]) !!}

                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!  Form::label('level_id', trans('core.level'),['class' => 'text-bold' ]) !!}
                            <br/>
                            {!!  Form::select('level_id', $levels,null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <br/>
                <hr/>
                <br/>
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        {!!  Form::label('dateIni', trans('core.eventDateIni'),['class' => 'text-bold' ]) !!}
                        {{--<br/>--}}


                        <div class="input-group">
                            <span class="input-group-addon">{{trans('core.from') }}</span>
                            {!!  Form::input('text', 'dateIni', old('dateIni'), ['class' => 'form-control dateIni']) !!}
                            <span class="input-group-addon"><i
                                        class="icon-calendar3"></i></span>

                        </div>

                    </div>
                    <div class="col-md-3">

                        {!!  Form::label('dateFin', trans('core.eventDateFin'),['class' => 'text-bold' ]) !!}
                        {{--<br/>--}}


                        <div class="input-group">
                            <span class="input-group-addon">{{trans('core.to') }}</span>
                            {!!  Form::input('text', 'dateFin', old('dateFin'), ['class' => 'form-control dateFin']) !!}
                            <span class="input-group-addon"><i
                                        class="icon-calendar3"></i></span>
                        </div>

                    </div>
                    <div class="col-md-3">

                        {!!  Form::label('registerDateLimit', trans('core.limitDateRegistration'),['class' => 'text-bold' ]) !!}
                        <br/>

                        <div class="input-group">

                            {!!  Form::input('text', 'registerDateLimit', ($tournament->registerDateLimit == '0000-00-00') ? '' : old('registerDateLimit') , ['class' => 'form-control dateLimit']) !!}
                            <span class="input-group-addon"><i
                                        class="icon-calendar3"></i></span>
                        </div>
                        <br/>
                    </div>
                </div>
                <br/>
                <hr/>
                <br/>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!  Form::label('promoter', trans('core.promoter'),['class' => 'text-bold' ]) !!}
                            <br/>
                            {!!  Form::text('promoter', old('promoter'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!  Form::label('host_organization', trans('core.host_organization'),['class' => 'text-bold' ]) !!}
                            <br/>
                            {!!  Form::text('host_organization', old('host_organization'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!!  Form::label('technical_assistance', trans('core.technical_assistance'),['class' => 'text-bold' ]) !!}
                            <br/>
                            {!!  Form::text('technical_assistance', old('technical_assistance'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div align="right">
            <button type="submit" class="btn btn-success" id="saveTournament">
                {{trans("core.save")}}
            </button>
        </div>
    </div>
</div>
<input type="hidden" id="activeTab" name="activeTab" value="general" />
{!! Form::close()!!}