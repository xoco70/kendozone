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
                        <li><a href="#"><i class="icon-trophy2"></i> {{ trans('crud.general') }}</a></li>



                        <li><a href="/tournaments/{{$tournament->slug}}/users"><i class="icon-users"></i>
                                {{trans_choice("crud.competitor",2)}}
                                @if((sizeof($tournament->competitors()))>8)
                                    <span class="badge badge-success">{{sizeof($tournament->competitors())}}</span>
                                @else
                                    <span class="badge badge-warning">{{sizeof($tournament->competitors())}}</span>
                                @endif

                            </a>
                        <li class="disabled"><a href="#"><i
                                        class="icon-certificate"></i>{{ trans('crud.certificates') }}</a>
                        <li class="disabled"><a href="#"><i class="icon-user-lock"></i>{{ trans('crud.acredit') }}</a>
                        <li class="disabled"><a href="#"><i class="icon-feed"></i>{{ trans('crud.broadcast') }}</a>
                        <li class="disabled"><a href="#"><i class="icon-share"></i>{{ trans('crud.publish') }}</a>

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
            <p><a href="{!!   URL::action('InviteController@inviteUsers',  $tournament->slug) !!}" type="button" class="btn btn-primary btn-labeled btn-xlg"
                  style="width: 100%;"><b><i class="icon-envelope"></i></b>{{ trans('crud.invite_competitors') }}</a>
            </p>

        </div>
    </div>
    <br/>

    <br/>

    <?php
    //    $competitors = $tournament->competitors()->orderby('pivot_created_at')->take(5)->get();
    //    ?>
    {{--@if (sizeof($competitors)>0)--}}

    {{--
    <div class="sidebar sidebar-default">--}}

        {{--
        <div class="sidebar-content">--}}


            {{--<!-- Sub navigation -->--}}
            {{--
            <div class="sidebar-category">--}}
                {{--
                <div class="category-title">--}}
                    {{--<span>{{ Lang::get("crud.latest_competitors") }}</span>--}}
                    {{--
                    <ul class="icons-list">--}}
                        {{--
                        <li><a href="#" data-action="collapse"></a></li>
                        --}}
                        {{--
                    </ul>
                    --}}
                    {{--
                </div>
                --}}


                {{--
                <div class="category-content no-padding">--}}
                    {{--
                    <ul class="navigation navigation-alt navigation-accordion">--}}
                        {{--@foreach($competitors as $competitor)--}}
                        {{--
                        <li><a href="/users/{{$competitor->id}}"><i class="icon-user"></i>{{$competitor->name}}--}}
                                {{--</a>--}}
                            {{--@endforeach--}}

                            {{--
                    </ul>
                    --}}
                    {{--
                </div>
                --}}

                {{--
            </div>
            --}}

            {{--<!-- /sub navigation -->--}}


            {{--
        </div>
        --}}
        {{--
    </div>
    --}}
    {{--@endif--}}
</div>
<!-- /detached sidebar -->