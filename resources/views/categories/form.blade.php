<div class="col-xs-12 col-lg-8 col-lg-offset-2"
     xmlns:v-on="http://www.w3.org/1999/xhtml"
     xmlns:v-bind="http://www.w3.org/1999/xhtml">
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


                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class=" form-group">
                            {!!  Form::label('gender', trans('core.gender'),['class' => 'text-bold' ]) !!}

                            <select v-model="gender" class="form-control" @change="getCategoryName" v-el:gender>
                            <option value="X">{{trans('core.mixt')}}</option>
                            <option value="1">{{trans('core.male')}}</option>
                            <option value="2">{{trans('core.female')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class=" form-group">
                            {!!  Form::label('ageCategory', trans('core.ageCategory'),['class' => 'text-bold' ]) !!}
                            <select v-model="ageCategory" class="form-control" @change="calculateCategoryName"
                            v-el:age-category>
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
                            <select v-model="ageIni" class="form-control" @change="calculateCategoryName"
                            :disabled="ageCategory!=5">
                            <option value="0">No age limit</option>
                            <option :value="n+6" v-for="n in 85">@{{n+6}}</option>

                            </select>


                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class=" form-group">
                            {!!  Form::label('ageFin', trans('core.to'),['class' => 'text-bold' ]) !!}
                            <select v-model="ageFin" class="form-control" @change="calculateCategoryName" :disabled="
                            ageCategory!=5">
                            <option value="0">No age limit</option>
                            <option :value="n+6" v-for="n in 85">@{{n+6}}</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class=" form-group">
                            {!!  Form::label('grade', trans('core.grade'),['class' => 'text-bold' ]) !!}
                            <select v-model="grade" class="form-control">
                            @foreach ($grades as $grade)
                                <option :grade="{{ $grade }}">{{ $grade }}</option>
                            @endforeach
                            {{--<option v-for="gradeValue in gradeValues"--}}
                                    {{--:gradeValues="{{ $grades }}">@{{ gradeValue }}</option>--}}
                            {{--</select>--}}
                        </div>
                    </div>
                </div>
                {{--<div class="col-md-2">--}}
                {{--<div class=" form-group">--}}
                {{--{!!  Form::label('ageIni', trans('core.from'),['class' => 'text-bold' ]) !!}--}}
                {{--<select v-model="ageIni" class="form-control" @change="calculateCategoryName"--}}
                {{--:disabled="ageCategory!=5">--}}
                {{--<option value="0">No age limit</option>--}}
                {{--<option :value="n+6" v-for="n in 85">@{{n+6}}</option>--}}

                {{--</select>--}}


                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-2">--}}
                {{--<div class=" form-group">--}}
                {{--{!!  Form::label('ageFin', trans('core.to'),['class' => 'text-bold' ]) !!}--}}
                {{--<select v-model="ageFin" class="form-control" @change="calculateCategoryName" :disabled="ageCategory!=5">--}}
                {{--<option value="0">No age limit</option>--}}
                {{--<option :value="n+6" v-for="n in 85">@{{n+6}}</option>--}}

                {{--</select>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}


                <div class=" text-right mt-20 pt-20">
                    {!!  Form::submit($submitButton, ['class' => 'btn btn-success ']) !!}
                </div>
            </div>


        </div>

    </div>
</div>
