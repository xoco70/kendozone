@foreach($tournamentWithTrees->championships as $championship)

    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="container-fluid">

                <div class="tab-pane {{ $loop->first ? "active" : "" }}" id="{{$championship->id}}"
                     @if($championship->isDirectEliminationType()) style="padding-bottom: {{ $championship->fights->count() *2 *65}}px" @endif >


                <h1> {{$championship->buildName()}}</h1>
                    <a href="{{URL::action('PDFController@tree', ['championship'=> $championship->id]) }}"
                       class="btn bg-teal btn-xs btnPrint pull-right ml-10 mt-5">{{ trans('core.print') }}
                        <i class="icon-printer"></i>
                    </a>

                    @if ($championship->fightersGroups != null  && $championship->fightersGroups->count() != 0)
                        @if ($championship->hasPreliminary())
                            @include('layouts.tree.preliminary')
                        @elseif ($championship->isDirectEliminationType())
                            @include('laravel-tournaments::partials.tree.directElimination', ['hasPreliminary' => 0])
                        @elseif ($championship->isPlayOffType())
                            @include('layouts.tree.roundRobin')
                        @elseif ($championship->isPlayOffType())
                            @include('layouts.tree.playOff')
                        @else
                            <div>{{trans('core.no_generated_tree')}}</div>
                        @endif
                    @endif
                </div>
                <br/>
            </div>
        </div>
    </div>
@endforeach
