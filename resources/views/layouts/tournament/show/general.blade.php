<div class="col-lg-8 col-lg-offset-2">
    <div class="panel panel-flat">

        <div class="panel-body">
            <div class="container-fluid">


                <fieldset title="{{Lang::get('core.general_data')}}">
                    <legend class="text-semibold">{{Lang::get('core.general_data')}}</legend>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>{{ trans('core.name') }}</strong>
                                <br/>
                                {{ $tournament->name }}
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <strong>{{ trans('core.level') }}</strong>
                                <br/>
                                {{ $tournament->level->name }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>{{ trans('core.eventDate') }}</strong>
                            <br/>
                            {{ $tournament->dateIni }} / {{ $tournament->dateFin }}
                        </div>


                        <div class="col-md-3">
                            @if ($tournament->registerDateLimit!= null && $tournament->registerDateLimit!= '0000-00-00')
                                <strong>{{ trans('core.limitDateRegistration') }}</strong>
                                <br/>
                                {{ $tournament->registerDateLimit }}
                                <br/>
                            @endif

                        </div>

                        <div class="col-md-3">

                            <strong>{{ trans('core.tournamentType')  }}</strong>
                            <br/>
                            {{ $tournament->type == 1 ? trans('core.open') : trans_choice('core.invitation', 1) }}


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
                        <legend class="text-semibold">
                            {{trans('core.venue')}}:
                        </legend>
                    </a>
                </fieldset>
                <div class="row">
                    <div class="col-md-6">

                        <strong>{{ trans('core.address')  }}</strong>
                        <br/>
                        {{ $tournament->venue != null ? $tournament->venue->address :""}}
                    </div>
                    <div class="col-md-6">
                        <strong>{{ trans('core.details')  }}</strong>
                        <br/>
                        {{ $tournament->venue != null ? $tournament->venue->details : ""}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>{{ trans('core.state')  }}</strong>
                        <br/>
                        {{ $tournament->venue != null ? $tournament->venue->state :""}}

                    </div>
                    <div class="col-md-6">
                        <strong>{{ trans('core.country')  }}</strong>
                        <br/>
                        @if ($tournament->venue != null)
                            {{ $tournament->venue->country->name }}&nbsp; <img
                                    src="/images/flags/{{ $tournament->venue->country->flag }}"
                                    alt="{{ $tournament->venue->country->name }}"/>
                        @endif
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