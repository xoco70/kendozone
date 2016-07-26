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
                    {!!  Form::label('address', trans('core.address'),['class' => 'text-bold' ]) !!}
                    {!!  Form::text('address', old('address'), ['class' => 'form-control']) !!}
                </div>

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