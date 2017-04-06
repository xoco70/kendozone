@extends('layouts.dashboard')

@section('content')
    <!-- Submenu -->
    <!-- /Submenu -->


    <div class="container-fluid">


        {!! Form::open(['url'=>route('impersonate.store')]) !!}

        <div class="form-group">
            {!!  Form::label('email', trans('core.email'),['class' => 'text-bold' ]) !!}
            <br/>
            {!!  Form::text('email', '', ['class' => 'form-control']) !!}

        </div>
        <div align="right">
            <button type="submit" class="btn btn-success" id="save"><i></i>{{trans("core.save")}}</button>
        </div>
        {!! Form::close() !!}
    </div>


@stop
