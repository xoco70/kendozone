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
                            <h1> {{$championship->category->buildName($grades)}}</h1>


                                {{--Area {{ $tree->area }} <br/>--}}
                                <table class="table-bordered full-width">
                                    <th class="p-10" width="5%">Id</th>
                                    <th class="p-10" width="20%">{{trans_choice('core.competitor',1)}} 1</th>
                                    <th class="p-10" width="20%">{{trans_choice('core.competitor',1)}} 2</th>
                                    <?php dd($championship->fights) ?>
                                    @foreach($championship->fights as $fight)
                                        <tr>
                                            <td class="p-10">{{$fight->id}}</td>
                                            <td class="p-10">{{$fight->user1!= null ? $fight->user1->id : ''}}</td>
                                            <td class="p-10">{{$fight->user2!= null ? $fight->user2->id : ''}}</td>
                                        </tr>
                                    @endforeach
                                </table><br/>


                        @empty
                            No hay lista de combates para esta categoria
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
