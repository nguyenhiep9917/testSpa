<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cmssubject extends Model
{
	protected $table = "cmssubject";
	protected $primaryKey = 'cmssubject_id';

    //
    public $timestamps = false;
}
