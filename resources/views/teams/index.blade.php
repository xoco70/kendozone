@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('teams.index', $tournament) !!}
@stop
<?php
$teams = $tournament->teams;
?>
@section('content')
    <div class="container-detached">
        <div class="content-detached">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @if (sizeof($teams)==0)
                        @include('layouts.noTeams')
                    @else

                        @if (Auth::user()->isSuperAdmin() || Auth::user()->isFederationPresident())
                            <span class="pl-10 pull-right">
                <a href="{!!   URL::action('TeamController@create', $tournament->slug) !!}" id="addTeam"
                   class="btn btn-primary btn-xs "><b><i class="icon-plus22 mr-5"></i></b>
                    @lang('core.addModel', ['currentModelName' => $currentModelName])
                </a>
            </span>

                        @endif
                        <table class="table table-togglable table-hover">
                            <thead>
                            <tr>

                                <th data-toggle="true">{{ trans_choice('core.name',1) }}</th>
                                <th data-hide="phone">{{ trans_choice('categories.category',1) }}</th>
                                <th data-hide="phone">{{ trans('core.action') }}</th>

                            </tr>
                            </thead>
                            @foreach($teams as $team)
                                <tr>
                                    <td>
                                        @if (Auth::user()->isSuperAdmin() || Auth::user()->isFederationPresident())
                                            <a href="{!!   URL::action('TeamController@edit',  ['tournament' => $tournament->slug, 'teams' => $team->id]) !!}">{{ $team->name }}</a>
                                        @else
                                            {{ $team->name }}
                                        @endif
                                    </td>
                                    <td>{{ $team->championship->category->alias!=""
                                    ? $team->championship->category->alias
                                    : trim($team->championship->category->buildName())}}</td>
                                    <td>

                                        @can('edit', $team)
                                            <a href="{{URL::action('TeamController@edit', ['tournament' => $tournament->slug, 'teams' => $team->id])}}"><i
                                                        class="icon icon-pencil7"></i></a>

                                        @endcan
                                        @can('delete', $team)
                                            {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteTeam', 'action' => ['TeamController@destroy', $tournament->slug,$team->id], 'style'=>"display: inline-block"]) !!}
                                            {!! Form::button( '<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit','class' => 'btn text-warning-600 btn-flat btnDeleteTeam', 'id'=>'delete_'.$team->id, 'data-id' => $team->id ] ) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>

                                </tr>

                            @endforeach


                        </table>
                    @endif
                </div>
            </div>
        </div>

    </div>
    @include("right-panel.tournament_menu")
    @include("errors.list")
@stop
@section('scripts_footer')
    {!! Html::script('js/pages/header/footable.js') !!}

    <script>
        var url = "{{ URL::action('TeamController@index', $tournament->slug) }}";
    </script>
    {!! Html::script('js/pages/footer/teamIndexFooter.js') !!}
@stop
