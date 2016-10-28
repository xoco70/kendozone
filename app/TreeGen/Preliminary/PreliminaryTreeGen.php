<?php


namespace App\TreeGen\Preliminary;


use App\Championship;
use App\ChampionshipSettings;
use App\Contracts\PreliminaryTreeGenerable;
use App\PreliminaryTree;
use Illuminate\Support\Collection;

class PreliminaryTreeGen implements PreliminaryTreeGenerable
{

    protected $championship, $groupBy;

    public function __construct(Championship $championship, $groupBy)
    {
        $this->championship = $championship;
        $this->groupBy = $groupBy;
    }

    /*
     * TODO Definir: Min competitor by championship
     *               Min competitor by areas
     *
     */
    public function run()
    {
        $preliminiaryTress = new Collection();
        $settings = $this->championship->settings ??  new ChampionshipSettings(config('options.ikf_settings')[3]);

        // Get Areas
        $areas = $settings->fightingAreas;

        // Get Competitor's list
        if ($this->groupBy == null) {
            $users = $this->championship->users; // Single Collection -  Easier
        } else {
            $users = $this->getUsersByEntity();
        }

        // Chunk list by Areas

//        dump(sizeof($users));
//        dump($areas);
        $usersByArea = $users->chunk(sizeof($users) / $areas);

        $area = 1;
//        dump($usersByArea);
        foreach ($usersByArea as $users) {
            $roundRobinGroups = $users->chunk($settings->roundRobinGroupSize)->shuffle();

            // Before doing anything, check last group if numUser = 1
            foreach ($roundRobinGroups as $robinGroup){
                $robinGroup = $robinGroup->shuffle()->values();

                $order = 1;
                $pt = new PreliminaryTree;
                $pt->area = $area;
                $pt->order = $order;
                $pt->championship_id = $this->championship->id;


                $c1 = $robinGroup->get(0);
                $c2 = $robinGroup->get(1);
                $c3 = $robinGroup->get(2);
                $c4 = $robinGroup->get(3);
                $c5 = $robinGroup->get(4);

                if (isset($c1)) $pt->c1 = $c1->id;
                if (isset($c2)) $pt->c2 = $c2->id;
                if (isset($c3)) $pt->c3 = $c3->id;
                if (isset($c4)) $pt->c4 = $c4->id;
                if (isset($c5)) $pt->c5 = $c5->id/**/;

                $pt->save();
                $preliminiaryTress->push($pt);
            }
            $area++;
        }
        return $preliminiaryTress;
    }

    /**
     * @param $userGroups
     * @return int
     */
    private function getMaxCompetitorByEntity($userGroups):int
    {
        $max = 0;
        foreach ($userGroups as $userGroup) {
            if (sizeof($userGroup) > $max) {
                $max = sizeof($userGroup);
            }

        }
        return $max;
    }

    /**
     * @return Collection
     */
    private function getUsersByEntity():Collection
    {
        $competitors = new Collection();

        $userGroups = $this->championship->users->groupBy($this->groupBy); // Collection of Collection
        // Get biggest group.
        $max = $this->getMaxCompetitorByEntity($userGroups);

        for ($i = 0; $i < $max; $i++) {
            foreach ($userGroups as $userGroup) {
                $competitor = $userGroup->get($i);
                if (isset($competitor)) {
                    $competitors->push($userGroup->get($i));
                }
            }
        }
        return $competitors;
    }
}