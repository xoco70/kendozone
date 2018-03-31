@extends('layouts.dashboard')
@section('content')

    @include("errors.list")

    <div class="container">
        <div class="row col-md-8 custyle">

            @include("users.form", ["submitButton" => trans('core.add').'' .trans_choice('core.users',1)])

        </div>
    </div>

@stop

