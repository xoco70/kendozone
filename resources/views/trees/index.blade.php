@extends('layouts.dashboard')

@section('styles')
    {!! Html::style('css/pages/trees.css')!!}

@stop

@section('breadcrumbs')
    {!! Breadcrumbs::render('trees.index', $tournament) !!}
@stop

@section('content')

    <div class="container-detached">

        <div class="content-detached">
            @include('layouts.tree.topTree')
            <ul class="nav nav-tabs nav-tabs-solid nav-justified trees">
                @foreach($tournament->championships as $championship)
                    <li class={{ $loop->first ? "active" : "" }}><a href="#{{$championship->id}}" data-toggle="tab"
                                                                    id="tab{{$championship->id}}">{{$championship->category->buildName($grades)}}</a>
                    </li>

                @endforeach
            </ul>

            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="tab-content">
                            @foreach($tournament->championships as $championship)
                                <div class="tab-pane {{ $loop->first ? "active" : "" }}" id="{{$championship->id}}">
                                    <h1> {{$championship->category->buildName($grades)}}

                                        <a href="{{URL::action('TreeController@single', ['championship'=> $championship->id]) }}"
                                            class="btn bg-teal btn-xs btnPrint pull-right ml-10 mt-5">
                                            <i class="icon-printer"></i>
                                        </a>

                                        @can('generateTree', $tournament)
                                            {!! Form::close() !!}

                                            {!! Form::open(
                                                ['method' => 'POST', 'id' => 'storeTree', 'class'=> 'pull-right',
                                                 'data-gen' => $championship->tree->count(),
                                                'action' => ['TreeController@store', $championship->id]]) !!}

                                            <button type="button" class="btn bg-success btn-xs generate">
                                                {{ trans_choice('core.generate_tree',1) }}
                                            </button>
                                            {!! Form::close() !!}
                                        @endcan

                                    </h1>

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
                            @endforeach
                        </div>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("right-panel.tournament_menu")

    @include("errors.list")
@stop
@section('scripts_footer')
    <?php
    $championshipWithBrackets = $tournament->championships
        ->filter(function ($championship, $key) {
            return ($championship->isDirectEliminationType() && !$championship->hasPreliminary());
        })->map(function ($championship, $key) {
            return $championship->id;
        })->toArray();


    ?>

    {!! Html::script('js/pages/footer/trees.js')!!}
    <script>
        function render_fn(container, data, score, state) {
            switch (state) {
                case "empty-bye":
                    container.append("No team")
                    return;
                case "empty-tbd":
                    container.append("Upcoming")
                    return;

                case "entry-no-score":
                case "entry-default-win":
                case "entry-complete":
                    container.append('<img src="site/png/' + data.flag + '.png" /> ').append(data.name)
                    return;
            }
        }
        @foreach($championshipWithBrackets as $championshipId)

            $(function () {
            $('#brackets_{{ $championshipId }}').bracket({
                init: minimalData_{{ $championshipId }}, /* data to initialize the bracket with */
                teamWidth: 100,
            })
        });
        @endforeach




        $('.generate').on('click', function (e) {
            e.preventDefault();
            var form = $(this).parents('form:first');
            inputData = form.serialize();
            var count = form.data('gen');
            if (count != 0) {
                var form = $(this).parents('form');
                swal({
                        title: "{{ trans('msg.are_you_sure') }}",
                        text: "{{ trans('msg.this_will_delete_previous_tree') }}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: "{{ trans('msg.do_it_again') }}",
                        cancelButtonText: "{{ trans('msg.cancel_it') }}",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            form.submit();
                        } else {
                            swal("{{ trans('msg.cancelled') }}", "{{ trans('msg.operation_cancelled') }}", "error");
                        }
                    });
            } else {
                form.submit();
            }

        });


    </script>

@stop
