@extends('pdf.scoresheets.master')
@section('content')
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


