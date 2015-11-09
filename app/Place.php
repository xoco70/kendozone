<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model {

	protected $table = 'Place';
	public $timestamps = true;
	protected $fillable = ['name','coords','city','state','countryId'];
    protected $attributes = array(
        'countryId' => '484'
    );
    public function country()
    {
        return $this->hasOne('Country');
    }



}