{!! Form::model($tournament, ['method'=>"PATCH", 'id'=>'form', "action" => ["TournamentController@update", $tournament->slug]]) !!}
<!-- Simple panel 2 : Venue -->
<div class="panel panel-flat">
    <div class="panel-body">
        <div class="container-fluid">
            <div class="col-lg-12 mt-20">
                <div class="form-group">
                    {!!  Form::label('venue', trans('core.name'),['class' => 'text-bold' ]) !!}
                    {!!  Form::text('venue', old('venue'), ['class' => 'form-control']) !!}
                </div>

                {!!  Form::hidden('latitude', old('latitude'), ['class' => 'form-control', 'id' =>'latitude']) !!}
                {!!  Form::hidden('longitude', old('longitude'), ['class' => 'form-control','id' =>'longitude']) !!}

                <div class="form-group">
                    {!!  Form::label('address', trans('core.address'),['class' => 'text-bold' ]) !!}
                    {!!  Form::text('address', old('address'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!!  Form::label('details', trans('core.details'),['class' => 'text-bold' ]) !!}
                    {!!  Form::text('details', old('details'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!!  Form::label('city', trans('core.city'),['class' => 'text-bold' ]) !!}
                    {!!  Form::text('city', old('city'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!!  Form::label('CP', trans('core.CP'),['class' => 'text-bold' ]) !!}
                    {!!  Form::text('CP', old('CP'), ['class' => 'form-control']) !!}
                </div>
            {!!  Form::label('country_id', trans('core.country'),['class' => 'text-bold']) !!}
            {!!  Form::select('country_id', $countries,Auth::user()->country_id, ['class' => 'form-control']) !!} <!-- 484 is Mexico Code -->

            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    {!!  Form::label('name', trans('core.coords'),['class' => 'text-bold' ]) !!}
                    <div class="map-wrapper locationpicker-default"
                         id="locationpicker-default"></div>
                </div>
            </div>
        </div>
        <div align="right">
            <button type="submit"
                    class="btn btn-success btn-update-tour"><i></i>{{trans("core.save")}}
            </button>
        </div>
    </div>
</div>
{!! Form::close()!!}