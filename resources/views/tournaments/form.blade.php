{{--TODO PREFENCIAS CURRENCY--}}
<div class="col-md-12 col-lg-8 col-lg-offset-2">
    <div class="panel panel-flat">

        <div class="panel-body">

            <div class="container-fluid">
                <fieldset title="{{Lang::get('crud.newTournament')}}">

                    <legend class="text-semibold">{{Lang::get('crud.newTournament')}}</legend>

                </fieldset>

                <div class="row">
                    <div class="col-md-4">
                        <div class=" form-group">
                            {!!  Form::label('name', trans('crud.name')) !!}
                            {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        {!!  Form::label('dateIni', trans('crud.eventDateIni'),['class' => 'text-bold' ]) !!}

                        <div class="input-group">
                            <span class="input-group-addon">{{trans('crud.from') }}</span>
                            {!!  Form::input('text', 'dateIni', old('dateIni'), ['class' => 'form-control datetournament']) !!}
                            <span class="input-group-addon"><i class="icon-calendar3"></i></span>

                        </div>

                    </div>
                    <div class="col-md-4">

                        {!!  Form::label('dateFin', trans('crud.eventDateFin'),['class' => 'text-bold' ]) !!}

                        <div class="input-group">
                            <span class="input-group-addon">{{trans('crud.to') }}</span>
                            {!!  Form::input('text', 'dateFin', old('dateFin'), ['class' => 'form-control datetournament']) !!}
                            <span class="input-group-addon"><i class="icon-calendar3"></i></span>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="coutent-group">{{trans('crud.select_categories_to_register')}}</p>


                        {!!  Form::select('category[]', $categories,$tournament->getCategoryList(), ['class' => 'form-control listbox-filter-disabled', "multiple"]) !!} <!-- Default 1st Dan-->
                    </div>
                </div>
                {{--<div class="row text-uppercase">--}}
                    {{--<div class="col-md-6 col-md-offset-6 ">--}}
                        {{--<a href="{{URL::action('CategoryController@create')}}" class="text-black">+ Agregar otra categoria</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class=" text-right mt-15">
                    {!!  Form::submit($submitButton, ['class' => 'btn btn-success ']) !!}
                </div>
            </div>


        </div>

    </div>
</div>


<?php
$now = Carbon\Carbon::now();
$year = $now->year;
$month = $now->month;
$day = $now->day;
?>


        <!-- Theme JS files -->
<script>

    $(function () {
        $('.datetournament').pickadate({
            min: [{{$year}}, {{$month}}, {{$day}}],
            format: 'yyyy-mm-dd'
        });


        // Basic Dual select example
        // Disable filtering
        $('.listbox-filter-disabled').bootstrapDualListbox({
            showFilterInputs: false,
            infoTextEmpty: '',
            infoText: ''


        });


        $('#block-panel').on('click', function () {
            var block = $(this).parent().parent();
            $(block).block({
                message: '<i class="icon-spinner4 spinner"></i>',
                timeout: 2000, //unblock after 2 seconds
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'transparent'
                }
            });
        });


    });
</script>