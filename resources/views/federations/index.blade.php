@extends('layouts.dashboard')
@section('title')
    <title>{{ trans_choice('structures.federation',2) }}</title>
@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('federations.index') !!}

@stop

@section('content')


    <!-- Submenu -->
    @include('layouts.displayMenuMyEntitiesOnTop')
    <!-- /Submenu -->

    <div class="container-fluid">

        @if (sizeof($federations)==0)
            {{--            @include('layouts.noFederations')--}}
        @else
            <table class="table table-togglable table-hover">
                <thead>
                <tr>

                    <th data-toggle="true">{{ trans_choice('core.name',1) }}</th>
                    <th class="text-center" data-hide="phone">{{ trans('structures.federation.president') }}</th>
                    <th class="text-center" data-hide="all">{{ trans('structures.federation.address') }}</th>
                    <th class="text-center" data-hide="phone">{{ trans('core.email') }}</th>
                    <th class="text-center" data-hide="phone">{{ trans('structures.federation.phone') }}</th>
                    <th class="text-center" data-hide="phone">{{ trans('core.country') }}</th>
                    @if (Auth::user()->isSuperAdmin())
                        <th class="text-center" data-hide="phone">{{ trans('core.action') }}</th>
                    @endif
                </tr>
                </thead>
                @foreach($federations as $federation)
                    <tr>
                        <td>

                            @if (Auth::user()->isSuperAdmin())
                                <a href="{!!   URL::action('FederationController@edit',  $federation->id) !!}">{{ $federation->name }}</a>
                            @else
                                {{ $federation->name }}
                            @endif
                        </td>
                        <td align="center">@if ($federation->president != null) {{ $federation->president->name }} @endif</td>
                        <td align="center">{{ $federation->address }}</td>
                        <td align="center">{{ $federation->email}}</td>
                        <td align="center">{{ $federation->phone }}</td>
                        <td align="center">@if ($federation->country!= null)
                                <img src="images/flags/{{ $federation->country->flag ?? "no_flag.png"}}"/>@else
                                &nbsp; @endif</td>
                        @can('edit', $federation)
                            <td align="center"><a
                                        href="{{URL::action('FederationController@edit', $federation->id)}}"><i
                                            class="icon icon-pencil7"></i></a></td>
                        @endcan
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
        $(function () {

            // Initialize responsive functionality
            $('.table-togglable').footable();

        });
    </script>

@stop
