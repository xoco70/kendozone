@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('clubs.index') !!}

@stop

@section('content')
    <!-- Tabs -->
    <ul class="nav nav-lg nav-tabs nav-tabs-bottom search-results-tabs">
        <li><a href="{{ route('federations.index') }}"><i class="position-left"></i> {{trans_choice('core.federation',2)}}</a></li>
        <li><a href="{{ route('associations.index') }}"><i class="position-left"></i> {{trans_choice('core.association',2)}}</a></li>
        <li class="active"><a href="#"><i class="position-left"></i> {{trans_choice('core.club',2)}} </a></li>
        <li><a href="{{ route('users.index') }}"><i class="position-left"></i> {{trans_choice('core.user',2)}}</a></li>
        @if (sizeof($clubs)!=0)
            @can('create', new App\Club)
                <span class="pl-10 pull-right">
                    <a id="addClub" href="{!!   URL::action('ClubController@create') !!}"
                       class="btn btn-primary btn-xs "><b><i class="icon-plus22 mr-5"></i></b>
                        @lang('core.addModel', ['currentModelName' => $currentModelName])
                    </a>
                </span>
            @endcan
        @endif
    </ul>
    <!-- /tabs -->

    <div class="container-fluid">

        @if (sizeof($clubs)==0)
            @include('layouts.noClubs')
        @else

            <table class="table table-togglable table-hover">
                <thead>
                <tr>

                    <th data-toggle="true">{{ trans_choice('core.name',1) }}</th>
                    <th class="text-center" data-hide="phone">{{ trans_choice('core.federation',1) }}</th>
                    <th class="text-center" data-hide="phone">{{ trans_choice('core.association',1) }}</th>
                    <th class="text-center" data-hide="phone">{{ trans('core.club.president') }}</th>
                    <th class="text-center" data-hide="phone">{{ trans('core.email') }}</th>
                    <th class="text-center" data-hide="all">{{ trans('core.club.address') }}</th>
                    <th class="text-center" data-hide="tablet">{{ trans('core.club.phone') }}</th>
                    <th class="text-center" data-hide="phone">{{ trans('core.action') }}</th>

                </tr>
                </thead>
                @foreach($clubs as $club)
                    <tr>
                        <td>@can('edit',$club)
                                <a href="{!!   URL::action('ClubController@edit',  $club->id) !!}">{{ $club->name }}</a>
                            @else
                                {{ $club->name }}
                            @endcan
                        </td>
                        <td>{{ $club->association !=null && $club->association->federation != null ? $club->association->federation->name : "-"}}</td>
                        <td>{{ $club->association !=null ? $club->association->name : "-"}}</td>
                        <td align="center">{{ $club->president !=null ? $club->president->name : " - " }}</td>
                        <td align="center">{{ $club->president != null ? $club->president->email : " - "}}</td>
                        <td align="center">{{ $club->address }}</td>
                        <td align="center">{{ $club->phone }}</td>
                        <td align="center">
                            @can('edit',$club)
                                <a href="{{URL::action('ClubController@edit', $club->id)}}"><i
                                            class="icon icon-pencil7"></i></a>
                            @endcan
                            @can('delete',$club)
                                {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteClub', 'action' => ['ClubController@destroy', $club->id], 'style'=>"display: inline-block"]) !!}
                                {!! Form::button( '<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit','class' => 'btn text-warning-600 btn-flat btnDeleteClub', 'id'=>'delete_'.$club->id, 'data-id' => $club->id ] ) !!}
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
        var url = "{{ URL::action('ClubController@index') }}";
    </script>
    {!! Html::script('js/pages/footer/clubIndexFooter.js') !!}
@stop
