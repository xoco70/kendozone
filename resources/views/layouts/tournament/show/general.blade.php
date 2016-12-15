<div class="col-lg-8 col-lg-offset-2">
    <div class="panel panel-flat">

        <div class="panel-body">
            <div class="container-fluid">


                <fieldset title="{{Lang::get('core.general_data')}}">
                    <legend class="text-semibold">{{Lang::get('core.general_data')}}</legend>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!!  Form::label('name', trans('core.name'),['class' => 'text-bold ' ]) !!}
                                <br/>
                                {{ $tournament->name }}


                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                {!!  Form::label('level_id', trans('core.level'),['class' => 'text-bold' ]) !!}
                                <br/>
                                {{ $tournament->level->name }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            {!!  Form::label('date', trans('core.eventDate'),['class' => 'text-bold' ]) !!}
                            {{--<br/>--}}


                            <div class="input-group">
                                {{ $tournament->dateIni }} / {{ $tournament->dateFin }}
                            </div>


                        </div>


                        <div class="col-md-3">
                            @if ($tournament->registerDateLimit!= null && $tournament->registerDateLimit!= '0000-00-00')
                                {!!  Form::label('registerDateLimit', trans('core.limitDateRegistration'),['class' => 'text-bold' ]) !!}
                                <br/>

                                <div class="input-group">

                                    {{ $tournament->registerDateLimit }}

                                </div>
                                <br/>
                            @endif

                        </div>

                        <div class="col-md-3">

                            <div class="checkbox-switch">
                                <label>

                                    {!!  Form::label('type', trans('core.tournamentType'),['class' => 'text-bold' ]) !!}

                                    <br/>
                                    {{ $tournament->type == 1 ? trans('core.open') : trans_choice('core.invitation', 1) }}

                                </label>
                            </div>

                        </div>
                    </div>

                </fieldset>


            </div>
        </div>
    </div>
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="container-fluid">


                <fieldset title="{{Lang::get('core.venue')}}">
                    <a name="place">
                        <legend class="text-semibold">{{Lang::get('core.venue')}}
                            : {{ $tournament->venue != null ? $tournament->venue->venue_name : ""}}</legend>
                    </a>
                </fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!!  Form::label('address', trans('core.address'),['class' => 'text-bold' ]) !!}
                            <br/>
                            {{ $tournament->venue != null ? $tournament->venue->address :""}}


                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            {!!  Form::label('details', trans('core.details'),['class' => 'text-bold' ]) !!}
                            <br/>
                            {{ $tournament->venue != null ? $tournament->venue->details : ""}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!!  Form::label('state', trans('core.state'),['class' => 'text-bold' ]) !!}
                            <br/>
                            {{ $tournament->venue != null ? $tournament->venue->state :""}}


                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            {!!  Form::label('country', trans('core.country'),['class' => 'text-bold' ]) !!}
                            <br/>
                            @if ($tournament->venue != null)
                                {{ $tournament->venue->country->name }}&nbsp; <img
                                        src="/images/flags/{{ $tournament->venue->country->flag }}"
                                        alt="{{ $tournament->venue->country->name }}"/>
                            @endif
                        </div>
                    </div>
                </div>

                @if ($tournament->venue!=null)
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="map-container map-basic"></div>
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </div>
@if ($tournament->type==1)

    <!-- /simple panel -->
        <div class="panel panel-flat" id="share_tournament">

            <div class="panel-body">

                <legend class="text-semibold ">{{ trans('core.invite_with_link') }}</legend>

                <h2 class="form-group text-center m">
                    <br/>
                    {{$appURL}}/tournaments/{{$tournament->slug}}/register/
                </h2>


            </div>
        </div>
    @endif
</div>