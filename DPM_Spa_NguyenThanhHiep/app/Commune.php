<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    //
    protected $table = "commune";

    public function district()
    {
    	return $this->belongsTo('App\District', 'district_id', 'commune_id');
    }
    //
    public $timestamps = false;
}
