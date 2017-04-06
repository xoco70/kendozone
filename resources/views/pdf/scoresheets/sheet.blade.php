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

    @include('layouts.scoresheets.sheets')
@stop
@section('footer')
    @include('pdf.footer')
@stop
{{--@section('scripts_footer')--}}
    {{--{!! Html::style('css/pages/preliminary_trees.css')!!}--}}
{{--@stop--}}


