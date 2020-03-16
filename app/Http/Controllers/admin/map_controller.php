<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class map_controller extends Controller
{
    public function map_realtime($id)
    {
    	$result=DB::select("SELECT * FROM postman_location where postman_id='$id'");
    	foreach ($result as $row) {
    		# code...
    	}
    	echo $json = '{"geometry": {"type": "Point", "coordinates": [' . $row->lon . ', ' . $row->lat . ']}, "type": "Feature", "properties": {}}';
    }
    public function index()
    {
    	$result=DB::select("SELECT  pl.lat,pl.lon,dp.user_name,dp.ph_one	
    				FROM postman_location as pl 
    				JOIN delivery_postman as dp
    				ON dp.id=pl.postman_id
    		");
    	return view('admin/map_overview',['result'=>$result]);
    	// dd($result);
    }
    public function search()
    {
    	return view("admin/map_overview");
    }
}
