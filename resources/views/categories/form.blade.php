<div class="col-md-12 col-lg-8 col-lg-offset-2">
    <div class="panel panel-flat">

        <div class="panel-body">

            <div class="container-fluid">
                <fieldset title="{{Lang::get('core.addCategory')}}">

                    <legend class="text-semibold">{{Lang::get('core.add_category')}}</legend>

                </fieldset>

                <div class="row">
                    <div class="col-md-10">
                        <div class=" form-group border-grey-700">
                            {!!  Form::label('name') !!}
                            <p class="full-width border-lg p-20 border-grey-300 border-solid text-size-large">@{{ categoryName }} </p>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">


                        {!!     Form::label('isTeam', trans('core.isTeam'),['class' => 'text-bold' ])  !!}
                        <br/>

                        <div class="checkbox-switch">
                            <label>
                                {!!     Form::hidden('isTeam', 0) !!}
                                {!!       Form::checkbox('isTeam', 1, null, ['class' => 'switch', 'data-on-text'=>trans('core.yes'), 'data-off-text'=>trans('core.no')]) !!}
                            </label>
                        </div>

                    </div>
                    <div class="col-md-4">
                        {!!  Form::label('gender', trans('core.gender'),['class' => 'text-bold' ]) !!}
                        {!!  Form::select('genger', ['M'=> trans('core.male') ,
                                                       'F'=> trans('core.female') ,
                                                       'X'=> trans('core.mixt') , ],
                                           old('gender'), ['class' => 'form-control','v-on:change'=> "getCategoryName","v-model"=>"gender"]) !!}

                    </div>
                    <div class="col-md-4">
                        {!!  Form::label('ageCategory', trans('core.ageCategory'),['class' => 'text-bold' ]) !!}
                        {!!  Form::select('ageCategory', ['0'=> trans('core.no_age') ,
                                                       '1'=> trans('core.children') ,
                                                       '2'=> trans('core.teenagers') ,
                                                       '3'=> trans('core.adults') ,
                                                       '4'=> trans('core.masters')],
                                           old('ageCategory'), ['class' => 'form-control','v-on:change'=> "getCategoryName","v-model"=>"ageCategory"]) !!}

                    </div>

                </div>


                <div class=" text-right mt-20 pt-20">
                    {!!  Form::submit($submitButton, ['class' => 'btn btn-success ']) !!}
                </div>
            </div>


        </div>

    </div>
</div>
