<div class="container-fluid">


    <div class="content">

        <!-- Detached content -->
        <div class="container-detached">
            <div class="content-detached">

                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="container-fluid">


                            <fieldset title="add_competitor">
                                <legend class="text-semibold">{{Lang::get('core.add_competitor')}}</legend>
                            </fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    {!!  Form::label('username', trans('core.username')) !!}
                                    {!!  Form::text('username',null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    {!!  Form::label('email', trans('core.email')) !!}
                                    {!!  Form::email('email',null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <br/>
                            {{--Tournament Categories --}}
                            <div class="row">
                                <legend class="text-semibold">{{Lang::get('core.select_competitor_categories')}}</legend>
                                @foreach($tournament->categories as $key => $category)

                                    <?php
                                    $Championship = DB::table('championship')
                                            ->where('tournament_id', $tournament->id)
                                            ->where('category_id', $category->id)
                                            ->first();
                                    $old = DB::table('competitor')
                                            ->where('championship_id', $Championship->id)
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

                @include("right-panel.users_menu")


            </div>


        </div>


    </div>
</div>