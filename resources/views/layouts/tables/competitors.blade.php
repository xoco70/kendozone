<table class="table datatable-responsive" id="table{{ $championship->id }}">
    <thead>
    <tr>
        <th class="min-tablet text-center "
            data-hide="phone">{{ trans('core.avatar') }}</th>
        <th class="all">{{ trans('core.username') }}</th>
        <th class="phone">{{ trans('core.email') }}</th>
        <th align="center" class="phone">{{ trans_choice('categories.category',1) }}</th>
        <th align="center" class="phone">{{ trans('core.paid') }}</th>
        <th class="phone">{{ trans('core.country') }}</th>
        @can('edit',$tournament)
            <th class="all">{{ trans('core.action') }}</th>
        @endcan
    </tr>
    </thead>


    @foreach($championship->users as $user)
        <?php
        $arr_country = $countries->where('id', $user->country_id)->all();
        $country = array_first($arr_country, null);
        ?>
        <tr>
            <td class="text-center">
                <a href="{!!   URL::action('UserController@show',  $user->slug) !!}">
                    <img src="/images/avatar/avatar.png" class="img-circle img-sm"/></a>
            </td>
            <td>
                @can('edit',$user)
                    <a href="{!!   URL::action('UserController@edit',  ['users'=>$user->slug] ) !!}">{{ $user->name }}</a>
                @else
                    <a href="{!!   URL::action('UserController@show',  ['users'=>$user->slug] ) !!}">{{ $user->name }}</a>
                @endcan


            </td>
            <td>{{ $user->email }}</td>
            <td class="text-center">{{ $championship->buildName()}}</td>

            <td class="text-center">
                @if ($user->pivot->confirmed)
                    <?php $class = "glyphicon glyphicon-ok-sign text-success";?>
                @else
                    <?php $class = "glyphicon glyphicon-remove-sign text-danger ";?>
                @endif

                @can('edit',$tournament)
                    {!! Form::open(['method' => 'PUT', 'id' => 'formConfirmTCU',
                'action' => ['CompetitorController@confirmUser', $tournament->slug, $championship->id,$user->slug  ]]) !!}


                    <button type="submit"
                            class="btn btn-flat btnConfirmTCU"
                            id="confirm_{!! $tournament->slug !!}_{!! $championship->id !!}_{!! $user->slug !!}"
                            data-tournament="{!! $tournament->slug !!}"
                            data-category="{!! $championship->id !!}"
                            data-user="{!! $user->slug !!}">
                        <i class="{!! $class  !!} "></i>
                    </button>
                    {!! Form::close() !!}
                @else
                    <i class="{!! $class  !!} "></i>


                @endcan


            </td>


            <td class="text-center"><img src="/images/flags/{{ $country->flag }}"
                                         alt="{{ $country->name }}"/></td>

            @can('edit',$tournament)
                <td class="text-center">

                    {!! Form::model(null, ['method' => 'DELETE', 'id' => 'formDeleteTCU',
                 'action' => ['CompetitorController@deleteUser', $tournament->slug, $championship->id,$user->slug  ]]) !!}

                    <button type="submit"
                            class="btn text-warning-600 btn-flat btnDeleteTCU"
                            id="delete_{!! $tournament->slug !!}_{!! $championship->id !!}_{!! $user->slug !!}"
                            data-tournament="{!! $tournament->slug !!}"
                            data-category="{!! $championship->id !!}"
                            data-user="{!! $user->slug !!}">
                        <i class="glyphicon glyphicon-remove"></i>
                    </button>
                    {!! Form::close() !!}
                </td>
            @endcan
        </tr>

    @endforeach

</table>