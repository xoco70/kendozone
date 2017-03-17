
<table class="table table-togglable table-hover">
    <thead>
    <tr>

        <th data-toggle="true">{{ trans_choice('core.name',1) }}</th>
        <th data-hide="phone">{{ trans_choice('categories.category',1) }}</th>
        <th data-hide="phone">{{ trans('core.action') }}</th>

    </tr>
    </thead>
    @foreach($teams as $team)
        <tr>
            <td>
                @if (Auth::user()->can('edit', [App\Team::class, $tournament]))
                    <a href="{!!   URL::action('TeamController@edit',  ['tournament' => $tournament->slug, 'teams' => $team->id]) !!}">{{ $team->name }}</a>
                @else
                    {{ $team->name }}
                @endif
            </td>
            <td>{{ $team->championship->settings->alias!=""
                                    ? $team->championship->settings->alias
                                    : trim($team->championship->buildName())}}</td>
            <td>

                @can('edit', [App\Team::class, $tournament])
                    <a href="{{URL::action('TeamController@edit', ['tournament' => $tournament->slug, 'teams' => $team->id])}}"><i
                                class="icon icon-pencil7"></i></a>

                @endcan
                @can('delete', [App\Team::class, $tournament])
                    {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteTeam', 'action' => ['TeamController@destroy', $tournament->slug,$team->id], 'style'=>"display: inline-block"]) !!}
                    {!! Form::button( '<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit','class' => 'btn text-warning-600 btn-flat btnDeleteTeam', 'id'=>'delete_'.$team->id, 'data-id' => $team->id ] ) !!}
                    {!! Form::close() !!}
                @endcan
            </td>

        </tr>

    @endforeach


</table>