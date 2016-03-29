@extends('layouts.dashboard')
@section('content')

    @include("errors.list")

    <div class="container">

            @include("users.form", ["submitButton" => trans('crud.updateModel',['currentModelName' => $currentModelName]) ])

    </div>
@stop