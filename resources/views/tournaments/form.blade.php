<div class="col-md-12 col-lg-8 col-lg-offset-2">
    <div class="panel panel-flat">

        <div class="panel-body">

            <div class="container-fluid">
                <fieldset title="{{Lang::get('core.newTournament')}}">

                    <legend class="text-semibold">{{Lang::get('core.newTournament')}}</legend>

                </fieldset>

                <div class="row">
                    <div class="col-xs-2 col-md-1">
                        <span class="btn btn-flat border-grey-800 btn-rounded text-bold ">1</span>
                    </div>
                    <div class="col-xs-10"><span class="text-bold">{{ trans('core.general_data') }}</span><BR/>
                        {{ trans('core.general_data_step1') }}
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
                    <div class="col-xs-2 col-md-1">
                        <span class="btn btn-flat border-grey-800 btn-rounded text-bold ">2</span>
                    </div>
                    <div class="col-xs-10"><span class="text-bold">{{ mb_strtoupper(trans('categories.configure_categories')) }}</span><BR/>
                        {{ trans('categories.configure_categories_text') }}
                        <br/>
                    </div>
                </div>
                <br/><br/>
                <div class="row">
                    <div class="col-xs-1 col-md-offset-1">{{ Form::radio('config', '0',true, ['id' => 'c1']) }}</div>
                    <div class="col-md-10"><span class="text-bold">{{  mb_strtoupper(trans('categories.presettings')) }}</span><br/>
                        {{ trans('categories.presettings_text') }}
                        <br/><br/>
                    </div>
                </div>
                <div class="row md-10">
                    <div class="col-md-3 col-md-offset-2">
                        {!!  Form::select('rule_id', $rules,$tournament->rule_id == null ? 0 : $tournament->rule_id, ['class' => 'form-control', 'id' => 'rules']) !!}
                    </div>
                    <div class="col-md-7">
                        <small id="categories_desc"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-11 col-md-offset-1">
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-1 col-md-offset-1">{{ Form::radio('config', '1', false, ['id' => 'c2']) }}</div>
                    <div class="col-md-10"><span class="text-bold">{{ mb_strtoupper(trans('categories.manual')) }}</span><br/>
                        {{trans('core.select_categories_to_register')}}<br/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-offset-2">

                        <div class="form-group multiselect">
                        {!!  Form::select('category[]', $categories,$tournament->getCategoryList(), ['class' => 'form-group form-control listbox-filter-disabled', "multiple"]) !!}
                        </div>

                    </div>
                </div>
                <div class="row text-uppercase">
                    <div class="col-md-7 mb-20 mt-20 pt-20">
                        <span class="text-danger" v-cloak>
                            @{{ error }}
                        </span>

                    </div>
                    <div class="col-md-5 mb-20 mt-20 pt-20 disabled" id="create_category_link">
                        {{--<button type="button" class="btn btn-primary"--}}
                        {{--id="demo2-add">{{ trans('core.add_and_new') }}</button>--}}
                        <a href="#" data-toggle="modal" data-target="#create_category" id="create_category_link"
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
</div>