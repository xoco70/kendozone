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
            <div class="col-md-6">

                {!!  Form::label('tournamentDate', trans('crud.eventDate')) !!}

                <div class="input-group">
                    <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                    {!!  Form::input('text', 'tournamentDate', old('date'), ['class' => 'form-control pickadate-limits']) !!}
                </div>
            </div>



            <div class="col-md-6">
                <div class="form-group">
                {!!  Form::label('levelId', trans('crud.level')) !!}
                {!!  Form::select('levelId', $levels,null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!!  Form::label('cost', trans('crud.cost')) !!}
                    {!!  Form::text('cost', old('cost'), ['class' => 'form-control']) !!}
                </div>
            </div>



            <div class="col-md-6">
                <p>&nbsp;</p><label>
                    <input name ="pay4register" id="pay4register" value type="checkbox" class="switchery" checked="checked">
                    {!! trans('crud.pay4register') !!}
                </label>
            </div>
        </div>



    </fieldset>

    <fieldset title="2">
        <legend class="text-semibold">{{trans_choice('crud.place',1)}}</legend>

        <div class="col-md-6">
            <div class="form-group">
                {!!  Form::label('name', trans('crud.name')) !!}
                {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('latitude', trans('crud.latitude'),'') !!}
                {!!  Form::text('latitude', old('latitude'), ['class' => 'form-control', 'id' => 'lat',  'disabled' => 'disabled']) !!}
            </div>
            <div class="form-group">
                {!!  Form::label('longitude', trans('crud.longitude'),'') !!}
                {!!  Form::text('longitude', old('longitude'), ['class' => 'form-control', 'id' => 'lng',  'disabled' => 'disabled']) !!}
            </div>

            <div class="form-group">
                {!!  Form::label('country', trans('crud.country')) !!}
                {!!  Form::text('country', old('country'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!!  Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
            </div>

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
        <legend class="text-semibold">{{Lang::get('crud.settings')}}</legend>

        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                    {!!  Form::input('text', 'limitRegistrationDate', old('limitRegistrationDate'), ['class' => 'form-control pickadate-limits']) !!}
                </div>

                <div class="form-group">
                    {!!  Form::label('limitRegistrationDate', trans('crud.fullLimitDateRegistration')) !!}
                    {!!  Form::input('date', 'limitRegistrationDate', old('limitRegistrationDate'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!!  Form::label('teamSize', trans('crud.teamsize')) !!}
                    {!!  Form::input('number','teamSize', old('teamSize'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!!  Form::label('fightingAreas', trans('crud.fightingAreas')) !!}
                    {!!  Form::input('number','fightingAreas', old('fightingAreas'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!!  Form::label('roundRobinWinner', trans('crud.roundRobinWinner')) !!}
                    {!!  Form::input('number','roundRobinWinner', old('roundRobinWinner'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        {!!  Form::label('fightDuration', trans('crud.fightDuration')) !!}
                        {!!  Form::input('number','fightDuration', old('fightDuration'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!!  Form::label('type', trans('crud.tournamentType')) !!}
                        {!!  Form::select('type',['0' => 'abierto','1' => 'cerrado'], old('type'),  ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!!  Form::label('level', trans('crud.tournamentLevel')) !!}
                        {!!  Form::select('level',$levels, old('level'),  ['class' => 'form-control']) !!}
                    </div>
                    <div class="checkbox checkbox-switchery">
                        <label>
                            <input name ="hasRoundRobin" id="hasRoundRobin" type="checkbox" class="switchery" checked="checked">
                            {!! trans('crud.hasRoundRobin') !!}
                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                            <input name ="hasEncho" id="hasEncho" value type="checkbox" class="switchery" checked="checked">
                            {!! trans('crud.hasEncho') !!}
                        </label>
                        <label>
                            <input name ="hasHantei" id="hasHantei" value type="checkbox" class="switchery" checked="checked">
                            {!! trans('crud.hasHantei') !!}
                        </label>
                    </div>
                    EnchoQty 2
                    EnchoDuration 90
                </div>
            </div>
        </div>
    </fieldset>



    <button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i>
    </button>


<!-- Theme JS files -->


