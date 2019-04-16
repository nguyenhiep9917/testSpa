<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $table = "province";

    public function district()
    {
    	return $this->hasMany('App\District','province_id','province_id');
    }



    //
    public $timestamps = false;

}
