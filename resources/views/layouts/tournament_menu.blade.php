<!-- Detached sidebar -->
<div class="sidebar-detached">

    <div class="sidebar sidebar-default">

        <div class="sidebar-content">


            <!-- Sub navigation -->
            <div class="sidebar-category">
                <div class="category-title">
                    <span>{{ $tournament->name }}</span>
                    <ul class="icons-list">
                        <li><a href="#" data-action="collapse"></a></li>
                    </ul>
                </div>

                <div class="category-content no-padding">
                    <ul class="navigation navigation-alt navigation-accordion">
                        <li><a href="#"><i class="icon-trophy2"></i> {{ trans('crud.general') }}
                                @if(!isNullOrEmptyString($tournament->registerDateLimit) && !isNullOrEmptyString($tournament->fightingAreas) && $tournament->level_id!=1)
                                    <span class="badge badge-success"><i class=" icon icon-checkmark2"></i></span>
                                @endif
                            </a></li>
                        <li><a href="/tournaments/{{$tournament->id}}/edit#place"><i class="icon-location4"></i> Lugar
                                @if(!isNullOrEmptyString($tournament->venue) && $tournament->latitude!=0 && $tournament->longitude!=0)
                                    <span class="badge badge-success"><i class=" icon icon-checkmark2"></i></span>
                                @endif
                            </a></li>
                        <li><a href="/tournaments/{{$tournament->id}}/categories"><i class="icon-cog2"></i>{{trans_choice('crud.category',2)}}
                                <?php
                                    $settingSize = sizeof($tournament->settings($tournament->id));
                                    $categorySize = sizeof($tournament->categories);
                                    if ($settingSize > 0 && $settingSize == $categorySize)
                                        $class="badge-success";
                                    else
                                        $class="badge-warning";
                                    ?>
                                <span class="badge {!! $class !!}">
                                {{ $settingSize  }} / {{$categorySize}}</span>
                            </a></li>

                        <li><a href="/tournaments/{{$tournament->id}}/users"><i class="icon-users"></i>
                                {{trans_choice("crud.competitor",2)}}
                                @if((sizeof($tournament->competitors()))>8)
                                    <span class="badge badge-success">{{sizeof($tournament->competitors())}}</span>
                                @endif

                            </a>
                        <li><a href="#"><i class="icon-certificate"></i>{{ trans('crud.certificates') }}</a>
                        <li><a href="#"><i class="icon-user-lock"></i>{{ trans('crud.acredit') }}</a>
                        <li><a href="#"><i class="icon-feed"></i>{{ trans('crud.broadcast') }}</a>
                        <li><a href="#"><i class="icon-share"></i>{{ trans('crud.publish') }}</a>

                        </li>
                        {{--<li><a href="#"><i class="icon-portfolio"></i> Link with label <span--}}
                        {{--class="label bg-success-400">Online</span></a></li>--}}
                        {{--<li class="navigation-divider"></li>--}}

                    </ul>
                </div>
            </div>
            <!-- /sub navigation -->


        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <p><a href="/invites/{{$tournament->id}}" type="button" class="btn btn-primary btn-labeled btn-xlg"
                  style="width: 100%;"><b><i class="icon-envelope"></i></b>{{ trans('crud.invite_competitors') }}</a></p>

        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <p><a href="{!!   URL::action('TournamentController@generateTrees',
                                                    ['tournamentId'=>$tournament->id]) !!}" type="button" class="btn btn-warning btn-labeled btn-xlg"
                  style="width: 100%;"><b><i class="icon-tree7"></i></b>{{ trans('crud.generate_trees') }}</a></p>

        </div>

    </div>
    <br/>

<?php
//    $competitors = $tournament->competitors()->orderby('pivot_created_at')->take(5)->get();
//    ?>
    {{--@if (sizeof($competitors)>0)--}}

        {{--<div class="sidebar sidebar-default">--}}

            {{--<div class="sidebar-content">--}}


                {{--<!-- Sub navigation -->--}}
                {{--<div class="sidebar-category">--}}
                    {{--<div class="category-title">--}}
                        {{--<span>{{ Lang::get("crud.latest_competitors") }}</span>--}}
                        {{--<ul class="icons-list">--}}
                            {{--<li><a href="#" data-action="collapse"></a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}


                    {{--<div class="category-content no-padding">--}}
                        {{--<ul class="navigation navigation-alt navigation-accordion">--}}
                            {{--@foreach($competitors as $competitor)--}}
                                {{--<li><a href="/users/{{$competitor->id}}"><i class="icon-user"></i>{{$competitor->name}}--}}
                                    {{--</a>--}}
                            {{--@endforeach--}}

                        {{--</ul>--}}
                    {{--</div>--}}

                {{--</div>--}}

                {{--<!-- /sub navigation -->--}}


            {{--</div>--}}
        {{--</div>--}}
    {{--@endif--}}
</div>
<!-- /detached sidebar -->