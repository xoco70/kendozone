@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <?php

        $link = "";
        $id = "";
        if ($settingSize > 0 && $settingSize == $categorySize)
            $link = URL::action('TournamentController@generateTrees', ['tournamentId' => $tournament->id]);
        else
            // For showing Modal
            $link = "#";
        $id = 'id="generate_tree"';

        ?>
                <!-- Detached content -->
        <div class="container-detached">
            <div class="content-detached">
                @foreach($tournament->categoryTournaments as $categoryTournament)

                    <div class="panel panel-flat">

                        <div class="panel-body">
                            <div class="mb-20">


                                {{--<a href="{!!   $link !!}" {!! $id !!}--}}
                                {{--class="btn bg-teal btn-xs pull-right ml-20"><b><i--}}
                                {{--class="icon-tree7 mr-5"></i>{{ trans('crud.generate_trees') }}</b>--}}
                                {{--</a>--}}
                                {{--<a href="{!!   URL::action('TournamentUserController@create',--}}
                                {{--['tournamentId'=>$tournament->id]) !!}"--}}
                                {{--class="btn btn-primary btn-xs pull-right"><b><i--}}
                                {{--class="icon-plus22 mr-5"></i></b> @lang('crud.addModel', ['currentModelName' => trans_choice('crud.competitor',2)])--}}
                                {{--</a>--}}
                            </div>
                            <div class="container-fluid">


                                <div class="mb-20">
                                    <a href="{!!   $link !!}" {!! $id !!}
                                    class="btn bg-teal btn-xs pull-right ml-20"><b><i
                                                    class="icon-tree7 mr-5"></i>{{ trans('crud.generate_trees') }}</b>
                                    </a>
                                    <a href="{!!   URL::action('TournamentUserController@create',
                                                    ['tournamentId'=>$tournament->id,
                                                    'categoryId'=>$categoryTournament->id
                                                    ]) !!}"
                                       class="btn btn-primary btn-xs pull-right"><b><i
                                                    class="icon-plus22 mr-5"></i></b> @lang('crud.addModel', ['currentModelName' => trans_choice('crud.competitor',2)])
                                    </a>
                                </div>
                                <a name="{{ $categoryTournament->category->name }}"><legend class="text-semibold">{{ $categoryTournament->category->name }}</legend></a>

                                <table class="table datatable-responsive" >
                                    <thead>
                                    <tr>
                                        <th class="min-tablet text-center "
                                            data-hide="phone">{{ trans('crud.avatar') }}</th>
                                        <th class="all">{{ trans('crud.username') }}</th>
                                        <th class="phone">{{ trans('crud.email') }}</th>
                                        <th class="phone">{{ trans_choice('crud.category',1) }}</th>
                                        <th class="phone">{{ trans('crud.confirmed') }}</th>
                                        <th class="phone">{{ trans('crud.country') }}</th>
                                        <th class="all">{{ trans('crud.action') }}</th>
                                    </tr>
                                    </thead>
                                    @foreach($categoryTournament->users as $user)
                                        <tr>
                                            <td class="text-center">
                                                <a href="{!!   URL::action('UserController@show',  $user->id) !!}"><img
                                                            src="{{ $user->avatar }}" class="img-circle img-sm"/></a>
                                            </td>
                                            <td><a
                                                        href="{!!   URL::action('UserController@show',  ['users'=>$user->id] ) !!}">{{ $user->name }}</a>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center">{{ trans($categoryTournament->category->name)}}</td>

                                            <td class="text-center">
                                                @if ($user->confirmed)
                                                    <a class=" text-success" href="#"><span
                                                                class="glyphicon glyphicon-ok-sign"></span></a>
                                                @else
                                                    <a class=" text-danger text-center" href="#"><span
                                                                class="glyphicon glyphicon-remove-sign"></span></a>
                                                @endif

                                            </td>


                                            <td class="text-center"><img src="/images/flags/{{ $user->country->flag }}"
                                                                         alt="{{ $user->country->name }}"/></td>


                                            <td class="text-center">
                                                <a class=" text-danger "
                                                   href="{!! URL::action('TournamentUserController@deleteUser',
                                                    ['tournamentId'=>$tournament->id,
                                                    'categoryId'=>$categoryTournament->id,
                                                    'userId'=>$user->id])  !!}">
                                                    <span class="glyphicon glyphicon-remove"></span></a>
                                            </td>
                                        </tr>

                                    @endforeach

                                </table>
                                <br/>


                            </div>
                            <br/><br/>

                            {{--                <div class="text-right mr-20">{{ $users->count() }} {{ Lang::get('crud.results')}}</div>--}}

                            {{--                <div class="text-center">{!! $users->render() !!}</div>--}}


                        </div>

                    </div>
                @endforeach
            </div>
        </div>


        @include("right-panel.users_menu")


    </div>

    <script>
        $(function () {

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
            });


            // External table additions
            // ------------------------------

            // Add placeholder to the datatable filter option
            $('.dataTables_filter input[type=search]').attr('placeholder', 'Type to filter...');

// Info alert
            $('#generate_tree').on('click', function () {
                swal({
                    title: "{!! trans('core.information') !!}",
                    text: "{!!   trans('crud.all_categories_not_configured') !!}",
                    confirmButtonColor: "#2196F3",
                    type: "info"
                });
            });
        });
    </script>
@stop
