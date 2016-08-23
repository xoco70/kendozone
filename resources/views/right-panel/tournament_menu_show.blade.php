<?php
$competitors = $tournament->competitors();
$numCompetitors = $competitors->count();
?>

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
                        <li><a href="#"><i class="icon-trophy2"></i> {{ trans('core.general') }}</a></li>



                        <li><a href="{{ URL::action('CompetitorController@index',$tournament->slug) }}"><i class="icon-users"></i>
                                {{trans_choice("core.competitor",2)}}

                            @if(($numCompetitors)>8)
                                    <span class="badge badge-success">{{$numCompetitors}}</span>
                                @else
                                    <span class="badge badge-warning">{{$numCompetitors}}</span>
                                @endif

                            </a>
                        </li>
                        <li><a href="#teams"><i class="icon-people"></i>{{ trans_choice('core.team',2) }}</a></li>
                        {{--<li class="disabled"><a href="#"><i--}}
                                        {{--class="icon-certificate"></i>{{ trans('core.certificates') }}</a>--}}
                        {{--<li class="disabled"><a href="#"><i class="icon-user-lock"></i>{{ trans('core.acredit') }}</a>--}}
                        <li class="disabled"><a href="#"><i class="icon-feed"></i>{{ trans('core.broadcast') }}</a></li>
                        <li class="disabled"><a href="#"><i class="icon-share"></i>{{ trans('core.publish') }}</a></li>
                    </ul>
                </div>
            </div>
            <!-- /sub navigation -->
        </div>
    </div>
</div>
<!-- /detached sidebar -->