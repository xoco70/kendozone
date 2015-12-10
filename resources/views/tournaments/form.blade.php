{{--TODO PREFENCIAS CURRENCY--}}

<h2 align="center">{{Lang::get('crud.newTournament')}}</h2>

<div class="row">
    <div class="col-md-12 col-lg-6 col-lg-offset-3">
        <div class="col-md-6">
            <div class=" form-group">
                {!!  Form::label('name', trans('crud.name')) !!}
                {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            {!!  Form::label('date', trans('crud.eventDate')) !!}
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                {!!  Form::input('text', 'date', old('date'), ['class' => 'form-control datetournament']) !!}
            </div>
        </div>
    </div>


    <div class="col-md-12 col-lg-6 col-lg-offset-3">
        <div class="col-md-6">
            <div class="form-group">
                {!!  Form::label('level_id', trans('crud.level')) !!}
                {!!  Form::select('level_id', $levels,null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

</div>
{{--<div class="row">--}}


{{--<div class="col-md-3">--}}
{{--{!!  Form::label('limitRegistrationDate', trans('crud.limitDateRegistration')) !!}--}}
{{--<div class="input-group">--}}
{{--<span class="input-group-addon"><i class="icon-calendar5"></i></span>--}}
{{--{!!  Form::input('text', 'registerDateLimit', old('registerDateLimit'), ['class' => 'form-control datelimit']) !!}--}}
{{--</div>--}}
{{--<br/>--}}


{{--</div>--}}
{{--<div class="col-md-3">--}}


{{--<div class="checkbox-switch">--}}
{{--<label>--}}
{{--{!!     Form::label('mustPay', trans('crud.pay4register'))  !!} <br/>--}}
{{--{!!     Form::hidden('mustPay', 0) !!}--}}
{{--{!!       Form::checkbox('mustPay', 1, $tournament->mustPay, ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No"]) !!}--}}
{{--</label>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-md-3">--}}

{{--<div class="checkbox-switch">--}}
{{--<label>--}}

{{--{!!  Form::label('type', trans('crud.tournamentType')) !!} <br/>--}}
{{--{!!   Form::hidden('type', 0) !!}--}}
{{--{!!   Form::checkbox('type', 1, $tournament->type, ['class' => 'switch', 'data-on-text'=>"Abierto", 'data-off-text'=>"Invitación"]) !!}--}}

{{--</label>--}}
{{--</div>--}}

{{--</div>--}}


{{--</div>--}}
{{--<div class="row">--}}
{{--<div class="col-md-4">--}}
{{--<div class="form-group">--}}
{{--{!!  Form::label('cost', trans('crud.cost')) !!}--}}
{{--{!!  Form::input('number','cost', old('cost'), ['class' => 'form-control', 'size'=>'3','maxsize'=>'4']) !!}--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-md-4">--}}
{{--<div class="form-group">--}}
{{--{!!  Form::label('fightingAreas', trans('crud.fightingAreas')) !!}--}}
{{--{!!  Form::input('number','fightingAreas', old('fightingAreas'), ['class' => 'form-control']) !!}--}}
{{--</div>--}}

{{--</div>--}}

{{--<div class="col-md-4">--}}

{{--</div>--}}
{{--</div>--}}
{{--<div class="row">--}}
{{--<div class="col-md-6">--}}


{{--</div>--}}
{{--<div class="col-md-6">--}}

{{--</div>--}}

{{--</div>--}}


{{--<fieldset title="2">--}}
{{--<legend class="text-semibold">{{trans_choice('crud.place',1)}}</legend>--}}

{{--<div class="col-md-6">--}}
{{--<div class="form-group">--}}
{{--{!!  Form::label('place', trans('crud.name')) !!}--}}
{{--{!!  Form::text('place', old('place'), ['class' => 'form-control']) !!}--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--{!!  Form::label('latitude', trans('crud.latitude'),'') !!}--}}
{{--{!!  Form::text('latitude', old('latitude'), ['class' => 'form-control', 'id' => 'lat']) !!}--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--{!!  Form::label('longitude', trans('crud.longitude'),'') !!}--}}
{{--{!!  Form::text('longitude', old('longitude'), ['class' => 'form-control', 'id' => 'lng']) !!}--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--{!!  Form::label('country', trans('crud.country')) !!}--}}
{{--{!!  Form::text('country', old('country'), ['class' => 'form-control']) !!}--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--{!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}--}}
{{--</div>--}}

{{--</div>--}}
{{--<div class="col-md-6">--}}
{{--<div class="form-group">--}}
{{--{!!  Form::label('name', trans('crud.coords')) !!}--}}
{{--<div class="map-wrapper locationpicker-default" id="locationpicker-default"></div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<script>$('#locationpicker-default').locationpicker({--}}
{{--location: {latitude: 46.15242437752303, longitude: 2.7470703125},--}}
{{--radius: 300,--}}
{{--inputBinding: {--}}
{{--latitudeInput: $('#lat'),--}}
{{--longitudeInput: $('#lng'),--}}
{{--radiusInput: $('#us2-radius'),--}}
{{--locationNameInput: $('#city')--}}
{{--}--}}
{{--});--}}
{{--</script>--}}
{{--</fieldset>--}}

{{--<fieldset title="3">--}}
{{--<legend class="text-semibold">{{trans_choice('crud.category',2)}}</legend>--}}

<div class="row">
    <div class="col-md-12 col-lg-6 col-lg-offset-3">
        <div class="panel-body">
            <p class="coutent-group">Seleccione las categorias abiertas para su torneo</p>


            {!!  Form::select('category[]', $categories,$tournament->getCategoryList(), ['class' => 'form-control listbox-filter-disabled', "multiple"]) !!} <!-- Default 1st Dan-->
        </div>


    </div>
    {{--<div class="row">--}}
    {{--<div class="col-md-6">--}}


    {{--EnchoQty 2--}}
    {{--EnchoDuration 90--}}
    {{--</div>--}}
    {{--</div>--}}
</div>
{{--</fieldset>--}}


<button type="submit" class="btn btn-primary " id="block-panel">Submit <i class="icon-check position-right"></i>
</button>


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
        {{--$('.datelimit').pickadate({--}}
        {{--min: [{{$year}}, {{$month}}, {{$day}}],--}}
        {{--format: 'yyyy-mm-dd'--}}
        {{--});--}}


        // Basic Dual select example
        // Disable filtering
        $('.listbox-filter-disabled').bootstrapDualListbox({
            showFilterInputs: false
        });

        // Stepy settings
        // Override defaults
//        $.fn.stepy.defaults.legend = false;
//        $.fn.stepy.defaults.transition = 'fade';
//        $.fn.stepy.defaults.duration = 150;
//        $.fn.stepy.defaults.backLabel = '<i class="icon-arrow-left13 position-left"></i> Back';
//        $.fn.stepy.defaults.nextLabel = 'Next <i class="icon-arrow-right14 position-right"></i>';
//        $(".stepy-validation").stepy({});


        // Apply "Back" and "Next" button styling
//        $('.stepy-step').find('.button-next').addClass('btn btn-primary');
//        $('.stepy-step').find('.button-back').addClass('btn btn-default');
//        $(".switch").bootstrapSwitch();

        // Manipulating from callback
        // Basic functionality
//        $('.locationpicker-default').locationpicker({
//            radius: 150,
//            scrollwheel: false,
//            zoom: 10
//        });


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