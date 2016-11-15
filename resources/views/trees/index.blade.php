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
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="container-fluid">
                        @foreach($tournament->championships as $championship)
                            <h1> {{$championship->category->buildName($grades)}}
                                {!! Form::model(null,
                                    ['method' => 'POST', 'id' => 'storeTree', 'class'=> 'pull-right',
                                     'data-gen' => $championship->tree->count(),
                                    'action' => ['TreeController@store', $championship->id]]) !!}

                                <button type="button" class="btn bg-teal btn-xs generate">
                                    {{ trans_choice('core.generate_tree',1) }}
                                </button>


                                {!! Form::close() !!}
                            </h1>

                            @if ($championship->tree != null  && $championship->tree->count() != 0)
                                @foreach($championship->tree->groupBy('area') as $ptByArea)
                                    @if ($championship->hasPreliminary())
                                        @include('layouts.tree.preliminary')
                                    @elseif ($championship->isDirectEliminationType())
                                        @include('layouts.tree.directElimination')
                                    @endif
                                @endforeach
                            @elseif (! $championship->hasPreliminary() && $championship->isRoundRobinType())
                                @include('layouts.tree.roundRobin')
                            @else
                                <div>{{trans('core.no_generated_tree')}}</div>
                            @endif
                        @endforeach
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
    {!! Html::script('js/pages/footer/trees.js')!!}
    <script>
        var minimalData = {
            teams : [
                ["Team 1", "Team 2"], /* first matchup */
                ["Team 3", "Team 4"]  /* second matchup */
            ]
        }

        $(function() {
            $('#brackets').bracket({
                init: minimalData /* data to initialize the bracket with */ })
        })
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
