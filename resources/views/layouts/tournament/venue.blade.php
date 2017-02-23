{!! Form::model($tournament, ['method'=>"PATCH", 'id'=>'form', "action" => ["TournamentController@update", $tournament->slug]]) !!}
<!-- Simple panel 2 : Venue -->
<div class="panel panel-flat">
    <div class="panel-body">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="form-group">
                    {!! Form::label('name', trans('core.coords'),['class' => 'text-bold' ]) !!}
                    <div class="map-wrapper locationpicker-default"
                         id="locationpicker-default"></div>
                </div>
            </div>

            <div class="col-lg-12 mt-20">
                <div class="form-group">
                    {!! Form::label('venue_name', trans('core.name'),['class' => 'text-bold' ]) !!}
                    {!! Form::text('venue_name', $venue->venue_name, ['class' => 'form-control','id' =>'venue_name']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('address', trans('core.address'),['class' => 'text-bold' ]) !!}
                    {!! Form::text('address', $venue->address, ['class' => 'form-control','id' =>'address']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('details', trans('core.details'),['class' => 'text-bold' ]) !!}
                    {!! Form::text('details', $venue->details, ['class' => 'form-control','id' =>'details']) !!}
                </div>

                {!! Form::hidden('latitude', $venue->setDefaultLocation($tournament, $venue->latitude,$venue->longitude)->latitude, ['id' =>'latitude']) !!}
                {!! Form::hidden('longitude',$venue->setDefaultLocation($tournament, $venue->latitude,$venue->longitude)->longitude, ['id' =>'longitude']) !!}

                {!! Form::hidden('city', $venue->city, ['id' =>'city']) !!}
                {!! Form::hidden('CP', $venue->CP, ['id' =>'CP']) !!}
                {!! Form::hidden('state', $venue->state, ['id' =>'state']) !!}

                {!! Form::label('country_id', trans('core.country'),['class' => 'text-bold']) !!}
                {!! Form::select('country_id',
                $countries,$venue->country_id == null
                    ? Auth::user()->country_id
                    : $venue->country_id ,
                ['class' => 'form-control']) !!} <!-- 484 is Mexico Code -->

            </div>
        </div>
        <div align="right">
            <button type="submit" class="btn btn-success btn-update-tour mr-20 mt-20 " id="update_venue"><i></i>{{trans("core.save")}}
            </button>
        </div>
    </div>
</div>
<input type="hidden" id="activeTab" name="activeTab" value="venue" />
{!! Form::close()!!}