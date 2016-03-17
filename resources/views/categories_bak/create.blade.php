@extends('layouts.dashboard')
@section('content')

    @include("errors.list")

    <div class="container">
        <div class="row col-md-10 custyle">
            <?php
                $category = \App\Category::findOrFail($categoryId);
            ?>
            <h2 align="center">{{ $category->name }}</h2>
            {!! Form::open(['url'=>"tournaments/$tournamentId/categories/$categoryId/settings", 'enctype' => 'multipart/form-data']) !!}

                @include('categories.categorySettings')

            {!! Form::close()!!}
        </div>
    </div>


@stop

