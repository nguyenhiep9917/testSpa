<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\District;
use App\Commune;

class AjaxController extends Controller
{
    //
    public function getHuyen($idTinh)
    {
    	$data_district = District::Where('province_id', $idTinh)->get();
    	foreach ($data_district as $value)
    	{
    		echo "<option value='".$value->district_id."'>".$value->district_name."</option>";
    	}
    }
    // get Xã
    public function getXa($idHuyen)
    {
    	$data_commune = Commune::Where('district_id', $idHuyen)->get();
    	foreach ($data_commune as $value)
    	{
    		echo "<option value='".$value->commune_id."'>".$value->commune_name."</option>";
    	}
    }
}
