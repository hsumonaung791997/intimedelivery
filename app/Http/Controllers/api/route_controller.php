<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class route_controller extends Controller
{
    public function route_list(Request $request)
    {
    	$api_key="04f38d5f332a9410d3aa737eff3b2698";
 		$apikey=$request->input('api_key');
 		$postman_id=$request->input('postman_id');

 		if($apikey==$api_key){
 			$result=DB::select("SELECT rp.address as address,ts.name as t_name,s.name as s_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,p.product_name as product_name,dp.user_name as postman_name,dp.delivery_name as delivery_name,rp.id as route_plan_id,rp.phone as phone,p.product_id,p.p_id,p.product_vendor_name,p.product_size,p.product_type,rp.customer_confirm_status,rp.r_name
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
                            WHERE pr.postman_id='$postman_id' AND r_p.status=1 GROUP BY rp.id
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
    public function route_plan_detail(Request $request)
    {
        $api_key="04f38d5f332a9410d3aa737eff3b2698";
        $apikey=$request->input('api_key');
        $postman_id=$request->input('postman_id');
        $route_plan_id=$request->input('route_plan_id');
        if($apikey==$api_key){
            $result=DB::select("SELECT r_p.plan_id,r_p.delivery_postman_id as delivery_postman_id,r_p.assign_date as assign_date,r_p.notification_date as notification_date,rp.reg_date as reg_date,rp.target_date as target_date,r_p.status,s.name as division,t.name as township,r_p.address as address,r_p.quantity as quantity,r_p.amount as amount,r_p.extra_charges as extra_chages,over_tender_charges,r_p.delivery_charges as delivery_charges,r_p.paid_unpaid as payment_status,rp.r_name,rp.phone as phone,p.p_id as item_code,p.product_name,p.product_type,p.product_size,rp.id as route_plan_id,p.product_vendor_name,rp.customer_confirm_status
                FROM route_planning as r_p
                JOIN route_plan as rp
                ON rp.id=r_p.plan_id
                JOIN product as p
                ON p.p_id=r_p.product_id
                JOIN state as s
                ON s.id=r_p.division
                JOIN township as t
                ON t.id=r_p.township
                 where r_p.plan_id='$route_plan_id' AND r_p.delivery_postman_id='$postman_id' GROUP BY r_p.id
                        ");
            if (isset($result)<0) {
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
    public function customer_confirm(Request $request)
    {
       $api_key="04f38d5f332a9410d3aa737eff3b2698";
        $apikey=$request->input('api_key');
        $remark=$request->input('remark');
        $route_plan_id=$request->input('route_plan_id');
        $issue=$request->input('issue');
        $updated_at=date("Y-m-d H:i:s");
        $customer_confirm_status=$request->input('customer_confirm_status');
        if($apikey==$api_key){
            if($customer_confirm_status==1){
        DB::update("UPDATE route_plan set customer_confirm_status='$customer_confirm_status',remark='$remark',status=1,issue_type='$issue',updated_at='$updated_at' where id='$route_plan_id'");
        DB::delete("DELETE FROM postman_route where p_id='$route_plan_id'");

            return response()->json(['status'=>true]);
        }elseif ($customer_confirm_status==0) {
        DB::update("UPDATE route_plan set customer_confirm_status='$customer_confirm_status',remark='$remark',status=2,updated_at='$updated_at' where id='$route_plan_id'");
            return response()->json(['status'=>true]);
            }
        }
        else
        {
            return response()->json(['status'=>false]);

        }
    }
      public function delivery_list(Request $request)
    {
        $api_key="04f38d5f332a9410d3aa737eff3b2698";
        $apikey=$request->input('api_key');
        $postman_id=$request->input('postman_id');

        if($apikey==$api_key){
            $result=DB::select("SELECT rp.address as address,ts.name as t_name,s.name as s_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,p.product_name as product_name,dp.user_name as postman_name,dp.delivery_name as delivery_name,rp.id as route_plan_id,rp.phone as phone,p.product_id,p.p_id,p.product_vendor_name,p.product_size,p.product_type,rp.customer_confirm_status,rp.r_name
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
                            WHERE pr.postman_id='$postman_id' AND r_p.status=1 AND rp.parcel_status=0 AND rp.customer_confirm_status=0 GROUP BY rp.id
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
    public function issue_list()
    {
        $data=DB::select("SELECT * FROM issue");
        return response()->json(['data'=>$data]);
    }
}