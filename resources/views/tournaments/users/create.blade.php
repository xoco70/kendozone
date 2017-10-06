{{--Doesn't seem to be use too--}}
@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('tournaments.users.create',$tournament) !!}
@stop
@section('content')

    @include("errors.list")

    <div class="container">
        <div class="row col-md-10 col-md-offset-2 custyle">
            Shadow
            <?php
            $championship = \App\Championship::findOrFail($championshipId);
            ?>
            {!! Form::open(['url'=>URL::action("CompetitorController@index",$tournament->slug)]) !!}


            <div class="container-fluid">


                <div class="content">

                    <!-- Detached content -->
                    <div class="container-detached">
                        <div class="content-detached">


                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <div class="container-fluid">


                                        <fieldset title="add_competitor">
                                            <legend class="text-semibold">{{trans('core.add_competitor_to_category',['category' => $championship->category->name])}}</legend>
                                        </fieldset>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    {!!  Form::label('username', trans('core.username')) !!}
                                                    {!!  Form::text('username',null, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="form-group">

                                                <div class="col-md-6">
                                                    {!!  Form::label('email', trans('core.email')) !!}
                                                    {!!  Form::email('email',null, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        {!!  Form::hidden('championshipId',$championshipId) !!}


                                        <div align="right">
                                            <button type="submit"
                                                    class="btn btn-success">{{trans("core.save")}}</button>
                                        </div>
                                    </div>


                                </div>

                            </div>

                            @include("right-panel.users_create")


                        </div>


                    </div>


                </div>
            </div>


            {!! Form::close()!!}

        </div>
    </div>
@stop

@section('scripts_footer')
    {!! Html::script('js/pages/header/competitorCreate.js') !!}
    {!! JsValidator::formRequest('App\Http\Requests\CompetitorRequest') !!}
@stop
