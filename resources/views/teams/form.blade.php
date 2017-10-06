@extends('layouts.dashboard')
@section('title')
    <title>{{ trans('core.add') .' '.trans_choice('core.team',2) }}</title>
@stop

@section('breadcrumbs')
    {!! Breadcrumbs::render('teams.create',$tournament) !!}
@stop
@section('content')
    @include("errors.list")
    <!-- Detached content -->
    <div class="container-detached">
        <div class="content-detached">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                @if (!is_null($team->id))
                    {!! Form::model($team, ['method'=>"PATCH",
                                            "action" => ["TeamController@update", $tournament->slug, $team->id],
                                            'enctype' => 'multipart/form-data',
                                            'id' => 'form']) !!}
                @else
                    {!! Form::open(['url'=>URL::action('TeamController@store', $tournament->slug),'enctype' => 'multipart/form-data']) !!}
                @endif
                <!-- Simple panel 1 : General Data-->
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="form-group">
                                        {!!  Form::label('name', trans('core.name'),['class' => 'text-bold' ]) !!}
                                        {!!  Form::text('name', old('name'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!!  Form::label('name', trans_choice('categories.category',1),['class' => 'text-bold' ]) !!}
                                        <br/>
                                        {!!  Form::select('championship_id', $tournament->buildCategoryList(), old('championship_id'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group" align="right">
                                <button type="submit" class="btn btn-success" id="save">
                                    <i></i>{{trans("core.save")}}</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    @include("right-panel.tournament_menu")
@stop
@section('scripts_footer')
    {!! JsValidator::formRequest('App\Http\Requests\TeamRequest') !!}
@stop