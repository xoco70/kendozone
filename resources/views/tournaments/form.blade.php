{{--TODO PREFENCIAS CURRENCY--}}

<fieldset title="1">
    <legend class="text-semibold">{{Lang::get('crud.general_data')}}</legend>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!!  Form::label('name', trans('crud.name')) !!}
                {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4">

            {!!  Form::label('tournamentDate', trans('crud.eventDate')) !!}

            <div class="input-group">
                <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                {!!  Form::input('text', 'tournamentDate', old('date'), ['class' => 'form-control datetournament']) !!}
            </div>
        </div>


        <div class="col-md-4">
            {!!  Form::label('limitRegistrationDate', trans('crud.limitDateRegistration')) !!}
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                {!!  Form::input('text', 'registerDateLimit', old('registerDateLimit'), ['class' => 'form-control datelimit']) !!}
            </div>
            <br/>


        </div>
        <div class="col-md-4">


            <p>&nbsp;</p><label>
                {!!   Form::checkbox('mustPay', old('mustPay'), null, ['class' => 'switchery', 'checked' => 'checked']) !!}
                {!! trans('crud.pay4register') !!}
            </label>
        </div>


    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!!  Form::label('cost', trans('crud.cost')) !!}
                {!!  Form::input('number','cost', old('cost'), ['class' => 'form-control', 'size'=>'3','maxsize'=>'4']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!!  Form::label('fightingAreas', trans('crud.fightingAreas')) !!}
                {!!  Form::input('number','fightingAreas', old('fightingAreas'), ['class' => 'form-control']) !!}
            </div>

        </div>

        <div class="col-md-3">

            <div class="form-group">
                {!!  Form::label('levelId', trans('crud.level')) !!}
                {!!  Form::select('levelId', $levels,null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!!  Form::label('type', trans('crud.tournamentType')) !!}
                {!!  Form::select('type',['0' => 'abierto','1' => 'cerrado'], old('type'),  ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">


        </div>
        <div class="col-md-6">

        </div>

    </div>


</fieldset>

<fieldset title="2">
    <legend class="text-semibold">{{trans_choice('crud.place',1)}}</legend>

    <div class="col-md-6">
        <div class="form-group">
            {!!  Form::label('place', trans('crud.name')) !!}
            {!!  Form::text('place', old('place'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!!  Form::label('latitude', trans('crud.latitude'),'') !!}
            {!!  Form::text('latitude', old('latitude'), ['class' => 'form-control', 'id' => 'lat']) !!}
        </div>
        <div class="form-group">
            {!!  Form::label('longitude', trans('crud.longitude'),'') !!}
            {!!  Form::text('longitude', old('longitude'), ['class' => 'form-control', 'id' => 'lng']) !!}
        </div>

        <div class="form-group">
            {!!  Form::label('country', trans('crud.country')) !!}
            {!!  Form::text('country', old('country'), ['class' => 'form-control']) !!}
        </div>
        {{--<div class="form-group">--}}
        {{--{!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}--}}
        {{--</div>--}}

    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!!  Form::label('name', trans('crud.coords')) !!}
            <div class="map-wrapper locationpicker-default" id="locationpicker-default"></div>
        </div>
    </div>
    <script>$('#locationpicker-default').locationpicker({
            location: {latitude: 46.15242437752303, longitude: 2.7470703125},
            radius: 300,
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng'),
                radiusInput: $('#us2-radius'),
                locationNameInput: $('#city')
            }
        });
    </script>
</fieldset>

<fieldset title="3">
    <legend class="text-semibold">{{trans_choice('crud.category',2)}}</legend>

    <div class="row">
        <div class="col-md-12">
            <div class="panel-body">
                <p class="coutent-group">Seleccione las categorias abiertas para su torneo</p>



                {!!  Form::select('category[]', $categories,$tournament->getCategoryList(), ['class' => 'form-control listbox-filter-disabled', "multiple"]) !!} <!-- Default 1st Dan-->
                {{--<select multiple="multiple" class="form-control listbox">--}}
                    {{--@foreach($categories as $category)--}}
                        {{--<option value="{!!$category->id!!}">{!!$category->name!!}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            </div>
            {{--It could be great to use : form_dual_listboxes.html basic--}}

            {{--<div class="form-group">--}}
            {{--{!!  Form::label('limitRegistrationDate', trans('crud.fullLimitDateRegistration')) !!}--}}
            {{--{!!  Form::input('date', 'limitRegistrationDate', old('limitRegistrationDate'), ['class' => 'form-control']) !!}--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
            {{--{!!  Form::label('teamSize', trans('crud.teamsize')) !!}--}}
            {{--{!!  Form::input('number','teamSize', old('teamSize'), ['class' => 'form-control','size']) !!}--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
            {{--{!!  Form::label('roundRobinWinner', trans('crud.roundRobinWinner')) !!}--}}
            {{--{!!  Form::input('number','roundRobinWinner', old('roundRobinWinner'), ['class' => 'form-control']) !!}--}}
            {{--</div>--}}
        </div>
        {{--<div class="row">--}}
        {{--<div class="col-md-6">--}}

        {{--<div class="form-group">--}}
        {{--{!!  Form::label('fightDuration', trans('crud.fightDuration')) !!}--}}
        {{--{!!  Form::input('number','fightDuration', old('fightDuration'), ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
        {{----}}
        {{--<div class="form-group">--}}
        {{--{!!  Form::label('level', trans('crud.tournamentLevel')) !!}--}}
        {{--{!!  Form::select('level',$levels, old('level'),  ['class' => 'form-control']) !!}--}}
        {{--</div>--}}
        {{--<div class="checkbox checkbox-switchery">--}}
        {{--<label>--}}
        {{--<input name="hasRoundRobin" id="hasRoundRobin" type="checkbox" class="switchery"--}}
        {{--checked="checked">--}}
        {{--{!! trans('crud.hasRoundRobin') !!}--}}
        {{--</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
        {{--<label>--}}
        {{--<input name="hasEncho" id="hasEncho" value type="checkbox" class="switchery" checked="checked">--}}
        {{--{!! trans('crud.hasEncho') !!}--}}
        {{--</label>--}}
        {{--<label>--}}
        {{--<input name="hasHantei" id="hasHantei" value type="checkbox" class="switchery"--}}
        {{--checked="checked">--}}
        {{--{!! trans('crud.hasHantei') !!}--}}
        {{--</label>--}}
        {{--</div>--}}
        {{--EnchoQty 2--}}
        {{--EnchoDuration 90--}}
        {{--</div>--}}
        {{--</div>--}}
    </div>
</fieldset>


<button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i>
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
        $('.datelimit').pickadate({
            min: [{{$year}}, {{$month}}, {{$day}}],
            format: 'yyyy-mm-dd'
        });


        // Basic Dual select example
        // Disable filtering
        $('.listbox-filter-disabled').bootstrapDualListbox({
            showFilterInputs: false
        });


    });
</script>