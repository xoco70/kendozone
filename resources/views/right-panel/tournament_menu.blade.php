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
                        <li><a href="#"><i class="icon-trophy2"></i> {{ trans('core.general') }}
                                @if(!isNullOrEmptyString($tournament->registerDateLimit) && !isNullOrEmptyString($tournament->fightingAreas) && $tournament->level_id!=1)
                                    <span class="badge badge-success"><i class=" icon icon-checkmark2"></i></span>
                                @endif
                            </a></li>
                        <li><a href="#"><i
                                        class="icon-location4"></i> Lugar

                                <span class="badge badge-success" id="venue-status"><i
                                            class=" icon icon-checkmark2"></i></span>
                            </a></li>
                        <li><a href="#">
                                <i class="icon-cog2"></i>{{trans_choice('categories.category',2)}}
                                <?php
                                if ($settingSize > 0 && $settingSize == $categorySize)
                                    $class = "badge-success";
                                else
                                    $class = "badge-primary";
                                ?>
                                <div class="badge {!! $class !!}" id="categories-status">
                                    <span class="category-size">{{ $settingSize  }}</span> / {{ $categorySize }}
                                </div>
                            </a></li>


                        <li><a href="{{ URL::action('TournamentUserController@index',$tournament->slug) }}"><i
                                        class="icon-users"></i>
                                {{trans_choice("core.competitor",2)}}
                                @if($numCompetitors>8)
                                    <span class="badge badge-success">{{$numCompetitors }}</span>
                                @else
                                    <span class="badge badge-primary">{{$numCompetitors}}</span>
                                @endif

                            </a>
                        </li>
                        <li ><a href="{{ URL::action('TeamController@index',$tournament->slug) }}"><i class="icon-collaboration"></i>{{ trans_choice('core.team',2) }}
                                @if($numTeams>2)
                                    <span class="badge badge-success">{{$numTeams }}</span>
                                @else
                                    <span class="badge badge-primary">{{$numTeams}}</span>
                                @endif
                            </a></li>
                        <li class="disabled"><a href="#"><i class="icon-certificate"></i>{{ trans('core.certificates') }}</a></li>
                        <li class="disabled"><a href="#"><i class="icon-user-lock"></i>{{ trans('core.acredit') }}</a></li>
                        <li class="disabled"><a href="#"><i class="icon-feed"></i>{{ trans('core.broadcast') }}</a></li>
                        <li class="disabled"><a href="#"><i class="icon-share"></i>{{ trans('core.publish') }}</a></li>




                    </ul>
                </div>
            </div>
            <!-- /sub navigation -->


        </div>
    </div>
    <br/>
    @if ($tournament->isOpen())

    <div class="sidebar-category">
        <div class="category-title">
            <span>{{ trans('core.share_link') }}</span>
            <ul class="icons-list">
                <li><a href="#" data-action="collapse"></a></li>
            </ul>
        </div>

        <div class="category-content no-padding">
            <input value="{{ URL::action('TournamentController@register',$tournament->slug) }}" class="p-10 full-width" >
        </div>
    </div>
    <br/>
    @endif
    {{-- If open Tournament--}}


    @can('edit',$tournament)
        <div class="row">
            <div class="col-md-12">
                <p><a href="{!!   URL::action('InviteController@create',  $tournament->slug) !!}" type="button"
                      class="btn btn-primary btn-labeled btn-xlg" style="width: 100%"><b><i
                                    class="icon-envelope"></i></b>{{ trans('core.invite_competitors') }}
                    </a>
                </p>

            </div>
        </div>
    @endcan
    <br/>

</div>
<?php
$link = "";
$id = "";
if ($settingSize > 0 && $settingSize == $categorySize) {
    $link = URL::action('TournamentController@generateTrees', ['tournamentId' => $tournament->slug]);
    $id = "";
} else {
    // For showing Modal
    $link = "#";
    $id = 'id="generate_tree"';
}


?>

{{--@if (Auth::user()->canEditTournament($tournament))--}}
{{--<div class="row">--}}
{{--<div class="col-md-12">--}}
{{--<p><a href="{!!  $link  !!}" {!! $id !!} type="button" class="btn bg-teal btn-labeled btn-xlg"--}}
{{--style="width: 100%;"><b><i class="icon-tree7"></i></b>{{ trans('core.generate_trees') }}</a></p>--}}

{{--</div>--}}

{{--</div>--}}
{{--<br/>--}}
{{--@endif--}}

<!-- /detached sidebar -->