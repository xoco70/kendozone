@extends('layouts.dashboard')
@section('content')
    <?php
    $ok = '<span class=" text-success glyphicon glyphicon-ok"></span>';
    $nok = '<span class=" text-warning glyphicon glyphicon-remove"></span>';
    ?>


    <div class="container">
        <div class="row col-md-10 custyle">
            <div class="panel panel-flat">

                <div class="panel-body">
                    <div class="container-fluid">
                        <table class="table table-striped custab">
                            <thead>


                            <tr>
                                <th>ID</th>
                                <th class="text-center">{{ trans('core.name') }}</th>
                                <th class="text-center">{{ trans('core.isTeam') }}</th>
                                <th class="text-center">{{ trans('core.fightDuration') }}</th>
                                <th class="text-center">{{ trans('core.hasRoundRobin') }}</th>
                                <th class="text-center">{{ trans('core.hasEncho') }}</th>
                                <th class="text-center">{{ trans('core.hasHantei') }}</th>
                                <th class="text-center">{{ trans('core.action') }}</th>
                            </tr>
                            </thead>
                            @foreach($categories as $category)
                                <?php
                                $championship = DB::table('championship')
                                        ->where('category_id', $category->id)
                                        ->where('tournament_id', $category->pivot->tournament_id)
                                        ->first();

                                $settings = \App\ChampionshipSettings::where('championship_id', $championship->id)->first();



                                ?>
                                @if ($settings !=null)

                                    <tr>
                                        <td>
                                            <a href="{!!   URL::action('CategorySettingsController@edit',
                                   ['tournamentId'=> $category->pivot->tournament_id,
                                    'championship_id' => $championship->id,
                                    'settings' => $settings->id
                                    ]) !!}">
                                                {{ $category->id }}</a>
                                        </td>
                                        <td>
                                            <a href="{!!   URL::action('CategorySettingsController@edit',
                                    ['tournamentId'=> $category->pivot->tournament_id,
                                     'championship_id' => $championship->id,
                                     'settings' => $settings->id]) !!}">
                                                {{ $category->name }}</a>

                                        </td>
                                        <td class="text-center">{!! $settings->isTeam == 1 ? $ok : $nok !!}</td>
                                        <td class="text-center">{!! $settings->fightDuration !!}</td>
                                        <td class="text-center">{!! $settings->hasRoundRobin == 1 ? $ok : $nok !!}</td>
                                        <td class="text-center">{!! $settings->hasEncho == 1 ? $ok : $nok !!}</td>
                                        <td class="text-center">{!! $settings->hasHantei == 1 ? $ok : $nok !!}</td>

                                        <td class="text-center">
                                            <a class=" text-info "
                                               href="{!! URL::action('CategorySettingsController@edit',
                                   ['tournamentId'=> $category->pivot->tournament_id,
                                   'championship_id' => $championship->id,
                                   'settings' => $settings->id]) !!}">
                                                <span class="text-slate glyphicon glyphicon-cog"></span></a>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                            <a href="{!!   URL::action('CategorySettingsController@create',
                                                    ['tournamentId'=> $category->pivot->tournament_id,
                                                     'championship_id' =>$category->id]) !!}">
                                                {{ $category->id }}</a>
                                        </td>
                                        <td>
                                            <a href="{!!   URL::action('CategorySettingsController@create',
                                                 ['tournamentId'=> $category->pivot->tournament_id,
                                                  'championship_id' => $category->id]) !!}">
                                                {{ $category->name }}</a>
                                        </td>
                                        <td class="text-center">{!!  $defaultSettings->isTeam == 1 ? $ok : $nok!!}</td>
                                        <td class="text-center">{!!  $defaultSettings->fightDuration!!}</td>
                                        <td class="text-center">{!!  $defaultSettings->hasRoundRobin == 1 ? $ok : $nok!!}</td>
                                        <td class="text-center">{!!  $defaultSettings->hasEncho == 1 ? $ok : $nok!!}</td>
                                        <td class="text-center">{!!  $defaultSettings->hasHantei == 1 ? $ok : $nok !!}</td>

                                        <td class="text-center">
                                            <a class=" text-info "
                                               href="{!! URL::action('CategorySettingsController@create',
                                                    ['tournamentId'=> $category->pivot->tournament_id,
                                                     'championship_id' => $category->id]) !!}"><span
                                                        class="text-slate glyphicon glyphicon-cog"></span></a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>

        </div>

@stop

