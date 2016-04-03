<?php
 $tournament = \App\Tournament::with('categoryTournaments.users')->find($tournament->id);
?>
<div class="col-lg-6">
    <div class="panel panel-info panel-bordered">
        <div class="panel-heading">
            <h6 class="panel-title"><a href="{!! URL::action('TournamentController@edit', $tournament->slug) !!}">{{ $tournament->name }}</a></h6>
            <div class="heading-elements">
            </div>
        </div>

        <div class="container-fluid pt-20">
            <div class="row">
                <div class="col-lg-4">
                    <div id="campaigns-donut"></div>
                    <ul class="list-inline text-center">
                        <li>
                            <a href="{{URL::action('TournamentController@edit', $tournament->slug)}}#categories"
                               class="btn border-teal text-teal  btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-plus3"></i></a>
                        </li>
                        <li class="text-left">
                            <div class="text-semibold"><a class="text-default" href="{!! URL::action('TournamentController@edit', $tournament->slug) !!}"> {{ trans_choice('core.category',2) }}</a></div>
                            <div class="text-muted"><span class="status-mark border-success position-left"></span> {{ sizeof($tournament->categoryTournaments) }} </div>
                        </li>
                    </ul>

                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="content-group" id="new-visitors"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="index.html#"
                               class="btn border-grey-400 text-grey-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                        class="icon-people"></i></a>
                        </li>
                        <li class="text-left">
                            <div class="text-semibold"> <a class="text-default" href="{!! URL::action('TournamentUserController@index', $tournament->slug) !!}"> {{trans_choice('core.competitor',2)}}</a></div>
                            <div class="text-muted"><span class="status-mark border-success position-left"></span> {{ $tournament->competitors()->count() }}

                            </div>

                        </li>
                    </ul>

                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="content-group" id="total-online"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="index.html#"
                               class="btn border-indigo-400 text-indigo-400  btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                        class="icon-lock2"></i></a>
                        </li>
                        <li class="text-left">
                            <div class="text-semibold">{{ trans('core.type') }}</div>
                            <div class="text-muted">{{ $tournament->type ? trans_choice('core.invitation',1) :  trans('core.open')}}</div>
                        </li>
                    </ul>

                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="content-group" id="new-sessions"></div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-4">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#"
                               class="btn border-pink text-pink btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                        class="icon-calendar22"></i></a>
                        </li>
                        <li class="text-left">
                            <div class="text-semibold">{{ trans('core.date') }}</div>
                            <div class="text-muted">{{ $tournament->date }}</div>
                        </li>
                    </ul>

                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="content-group" id="new-visitors"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="index.html#"
                               class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                        class="icon-alert"></i></a>
                        </li>
                        <li class="text-left">
                            <div class="text-semibold">{{ trans('core.limitDate')}}</div>
                            <div class="text-muted">{{ $tournament->registerDateLimit == '0000-00-00' ? '--' : $tournament->registerDateLimit  }}</div>
                        </li>
                    </ul>

                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="content-group" id="new-sessions"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="index.html#"
                               class="btn border-brown-400 text-brown-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                        class="icon-target"></i></a>
                        </li>
                        <li class="text-left">
                            <div class="text-semibold">{{trans('core.level')}}</div>
                            <div class="text-muted"></span> {{ $tournament->level->name }}
                            </div>
                        </li>
                    </ul>

                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="content-group" id="total-online"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="position-relative" id="traffic-sources"></div>
    </div>
</div>