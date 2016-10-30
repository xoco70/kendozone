@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('tournaments.users.index',$tournament) !!}
@stop
@section('content')
    <?php
    //    $countries = Countries::all();
    //    $link = "";
    //    if ($settingSize > 0 && $settingSize == $categorySize)
    //        $link = URL::action('TournamentController@generateTrees', ['tournamentId' => $tournament->slug]);
    //    else
    //        // For showing Modal
    $link = route('workingonit');

    ?>
    <!-- Detached content -->
    <div class="container-detached">
        <div class="content-detached">
            @foreach($tournament->championships as $championship)
                <div class="panel panel-flat">

                    <div class="panel-body">

                        <div class="container-fluid">

                            @can('edit',$tournament)
                                <a href="#championshipId={{$championship->id}}" data-toggle="modal"
                                   data-target="#create_tournament_user"
                                   class="btn btn-primary btn-xs pull-right open-modal"
                                   data-id="{!! $championship->id !!}"
                                   data-name="{!! $championship->category->buildName($grades) !!}"><b><i
                                                class="icon-plus22 mr-5"></i></b> @lang('core.addModel', ['currentModelName' => trans_choice('core.competitor',1)])
                                </a>

                                {{--{!! Form::model(null, ['method' => 'POST', 'id' => 'storeTree',--}}
                                {{--'action' => ['PreliminaryTreeController@store', $championship->id]]) !!}--}}

                                {{--<button type="button" @click="loadButton()"--}}
                                {{--class="btn bg-teal btn-xs pull-right mr-10">--}}
                                {{--<i v-cloak v-show="loading" class="icon-spinner spinner mr-5"></i>Generate Trees--}}

                                {{--</button>--}}
                                {{--{!! Form::close() !!}--}}

                                @if (App::environment('production'))
                                    <a href="{{ route('workingonit') }}"
                                       data-target="#create_tournament_user"
                                       class="btn bg-teal btn-xs pull-right mr-10"><b>
                                            <i class="mr-5"></i>Generate Trees</b>
                                    </a>

                                @else
                                    {!! Form::model(null, ['method' => 'POST', 'id' => 'storeTree',
'action' => ['PreliminaryTreeController@store', $championship->id]]) !!}

                                    <button type="submit"
                                            class="btn bg-teal btn-xs pull-right mr-10">
                                        <i class="mr-5"></i>Generate Trees

                                    </button>


                                    {!! Form::close() !!}
                                @endif



                            @endcan

                            <a name="{{ str_slug($championship->category->buildName($grades), "-") }}">
                                <legend class="text-semibold">{{ $championship->category->buildName($grades) }} </legend>

                            </a>

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
                                        <td class="text-center">{{ $championship->category->buildName($grades)}}</td>

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
                            <br/>


                        </div>
                        <br/><br/>

                    </div>

                </div>
            @endforeach
        </div>
    </div>

    @include("right-panel.users_menu")
    @include("modals.add_tournament_user")
@stop
@section("scripts_footer")
    {!! Html::script('js/pages/header/competitorIndex.js') !!}
    {!! Html::script('js/loadingButton.js') !!}
    {{--{!! JsValidator::formRequest('App\Http\Requests\CompetitorRequest') !!} // Generate exception that I can't fix --}}
    <script>


        var url = "{{ URL::action('TournamentController@show',$tournament->slug) }}";

        $(document).on("click", ".open-modal", function () {
            championshipId = $(this).data('id');
            championshipName = $(this).data('name');

            newUserName = $('#newUsername');
            newUserEmail = $('#newUserEmail');

            $("#championshipId").val(championshipId);
        });


    </script>
@stop
