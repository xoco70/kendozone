@extends('layouts.pdf')
@section('content')
    @include('laravel-tournaments::partials.tree.preliminary', ['show_tree' => true])
@stop
@section('footer')
    @include('pdf.footer')
@stop

