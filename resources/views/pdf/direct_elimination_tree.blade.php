@extends('layouts.pdf')
@section('content')
    @include('laravel-tournaments::partials.tree.directElimination', ['hasPreliminary' => 1])
@stop
{{--@section('footer')--}}
    {{--@include('pdf.footer', ['championship' => $championship])--}}
{{--@stop--}}
@section('scripts_footer')
    {!! Html::style('css/pages/preliminary_trees.css')!!}
@stop


