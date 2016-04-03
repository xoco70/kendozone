@extends('layouts.dashboard')
@section('content')

    @include("errors.list")

    <div class="container">

            @include("users.form", ["submitButton" => trans('core.updateModel',['currentModelName' => $currentModelName]) ])

    </div>
@stop