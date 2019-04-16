<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    //
    protected $table = "properties";
    //
    public function properties_option()
    {
    	return $this->hasMany('App\Properties_option','properties_id','id');
    }
    public $timestamps = false;
}
