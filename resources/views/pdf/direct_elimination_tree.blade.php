@extends('layouts.pdf')
@section('content')
    @include("layouts.tree.directElimination")
@stop
@section('footer')
    @include('pdf.footer', ['championship' => $championship])
@stop
@section('scripts_footer')
    {!! Html::style('css/pages/preliminary_trees.css')!!}
@stop


