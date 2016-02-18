@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/header/tournamentInvite.js') !!}
@stop
@section('styles')
    {!! Html::style('css/tournamentInvite.css') !!}
@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('invites.show',$tournament) !!}
@stop
@section('content')

    @include("errors.list")

    <div class="container-fluid">


        <div class="content">

            <!-- Detached content -->

            <!-- Simple panel 1 : General Data-->
            <div class="row">
                <div class="col-md-12 col-lg-6 col-lg-offset-3">

                    <div class="panel panel-flat">

                        <div class="panel-body">
                            <div class="container-fluid">

                                <fieldset title="{{Lang::get('crud.invite_send',['tournament' => $tournament->name])}}">
                                    <legend class="text-semibold">{{Lang::get('crud.invite_send',['tournament' => $tournament->name])}}</legend>

                                    <div class="container-fluid">

                                        {!! Form::open(['url'=>URL::action('InviteController@store')]) !!}
                                        <div class=" form-group">
                                            {!!  Form::label('recipients', trans('crud.recipients')) !!}
                                            {!!  Form::text('recipients', null, ['class' => 'form-control', 'placeholder'=>trans('crud.invite_recipients')]) !!}
                                        </div>
                                        {!!  Form::hidden('tournamentSlug', $tournament->slug) !!}

                                        <div class="form-group">
                                            {!!  Form::submit(trans('crud.send_invites'), ['class' => 'btn btn-primary form-control']) !!}
                                        </div>

                                        {!! Form::close()!!}

                                    </div>


                                </fieldset>


                            </div>
                        </div>
                        <!-- /detached content -->

                    </div>
                </div>

            </div>
            <!-- /content area -->


        </div>


        <script>
            $('#recipients').multiple_emails({
                position: 'top', // Display the added emails above the input
                theme: 'bootstrap', // Bootstrap is the default theme
                checkDupEmail: true // Should check for duplicate emails added
            });
        </script>
    </div>
@stop


