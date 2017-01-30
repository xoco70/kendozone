<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
    /**
     * Fight constructor.
     */
    public function __construct($userId1 = null, $userId2 = null)
    {
        $this->c1 = $userId1;
        $this->c2 = $userId2;

    }

    protected $table = 'fight';
    public $timestamps = true;

    protected $fillable = [
        'tree_id',
        'c1',
        'c2'
    ];

    /**
     * Get First Fighter
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user1()
    {
        return $this->belongsTo(User::class, 'c1', 'id');
    }

    /**
     * Get Second Fighter
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user2()
    {
        return $this->belongsTo(User::class, 'c2', 'id');
    }

    /**
     * Get First Fighter
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team1()
    {
        return $this->belongsTo(Team::class, 'c1', 'id');
    }

    /**
     * Get Second Fighter
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team2()
    {
        return $this->belongsTo(Team::class, 'c2', 'id');
    }

    /**
     * Save a Fight.
     * @param $tree
     * @param int $numRound
     */
    public static function saveFightRound($tree, $numRound = 1)
    {

        $c1 = $c2 = $c3 = null;
        $order = 0;

        foreach ($tree as $treeGroup) {

            switch ($numRound) {
                case 1:
                    $c1 = $treeGroup->c1 ?? null;
                    $c2 = $treeGroup->c2 ?? null;
                    break;
                case 2:
                    $c1 = $treeGroup->c2 ?? null;
                    $c2 = $treeGroup->c3 ?? null;
                    break;
                case 3:
                    $c1 = $treeGroup->c3 ?? null;
                    $c2 = $treeGroup->c1 ?? null;
                    break;
            }
            $fight = new Fight();
            $fight->tree_id = $treeGroup->id;
            $fight->c1 = $c1;
            $fight->c2 = $c2;
            $fight->order = $order++;
            $fight->area = $treeGroup->area;
            $fight->save();
        }
    }


    public static function saveRoundRobinFight(Championship $championship, $tree)
    {
        $championship->category->isTeam
            ? $fighters = $championship->teams
            : $fighters = $championship->users;

        $reverseFighters = $fighters->reverse();
        $order = 0;
        foreach ($reverseFighters as $reverse) {
            foreach ($fighters as $fighter) {
                if ($fighter->id != $reverse->id) {
                    $fight = new Fight();
                    $fight->tree_id = $tree[0]->id;
                    $fight->c1 = $fighter->id;
                    $fight->c2 = $reverse->id;
                    $fight->order = $order++;
                    $fight->area = 1;
                    $fight->save();
                    $order++;
                }
            }
        }
    }

}