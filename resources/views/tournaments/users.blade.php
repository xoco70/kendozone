@extends('layouts.dashboard')

@section('content')

    <div class="container">


        <div class="panel panel-flat">

            <div class="panel-body">
                <div class="mb-20">
                    <a href="{!!   URL::action('UserController@create') !!}"
                       class="btn btn-warning btn-xs pull-right ml-20"><b><i
                                    class="icon-tree7 mr-5"></i>{{ trans('crud.generate_trees') }}</b>
                    </a>
                    <a href="{!!   URL::action('TournamentController@createUser',
                                                    ['tournamentId'=>$users[0]->tournament_id]) !!}"
                       class="btn btn-primary btn-xs pull-right"><b><i
                                    class="icon-plus22 mr-5"></i></b> @lang('crud.addModel', ['currentModelName' => trans_choice('crud.competitor',2)])
                    </a>
                </div>
                <div class="container-fluid">

                    {{--<legend class="text-semibold">{{ $title }}</legend>--}}
                    <table class="table datatable-responsive">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">{{ trans('crud.username') }}</th>
                            <th class="text-center">{{ trans('crud.email') }}</th>
                            <th class="text-center">{{ trans_choice('crud.category',1) }}</th>
                            <th class="text-center">{{ trans('crud.confirmed') }}</th>
                            <th class="text-center">{{ trans('crud.avatar') }}</th>
                            <th class="text-center">{{ trans('crud.country') }}</th>
                            <th class="text-center">{{ trans('crud.action') }}</th>
                        </tr>
                        </thead>

                        @foreach($users as $user)
                            <tr>
                                <td class="text-center"><a
                                            href="{!!   URL::action('UserController@show',  $user->tcu_id) !!}">{{ $user->ctuId }}</a>
                                </td>
                                <td class="text-center"><a
                                            href="{!!   URL::action('UserController@show',  $user->id) !!}">{{ $user->name }}</a>
                                </td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">{{ trans($user->cat_name)}}</td>

                                <td class="text-center">
                                    @if ($user->confirmed)
                                        <a class=" text-success" href="#"><span
                                                    class="glyphicon glyphicon-ok-sign"></span></a>
                                    @else
                                        <a class=" text-danger text-center" href="#"><span
                                                    class="glyphicon glyphicon-remove-sign"></span></a>
                                    @endif

                                </td>
                                <td class="text-center">
                                    <a href="{!!   URL::action('UserController@show',  $user->id) !!}"><img
                                                src="{{ $user->avatar }}" class="img-circle img-sm"/></a>
                                </td>

                                <td class="text-center"><img src="/images/flags/{{ $user->country->flag }}"
                                                             alt="{{ $user->country->name }}"/></td>

                                <td class="text-center">
                                    <a class=" text-danger "
                                       href="{!! URL::action('TournamentController@deleteUser',
                                                    ['tournamentId'=>$user->tournament_id,
                                                    'tcId'=>$user->tcId,
                                                    'userId'=>$user->id])  !!}">
                                        <span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            </tr>

                        @endforeach

                    </table>

                </div>
                <br/><br/>

                {{--                <div class="text-right mr-20">{{ $users->count() }} {{ Lang::get('crud.results')}}</div>--}}

                {{--                <div class="text-center">{!! $users->render() !!}</div>--}}


            </div>
        </div>
    </div>
    <script>
        $(function () {


            // Table setup
            // ------------------------------

            // Setting datatable defaults
            $.extend($.fn.dataTable.defaults, {
                autoWidth: false,
                responsive: true,
                columnDefs: [{
                    orderable: false,
                    width: '100px',
                    targets: [5]
                }],
                dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                language: {
                    search: '<span>Filter:</span> _INPUT_',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
                },
                drawCallback: function () {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
                },
                preDrawCallback: function () {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
                }
            });


            // Basic responsive configuration
            $('.datatable-responsive').DataTable();


            // Column controlled child rows
            $('.datatable-responsive-column-controlled').DataTable({
                responsive: {
                    details: {
                        type: 'column'
                    }
                },
                columnDefs: [
                    {
                        className: 'control',
                        orderable: false,
                        targets: 0
                    },
                    {
                        width: "100px",
                        targets: [6]
                    },
                    {
                        orderable: false,
                        targets: [6]
                    }
                ],
                order: [1, 'asc']
            });


            // Control position
            $('.datatable-responsive-control-right').DataTable({
                responsive: {
                    details: {
                        type: 'column',
                        target: -1
                    }
                },
                columnDefs: [
                    {
                        className: 'control',
                        orderable: false,
                        targets: -1
                    },
                    {
                        width: "100px",
                        targets: [5]
                    },
                    {
                        orderable: false,
                        targets: [5]
                    }
                ]
            });


            // Whole row as a control
            $('.datatable-responsive-row-control').DataTable({
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                columnDefs: [
                    {
                        className: 'control',
                        orderable: false,
                        targets: 0
                    },
                    {
                        width: "100px",
                        targets: [6]
                    },
                    {
                        orderable: false,
                        targets: [6]
                    }
                ],
                order: [1, 'asc']
            });


            // External table additions
            // ------------------------------

            // Add placeholder to the datatable filter option
            $('.dataTables_filter input[type=search]').attr('placeholder', 'Type to filter...');


        });
    </script>
@stop

