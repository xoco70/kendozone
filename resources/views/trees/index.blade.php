@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/footer/trees.js')!!}
@stop

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
                                @if (App::environment('production'))
                                    <a href="{{ route('workingonit') }}"
                                       data-target="#create_tournament_user"
                                       class="btn bg-teal btn-xs mr-10"><b>
                                            <i class="mr-5"></i>{{ trans_choice('core.generate_tree',1) }}</b>
                                    </a>

                                @else

                                    {!! Form::model(null, ['method' => 'POST', 'id' => 'storeTree', 'class'=> 'pull-right',
                                        'action' => ['TreeController@store', $championship->id]]) !!}

                                    <button type="button" class="btn bg-teal btn-xs" id="generate">
                                        {{ trans_choice('core.generate_tree',1) }}
                                    </button>


                                    {!! Form::close() !!}
                                @endif
                            </h1>
                            @if ($championship->tree != null && $championship->tree->count() != 0)
                                @foreach($championship->tree->groupBy('area') as $ptByArea)
                                    <table class="table-bordered full-width">
                                        {{--<th class="p-10">ID</th>--}}
                                        <th class="p-10" width="35%">{{ trans_choice('categories.category',1) }}</th>
                                        <th class="p-10" width="5%">{{ trans_choice('categories.fightingArea',1) }}</th>
                                        <th class="p-10" width="20%">{{trans_choice('core.competitor',1)}} 1</th>
                                        <th class="p-10" width="20%">{{trans_choice('core.competitor',1)}} 2</th>
                                        <th class="p-10" width="20%">{{trans_choice('core.competitor',1)}} 3</th>


                                        @if ($championship->settings!= null && $championship->settings->preliminaryGroupSize>3)
                                            <th class="p-10">Competidor 4</th>
                                        @endif
                                        @if ($championship->settings!= null && $championship->settings->preliminaryGroupSize==5)
                                            <th class="p-10">Competidor 5</th>
                                        @endif
                                        @foreach($ptByArea as $pt)
                                            <tr>
                                                {{--<td class="p-10">{{$pt->id}}</td>--}}
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

                                <div>{{trans('core.no_generated_tree')}}</div>

                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("right-panel.tournament_menu")

    @include("errors.list")
@stop
@section('scripts_footer')
    <script>
        $('#generate').on('click', function (e) {
            e.preventDefault();
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
        });


    </script>

@stop
