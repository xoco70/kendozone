<div class="panel panel-flat category-settings">
    <div class="panel-body">
        <div class="container-fluid">
            <div class="panel-group" id="accordion-styled">
                @foreach($tournament->categoryTournaments as $key => $categoryTournament)
                    {{--TODO This is making n+1 query, have to cache it--}}
                    <?php
                    // Set defaults
                    $setting = $tournament->categoryTournaments->get($key)->settings;
                    $teamSize = isset($setting->teamSize) ? $setting->teamSize : 0;
                    $enchoQty = isset($setting->enchoQty) ? $setting->enchoQty : 0;
                    $fightingAreas = isset($setting->fightingAreas) ? $setting->fightingAreas : 0;

                    $fightDuration = (isset($setting->fightDuration) && $setting->fightDuration != "")
                            ? $setting->fightDuration : config('constants.CAT_FIGHT_DURATION');

                    $enchoDuration = (isset($setting->enchoDuration) && $setting->enchoDuration != "")
                            ? $setting->enchoDuration : config('constants.CAT_ENCHO_DURATION');


                    ?>

                    <div class="panel">
                        <div class="row">
                            <div class="col-lg-7 col-xs-5 cat-title">
                                <a data-toggle="collapse" data-parent="#accordion-styled"
                                   href="#accordion-styled-group{!! $key !!}">

                                    <div class="panel-heading">
                                        <h6 class="panel-title">

                                            {{trans($categoryTournament->category->buildName($grades))}} <i
                                                    class="glyphicon  glyphicon-edit  status-icon"></i>
                                        </h6>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-5 col-xs-7 cat-status">
                                <a data-toggle="collapse" data-parent="#accordion-styled"
                                   href="#accordion-styled-group{!! $key !!}">
                                    <div class="panel-heading">
                                        @if (is_null($setting))
                                            <span class="text-orange-600">
                                                            <span class="cat-state">{{ trans('core.configure') }}</span>
                                                            <i class="glyphicon  glyphicon-exclamation-sign  status-icon"></i>
                                                        </span>
                                        @else

                                            <span class="text-success">

                                                            <span class="cat-state">{{ trans('core.configured_full') }}</span>
                                                            <i class="glyphicon text-success glyphicon-ok  status-icon"></i>
                                                        </span>
                                        @endif
                                    </div>
                                </a>
                            </div>

                        </div>
                        <div id="accordion-styled-group{!! $key !!}"
                             class="panel-collapse collapse {!! $key==0 ? "in" : "" !!} ">
                            <div class="panel-body">
                                {{--FORM--}}
                                @include('categories.categorySettings')
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>


        </div>


        @if ($settingSize > 0 && $settingSize == $categorySize)
            <br/>
            <a href="{{ URL::action('InviteController@create',  $tournament->slug) }}" id="add_competitors" type="button"
               class="btn btn-success p-20 mr-10 pull-right" > @lang('core.invite_competitors') <i class="glyphicon glyphicon-chevron-right"></i></a>
        @else
            <br/>
            <a href="{{ URL::action('InviteController@create',  $tournament->slug) }}" id="add_competitors" type="button"
               class="hide btn btn-success mr-10 pull-right p-20"> @lang('core.invite_competitors') <i class="glyphicon glyphicon-chevron-right"></i> </a>
        @endif

    </div>
    <!-- /simple panel -->
</div>
