<div class="col-lg-8 col-lg-offset-2">
    @foreach($tournament->championships as $championship)
        <div class="panel panel-flat">

            <div class="panel-body">

                <div class="container-fluid">
                    <a name="{{ str_slug($championship->buildName(), "-") }}">
                        <legend class="text-semibold">{{ $championship->buildName() }} </legend>

                    </a>

                    <table class="table datatable-responsive" id="table{{ $championship->id }}">
                        <thead>
                        <tr>
                            <th class="min-tablet text-center "
                                data-hide="phone">{{ trans('core.avatar') }}</th>
                            <th class="all">{{ trans('core.username') }}</th>
                            <th class="phone">{{ trans('core.email') }}</th>
                            <th class="phone">{{ trans('core.country') }}</th>
                            <th></th>
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

                                <td class="text-center"><img src="/images/flags/{{ $country->flag }}"
                                                             alt="{{ $country->name }}"/></td>

                            </tr>

                        @endforeach

                    </table>
                    <br/>


                </div>
                <br/><br/>

            </div>

        </div>
    @endforeach
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="container-fluid">


                <fieldset title="{{trans_choice('core.team',2)}}">
                    <a name="teams">
                        <legend class="text-semibold">{{trans_choice('core.team',2)}}</legend>
                    </a>
                </fieldset>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ trans('core.registered_team') }}
                        {{ $teams }}


                    </div>
                </div>


            </div>
        </div>
    </div>
</div>