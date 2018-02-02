@extends('layouts.dashboard')
@section('title')
    <title>{{ trans_choice('core.fight',2) }}</title>
@stop

@section('breadcrumbs')
    {!! Breadcrumbs::render('fights.index', $tournament) !!}
@stop
@section('content')
    <div class="container-detached">
        <div class="content-detached">
            @include('layouts.tree.topTree')
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="container-fluid" align="center">

                        @forelse($tournament->championships as $championship)
                            <h1> {{$championship->buildName()}}</h1>
                            @include('laravel-tournaments::partials.fights')
                        @empty
                            {{ trans('core.no_fight_list') }}
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("right-panel.tournament_menu")
@stop
@section('scripts_footer')
    <script>
        var facebook_id = "{{ env('FACEBOOK_CLIENT_ID') }}";
        var url_register = '{{ URL::action('TournamentController@register',$tournament->slug) }}';
        var url_show_tournament = '{{ URL::action('TournamentController@show',$tournament->slug) }}';
    </script>
    {!! Html::script('js/facebook.js') !!}
@stop
