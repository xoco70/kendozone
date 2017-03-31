@extends('layouts.dashboard')
@section('styles')
    {!! Html::style('css/pages/tournamentInvite.css') !!}
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

                                <fieldset title="{{Lang::get('core.invite_send',['tournament' => $tournament->name])}}">
                                    <legend class="text-semibold">{{Lang::get('core.invite_send',['tournament' => $tournament->name])}}</legend>

                                    <p>
                                    {{trans('core.2_choices_to_invite')}}
                                    <ul>
                                        <li>{{trans('core.invite_by_commas')}}</li>
                                        <li>{{trans('core.invite_by_excel')}}
                                        </li>
                                    </ul>
                                    </p>
                                    <div class="container-fluid">

                                        {!! Form::open(['url'=>URL::action('InviteController@store')]) !!}
                                        <div class=" form-group">
                                            {!!  Form::label('recipients', trans('core.recipients')) !!}
                                            {!!  Form::text('recipients', null, ['class' => 'form-control', 'placeholder'=>trans('core.invite_recipients')]) !!}
                                        </div>
                                        {!!  Form::hidden('tournamentSlug', $tournament->slug) !!}

                                        <div class="form-group">
                                            {!!  Form::submit(trans('core.send_invites'), ['class' => 'btn btn-primary form-control']) !!}
                                        </div>

                                        {!! Form::close()!!}

                                        <div class="content-divider text-muted form-group">
                                            <span>{{  trans('core.or') }}</span></div>
                                        <p align="center">
                                            <strong> {{ trans('core.bulk_upload') }} - <a
                                                        href="{{ url('layouts/invitations.csv') }}">{{ trans('core.download_layout') }}</a></strong><br/><br/>


                                            {!! Form::open(['url'=>URL::action('InviteController@upload'),'enctype' => 'multipart/form-data','id' => 'invites']) !!}

                                            <input id="invites" name="invites" type="file" class="file-input">
                                            <span class="help-block">{{ trans('core.upload_file_to_csv_format') }}<br>
                                                {{ trans('core.how_to_save_to_csv') }}<br></span>
                                            {!!  Form::hidden('tournamentSlug', $tournament->slug) !!}
                                            {!! Form::close()!!}


                                        </p>


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

    </div>
@stop
@section('scripts_footer')
    {!! Html::script('js/pages/header/tournamentInvite.js') !!}
    <script>
        $('#recipients').multiple_emails({
            position: 'top', // Display the added emails above the input
            theme: 'bootstrap', // Bootstrap is the default theme
            checkDupEmail: true // Should check for duplicate emails added
        });
    </script>

@stop

