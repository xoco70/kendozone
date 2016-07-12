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
                        @foreach($tournament->categoryTournaments as $categoryTournament)

                            <li><a href="#{{ str_slug($categoryTournament->category->buildName($grades), "-") }}"></i>
                                    <div>
                                        <?php

                                        $name = $categoryTournament->category->buildName($grades);
                                        echo str_limit($name, 25);


                                        ?>

                                        <span data-id="{{ $categoryTournament->id}}"
                                              class="menu label  label-striped">{{  sizeof($categoryTournament->users) }}</span>
                                    </div>
                                </a>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @if($link!="")

                <div class="sidebar-category">

                    <div class="category-content no-padding">
                        <a href="{!!   $link !!}" id="generate_tree"
                           class="btn bg-teal btn-xs pull-right p-20 ml-20 mt-20 full-width"  ><b><i
                                        class="icon-tree7 mr-5 "></i>{{ trans('core.generate_trees') }}</b>
                        </a>

                    </div>
                </div>
        @endif

        <!-- /sub navigation -->


        </div>
    </div>
</div>
<!-- /detached sidebar -->