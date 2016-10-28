@extends('layouts.dashboard')
@section('content')

    <?php

    ?>
    <div class="container-fluid">

        @foreach($preliminaryTree->groupBy('area') as $ptByArea)
            <table border="1" cellpadding="5" cellspacing="5">
                <th>ID</th>
                <th>Championship</th>
                <th>Area</th>
                <th>Competidor 1</th>
                <th>Competidor 2</th>
                <th>Competidor 3</th>
                <th>Competidor 4</th>
                <th>Competidor 5</th>
                {{--<th>Competidor 5</th>--}}
                @foreach($ptByArea as $pt)
                    <tr>
                        <td>{{$pt->id}}</td>
                        <td>{{$pt->championship->category->name}}</td>
                        <td>{{$pt->area}}</td>
                        <td>{{$pt->user1!= null ? $pt->user1->name : ''}}</td>
                        <td>{{$pt->user2!= null ? $pt->user2->name : ''}}</td>
                        <td>{{$pt->user3!= null ? $pt->user3->name : ''}}</td>
                        <td>{{$pt->user4!= null ? $pt->user4->name : ''}}</td>
                        <td>{{$pt->user5!= null ? $pt->user5->name : ''}}</td>
                    </tr>
                @endforeach
            </table><br/>
        @endforeach
    </div>

    @include("errors.list")
@stop
@section('scripts_footer')
@stop
