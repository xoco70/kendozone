<!-- Detached sidebar -->
<?php
$groups = $users->groupBy('tcId');

?>
<div class="sidebar-detached">
    <div class="sidebar sidebar-default">
        <div class="sidebar-content">

            <!-- Sub navigation -->
            <div class="sidebar-category">
                <div class="category-title">
                    <span>{{Lang::get('core.sumary') }}</span>
                    <ul class="icons-list">
                        <li><a href="#" data-action="collapse"></a></li>
                    </ul>
                </div>

                <div class="category-content no-padding">
                    <ul class="navigation navigation-alt navigation-accordion">
                        @foreach($groups as $group)

                            <li><a href="#"></i>
                                    <?php
                                    $tc = \App\TournamentCategory::findOrFail($group->get(0)->tcId);
                                    $name = $tc->category->name;
                                    echo $name;
                                    ?>

                                        <span class="label  label-striped">{{  sizeof($group) }}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- /sub navigation -->


        </div>
    </div>
</div>
<!-- /detached sidebar -->