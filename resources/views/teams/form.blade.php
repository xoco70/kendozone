@extends('layouts.dashboard')
@section('breadcrumbs')
    {{--@if (isset($team->id))--}}
    {{--{!! Breadcrumbs::render('teams.edit',$tournament) !!}--}}
    {{--@else--}}
    {!! Breadcrumbs::render('teams.create',$tournament) !!}
    {{--@endif--}}


@stop
@section('content')
    @include("errors.list")
    <?php
    $appURL = (app()->environment() == 'local' ? getenv('URL_BASE') : config('app.url'));
    ?>


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
                                        {!!  Form::select('championship_id', $cts, old('championship_id'), ['class' => 'form-control']) !!}

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