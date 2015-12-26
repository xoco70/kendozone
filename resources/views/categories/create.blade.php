@extends('layouts.dashboard')
@section('content')

    @include("errors.list")

    <div class="container">
        <div class="row col-md-10 custyle">

            {!! Form::open(['url'=>"tournaments/$tournamentId/categories/$categoryId/settings", 'enctype' => 'multipart/form-data']) !!}

                @include('layouts.categorySettings')

            {!! Form::close()!!}
        </div>
    </div>
    <script>

        $(function () {
            $(".switch").bootstrapSwitch();
        });
    </script>

@stop

