@extends('layouts.dashboard')
@section('content')

    @include("errors.list")

    <div class="container">
        <div class="row col-md-10 col-md-offset-2 custyle">

            {!! Form::model(null,
                ['method'=>"PATCH",
                 "action" => ["TournamentUserController@update",
                 'tournamentId' => $tournament->id,
                 'userId' => $user->id
                 ]]) !!}

            <div class="container-fluid">


                <div class="content">

                    <!-- Detached content -->
                    <div class="container-detached">
                        <div class="content-detached">

                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <div class="container-fluid">

                                        {{--Tournament Categories --}}
                                        <div class="row">
                                            <legend class="text-semibold">{{Lang::get('core.select_competitor_categories')}}</legend>
                                            @foreach($tournament->categories as $key => $category)

                                                <?php
                                                $Championship = DB::table('championship')
                                                        ->where('tournament_id', $tournament->id)
                                                        ->where('category_id', $category->id)
                                                        ->first();
                                                $old = DB::table('championship_user')
                                                        ->where('championship_id', $Championship->id)
                                                        ->where('user_id', $user->id)
                                                        ->count();
                                                ?>

                                                @if ($key % 3 == 0)
                                                    <div class="row">
                                                        @endif
                                                        <div class="col-md-4">
                                                            <p>

                                                                {!!  Form::label('cat['.$key.']', trans($category->name)) !!}
                                                                <br/>
                                                                {!!   Form::checkbox('cat['.$key.']', $Championship->id,$old, ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No" ]) !!}
                                                            </p>
                                                        </div>
                                                        @if ($key % 2 == 0 && $key != 0)
                                                    </div>
                                                @endif

                                            @endforeach
                                        </div>



                                        <div align="right">
                                            <button type="submit"
                                                    class="btn btn-success">{{trans("core.save")}}</button>
                                        </div>
                                    </div>


                                </div>

                            </div>


                        </div>


                    </div>


                </div>
            </div>


            {!! Form::close()!!}
        </div>
    </div>
@stop
@section('scripts_footer')
    {!! Html::script('js/pages/header/tournamentUserEdit.js') !!}
    <script>

        $(function () {
            $(" .switch").bootstrapSwitch();
        });
    </script>

@stop


