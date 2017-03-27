@extends('pdf.scoresheets.master')
@section('content')
    <?php
    if ($championship->category->isTeam()) {
        $fighters = $championship->teams;
    } else {
        $fighters = $championship->competitors;
    }
    $roundTitles = $championship->getRoundTitle(sizeof($fighters));
    ?>
    @forelse($championship->fightersGroups as $group)
        @include('layouts.scoresheets.sheet', ['group' => $group])
    @empty
        {{ trans('core.still_no_scoresheet') }}
    @endforelse
@stop
{{--@section('footer')--}}
{{--@include('pdf.footer')--}}
{{--@stop--}}
{{--@section('scripts_footer')--}}
{{--    {!! Html::style('css/pages/preliminary_trees.css')!!}--}}
{{--@stop--}}


