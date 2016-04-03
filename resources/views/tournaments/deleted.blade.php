@extends('layouts.dashboard')
@section('scripts')
    {!! Html::script('js/pages/header/tournamentIndex.js') !!}
@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('tournaments.index') !!}

@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-8 col-lg-offset-2">
                <div class="panel panel-flat">

                    <div class="panel-body">
                        <div class="container-fluid">

                            @if (sizeof($tournaments) == 0)
                                <fieldset title="{{ $title }}">
                                    <legend class="text-semibold">{{ $title }}</legend>
                                </fieldset>

                                <div class="mt-20 mb-20 pt-20 pb-20 text-center">{{ trans('core.no_tournament_deleted_yet') }}</div>
                                {{--@if ($printLink == true)--}}
                                    {{--<div class="text-center pb-20">--}}
                                        {{--<a href="{!! $link !!}" type="button"--}}
                                           {{--class="btn border-primary btn-flat text-primary text-uppercase p-10 ">{{ $linkLabel }}--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--@endif--}}




                            @else
                                <table class="table table-togglable table-hover">
                                    <thead>
                                    <tr>
                                        <th data-toggle="true">{{ trans('core.name') }}</th>
                                        <th data-hide="phone">{{ trans('core.date') }}</th>
                                        <th data-hide="phone">{{ trans('core.owner') }}</th>
                                        <th class="text-center">{{ trans('core.action') }}</th>

                                    </tr>
                                    </thead>
                                    @foreach($tournaments as $tournament)
                                        <tr id="{!! $tournament->slug !!}">
                                            <td>
                                                {{ $tournament->name }}
                                            </td>
                                            <td>{{ $tournament->dateIni }}</td>
                                            <td>{{ $tournament->owner->name}}</td>
                                            <td class="text-center">

                                                <a href="{!!   URL::action('TournamentController@restore',  $tournament->slug) !!}">
                                                    <span class="text-success undo">Restore</span>
                                                </a>


                                            </td>
                                        </tr>

                                    @endforeach

                                </table>
                                <div class="text-center">{!! $tournaments->render() !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("errors.list")
@stop
@section("scripts_footer")
    <script>
        var url = "{{ url("/tournaments") }}";

    </script>
    {!! Html::script('js/pages/footer/tournamentDeletedFooter.js') !!}
@stop