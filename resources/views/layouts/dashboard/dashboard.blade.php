<div class="row">
    <div class="col-md-6">
        <div class="row ml-5 mr-10">
            <div class="panel panel-body">
                <fieldset title="{{Lang::get('crud.venue')}}">
                    <legend class="text-semibold">TORNEOS CREADOS</legend>
                </fieldset>


                <table width="100%">


                    @foreach(Auth::user()->tournaments->sortByDesc('created_at')->take(3) as $tournament)
                        <tr class="dashboard-table">
                            <td width="80%">{{$tournament->name}}</td>
                            <td width="20%" align="right"><a class="btn text-success border-success border-4 pl-20 pr-20 "
                                                             href="{!! URL::action('TournamentController@edit', $tournament->slug) !!}">VER</a>
                            </td>
                        </tr>

                    @endforeach
                </table>
                <div align="right" class="mt-20 pt-20">
                    <a class="btn text-primary border-primary border-4 text-uppercase "
                       href="{!! URL::to('tournaments')!!}">{{trans('core.see_all')}}</a>
                </div>

            </div>
        </div>
        <div class="row ml-5 mr-10">
            <div class="panel panel-body">
                <fieldset title="MIS TORNEOS">
                    <legend class="text-semibold">MIS TORNEOS</legend>
                </fieldset>


                <table width="100%">


                    @foreach(Auth::user()->tournaments->sortByDesc('created_at')->take(3) as $tournament)
                        <tr class="dashboard-table" height="100px" valign="middle">
                            <td width="80%">{{$tournament->name}}</td>
                            <td width="20%" align="right"><a class="btn text-success border-success border-4 pl-20 pr-20 "
                                                             href="{!! URL::action('TournamentController@edit', $tournament->slug) !!}">VER</a>
                            </td>
                        </tr>

                    @endforeach
                </table>
                <div align="right" class="mt-20 pt-20">
                    <a class="btn text-primary border-primary border-4 text-uppercase "
                       href="{!! URL::action('TournamentController@edit', $tournament->slug) !!}">{{trans('core.see_all')}}</a>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="panel panel-body">
                <fieldset title="NUMEROS">
                    <legend class="text-semibold">NUMEROS</legend>
                </fieldset>
                <div class="row">
                    <div class="col-lg-6">

                        <div class="square bg-nav">{{ Auth::user()->tournaments()->count() }}
                            <div class="text-size-large text-uppercase">creados</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="square bg-secondary">2
                            <div class="text-size-large text-uppercase">Invitaciones</div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="square bg-primary">{{ Auth::user()->tournaments()->where('dateFin','<', new \DateTime('today'))->count() }}
                            <div class="text-size-large text-uppercase">Pasados</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="square bg-success">{{ Auth::user()->tournaments()->where('dateFin','>=', new \DateTime('today'))->count() }}
                            <div class="text-size-large text-uppercase">Próximos</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="row">
            <div class="panel panel-body">

                <fieldset title="ULTIMOS MENSAJES">
                    <legend class="text-semibold">ULTIMAS NOTIFICACIONES</legend>
                </fieldset>


                <ul class="media-list">
                    <li class="media">
                        <div class="media-left">
                            <img src="/images/demo/users/face10.jpg" class="img-circle img-xs" alt="">
                            {{--<span class="badge bg-danger-400 media-badge">8</span>--}}
                        </div>

                        <div class="media-body">
                            <a href="index.html#">
                                Jesus Maya
                                <span class="media-annotation pull-right">14:58</span>
                            </a>

                            <span class="display-block text-muted">Practica en Amecameca mañana... 4 horas de geiko para que se les quite lo p...</span>
                        </div>
                    </li>

                    <li class="media">
                        <div class="media-left">
                            <img src="/images/demo/users/face3.jpg" class="img-circle img-xs" alt="">
                        </div>

                        <div class="media-body">
                            <a href="index.html#">
                                FMK
                                <span class="media-annotation pull-right">12:16</span>
                            </a>

                            <span class="display-block text-muted">¡Examen de Iaido! No se apendejen!!!</span>
                        </div>
                    </li>

                    
                </ul>

                <div align="right" class="pt-20">
                    <a class="btn text-primary border-primary border-4 text-uppercase "
                       href="{!! URL::action('TournamentController@edit', $tournament->slug) !!}">{{trans('core.see_all')}}</a>
                </div>

            </div>
        </div>
    </div>

</div>