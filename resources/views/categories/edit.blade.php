@extends('layouts.dashboard')
@section('content')

    @include("errors.list")

    <div class="container">
        <div class="row col-md-10 custyle">
            <?php
            $category = \App\Category::findOrFail($categoryId);
            ?>
            <h2 align="center">{{ $category->name }}</h2>
            {!! Form::model($categorySetting,
                ['method'=>"PATCH",
                 "action" => ["CategorySettingsController@update",
                 $tournamentId,
                 $categoryId,
                 $categorySetting->id]]) !!}

            <div class="panel panel-flat">

                <div class="panel-body">
                    <div class="container-fluid">


                        @include('categories.categorySettings')

                        {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop