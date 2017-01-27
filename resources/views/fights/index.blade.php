@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('fights.index', $tournament) !!}

@stop

@section('content')



    <div class="container-detached">

        <div class="content-detached">
            @include('layouts.tree.topTree')
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="container-fluid">

                        @forelse($tournament->championships as $championship)
                            <h1> {{$championship->category->buildName()}}</h1>


                            {{--Area {{ $tree->area }} <br/>--}}
                            @foreach($championship->fights->groupBy('area') as $fightsByArea)
                                <table class="table-bordered full-width">
                                    <th class="p-10" width="5%">Id</th>
                                    <th class="p-10" width="5%">Area</th>
                                    <th class="p-10" width="20%">{{trans_choice('core.competitor',1)}} 1</th>
                                    <th class="p-10" width="20%">{{trans_choice('core.competitor',1)}} 2</th>

                                    @foreach($fightsByArea->sortBy('id') as $fight)

                                        <?php

                                        if ($championship->category->isTeam) {
                                            $user1 = $fight->team1 != null ? $fight->team1->name : 'BYE';
                                            $user2 = $fight->team2 != null ? $fight->team2->name : 'BYE';
                                        } else {
                                            $user1 = $fight->user1 != null ? $fight->user1->name : 'BYE';
                                            $user2 = $fight->user2 != null ? $fight->user2->name : 'BYE';
                                        }

                                        ?>


                                        <tr>
                                            <td class="p-10">{{$fight->id}}</td>
                                            <th class="p-10" width="5%">{{$fight->area}}</th>
                                            <td class="p-10">{{ $user1 }}</td>
                                            <td class="p-10">{{ $user2 }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                <br/>
                            @endforeach



                        @empty
                            {{ trans('core.no_fight_list') }}
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("right-panel.tournament_menu")

@stop
@section('scripts_footer')
    {{--{!! Html::script('js/pages/header/footable.js') !!}--}}
    {{--<script>--}}
    {{--$(function () {--}}

    {{--// Initialize responsive functionality--}}
    {{--$('.table-togglable').footable();--}}

    {{--});--}}
    {{--</script>--}}

@stop
