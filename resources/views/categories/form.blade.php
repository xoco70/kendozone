<div class="col-xs-12 col-lg-8 col-lg-offset-2" xmlns:v-on="http://www.w3.org/1999/xhtml"
     xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <person-data :grades="{{ $grades }}"></person-data>

    <div class="panel panel-flat">

        <div class="panel-body">

            <div class="container-fluid">
                <fieldset title="{{Lang::get('core.addCategory')}}">

                    <legend class="text-semibold">{{Lang::get('core.add_category')}}</legend>

                </fieldset>

                <div class="row">
                    <div class="col-md-12">
                        <div class=" form-group border-grey-700">
                            {!!  Form::label('name') !!}
                            <p class="full-width border-lg p-20 border-grey-300 border-solid text-size-large text-center text-uppercase">@{{ categoryFullName }} </p>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">

                        <div class=" form-group">

                            {!!     Form::label('isTeam', trans('core.isTeam'),['class' => 'text-bold' ])  !!}
                            <br/>

                            <div class="checkbox-switch">
                                <label>
                                    {!!     Form::hidden('isTeam', 0) !!}
                                    {!!       Form::checkbox('isTeam', 1, null, ["v-model"=>"isTeam", 'class' => 'switch', 'data-on-text'=>trans('core.yes'), 'data-off-text'=>trans('core.no')]) !!}
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        {!!  Form::label('gender', trans('core.gender'),['class' => 'text-bold' ]) !!}
                        {!!  Form::select('genger', ['M'=> trans('core.male') ,
                                                       'F'=> trans('core.female') ,
                                                       'X'=> trans('core.mixt') , ],
                                           old('gender'), ['class' => 'form-control',"v-model"=>"gender"]) !!}

                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class=" form-group">
                            {!!  Form::label('ageCategory', trans('core.ageCategory'),['class' => 'text-bold' ]) !!}
                            <select v-model="ageCategory" class="form-control">
                            <option value="0">{{trans('core.no_age')}}</option>
                            <option value="1">{{trans('core.children')}}</option>
                            <option value="2">{{trans('core.teenagers')}}</option>
                            <option value="3">{{trans('core.adults')}}</option>
                            <option value="4">{{trans('core.masters')}}</option>
                            <option value="5">{{trans('core.custom')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class=" form-group">
                            {!!  Form::label('ageIni', trans('core.from'),['class' => 'text-bold' ]) !!}
                            <select v-model="ageIni" class="form-control"  v-if="ageCategory!=5">
                            <option value="0">No age limit</option>
                            <option :value="n+6" v-for="n in 85">@{{n+6}}</option>

                            </select>


                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class=" form-group">
                            {!!  Form::label('ageFin', trans('core.to'),['class' => 'text-bold' ]) !!}
                            <select v-model="ageFin" class="form-control" :disabled="ageCategory!=5">
                            <option value="0">No age limit</option>
                            <option :value="n+6" v-for="n in 85">@{{n+6}}</option>

                            </select>
                        </div>
                    </div>


                </div>


                <div class="row">

                    <div class="col-md-4">
                        <div class=" form-group">
                            {!!  Form::label('gradesSelect', trans('core.grade'),['class' => 'text-bold' ]) !!}
                            <select v-model="gradesSelect" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class=" form-group">
                            {!!  Form::label('gradeIni', trans('core.from'),['class' => 'text-bold' ]) !!}
                            <select v-model="gradeIni" class="form-control"
                            v-show="gradesSelect!=0">
                            <option value="0">No grade restriction</option>
                            <option :value="n+6" v-for="n in 85">@{{n+6}}</option>

                            </select>


                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class=" form-group">
                            {!!  Form::label('gradeFin', trans('core.to'),['class' => 'text-bold' ]) !!}
                            <select v-model="gradeFin" class="form-control" v-show="gradesSelect!=0">
                            <option value="0">No grade restriction</option>
                            <option :value="n+6" v-for="n in 85">@{{n+6}}</option>

                            </select>
                        </div>
                    </div>


                </div>


                <div class=" text-right mt-20 pt-20">
                    {!!  Form::submit($submitButton, ['class' => 'btn btn-success ']) !!}
                </div>
            </div>


        </div>

    </div>
</div>
