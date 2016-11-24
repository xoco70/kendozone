<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
    public $c1, $c2;
    /**
     * Fight constructor.
     */
    public function __construct($userId1=null, $userId2=null)
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

}