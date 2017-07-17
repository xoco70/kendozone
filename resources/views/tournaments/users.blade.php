@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('tournaments.users.index',$tournament) !!}
@stop
@section('content')
    <?php

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
                                   data-name="{!! $championship->buildName() !!}">
                                    <b> <i class="icon-plus22 mr-5"></i></b>
                                    @lang('core.addModel', ['currentModelName' => trans_choice('core.competitor',2)])
                                </a>


                                {!! Form::model(null, ['method' => 'POST', 'id' => 'storeTree', 'class' => 'pull-right',
'action' => ['TreeController@store', $championship->id]]) !!}

                                <button type="submit"
                                        class="btn bg-success btn-xs pull-right mr-10" id="generate">
                                    {{ trans_choice('core.generate_tree',1) }}

                                </button>
                                {!! Form::close() !!}
                                <br/><br/>
                            @endcan

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
                                        <td>{{ strpos($user->email, "@kendozone.com")!== false ? substr($user->email,-21) : $user->email }}</td>
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
                            <br/>


                        </div>
                        <br/><br/>

                    </div>

                </div>
            @endforeach
        </div>
    </div>

    @include("right-panel.users_menu")
    @include("modals.add_competitor")
@stop
@section("scripts_footer")
    {!! Html::script('js/pages/header/competitorIndex.js') !!}

{{--    {!! JsValidator::formRequest('App\Http\Requests\CompetitorRequest') !!}--}}
    <script>


        var url = "{{ URL::action('TournamentController@show',$tournament->slug) }}";

        $(document).on("click", ".open-modal", function () {
            championshipId = $(this).data('id');
            championshipName = $(this).data('name');

            newUserName = $('#newUsername');
            newUserEmail = $('#newUserEmail');

            $("#championshipId").val(championshipId);
        });

        $(document).ready(function () {
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment


                    $(wrapper).append('<div class="form-group"><div class="col-sm-3"><input type="text" name="firstnames[]" class="form-control" placeholder=\"{{ trans("core.firstname") }}\"/></div><div class="col-sm-3"><input type="text" name="lastnames[]" class="form-control" placeholder=\"{{ trans("core.lastname") }}\"/></div><div class="col-sm-3"><input type="text" name="emails[]" class="form-control" placeholder=\"{{ trans("core.email") }}\"/></div><div class="col-sm-1"><a href="#" class="remove_field" title=\"{{ trans("core.remove_competitor") }}\"><i class="glyphicon glyphicon-remove pt-10 m-3"></i></a></div></div>'); //add input box
                }
            });

            $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
                x--;
            })
        });
    </script>
@stop
