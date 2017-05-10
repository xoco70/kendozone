<div class="container-fluid">
    <div class="row text-center">
        <div class="col-xs-12 col-lg-10 col-lg-offset-1">

            @if (sizeof($tournaments) == 0)
                <br/><br/><br/><br/><br/><br/>
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
                    $link = '#';
                    $linkLabel = trans('core.join_tournament');
                    $printLink = false;
                    ?>
                @endif

                <h1 class="no-margin text-semibold">{{ $title }}</h1>
                <p class="text-muted text-size-large">{{ $noItemYet }}</p>
                <br/>

                @if ($printLink == true)

                    <div align="center" class="mt-20 pt-20">
                        <a href="{!! $link !!}" type="button"
                           class="btn btn-primary text-uppercase p-10  ">{{ $linkLabel }}
                        </a>
                    </div>

                @endif
            @else
                <table class="table table-togglable table-hover">
                    <thead>
                    <tr>
                        <th data-toggle="true" class="text-center">{{ trans('core.name') }}</th>
                        <th data-hide="phone" class="text-center">{{ trans('core.date') }}</th>
                        <th data-hide="phone" class="text-center">{{ trans_choice('core.competitor',2) }}</th>
{{--                        <th data-hide="phone" class="text-center">{{ trans_choice('core.tree',2) }}</th>--}}
                        <th data-hide="phone" class="text-center">{{ trans('core.owner') }}</th>
                        @if ($title == trans('core.tournaments_created') || $title == trans('core.tournaments_deleted') )
                            <th class="text-center">{{ trans('core.action') }}</th>
                        @endif
                    </tr>
                    </thead>
                    @foreach($tournaments as $tournament)
                        <tr id="{!! $tournament->slug !!}">
                            <td>
                                @if (!$tournament->isDeleted())
                                    @can('edit',$tournament)

                                        <a href="{!!   URL::action('TournamentController@edit',  $tournament->slug) !!}">{{ $tournament->name }}</a>
                                    @else
                                        <a href="{!!   URL::action('TournamentController@show',  $tournament->slug) !!}">{{ $tournament->name }}</a>
                                    @endcan
                                @else
                                    {{ $tournament->name }}
                                @endif
                            </td>
                            <td>{{ $tournament->dateIni }}</td>
                            <td>{{ $tournament->competitors_count }}</td>
{{--                            <td>{{ $tournament->unique_trees_count }}</td>--}}
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
