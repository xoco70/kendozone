@extends('layouts.dashboard')
@section('breadcrumbs')
    {!! Breadcrumbs::render('clubs.index') !!}

@stop

@section('content')


    <div class="container-fluid">

        @if (sizeof($clubs)==0)
            {{--            @include('layouts.noFederations')--}}
        @else

            @can('create', new App\Club)
                <span class="pl-10 pull-right">
                    <a href="{!!   URL::action('ClubController@create') !!}"
                       class="btn btn-primary btn-xs "><b><i class="icon-plus22 mr-5"></i></b>
                        @lang('core.addModel', ['currentModelName' => $currentModelName])
                    </a>
                </span>
            @endcan
            <table class="table table-togglable table-hover">
                <thead>
                <tr>

                    <th data-toggle="true">{{ trans_choice('core.name',1) }}</th>
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
                        <td><a
                                    href="{!!   URL::action('ClubController@edit',  $club->id) !!}">{{ $club->name }}</a>
                        </td>
                        <td>{{ $club->association !=null ? $club->association->name : "-"}}</td>
                        <td align="center">{{ $club->president !=null ? $club->president->name : " - " }}</td>
                        <td align="center">{{ $club->president != null ? $club->president->email : " - "}}</td>
                        <td align="center">{{ $club->address }}</td>
                        <td align="center">{{ $club->phone }}</td>
                        <td align="center">
                            <a href="{{URL::action('ClubController@edit', $club->id)}}"><i class="icon icon-pencil7"></i></a>
                            {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteClub', 'action' => ['ClubController@destroy', $club->id], 'style'=>"display: inline-block"]) !!}
                            {!! Form::button( '<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit','class' => 'btn text-warning-600 btn-flat btnDeleteClub', 'id'=>'delete_'.$club->id, 'data-id' => $club->id ] ) !!}
                            {!! Form::close() !!}
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
        var url ="{{ URL::action('ClubController@index') }}";
    </script>
    {!! Html::script('js/pages/footer/clubIndexFooter.js') !!}
@stop
