<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-lg-8 col-lg-offset-2">
            <div class="panel panel-flat">

                <div class="panel-body">
                    <div class="container-fluid">

                        @if (sizeof($tournaments) == 0)

                            @if ($title == trans('core.tournaments_registered'))
                                <?php
                                $noItemYet = trans('core.no_tournament_registered_yet');
                                $link = '#';
                                $linkLabel = trans('core.create_new_tournament');
                                $printLink = false;
                                ?>

                            @elseif ($title == trans('core.tournaments_created'))
                                <?php
                                $noItemYet = trans('core.no_tournament_created_yet');
                                $link = URL::action('TournamentController@create');
                                $linkLabel = trans('core.create_new_tournament');
                                $printLink = true;
                                ?>

                            @elseif ($title == trans('core.tournaments_deleted'))
                                <?php
                                $noItemYet = trans('core.no_tournament_deleted_yet');
                                $link = '#'; //URL::action('TournamentController@joinOpenTournament') ;
                                $linkLabel = trans('core.join_tournament');
                                $printLink = false;
                                ?>
                            @endif


                            <fieldset title="{{ $title }}">
                                <legend class="text-semibold">{{ $title }}</legend>
                            </fieldset>

                            <div class="mt-20 mb-20 pt-20 pb-20 text-center">{{ $noItemYet }}</div>
                            @if ($printLink == true)

                                <div align="center">
                                    <a href="{!! $link !!}" type="button"
                                       class="btn btn-primary text-uppercase p-10  ">{{ $linkLabel }}
                                    </a>
                                </div>

                            @endif




                        @else
                            <table class="table table-togglable table-hover">
                                <thead>
                                <tr>
                                    <th data-toggle="true">{{ trans('core.name') }}</th>
                                    <th data-hide="phone">{{ trans('core.date') }}</th>
                                    <th data-hide="phone">{{ trans('core.owner') }}</th>
                                    @if ($title == trans('core.tournaments_created') || $title == trans('core.tournaments_deleted') )
                                        <th class="text-center">{{ trans('core.action') }}</th>
                                    @endif
                                </tr>
                                </thead>
                                @foreach($tournaments as $tournament)
                                    <tr id="{!! $tournament->slug !!}">
                                        <td>
                                            @if (Auth::user()->canEditTournament($tournament))
                                                <a href="{!!   URL::action('TournamentController@edit',  $tournament->slug) !!}">{{ $tournament->name }}</a>
                                            @else
                                                <a href="{!!   URL::action('TournamentController@show',  $tournament->slug) !!}">{{ $tournament->name }}</a>
                                            @endif
                                        </td>
                                        <td>{{ $tournament->dateIni }}</td>
                                        <td>{{ $tournament->owner->name}}</td>
                                        <td class="text-center">
                                            @if ($title == trans('core.tournaments_created'))
                                                {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteTournament', 'action' => ['TournamentController@destroy', $tournament->slug]]) !!}
                                                {!! Form::button( '<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit','class' => 'btn text-warning-600 btn-flat btnDeleteTournament', 'id'=>'delete_'.$tournament->slug, 'data-id' => $tournament->slug ] ) !!}
                                                {!! Form::close() !!}
                                            @elseif ($title ==  trans('core.tournaments_deleted'))
                                                <a href="{!!   URL::action('TournamentController@restore',  $tournament->slug) !!}">
                                                    <i class="icon-undo2 text-success undo"></i>
                                                </a>

                                            @endif
                                        </td>
                                    </tr>

                                @endforeach

                            </table>
                            <div class="text-center">{!! $tournaments->render() !!}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>