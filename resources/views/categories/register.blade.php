<?php
$championships = $tournament->championships;
$i = 0;
?>

@extends('layouts.dashboard')
@section('content')

    @include("errors.list")

    <div class="container">
        <div class="row col-md-10 custyle">

            <h2 align="center">{{ $tournament->name }}</h2>
            @if (isset($invite))
                {!! Form::open(['url'=> URL::action('ChampionshipController@store',
                    ['tournament' => $tournament->slug,'invite' => $invite->id] )]) !!}
            @else
                {!! Form::open(['url'=> URL::action('ChampionshipController@store',
                    ['tournament' => $tournament->slug,'invite' => 0] )]) !!}

            @endif
            <div class="panel panel-flat">

                <div class="panel-body">
                    <div class="container-fluid">
                        <legend class="text-semibold">{{trans('core.select_categories_to_register')}}</legend>


                        @foreach($championships as $championship)
                            @if ($i % 4 == 0)
                                <div class="row">
                                    @endif
                                    <div class="col-md-3">
                                        <p>
                                            {!!  Form::label('cat['.$championship->id.']', $championship->category->buildName($grades)) !!}
                                            <br/>
                                            {!!   Form::checkbox('cat['.$championship->id.']',
                                                $championship->id,
                                                $championship->users->where('users.id',Auth::user()->id)->count(),
                                                 ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No" ]) !!}
                                        </p>
                                    </div>
                                    @if ($i % 3 == 0 && $i != 0)
                                </div>

                            @endif
                            <?php $i++; ?>
                        @endforeach

                    </div>
                    <div align="right">
                        <button type="submit" class="btn btn-success">{{trans("core.save")}}</button>
                    </div>
                </div>
            </div>
            {!! Form::close()!!}

        </div>
    </div>
@stop
@section('scripts_footer')
    <script>

        $(function () {
            $(".switch").bootstrapSwitch();
        });
    </script>
@stop

