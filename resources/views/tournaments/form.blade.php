<div class="col-md-12 col-lg-8 col-lg-offset-2">
    <div class="panel panel-flat">

        <div class="panel-body">

            <div class="container-fluid">
                <fieldset title="{{Lang::get('core.newTournament')}}">

                    <legend class="text-semibold">{{Lang::get('core.newTournament')}}</legend>

                </fieldset>

                <div class="row">
                    <div class="col-md-3">
                        <div class=" form-group">
                            {!!  Form::label('name', trans('core.name'),['class' => 'text-bold ']) !!}
                            {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        {!!  Form::label('dateIni', trans('core.eventDateIni'),['class' => 'text-bold ']) !!}
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">{{trans('core.from') }}</span>
                                {!!  Form::input('text', 'dateIni', old('dateIni'), ['class' => 'form-control dateIni']) !!}
                                <span class="input-group-addon"><i class="icon-calendar3"></i></span>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">

                        {!!  Form::label('dateFin', trans('core.eventDateFin'),['class' => 'text-bold ' ]) !!}
                        <div class="form-group">

                            <div class="input-group">
                                <span class="input-group-addon">{{trans('core.to') }}</span>
                                {!!  Form::input('text', 'dateFin', old('dateFin'), ['class' => 'form-control dateFin']) !!}
                                <span class="input-group-addon"><i class="icon-calendar3"></i></span>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!!  Form::label('rule_id', trans('core.rules'),['class' => 'text-bold' ]) !!}
                            <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                               data-original-title="{{trans('categories.rulesTooltip')}}"></i>
                            <br/>
                            {!!  Form::select('rule_id', $rules,$tournament->rule_id, ['class' => 'form-control', 'v-model'=> "ruleSelect"]) !!}
                        </div>
                    </div>

                </div>
                <div class="row" :disabled="ruleSelect!=1">
                    <div class="col-md-12">

                        <p>{{trans('core.select_categories_to_register')}}</p>

                        <div class="form-group multiselect">
                            {!!  Form::select('category[]', $categories,$tournament->getCategoryList(), ['class' => 'form-group form-control listbox-filter-disabled', "multiple", "disabled"]) !!} <!-- Default 1st Dan-->
                        </div>

                    </div>
                </div>
                <div class="row text-uppercase">
                    <div class="col-md-6 mb-20 mt-20 pt-20">
                        <span class="text-danger" v-cloak>
                            @{{ error }}
                        </span>

                    </div>
                    <div class="col-md-6 mb-20 mt-20 pt-20" disabled="ruleSelect==1">
                        {{--<button type="button" class="btn btn-primary"--}}
                        {{--id="demo2-add">{{ trans('core.add_and_new') }}</button>--}}
                        <a href="#" data-toggle="modal" data-target="#create_category" class="text-semibold text-black" @click="resetModalValues()">+ {{ trans('core.add_custom_category') }}</a>
                    </div>
                </div>
                <div class=" text-right mt-15">
                    {!!  Form::submit($submitButton, ['class' => 'btn btn-success ']) !!}
                </div>
            </div>


        </div>

    </div>
</div>