@extends('layouts.dashboard')

@section('content')
    @include("errors.list")
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">Basic example</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        CARD1
    </div>
@stop