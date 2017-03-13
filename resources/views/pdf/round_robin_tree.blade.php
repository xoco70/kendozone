@extends('layouts.pdf')
@section('content')
    @include("layouts.tree.playOff")
@stop
@section('footer')
    @include('pdf.footer')
@stop
@section('scripts_footer')
    {!! Html::style('css/pages/preliminary_trees.css')!!}
@stop


