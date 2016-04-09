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



                        <li><a href="{{ URL::action('TournamentUserController@index',$tournament->slug) }}"><i class="icon-users"></i>
                                {{trans_choice("core.competitor",2)}}

                            @if(($numCompetitors)>8)
                                    <span class="badge badge-success">{{$numCompetitors}}</span>
                                @else
                                    <span class="badge badge-warning">{{$numCompetitors}}</span>
                                @endif

                            </a>
                        <li class="disabled"><a href="#"><i
                                        class="icon-certificate"></i>{{ trans('core.certificates') }}</a>
                        <li class="disabled"><a href="#"><i class="icon-user-lock"></i>{{ trans('core.acredit') }}</a>
                        <li class="disabled"><a href="#"><i class="icon-feed"></i>{{ trans('core.broadcast') }}</a>
                        <li class="disabled"><a href="#"><i class="icon-share"></i>{{ trans('core.publish') }}</a>

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
            @if ( $tournament->isOpen() || Auth::user()->isSuperAdmin())
                <p><a href="{!!   URL::action('InviteController@inviteUsers',  $tournament->slug) !!}" type="button" class="btn btn-primary btn-labeled btn-xlg"
                      style="width: 100%;"><b><i class="icon-envelope"></i></b>{{ trans('core.invite_competitors') }}</a>
                </p>
            @endif

        </div>
    </div>

</div>
<!-- /detached sidebar -->