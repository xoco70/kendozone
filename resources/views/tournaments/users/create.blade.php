@extends('layouts.dashboard')
@section('content')

    @include("errors.list")

    <div class="container">
        <div class="row col-md-10 col-md-offset-2 custyle">

            {!! Form::open(['url'=>"tournaments/$tournament->id/users/"]) !!}


            <div class="container-fluid">


                <div class="content">

                    <!-- Detached content -->
                    <div class="container-detached">
                        <div class="content-detached">

                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <div class="container-fluid">


                                        <fieldset title="add_competitor">
                                            <legend class="text-semibold">{{Lang::get('crud.add_competitor')}}</legend>
                                        </fieldset>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!!  Form::label('username', trans('crud.username')) !!}
                                                {!!  Form::text('username',null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!!  Form::label('email', trans('crud.email')) !!}
                                                {!!  Form::email('email',null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <br/>
                                        {{--Tournament Categories --}}
                                        <div class="row">
                                            <legend class="text-semibold">{{Lang::get('crud.select_competitor_categories')}}</legend>
                                            @foreach($tournament->categories as $key => $category)

                                                <?php
                                                $tournamentCategory = DB::table('category_tournament')
                                                        ->where('tournament_id', $tournament->id)
                                                        ->where('category_id', $category->id)
                                                        ->first();
                                                $old = DB::table('category_tournament_user')
                                                        ->where('category_tournament_id', $tournamentCategory->id)
                                                        ->where('user_id', Auth::user()->id)
                                                        ->count();
                                                ?>

                                                @if ($key % 3 == 0)
                                                    <div class="row">
                                                        @endif
                                                        <div class="col-md-4">
                                                            <p>

                                                                {!!  Form::label('cat['.$key.']', trans($category->name)) !!}
                                                                <br/>
                                                                {!!   Form::checkbox('cat['.$key.']', $tournamentCategory->id,$old, ['class' => 'switch', 'data-on-text'=>"Si", 'data-off-text'=>"No" ]) !!}
                                                            </p>
                                                        </div>
                                                        @if ($key % 2 == 0 && $key != 0)
                                                    </div>
                                                @endif

                                            @endforeach
                                        </div>

                                        {{--<div class="row">--}}
                                        {{--<div class="col-md-6">--}}
                                        {{--@can('CanChangeRole')--}}
                                        {{--<div class="form-group">--}}
                                        {{--{!!  Form::label('role_id', trans('crud.role')) !!}--}}
                                        {{--{!!  Form::select('role_id', $roles,old('role_id'), ['class' => 'form-control']) !!}--}}
                                        {{--</div>--}}
                                        {{--@endcan--}}
                                        {{--</div>--}}

                                        {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group">--}}
                                        {{--{!!  Form::label('password_confirmation', trans('auth.password_confirmation')) !!}--}}
                                        {{--{!!  Form::password('password_confirmation', ['class' => 'form-control']) !!}--}}
                                        {{--<p class="help-block">{{  Lang::get('crud.left_password_blank') }}</p>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}

                                        {{--</div>--}}

                                        <div align="right">
                                            <button type="submit"
                                                    class="btn btn-success">{{trans("core.save")}}</button>
                                        </div>
                                    </div>


                                </div>

                            </div>

                            @include("right-panel.users_create")


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

