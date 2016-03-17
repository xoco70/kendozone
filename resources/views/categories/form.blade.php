<div class="col-md-12 col-lg-8 col-lg-offset-2">
    <div class="panel panel-flat">

        <div class="panel-body">

            <div class="container-fluid">
                <fieldset title="{{Lang::get('crud.addCategory')}}">

                    <legend class="text-semibold">{{Lang::get('crud.add_category')}}</legend>

                </fieldset>

                <div class="row">
                    <div class="col-md-10">
                        <div class=" form-group">
                            {!!  Form::label('name', trans('crud.name')) !!}
                            {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">


                        {!!     Form::label('isTeam', trans('crud.isTeam'),['class' => 'text-bold' ])  !!}
                        <br/>

                        <div class="checkbox-switch">
                            <label>
                                {!!     Form::hidden('isTeam', 0) !!}
                                {!!       Form::checkbox('isTeam', 1, null, ['class' => 'switch', 'data-on-text'=>trans('core.yes'), 'data-off-text'=>trans('core.no')]) !!}
                            </label>
                        </div>

                    </div>
                    <div class="col-md-4">
                        {!!  Form::label('gender', trans('crud.gender'),['class' => 'text-bold' ]) !!}
                        {!!  Form::select('teamSize', ['M'=> trans('crud.male') ,
                                                       'F'=> trans('crud.female') ,
                                                       'X'=> trans('crud.mixt') , ],
                                           old('teamsize'), ['class' => 'form-control']) !!}

                    </div>
                    <div class="col-md-4">
                        {!!  Form::label('ageCategory', trans('crud.ageCategory'),['class' => 'text-bold' ]) !!}
                        {!!  Form::select('ageCategory', ['0'=> trans('crud.no_age') ,
                                                       '1'=> trans('crud.children') ,
                                                       '2'=> trans('crud.teenagers') ,
                                                       '3'=> trans('crud.adults') ,
                                                       '4'=> trans('crud.masters')],
                                           old('ageCategory'), ['class' => 'form-control']) !!}

                    </div>

                </div>


                <div class=" text-right mt-20 pt-20">
                    {!!  Form::submit($submitButton, ['class' => 'btn btn-success ']) !!}
                </div>
            </div>


        </div>

    </div>
</div>
@section('scripts_footer')
    {!! Html::script('js/pages/footer/categoryCreateFooter.js') !!}
@stop