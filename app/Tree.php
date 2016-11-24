<?php

namespace App;


use App\TreeGen\PreliminaryTreeGen;
use DaveJamesMiller\Breadcrumbs\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use OwenIt\Auditing\AuditingTrait;

class Tree extends Model
{
    protected $table = 'tree';
    public $timestamps = true;
    protected $guarded = ['id'];
    use AuditingTrait;

    public static function hasTournament($request)
    {
        return $request->tournamentSlug != null;
    }

    public static function hasChampionship($request)
    {
        return $request->championshipId != null; // has return false, don't know why
    }

    public static function getTournament($request)
    {
        $tournament = new Tournament;
        if (Tree::hasTournament($request)) {
            $tournamentSlug = $request->tournamentSlug;
            $tournament = Tournament::with(
                'championships.settings',
                'championships.category',
                'championships.tree.user1',
                'championships.tree.user2',
                'championships.tree.user3',
                'championships.tree.user4',
                'championships.tree.user5'

            )->where('slug', $tournamentSlug)->first();
        } elseif (Tree::hasChampionship($request)) {
            $tournamentSlug = Championship::find($request->championshipId)->tournament->slug;
            $tournament = Tournament::with([
                'championships' => function ($query) use ($request) {
                    $query->where('id', '=', $request->championshipId);
                },
                'championships.settings',
                'championships.category',
                'championships.tree.user1',
                'championships.tree.user2',
                'championships.tree.user3',
                'championships.tree.user4',
                'championships.tree.user5'
            ])->first();
        }

        return $tournament;
    }


    /**
     * @param $request
     * @return Collection
     */
    public static function getChampionships($request)
    {

        $championships = new Collection();
        if (Tree::hasChampionship($request)) {
            $championship = Championship::with('settings', 'category')->find($request->championshipId);
            $championships->push($championship);
        } else if (Tree::hasTournament($request)) {

            $tournament = Tournament::with(
                'championships.settings',
                'championships.category',
                'championships.tree.user1',
                'championships.tree.user2',
                'championships.tree.user3',
                'championships.tree.user4',
                'championships.tree.user5'

            )->where('slug', $request->tournamentId)->first();

            $championships = $tournament->championships;
        }
        return $championships;
    }

    public function championship()
    {
        return $this->belongsTo(Championship::class);
    }

    public function fights()
    {
        return $this->hasMany(Fight::class, 'tree_id', 'id');
    }

    public function user1()
    {
        return $this->belongsTo(User::class, 'c1', 'id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'c2', 'id');
    }

    public function user3()
    {
        return $this->belongsTo(User::class, 'c3', 'id');
    }

    public function user4()
    {
        return $this->belongsTo(User::class, 'c4', 'id');
    }

    public function user5()
    {
        return $this->belongsTo(User::class, 'c5', 'id');
    }


    public static function getGenerationStrategy(Championship $championship)
    {
        $tournament = $championship->tournament;
        switch ($tournament->level_id) {
            case Config::get('constants.ND'):
                return new PreliminaryTreeGen($championship, null);
                break;
            case Config::get('constants.local'):
                return new PreliminaryTreeGen($championship, null);
                break;
            case Config::get('constants.district'):
                return new PreliminaryTreeGen($championship, 'club_id');
                break;
            case Config::get('constants.city'):
                return new PreliminaryTreeGen($championship, 'club_id');
                break;
            case Config::get('constants.state'):
                return new PreliminaryTreeGen($championship, 'club_id');
                break;
            case Config::get('constants.regional'):
                return new PreliminaryTreeGen($championship, 'club_id');
                break;
            case Config::get('constants.national'):
                return new PreliminaryTreeGen($championship, 'association_id');
                break;
            case Config::get('constants.international'):
                return new PreliminaryTreeGen($championship, 'federation_id');
                break;
        }
        return null;

        // get Area number
        // get tournament type, and get criteria to repart
        // repart into areas
        // Shuffle
        // Analyse Number of competitors to repart Byes
        // Store / Print

    }

    public static function generateFights(Collection $tree)
    {

        // Delete previous fight for this championship

        $arrayTreeId = $tree->map(function ($value, $key) {
            return $value->id;
        })->toArray();
//        Fight::destroy($arrayTreeId);
        foreach ($tree as $treeGroup) {
            // First limited to 3 competitors in Preliminary
            // Fights will be be generated like that: A -> B, B -> C, C -> A
            try {
                $fight = Fight::create([
                        'tree_id' => $treeGroup->id,
                        'c1' => $treeGroup->c1 != null
                            ? $treeGroup->c1->id
                            : null,
                        'c2' => $treeGroup->c2 != null
                            ? $treeGroup->c2->id
                            : null]
                );

//                $fight1 = new Fight;
//                $fight1->c1 = $treeGroup->c1;
//                $fight1->c2 = $treeGroup->c2;
//                $fight1->save();
//                $fight2 = new Fight($treeGroup->c2, $treeGroup->c3);
//                $fight2->save();
//                $fight3 = new Fight($treeGroup->c3, $treeGroup->c1);
//                $fight3->save();
            } catch (Exception $e) {
                dd($e->getMessage());
            }

        }


        return null;
    }
}