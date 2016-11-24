<?php


namespace App\TreeGen;


use App\Championship;
use App\ChampionshipSettings;
use App\Contracts\TreeGenerable;
use App\Exceptions\TreeGenerationException;
use App\Tree;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class PreliminaryTreeGen implements TreeGenerable
{

    protected $groupBy;
    public $championship, $error;


    public function __construct(Championship $championship, $groupBy)
    {
        $this->championship = $championship;
        $this->groupBy = $groupBy;
//        $this->error = null;
    }

    /**
     * @return Collection
     * @throws TreeGenerationException
     */
    public function run()
    {
        $this->championship->tree()->delete();
        $preliminiaryTree = new Collection();
        $settings = $this->championship->settings ??  new ChampionshipSettings(config('options.default_settings'));
        // Get Areas
        $areas = $settings->fightingAreas;
        if ($this->championship->users->count() / $areas < config('constants.MIN_COMPETITORS_X_AREA')) {
            throw new TreeGenerationException(trans('msg.min_competitor_required', ['number' => Config::get('constants.MIN_COMPETITORS_X_AREA')]));

        }
        // Get Competitor's list
        if ($this->groupBy == null) {
            $users = $this->championship->users; // Single Collection -  Easier

        } else {
            $users = $this->getUsersByEntity();
        }


        // Chunk user by areas

        $usersByArea = $users->chunk(sizeof($users) / $areas);

        $area = 1;

        // loop on areas
        foreach ($usersByArea as $users) {

            // Chunking to make small round robin groups
            if ($this->championship->hasPreliminary()){
                $roundRobinGroups = $users->chunk(3)->shuffle();
            } // , $settings->roundRobinGroupSize
            else{
                $roundRobinGroups = $users->chunk(2)->shuffle();
            }

            $order = 1;

            // Before doing anything, check last group if numUser = 1
            foreach ($roundRobinGroups as $robinGroup) {
                $robinGroup = $robinGroup->shuffle()->values();

                $pt = new Tree;
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
                if (isset($c5)) $pt->c5 = $c5->id;
//                dd($pt);
                $pt->save();
                $preliminiaryTree->push($pt);
                $order++;
            }
            $area++;
        }
        return $preliminiaryTree;
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
        // We must add another group that has bye

        $byeGroup = $this->getByeGroup($this->championship);
        $userGroups->push($byeGroup);

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

//    private function chunk_by_num_competitor_by_area(Collection $users, $roundRobinGroupSize = 3)
//    {
//        $newUsers = new Collection();
//        $groupsConfig = Config::get(('options.chunk_by_num_competitor_by_area.15'));
//        foreach ($groupsConfig as $groupSize){
//             $splice = $users->splice(0,$groupSize);
//            $newUsers->push($splice);
//        }
//        dd($newUsers);
//        return $newUsers;
//    }

    private function getByeGroup(Championship $championship)
    {
        $groupSizeDefault = 3;
        // Deterime Bye Quantity

        $userCount = $championship->users->count();
        if ($championship->isDirectEliminationType()){
            $preliminaryGroupSize = 2;
        }else{
            $preliminaryGroupSize = $championship->settings != null
                ? $championship->settings->preliminaryGroupSize
                : "3";

        }


        $treeSize = $this->getTreeSize($userCount, $preliminaryGroupSize);

        $byeCount = $treeSize - $userCount;

        return $this->createNullsGroup($byeCount);
    }

    /**
     * @param $userCount
     * @return integer
     */
    private function getTreeSize($userCount, $groupSize)
    {
        $square = collect([2, 4, 8, 16, 32, 64]);
        $squareMultiplied = $square->map(function ($item, $key) use ($groupSize) {
            return $item * $groupSize;
        });
        foreach ($squareMultiplied as $limit) {
            if ($userCount < $limit) {

                return $limit;
            }
        }
        return 64 * $groupSize;

    }

    /**
     * @param $byeCount
     * @return Collection
     */
    private function createNullsGroup($byeCount):Collection
    {
        $nullUser = new User();

        $byeGroup = new Collection();
        for ($i = 0; $i < $byeCount; $i++) {
            $byeGroup->push($nullUser);
        }
        return $byeGroup;
    }
}