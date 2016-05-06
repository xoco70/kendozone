@extends('layouts.dashboard')
@section('breadcrumbs')
{!! Breadcrumbs::render('clubs.edit',$club) !!}

@stop
@section('content')
@include("errors.list")
<?php
$appURL = (app()->environment() == 'local' ? getenv('URL_BASE') : config('app.url'));
?>


        <!-- Detached content -->

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        @if (!is_null($club->id))
        {!! Form::model($club, ['method'=>"PATCH",
                                "action" => ["ClubController@update", $club->id],
                                'enctype' => 'multipart/form-data',
                                'id' => 'form']) !!}

        @else

        {!! Form::open(['url'=>URL::action('ClubController@store'),'enctype' => 'multipart/form-data']) !!}

        @endif
                <!-- Simple panel 1 : General Data-->


        <div class="panel panel-flat">

            <div class="panel-body">
                <div class="container-fluid">


                    <fieldset title="{{Lang::get('core.general_data')}}">
                        <legend class="text-semibold">{{Lang::get('core.general_data')}}</legend>

                        <div class="form-group">
                            {!!  Form::label('name', trans('core.name'),['class' => 'text-bold' ]) !!}
                            <br/>
                            {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}

                        </div>

                        {!!  Form::label('association', trans_choice('core.association',1),['class' => 'text-bold' ]) !!}
                        {!!  Form::select('association_id', $associations,$club->association_id, ['class' => 'form-control']) !!}


                        <br/>
                        {!!  Form::label('president', trans('core.club.president'),['class' => 'text-bold' ]) !!}
                        @if(sizeof($users)==0)
                            {!!  Form::text('president_id', trans('core.club.no_user_in_this_country'), ['class' => 'form-control ','disabled']) !!}
                            {!!  Form::hidden('president_id', 1) !!}

                        @else
                            {!!  Form::select('president_id', $users,$club->president_id, ['class' => 'form-control']) !!}
                        @endif


                        <br/>
                        {!!  Form::label('address', trans('core.club.address'),['class' => 'text-bold' ]) !!}
                        <div class="input-group">
                            <span class="input-group-addon">{{trans('core.club.address') }}</span>
                            {!!  Form::input('text', 'address', old('address'), ['class' => 'form-control address']) !!}
                            <span class="input-group-addon"><i class="icon-envelop3"></i></span>

                        </div>

                        <br/>
                        {!!  Form::label('phone', trans('core.club.phone'),['class' => 'text-bold' ]) !!}


                        <div class="input-group">
                            <span class="input-group-addon">{{trans('core.club.phone') }}</span>
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
    {!! JsValidator::formRequest('App\Http\Requests\ClubRequest') !!}
@stop