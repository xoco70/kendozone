@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/header/tournamentUserCreate.js') !!}
@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('tournaments.users.create',$tournament) !!}
@stop
@section('content')

    @include("errors.list")

    <div class="container">
        <div class="row col-md-10 col-md-offset-2 custyle">

            <?php
            //                dd($categoryTournamentId);
            $categoryTournament = \App\CategoryTournament::findOrFail($categoryTournamentId);
            ?>
            {!! Form::open(['url'=>URL::action("TournamentUserController@index",$tournament->slug)]) !!}


            <div class="container-fluid">


                <div class="content">

                    <!-- Detached content -->
                    <div class="container-detached">
                        <div class="content-detached">


                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <div class="container-fluid">


                                        <fieldset title="add_competitor">
                                            <legend class="text-semibold">{{trans('core.add_competitor_to_category',['category' => $categoryTournament->category->name])}}</legend>
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
                                        {!!  Form::hidden('categoryTournamentId',$categoryTournamentId) !!}


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
            {!! JsValidator::formRequest('App\Http\Requests\TournamentUserRequest') !!}
        </div>
    </div>
    <script>

        $(function () {
            $(" .switch").bootstrapSwitch();
        });
    </script>
@stop

