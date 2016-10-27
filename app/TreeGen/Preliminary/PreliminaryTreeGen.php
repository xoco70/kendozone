<?php


namespace App\TreeGen\Preliminary;


use App\Championship;
use App\ChampionshipSettings;
use App\Contracts\PreliminaryTreeGenerable;

class PreliminaryTreeGen implements PreliminaryTreeGenerable
{

    protected $championship, $groupBy;

    public function __construct(Championship $championship, $groupBy)
    {
        $this->championship = $championship;
        $this->groupBy = $groupBy;
    }

    public function run()
    {
        $settings = $this->championship->settings ??  new ChampionshipSettings(config('options.ikf_settings')[3]);

        // Get Areas
        $areas = $settings->fightingAreas;

        // Get Competitors by statew
        if ($this->groupBy == null){
            $users = $this->championship->users; // Single Collection -  Easier
        }else{
            $userGroups = $this->championship->users->groupBy($this->groupBy); // Collection of Collection
            foreach ($userGroups as $userGroup){
                // Parcours 15 subcollections with distinct size - Get Max Size

            }
        }



        // Distribute competitors by State
        dd('Run national Generation');
    }
}