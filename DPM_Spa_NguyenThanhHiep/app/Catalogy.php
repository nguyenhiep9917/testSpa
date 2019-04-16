<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogy extends Model
{
    protected $table = "catalogy";
    //
    public function product()
    {
    	return $this->belongTo('App\Product','id','id');
    }
    public $timestamps = false;
}
