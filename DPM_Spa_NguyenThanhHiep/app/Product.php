<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "product";
    //

    public function catalogy()
    {
    	return $this->hasMany('App\Catalogy','catalogy_id','id');
    }
    public function users()
    {
    	return $this->hasMany('App\User','user_id','id');
    }
    public function price()
    {
        return $this->hasMany('App\Price','price_id','id');
    }
    public function product_image()
    {
        return $this->hasMany('App\Product_image','image_id','id');
    }
    public $timestamps = false;
}
