@extends('layouts.dashboard')
@section('styles')
    {!! Html::style('css/brackets.css')!!}

@stop
@section('content')
    <div id="brackets-wrapper">

        @include('layouts.tree.brackets.2fights', ['numGroup' => 1])
        @include('layouts.tree.brackets.2fights', ['numGroup' => 2])
        @include('layouts.tree.brackets.2fights', ['numGroup' => 3])
        @include('layouts.tree.brackets.2fights', ['numGroup' => 4])

    </div>
@stop
