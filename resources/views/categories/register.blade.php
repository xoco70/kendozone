@extends('layouts.dashboard')
@section('content')

    @include("errors.list")

    <div class="container">
        <div class="row col-md-10 custyle">
            <?php
            $tournament = \App\Tournament::findOrFail($tournamentId);
            ?>
            <h2 align="center">{{ $tournament->name }}</h2>

            <div class="panel panel-flat">

                <div class="panel-body">
                    <div class="container-fluid">


                        {!! Form::open(['url'=>"tournaments/", 'enctype' => 'multipart/form-data']) !!}
                        <h6 class="coutent-group">Selecciona las categorias del torneo en las cuales deseas
                            participar</h6>




                    @foreach($tournament->categories as $key => $category)
                            @if ($key % 4 == 0)
                                <div class="row">
                                    @endif
                                    <div class="col-md-3">
                                        <p>
                                            {!!  Form::label($category->id, trans($category->name)) !!} <br/>
                                            {!!   Form::hidden($category->id, 0) !!}
                                            {!!   Form::checkbox($category->id, 0,0, ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No" ]) !!}
                                        </p>
                                    </div>
                                    @if ($key % 3 == 0 && $key != 0)
                                </div>
                            @endif

                        @endforeach
                        <div align="right">
                            <button type="submit" class="btn btn-success">{{trans("core.save")}}</button>
                        </div>
                    </div>

                </div>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
    <script>

        $(function () {
            $(" .switch").bootstrapSwitch();
        });
    </script>

@stop

