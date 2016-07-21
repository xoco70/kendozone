@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('teams.index', $tournament) !!}
@stop

@section('content')



    <div class="container-fluid">

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
                            {{ $team->name }}    {{--<a href="{!!   URL::action('TeamController@edit',  $team->id) !!}">{{ $team->name }}</a>--}}
                            @else
                                {{ $team->name }}
                            @endif
                        </td>
                        <td>{{ $team->category_tournament->category->name}}</td>
                        <td>

                            @can('edit', $team)
                                <a href="{{URL::action('TeamController@edit', ['tournament' => $tournament->slug, 'teams' => $team->id])}}"><i class="icon icon-pencil7"></i></a>

                            @endcan
                            @can('delete', $team)
                                {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteTeam', 'action' => ['TeamController@destroy', $team->id], 'style'=>"display: inline-block"]) !!}
                                {!! Form::button( '<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit','class' => 'btn text-warning-600 btn-flat btnDeleteTeam', 'id'=>'delete_'.$team->id, 'data-id' => $team->id ] ) !!}
                                {!! Form::close() !!}
                            @endcan
                        </td>

                    </tr>

                @endforeach


            </table>
        @endif


    </div>

    @include("errors.list")
@stop
@section('scripts_footer')
    {!! Html::script('js/pages/header/footable.js') !!}

    <script>
        var url = "{{ URL::action('TeamController@index', $tournament->slug) }}";
    </script>
    {!! Html::script('js/pages/footer/associationIndexFooter.js') !!}
@stop
