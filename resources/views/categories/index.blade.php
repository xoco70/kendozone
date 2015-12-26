@extends('layouts.dashboard')

@section('content')
    <?php
    $ok = '<span class=" text-success glyphicon glyphicon-ok"></span>';
    $nok = '<span class=" text-warning glyphicon glyphicon-remove"></span>';
    ?>


    <div class="container">
        <div class="row col-md-10 custyle">
            <table class="table table-striped custab">
                <thead>


                <tr>
                    <th>ID</th>
                    <th class="text-center">{{ trans('crud.name') }}</th>
                    <th class="text-center">{{ trans('core.isTeam') }}</th>
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
                                <a href="{!!   URL::action('CategorySettingsController@edit',
                                   ['tournamentId'=> $category->pivot->tournament_id,
                                    'categoryId' => $category->id,
                                    'settings' => $category->settings->id
                                    ]) !!}">
                                    {{ $category->id }}</a>
                            </td>
                            <td>
                                <a href="{!!   URL::action('CategorySettingsController@edit',
                                    ['tournamentId'=> $category->pivot->tournament_id,
                                     'categoryId' => $category->id,
                                     'settings' => $category->settings->id]) !!}">
                                    {{ $category->name }}</a>

                            </td>
                            <td class="text-center">{!! $category->settings->isTeam == 1 ? $ok : $nok !!}</td>
                            <td class="text-center">{!! $category->settings->fightDuration !!}</td>
                            <td class="text-center">{!! $category->settings->hasRoundRobin == 1 ? $ok : $nok !!}</td>
                            <td class="text-center">{!! $category->settings->hasEncho == 1 ? $ok : $nok !!}</td>
                            <td class="text-center">{!! $category->settings->hasHantei == 1 ? $ok : $nok !!}</td>

                            <td class="text-center">
                                <a class=" text-info "
                                   href="{!! URL::action('CategorySettingsController@edit',
                                   ['tournamentId'=> $category->pivot->tournament_id,
                                   'categoryId' => $category->id,
                                   'settings' => $category->settings->id]) !!}">
                                    <span class="text-slate glyphicon glyphicon-cog"></span></a>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>
                                <a href="{!!   URL::action('CategorySettingsController@create', ['tournamentId'=> $category->pivot->tournament_id, 'categoryId'=>$category->id]) !!}">{{ $category->id }}</a>
                            </td>
                            <td>
                                <a href="{!!   URL::action('CategorySettingsController@create', ['tournamentId'=> $category->pivot->tournament_id, 'categoryId'=>$category->id]) !!}">{{ $category->name }}</a>
                            </td>
                            <td class="text-center">{!!  $defaultSettings->isTeam == 1 ? $ok : $nok!!}</td>
                            <td class="text-center">{!!  $defaultSettings->fightDuration!!}</td>
                            <td class="text-center">{!!  $defaultSettings->hasRoundRobin == 1 ? $ok : $nok!!}</td>
                            <td class="text-center">{!!  $defaultSettings->hasEncho == 1 ? $ok : $nok!!}</td>
                            <td class="text-center">{!!  $defaultSettings->hasHantei == 1 ? $ok : $nok !!}</td>

                            <td class="text-center">
                                <a class=" text-info "
                                   href="{!! URL::action('CategorySettingsController@create', ['tournamentId'=> $category->pivot->tournament_id, 'categoryId'=>$category->id]) !!}"><span
                                            class="text-slate glyphicon glyphicon-cog"></span></a>
                            </td>
                        </tr>
                    @endif
                @endforeach

            </table>
            <br/><br/>

        </div>

    </div>

@stop

