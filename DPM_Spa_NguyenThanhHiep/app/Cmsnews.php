<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cmsnews extends Model
{
	protected $table = "cmsnews";
	protected $primaryKey = 'cmsnews_id';


    //
    public $timestamps = false;
}
