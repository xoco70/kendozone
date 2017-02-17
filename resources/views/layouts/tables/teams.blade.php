<table class="table datatable-responsive" id="table{{ $championship->id }}">
    <thead>
    <tr>
        <th class="all">{{ trans('core.name') }}</th>
        <th align="center" class="phone">{{ trans_choice('categories.category',1) }}</th>
        <th align="center" class="phone">{{ trans('core.paid') }}</th>
        @can('edit',$tournament)
            <th class="all">{{ trans('core.action') }}</th>
        @endcan
    </tr>
    </thead>


    @foreach($championship->teams as $team)
        <tr>
            <td>
                {{ $team->name }}

            </td>
            <td class="text-center">{{ $championship->category->buildName()}}</td>

            <td class="text-center">

                <?php $class = "glyphicon glyphicon-ok-sign text-success";?>


                {{--@can('edit',$tournament)--}}
                    {{--{!! Form::open(['method' => 'PUT', 'id' => 'formConfirmTCU',--}}
                    {{--'action' => ['CompetitorController@confirmUser', $tournament->slug, $championship->id,$team->id  ]]) !!}--}}


                    {{--<button type="submit"--}}
                            {{--class="btn btn-flat btnConfirmTCU"--}}
                            {{--id="confirm_{!! $tournament->slug !!}_{!! $championship->id !!}_{!! $team->id !!}"--}}
                            {{--data-tournament="{!! $tournament->slug !!}"--}}
                            {{--data-category="{!! $championship->id !!}"--}}
                            {{--data-team="{!! $team->id !!}">--}}
                        {{--<i class="{!! $class  !!} "></i>--}}
                    {{--</button>--}}
                    {{--{!! Form::close() !!}--}}
                {{--@else--}}
                    {{--<i class="{!! $class  !!} "></i>--}}


                {{--@endcan--}}


            </td>

            @can('edit',$tournament)
                <td class="text-center">

                    {{--@can('delete', [App\Team::class, $tournament])--}}
                        {{--{!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteTeam', 'action' => ['TeamController@destroy', $tournament->slug,$team->id], 'style'=>"display: inline-block"]) !!}--}}
                        {{--{!! Form::button( '<i class="glyphicon glyphicon-remove"></i>', ['type' => 'submit','class' => 'btn text-warning-600 btn-flat btnDeleteTeam', 'id'=>'delete_'.$team->id, 'data-id' => $team->id ] ) !!}--}}
                        {{--{!! Form::close() !!}--}}
                    {{--@endcan--}}
                </td>
            @endcan
        </tr>

    @endforeach

</table>