<div class="col-md-12 col-lg-8 col-lg-offset-2">
    <div class="panel panel-flat">

        <div class="panel-body">

            <div class="container-fluid">
                <fieldset title="{{Lang::get('core.newTournament')}}">

                    <legend class="text-semibold">{{Lang::get('core.newTournament')}}</legend>

                </fieldset>

                <div class="row">
                    <div class="col-md-1">
                        <span class="btn btn-flat border-grey-800 btn-rounded text-bold ">1</span>
                    </div>
                    <div class="col-md-10"><span class="text-bold">DATOS GENERALES</span><BR/>Escriba el nombre y la
                        fecha de tu torneo
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        <div class=" form-group">
                            {!!  Form::label('name', trans('core.name'),['class' => 'text-bold ']) !!}
                            {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        {!!  Form::label('dateIni', trans('core.eventDateIni'),['class' => 'text-bold ']) !!}
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">{{trans('core.from') }}</span>
                                {!!  Form::input('text', 'dateIni', old('dateIni'), ['class' => 'form-control dateIni']) !!}
                                <span class="input-group-addon"><i class="icon-calendar3"></i></span>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                        {!!  Form::label('dateFin', trans('core.eventDateFin'),['class' => 'text-bold ' ]) !!}
                        <div class="form-group">

                            <div class="input-group">
                                <span class="input-group-addon">{{trans('core.to') }}</span>
                                {!!  Form::input('text', 'dateFin', old('dateFin'), ['class' => 'form-control dateFin']) !!}
                                <span class="input-group-addon"><i class="icon-calendar3"></i></span>
                            </div>
                        </div>

                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-1">
                        <span class="btn btn-flat border-grey-800 btn-rounded text-bold ">2</span>
                    </div>
                    <div class="col-md-10"><span class="text-bold">CONFIGURA LAS CATEGORIAS</span><BR/>
                        Selecciona una de las 2 opciones para configurar las categorias del torneo
                    </div>
                </div>
                <br/><br/>
                <div class="row">
                    <div class="col-md-1 col-md-offset-1">{{ Form::radio('config', '0',true, ['id' => 'c1']) }}</div>
                    <div class="col-md-10"><span class="text-bold">PRECONFIGURADA</span><br/>
                        Elige el reglamento bajo el que tu torneo este regido. Las categorias se crearan y se
                        configuraran de forma automatica<br/>
                    </div>
                </div>
                <div class="row mt-10">
                    <div class="col-md-3 col-md-offset-2">
                        {!!  Form::select('rule_id', $rules,$tournament->rule_id == null ? 0 : $tournament->rule_id, ['class' => 'form-control', 'id' => 'rules']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-11 col-md-offset-1"><hr/></div>
                </div>

                <div class="row">
                    <div class="col-md-1 col-md-offset-1">{{ Form::radio('config', '1', false, ['id' => 'c2']) }}</div>
                    <div class="col-md-10"><span class="text-bold">MANUAL</span><br/>
                        {{trans('core.select_categories_to_register')}}<br/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-offset-2">

                        <div class="form-group multiselect">
                        {!!  Form::select('category[]', $categories,$tournament->getCategoryList(), ['class' => 'form-group form-control listbox-filter-disabled', "multiple"]) !!} <!-- Default 1st Dan-->
                        </div>

                    </div>
                </div>
                <div class="row text-uppercase">
                    <div class="col-md-7 mb-20 mt-20 pt-20">
                        <span class="text-danger" v-cloak>
                            @{{ error }}
                        </span>

                    </div>
                    <div class="col-md-5 mb-20 mt-20 pt-20">
                        {{--<button type="button" class="btn btn-primary"--}}
                        {{--id="demo2-add">{{ trans('core.add_and_new') }}</button>--}}
                        <a href="#" data-toggle="modal" data-target="#create_category"
                           class="text-semibold text-black" @click="resetModalValues()">
                        + {{ trans('core.add_custom_category') }}</a>
                    </div>
                </div>
                <div class=" text-right mt-15">
                    {!!  Form::submit($submitButton, ['class' => 'btn btn-success ']) !!}
                </div>
            </div>


        </div>

    </div>
</div>