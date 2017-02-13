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
                    <div class="container-fluid" align="center">

                        @forelse($tournament->championships as $championship)
                            <h1> {{$championship->category->buildName()}}</h1>


                            @foreach($championship->fights->groupBy('area') as $fightsByArea)
                                <table class="table-bordered text-center">
                                    <th class="p-10" >Id</th>
                                    <th class="p-10" >{{trans_choice('core.competitor',1)}} 1</th>
                                    <th class="p-10" >{{trans_choice('core.competitor',1)}} 2</th>

                                    @foreach($fightsByArea->sortBy('id') as $id => $fight)

                                        <?php

                                        if ($championship->category->isTeam) {
                                            $fighter1 = $fight->team1 != null ? $fight->team1->name : "BYE";
                                            $fighter2 = $fight->team2 != null ? $fight->team2->name : "BYE";
                                        } else {
                                            $fighter1 = $fight->competitor1 != null ? $fight->competitor1->user->name : "BYE";
                                            $fighter2 = $fight->competitor2 != null ? $fight->competitor2->user->name : "BYE";
                                        }


                                        ?>


                                        <tr>
                                            <td class="p-10">{{$id + 1}}</td>
                                            <td class="p-10">{{ $fighter1 }}</td>
                                            <td class="p-10">{{ $fighter2 }}</td>
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
@stop
