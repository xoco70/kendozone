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
                        <li class="navigation-header">¡Proximos pasos!</li>
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
                        <li><a href="/tournaments/{{$tournament->id}}/edit#categories"><i class="icon-cog2"></i>Categorías</a></li>
                        <!-- badge-flat border-success text-success-600-->
                        <li><a href="/invite/{{$tournament->id}}"><i class="icon-user-plus"></i>Invitar usuarios</a>
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
</div>
<!-- /detached sidebar -->