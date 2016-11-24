<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
//    public $c1, $c2;
    /**
     * Fight constructor.
     */
    public function __construct($userId1 = null, $userId2 = null)
    {
//        parent::__construct();
//        dd('construct');
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

    public static function saveFightRound($tree, $numRound)
    {
        $c1 = $c2 = $c3 = null;

        foreach ($tree as $treeGroup) {
            dump($numRound);
            switch ($numRound) {
                case 1:
                    $c1 = $treeGroup->c1 != null
                        ? $treeGroup->c1
                        : null;


                    $c2 = $treeGroup->c2 != null
                        ? $treeGroup->c2
                        : null;
                    break;
                case 2:
                    $c1 = $treeGroup->c2 != null
                        ? $treeGroup->c2
                        : null;

                    $c2 = $treeGroup->c3 != null
                        ? $treeGroup->c3
                        : null;
                    break;
                case 3:
                    $c1 = $treeGroup->c3 != null
                        ? $treeGroup->c3
                        : null;

                    $c2 = $treeGroup->c1 != null
                        ? $treeGroup->c1
                        : null;
                    break;
            }
            $fight = new Fight();
            $fight->tree_id = $treeGroup->id;
            $fight->c1 = $c1;
            $fight->c2 = $c2;
            $fight->save();
        }


    }

}