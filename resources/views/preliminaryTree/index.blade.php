@extends('layouts.dashboard')
@section('content')

    <div class="container-fluid">

        @foreach($preliminaryTree->groupBy('area') as $ptByArea)
            <?php
            $ptByAreaByc5 = $ptByArea->groupBy('c5');
            $ptByAreaByc4 = $ptByArea->groupBy('c4');
            $ptByAreaByc3 = $ptByArea->groupBy('c3');

            ?>

            <table class="table-bordered">
                <th class="p-10">ID</th>
                <th class="p-10">Championship</th>
                <th class="p-10">Area</th>
                <th class="p-10">Competidor 1</th>
                <th class="p-10">Competidor 2</th>
                @if ($ptByAreaByc3->count()!=0)
                    <th class="p-10">Competidor 3</th>
                @endif
                @if ($ptByAreaByc4->count()!=0)
                    <th class="p-10">Competidor 4</th>
                @endif
                @if ($ptByAreaByc5->count()!=0)
                    <th class="p-10">Competidor 5</th>
                @endif
                {{--<th>Competidor 5</th>--}}
                @foreach($ptByArea as $pt)
                    <tr>
                        <td class="p-10">{{$pt->id}}</td>
                        <td class="p-10">{{$pt->championship->category->name}}</td>
                        <td class="p-10">{{$pt->area}}</td>
                        <td class="p-10">{{$pt->user1!= null ? $pt->user1->name : ''}}</td>
                        <td class="p-10">{{$pt->user2!= null ? $pt->user2->name : ''}}</td>
                        @if ($ptByAreaByc3->count()!=0)
                            <td class="p-10">{{$pt->user3!= null ? $pt->user3->name : ''}}</td>
                        @endif
                        @if ($ptByAreaByc3->count()!=0)
                            <td class="p-10">{{$pt->user4!= null ? $pt->user4->name : ''}}</td>
                        @endif
                        @if ($ptByAreaByc3->count()!=0)
                            <td class="p-10">{{$pt->user5!= null ? $pt->user5->name : ''}}</td>
                        @endif
                    </tr>
                @endforeach
            </table><br/>
        @endforeach
    </div>

    @include("errors.list")
@stop
@section('scripts_footer')
@stop
