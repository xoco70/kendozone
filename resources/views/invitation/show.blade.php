@extends('layouts.dashboard')

@section('content')

    @include("errors.list")

    <div class="container-fluid">

        {!! Form::open(['url'=>"invite"]) !!}


        <div class="content">

            <!-- Detached content -->
            <div class="container-detached">
                <div class="content-detached">

                    <!-- Simple panel 1 : General Data-->
                    <div class="panel panel-flat">
                        {{--<div class="panel-heading " >--}}
                        {{--<button type="submit" class="btn btn-warning">Borrar</button>--}}
                        {{--</div>--}}

<?php $message = trans('crud.invite_template', ['link' => '<a href="#">link</a>','tournament' => 'Nacional de Kendo' ]); ?>

                        <div class="panel-body">
                            <div class="container-fluid">


                                <fieldset title="{{Lang::get('crud.invite_send',['tournament' => $tournament->name])}}">
                                    <legend class="text-semibold">{{Lang::get('crud.invite_send',['tournament' => $tournament->name])}}</legend>

                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-6 col-lg-offset-3">

                                                {!! Form::open(['url'=>"/invite"]) !!}
                                                <div class=" form-group">
                                                    {!!  Form::label('recipients', trans('crud.recipients')) !!}
                                                    {!!  Form::text('recipients', null, ['class' => 'form-control', 'placeholder'=>trans('crud.invite_recipients')]) !!}
                                                </div>
                                                <div class=" form-group">
                                                    {!!  Form::label('message', trans('crud.invite_message')) !!}
                                                    {!!  Form::textarea('message',nl2br(e($message)), ['class' => 'form-control', 'placeholder'=>trans('crud.invite_message_indication')]) !!}
                                                </div>
                                                <div class="form-group">
                                                    {!!  Form::submit(trans('crud.send_invites'), ['class' => 'btn btn-primary form-control']) !!}
                                                </div>

                                                {!! Form::close()!!}

                                            </div>
                                        </div>
                                    </div>


                                </fieldset>


                            </div>

                        </div>

                    </div>
                </div>
                <!-- /detached content -->

            @include("layouts.tournament_menu")

            </div>
            <!-- /content area -->


        </div>


        {!! Form::close()!!}

        <script>
            $('#recipients').multiple_emails({
                position: 'top', // Display the added emails above the input
                theme: 'bootstrap', // Bootstrap is the default theme
                checkDupEmail: true // Should check for duplicate emails added
            });
        </script>
    </div>
@stop


