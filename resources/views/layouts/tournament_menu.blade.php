<!-- Detached sidebar -->
<div class="sidebar-detached">
    <div class="row">
        <div class="col-md-12">
            <p><a href="/invite/{{$tournament->id}}" type="button" class="btn btn-primary btn-labeled btn-xlg" style="width: 100%;"><b><i class="icon-envelope"></i></b>Invita competidores</a></p>

        </div>
    </div>
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
                        <li class="navigation-header"></li>
                        <li><a href="#"><i class="icon-trophy2"></i> General
                                @if(!isNullOrEmptyString($tournament->registerDateLimit) && !isNullOrEmptyString($tournament->fightingAreas) && $tournament->level_id!=1)
                                    <span class="badge badge-success"><i class=" icon icon-checkmark2"></i></span>
                                @endif
                            </a></li>
                        <li><a href="/tournaments/{{$tournament->id}}/edit#place"><i class="icon-location4"></i> Lugar
                                @if(!isNullOrEmptyString($tournament->venue) && $tournament->latitude!=0 && $tournament->longitude!=0)
                                    <span class="badge badge-success"><i class=" icon icon-checkmark2"></i></span>
                                @endif
                            </a></li>
                        <li><a href="/tournaments/{{$tournament->id}}/edit#categories"><i class="icon-cog2"></i>{{trans_choice('crud.category',2)}}</a></li>
                        <!-- badge-flat border-success text-success-600-->
                        <li><a href="/tournaments/{{$tournament->id}}/users"><i class="icon-users"></i>{{Lang::get("crud.see_competitors")}}</a>
                        <li><a href="#"><i class="icon-certificate"></i>Certificados</a>
                        <li><a href="#"><i class="icon-user-lock"></i>Acreditación</a>
                        <li><a href="#"><i class="icon-feed"></i>Transmisión</a>
                        <li><a href="#"><i class="icon-share"></i>Publicar</a>

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
    <div class="sidebar sidebar-default">

        <div class="sidebar-content">

            {{--Get the last 10 user registration--}}
            <?php
//                    $latestUsers = $tournament->competitors->orderBy('created_at', 'desc')->take(10);
//                    dd($latestUsers);

                    ?>

            <!-- Sub navigation -->
            <div class="sidebar-category">
                <div class="category-title">
                    <span>{{ Lang::get("crud.latest_competitors") }}</span>
                    <ul class="icons-list">
                        <li><a href="#" data-action="collapse"></a></li>
                    </ul>
                </div>

                <div class="category-content no-padding">
                    <ul class="navigation navigation-alt navigation-accordion">


                        <li><a href="/tournaments/{{$tournament->id}}/edit#categories"><i class="icon-cog2"></i>{{trans_choice('crud.category',2)}}</a></li>
                        <!-- badge-flat border-success text-success-600-->
                        <li><a href="/tournaments/{{$tournament->id}}/users"><i class="icon-users"></i>{{Lang::get("crud.see_competitors")}}</a>

                    </ul>
                </div>
            </div>
            <!-- /sub navigation -->


        </div>
    </div>
</div>
<!-- /detached sidebar -->