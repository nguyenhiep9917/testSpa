<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    protected $table = "district";

    public function commune()
    {
    	return $this->hasMany('App\Commune','district_id','district_id');
    }
    //
    public function province()
    {
    	return $this->belongsTo('App\Province', 'province_id', 'district_id');
    }

    //
    public $timestamps = false;
}
