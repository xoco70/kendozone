@extends('layouts.dashboard')
@section('title')
    <title>{{ trans_choice('structures.association',2) }}</title>
@stop

@section('title')

@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('associations.index') !!}
@stop

@section('content')
    <!-- Submenu -->
    @include('layouts.displayMenuMyEntitiesOnTop')
    <!-- /Submenu -->


    <div class="container-fluid">

        @if (sizeof($associations)==0)
            @include('layouts.noAssociations')
        @else


            <table class="table table-togglable table-hover">
                <thead>
                <tr>

                    <th data-toggle="true">{{ trans_choice('core.name',1) }}</th>
                    <th class="text-center" data-hide="phone">{{ trans_choice('structures.federation',1) }}</th>
                    <th class="text-center" data-hide="phone">{{ trans('structures.association.president') }}</th>
                    <th class="text-center" data-hide="phone">{{ trans('core.email') }}</th>
                    <th class="text-center" data-hide="all">{{ trans('structures.association.address') }}</th>
                    <th class="text-center" data-hide="all">{{ trans('structures.association.phone') }}</th>
                    <th class="text-center" data-hide="phone">{{ trans('core.country') }}</th>
                    <th class="text-center" data-hide="phone">{{ trans('core.action') }}</th>

                </tr>
                </thead>
                @foreach($associations as $association)
                    <tr>
                        <td>
                            @if (Auth::user()->isSuperAdmin() || Auth::user()->isFederationPresident())
                                <a href="{!!   URL::action('AssociationController@edit',  $association->id) !!}">{{ $association->name }}</a>
                            @else
                                {{ $association->name }}
                            @endif
                        </td>
                        <td align="center">{{ $association->federation != null ? $association->federation->name : " - "}}</td>
                        <td align="center">{{ $association->president != null ? $association->president->name : " - "}}</td>
                        <td align="center">{{ $association->president != null ? $association->president->email : " - " }}</td>
                        <td align="center">{{ $association->address }}</td>
                        <td align="center">{{ $association->phone }}</td>
                        <td align="center">{!!   $association->federation !=null && $association->federation->country !=null? "<img src=/images/flags/".$association->federation->country->flag. " />" : '&nbsp;' !!}</td>
                        <td align="center">

                            @can('edit', $association)
                                <a href="{{URL::action('AssociationController@edit', $association->id)}}"><i
                                            class="icon icon-pencil7"></i></a>
                            @endcan
                            @can('delete', $association)
                                {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteAssociation', 'action' => ['AssociationController@destroy', $association->id], 'style'=>"display: inline-block"]) !!}
                                {!! Form::button( '<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit','class' => 'btn text-warning-600 btn-flat btnDeleteAssociation', 'id'=>'delete_'.$association->id, 'data-id' => $association->id ] ) !!}
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
        var url = "{{ URL::action('AssociationController@index') }}";
    </script>
    {!! Html::script('js/pages/footer/associationIndexFooter.js') !!}
@stop
