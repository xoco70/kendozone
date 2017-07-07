@extends('layouts.dashboard')
@section('breadcrumbs')
{!! Breadcrumbs::render('federations.edit',$federation) !!}

@stop
@section('content')
@include("errors.list")
<?php
$appURL = (app()->environment() == 'local' ? getenv('URL_BASE') : config('app.url'));
?>


        <!-- Detached content -->
@include('layouts.displayMenuMyEntitiesOnTop')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        {!! Form::model($federation, ['method'=>"PATCH", 'id'=>'form', "action" => ["FederationController@update", $federation->id]]) !!}

                <!-- Simple panel 1 : General Data-->


        <div class="panel panel-flat">

            <div class="panel-body">
                <div class="container-fluid">


                    <fieldset title="{{Lang::get('core.general_data')}}">
                        <legend class="text-semibold">{{Lang::get('core.general_data')}}</legend>
                        <h2><img src = "/images/flags/{{ $federation->country->flag}}" class="mr-20">{{ $federation->country->name }}</h2>
                        <br/>

                        <div class="form-group">
                            {!!  Form::label('name', trans('core.name'),['class' => 'text-bold' ]) !!}
                            <br/>
                            {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}

                        </div>

                        {!!  Form::label('president', trans('structures.federation.president'),['class' => 'text-bold' ]) !!}
                        @if(sizeof($users)==0)
                            {!!  Form::text('president_id', trans('structures.federation.no_user_in_this_country'), ['class' => 'form-control ','disabled']) !!}

                        @else
                            {!!  Form::select('president_id', $users,$federation->president_id, ['class' => 'form-control']) !!}
                        @endif



                        <br/>
                        {!!  Form::label('address', trans('structures.federation.address'),['class' => 'text-bold' ]) !!}
                        <div class="input-group">

                            {!!  Form::input('text', 'address', old('address'), ['class' => 'form-control address']) !!}
                            <span class="input-group-addon"><i class="icon-envelop3"></i></span>

                        </div>

                        <br/>
                        {!!  Form::label('phone', trans('structures.federation.phone'),['class' => 'text-bold' ]) !!}



                        <div class="input-group">
                            {!!  Form::input('text', 'phone', old('phone'), ['class' => 'form-control phone']) !!}
                            <span class="input-group-addon"><i class="icon-phone"></i></span>
                        </div>


                    </fieldset>


                </div>
                <br/>
                <div align="right">
                    <button type="submit" class="btn btn-success"><i></i>{{trans("core.save")}}</button>
                </div>
            </div>
        </div>

    </div>
</div>
@stop
@section('scripts_footer')
{!! JsValidator::formRequest('App\Http\Requests\FederationRequest') !!}
@stop