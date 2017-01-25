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
        // Get Competitor's list ordered by entities
        $users = $this->getUsersByEntity();

        // Chunk user by areas

        $usersByArea = $users->chunk(sizeof($users) / $areas);

        $area = 1;

        // loop on areas
        foreach ($usersByArea as $users) {

            // Chunking to make small round robin groups
            if ($this->championship->isRoundRobinType() || $this->championship->hasPreliminary()) {
                $roundRobinGroups = $users->chunk(3)->shuffle();

            }
            else {
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
    private function getMaxCompetitorByEntity($userGroups): int
    {
        // Surely there is a Laravel function that does it ;)
        $max = 0;
        foreach ($userGroups as $userGroup) {
            if (sizeof($userGroup) > $max) {
                $max = sizeof($userGroup);
            }

        }
        return $max;
    }

    /**
     * Get Competitor's list ordered by entities
     * Countries for Internation Tournament, State for a National Tournament, etc
     * @return Collection
     */
    private function getUsersByEntity(): Collection
    {
        $competitors = new Collection();

        if (($this->groupBy) != null) {
            $userGroups = $this->championship->users->groupBy($this->groupBy); // Collection of Collection
        } else {
            $userGroups = $this->championship->users->chunk(1); // Collection of Collection
        }

        // We must add another group that has bye

        $byeGroup = $this->getByeGroup($this->championship);
        if (sizeof($byeGroup)>0){
            $userGroups->push($byeGroup->values());
        }

        // Get biggest group.
        $max = $this->getMaxCompetitorByEntity($userGroups);
        //
        for ($i = 0; $i < $max; $i++) {
            foreach ($userGroups as $userGroup) {
                $competitor = $userGroup->values()->get($i);
                if ($competitor != null) {
                    $competitors->push($competitor);
                }
            }
        }
        return $competitors;
    }

    /**
     * Calculate the Byes need to fill the Championship Tree
     * @param Championship $championship
     * @return Collection
     */
    private function getByeGroup(Championship $championship)
    {
        $groupSizeDefault = 3;

        $userCount = $championship->users->count();
        if ($championship->hasPreliminary()) {
            $preliminaryGroupSize = $championship->settings != null
                ? $championship->settings->preliminaryGroupSize
                : $groupSizeDefault;
        } else if ($championship->isDirectEliminationType()) {
            $preliminaryGroupSize = 2;

        } else {
            // No Preliminary and No Direct Elimination --> Round Robin
            $preliminaryGroupSize = 2;
            dump('Round Robin Still not implemented');
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
            if ($userCount <= $limit) {

                return $limit;
            }
        }
        return 64 * $groupSize;

    }

    /**
     * @param $byeCount
     * @return Collection
     */
    private function createNullsGroup($byeCount): Collection
    {
        $nullUser = new User();

        $byeGroup = new Collection();
        for ($i = 0; $i < $byeCount; $i++) {
            $byeGroup->push($nullUser);
        }
        return $byeGroup;
    }
}