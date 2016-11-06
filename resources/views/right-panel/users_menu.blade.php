<!-- Detached sidebar -->
<div class="sidebar-detached">
    <div class="sidebar sidebar-default">
        <div class="sidebar-content">

            <!-- Sub navigation -->
            <div class="sidebar-category">
                <div class="category-title">
                    <span>{{trans('core.sumary') }}</span>
                    <ul class="icons-list">
                        <li><a href="#" data-action="collapse"></a></li>
                    </ul>
                </div>

                <div class="category-content no-padding">
                    <ul class="navigation navigation-alt navigation-accordion">
                        @foreach($tournament->championships as $championship)

                            <li><a href="#{{ str_slug($championship->category->buildName($grades), "-") }}"></i>
                                    <div>
                                        <?php

                                        $name = $championship->category->buildName($grades);
                                        echo str_limit($name, 25);


                                        ?>

                                        <span data-id="{{ $championship->id}}"
                                              class="menu label  label-striped">{{  sizeof($championship->users) }}</span>
                                    </div>
                                </a>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- /sub navigation -->


        </div>

    </div>
    @if (App::environment('production'))
        <a href="{{ route('workingonit') }}"
           data-target="#create_tournament_user"
           class="btn bg-teal btn-xs pull-right mr-10"><b>
                {{ trans_choice('core.generate_tree',2) }}</b>
        </a>

    @else
        {!! Form::model(null, [
            'method' => 'POST', 'id' => 'storeAllTree', 'class'=>'full-width',
            'route' => ['storeAllTree', $tournament->slug]
            ])   !!}


        <button type="submit" class="btn bg-teal pt-10 pb-10  mt-10 full-width ">
            <b><i class="icon-tree7 mr-5 "></i>{{ trans_choice('core.generate_tree',2) }}
            </b>


        </button>


        {!! Form::close() !!}
    @endif
</div>
<!-- /detached sidebar -->