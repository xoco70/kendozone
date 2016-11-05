@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('trees.index', $championships->get(0)->tournament) !!}
@stop

@section('content')

    <div class="panel panel-flat">

        <div class="panel-body">

            <div class="container-fluid">


                @foreach($championships as $championship)
                    <h1> {{$championship->category->buildName($grades)}}</h1>
                    @if (App::environment('production'))
                        <a href="{{ route('workingonit') }}"
                           data-target="#create_tournament_user"
                           class="btn bg-teal btn-xs pull-right mr-10"><b>
                                <i class="mr-5"></i>Generate Trees</b>
                        </a>

                    @else
                        <span>
                {!! Form::model(null, ['method' => 'POST', 'id' => 'storeTree',
'action' => ['TreeController@store', $championship->id]]) !!}

                            <button type="submit"
                                    class="btn bg-teal btn-xs pull-right mr-10">
                    <i class="mr-5"></i>Generate Trees

                </button>


                            {!! Form::close() !!}</span>
                    @endif
                    @if ($championship->tree != null && $championship->tree->count() != 0)
                        @foreach($championship->tree->groupBy('area') as $ptByArea)
                            <table class="table-bordered">
                                <th class="p-10">ID</th>
                                <th class="p-10">Championship</th>
                                <th class="p-10">Area</th>
                                <th class="p-10">Competidor 1</th>
                                <th class="p-10">Competidor 2</th>
                                <th class="p-10">Competidor 3</th>


                                @if ($championship->settings!= null && $championship->settings->preliminaryGroupSize>3)
                                    <th class="p-10">Competidor 4</th>
                                @endif
                                @if ($championship->settings!= null && $championship->settings->preliminaryGroupSize==5)
                                    <th class="p-10">Competidor 5</th>
                                @endif
                                @foreach($ptByArea as $pt)
                                    <tr>
                                        <td class="p-10">{{$pt->id}}</td>
                                        <td class="p-10">{{$championship->category->name}}</td>
                                        <td class="p-10">{{$pt->area}}</td>
                                        <td class="p-10">{{$pt->user1!= null ? $pt->user1->name : ''}}</td>
                                        <td class="p-10">{{$pt->user2!= null ? $pt->user2->name : ''}}</td>
                                        <td class="p-10">{{$pt->user3!= null ? $pt->user3->name : ''}}</td>

                                        @if ($championship->settings!= null && $championship->settings->preliminaryGroupSize>3)
                                            <td class="p-10">{{$pt->user4!= null ? $pt->user4->name : ''}}</td>
                                        @endif
                                        @if ($championship->settings!= null && $championship->settings->preliminaryGroupSize==5)
                                            <td class="p-10">{{$pt->user5!= null ? $pt->user5->name : ''}}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </table><br/>
                        @endforeach
                    @else

                        <div>No hay arbol generado</div>

                    @endif
                @endforeach
            </div>
        </div>

    </div>





    @include("errors.list")
@stop
@section('scripts_footer')
@stop
