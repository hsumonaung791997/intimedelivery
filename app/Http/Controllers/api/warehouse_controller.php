<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class warehouse_controller extends Controller
{
    public function route_list(Request $request)
    {
    	$api_key="04f38d5f332a9410d3aa737eff3b2698";
 		$apikey=$request->input('api_key');
 		$postman_id=$request->input('postman_id');

 		if($apikey==$api_key){
 			$result=DB::select("SELECT rp.address as address,ts.name as t_name,s.name as s_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as price_per_item,p.product_name as product_name,dp.user_name as postman_name,dp.delivery_name as delivery_name,rp.id as route_plan_id,p.p_id as product_id,p.product_id as p_id
                            FROM postman_route as pr
                            JOIN township as ts
                            ON pr.township_id=ts.id
                            JOIN route_plan as rp
                            ON rp.id=pr.p_id
                            JOIN delivery_postman as dp
                            ON dp.id=pr.postman_id
                            JOIN state as s
                            ON ts.state_id=s.id
                            JOIN product as p
                            ON p.product_id=rp.product_id 
                            LEFT JOIN route_planning as r_p
                            ON r_p.plan_id=rp.id
                            WHERE pr.postman_id='$postman_id' AND r_p.status=0 
 						");
 			if (count($result)<0) {
 			return response()->json(['status'=>true,'result'=>'No Data']);
 			}else{
 			return response()->json(['status'=>true,'result'=>$result]);
 			}

 		}
 		else
 		{
 			return response()->json(['status'=>false]);

 		}
    }
  
}
