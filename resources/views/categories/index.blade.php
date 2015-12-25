@extends('layouts.dashboard')

@section('content')

    <div class="container">
        <div class="row col-md-10 custyle">
            <table class="table table-striped custab">
                <thead>
                <span class="pull-right">
                                    <a href="{!!   URL::action('CategorySettingsController@create') !!}"
                                       class="btn btn-primary btn-xs "><b>+</b> @lang('crud.addModel', ['currentModelName' => $currentModelName])
                                    </a>

                </span>


                <tr>
                    <th>ID</th>
                    <th class="text-center">{{ trans('crud.name') }}</th>
                    <th class="text-center">{{ trans('crud.team') }}</th>
                    <th class="text-center">{{ trans('crud.fightDuration') }}</th>
                    <th class="text-center">{{ trans('crud.hasRoundRobin') }}</th>
                    <th class="text-center">{{ trans('crud.hasEncho') }}</th>
                    <th class="text-center">{{ trans('crud.hasHantei') }}</th>
                    <th class="text-center">{{ trans('crud.action') }}</th>
                </tr>
                </thead>
                @foreach($categories as $category)
                    @if ($category->settings !=null)

                        <tr>
                            <td>
                                <a href="{!!   URL::action('CategorySettingsController@edit',  $category->id) !!}">{{ $category->id }}</a>
                            </td>
                            <td>
                                <a href="{!!   URL::action('CategorySettingsController@edit',  $category->id) !!}">{{ $category->name }}</a>
                            </td>
                            <td>{{ $category->settings->isTeam }}</td>
                            <td>{{ $category->settings->fightDuration }}</td>
                            <td>{{ $category->settings->hasRoundRobin }}</td>
                            <td>{{ $category->settings->hasEncho }}</td>
                            <td>{{ $category->settings->hasHantei }}</td>

                            <td class="text-center">
                                <a class=" text-info "
                                   href="{!! URL::action('CategorySettingsController@edit',  $category->settings->id) !!}">
                                    <span class="glyphicon glyphicon-cog"></span></a>
                                <a class=" text-danger "
                                   href="{!! URL::action('CategorySettingsController@destroy',  $category->id) !!}"
                                   data-method="delete"
                                   data-token="{{csrf_token()}}">
                                    <span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>
                                <a href="{!!   URL::action('CategorySettingsController@edit',  $category->id) !!}">{{ $category->id }}</a>
                            </td>
                            <td>
                                <a href="{!!   URL::action('CategorySettingsController@edit',  $category->id) !!}">{{ $category->name }}</a>
                            </td>
                            <td align="center">{!!  $defaultSettings->isTeam == 1 ? '<span class=" text-info glyphicon glyphicon-ok"></span>' : '<span class=" text-info glyphicon glyphicon-remove"></span>'!!}</td>
                            <td align="center">{!!  $defaultSettings->fightDuration == 1 ? '<span class=" text-info glyphicon glyphicon-ok"></span>' : '<span class=" text-info glyphicon glyphicon-remove"></span>'!!}</td>
                            <td align="center">{!!  $defaultSettings->hasRoundRobin == 1 ? '<span class=" text-info glyphicon glyphicon-ok"></span>' : '<span class=" text-info glyphicon glyphicon-remove"></span>'!!}</td>
                            <td align="center">{!!  $defaultSettings->hasEncho == 1 ? '<span class=" text-info glyphicon glyphicon-ok"></span>' : '<span class=" text-info glyphicon glyphicon-remove"></span>'!!}</td>
                            <td align="center">{!!  $defaultSettings->hasHantei == 1 ? '<span class=" text-info glyphicon glyphicon-ok"></span>' : '<span class=" text-info glyphicon glyphicon-remove"></span>'!!}</td>

                            <td class="text-center">
                                <a class=" text-info "
                                   href="{!! URL::action('CategorySettingsController@create') !!}"><span
                                            class="glyphicon glyphicon-cog"></span></a>
                                <a class=" text-danger "
                                   href="{!! URL::action('CategorySettingsController@destroy',  $category->id) !!}"
                                   data-method="delete"
                                   data-token="{{csrf_token()}}">
                                    <span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                        </tr>
                    @endif
                @endforeach

            </table>
            <br/><br/>

        </div>

    </div>

@stop

