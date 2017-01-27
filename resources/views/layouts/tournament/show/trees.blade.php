@foreach($tournamentWithTrees->championships as $championship)

    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="container-fluid">

                        <div class="tab-pane {{ $loop->first ? "active" : "" }}" id="{{$championship->id}}">
                            <h1> {{$championship->category->buildName()}}</h1>
                            <a href="{{URL::action('PDFController@tree', ['championship'=> $championship->id]) }}"
                               class="btn bg-teal btn-xs btnPrint pull-right ml-10 mt-5">{{ trans('core.print') }}
                                <i class="icon-printer"></i>
                            </a>

                        @if ($championship->tree != null  && $championship->tree->count() != 0)
                                @if ($championship->hasPreliminary())
                                    @include('layouts.tree.preliminary')
                                @elseif ($championship->isDirectEliminationType())
                                    @include('layouts.tree.directElimination')
                                @endif
                            @elseif (! $championship->hasPreliminary() && $championship->isRoundRobinType())
                                @include('layouts.tree.roundRobin')
                            @else
                                <div>{{trans('core.no_generated_tree')}}</div>
                            @endif
                        </div>
                <br/>
            </div>
        </div>
    </div>
@endforeach
