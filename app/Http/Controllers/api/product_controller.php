<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class product_controller extends Controller
{
  public function product_drop(Request $request)
  {
  	   	$api_key="04f38d5f332a9410d3aa737eff3b2698";
 		$apikey=$request->input('api_key');
 		$postman_id=$request->input('postman_id');
 		$route_plan_id=$request->input('route_plan_id');
    $updated_at=date("Y-m-d H:i:s");
 		$payment=$request->input('payment');
 		if($apikey==$api_key){
 			DB::update("UPDATE route_planning SET status=3,paid_unpaid='$payment' where plan_id='$route_plan_id' AND delivery_postman_id='$postman_id'
 						");
 			DB::update("UPDATE route_plan SET status=3,updated_at='$updated_at' where id='$route_plan_id'");
 			DB::update("UPDATE postman_route SET status=3 where p_id='$route_plan_id'");
 			return response()->json(['status'=>true]);
 			}else{
 				return response()->json(['status'=>false]);
 			};
	}
	public function stock_list(Request $request)
    {
    	$api_key="04f38d5f332a9410d3aa737eff3b2698";
 		$apikey=$request->input('api_key');
 		$postman_id=$request->input('postman_id');

 		if($apikey==$api_key){
 			$result=DB::select("SELECT p.product_name as product_name,p.p_id as p_id,p.product_id as product_id,rp.quantity as quantity,p.product_size as product_size,p.product_type as product_type,rp.target_date as target_date,rp.phone as phone
 				FROM postman_route as pr 
 				JOIN route_plan as rp
 				ON pr.p_id=rp.id
 				JOIN product as p 
 				ON p.product_id=rp.product_id
 				WHERE rp.status=2 AND pr.postman_id='$postman_id'
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
    public function stock_out(Request $request,$apiKey,$postman_id)
    {
    	$api_key="04f38d5f332a9410d3aa737eff3b2698";
 		// $apiKey=$request->input('apiKey');
    	// $postman_id=$request->input('postman_id');
    	$created_at=date('Y-m-d H:i:s');
    	$p_id=$request->all();
   			$result=json_encode($p_id, true);
        $data=json_decode($result, true);
        // dd($data);

   			if($apiKey==$api_key){
   			$i=-1;
   			foreach ($data as $row) {
   				$i++;

   				$reg_date=$data[$i]['reg_date'];
   				$target_date=$data[$i]['target_date'];
   				$qty=$data[$i]['qty'];
   				$amount=$data[$i]['price_per_item'];
   				$route_plan_id=$data[$i]['route_plan_id'];
   				$product_id=$data[$i]['product_id'];
          $postman_name=$data[$i]['postman_name'];
   				$p_id=$data[$i]['p_id'];
          $address=$data[$i]['address'];
          $t_name=$data[$i]['t_name'];
          $s_name=$data[$i]['s_name'];
          $location=$address.$t_name.$s_name;
          // $route_plan_id=$data[$i]['route_plan_id'];com
   				$total=$amount*$qty;
				DB::insert("INSERT INTO stock_out  (product_id,price_per_item,out_qty,postman_id,created_at) VALUES(?,?,?,?,?)",[$product_id,$amount,$qty,$postman_id,$created_at,]);
				DB::insert("INSERT INTO stock_in_out_return(product_id,verified_date,remark_quantity,product_price_per_item,stock_out,created_at,product_amount,postman_id) VALUES(?,?,?,?,?,?,?,?)",[$product_id,$created_at,$qty,$amount,$qty,$created_at,$total,$postman_id]);
   				}
 			return response()->json(['status'=>true]);

   			}else{
 			return response()->json(['status'=>false]);

   			}
       }
       public function product_return(Request $request)
  {
    $api_key="04f38d5f332a9410d3aa737eff3b2698";
    $apikey=$request->input('api_key');
    $item_code=$request->input('item_code');
    $postman_id=$request->input('postman_id');
    $route_plan_id=$request->input('route_plan_id');
    $payment=$request->input('payment');
    $remark=$request->input('remark');
    $created_at=date("Y-m-d H:i:s");
    $price_per_item=$request->input('amount');
    $quantity=$request->input('quantity');
    $notification_date=$request->input('notification_date');
    $noti_date=date('Y-m-d',strtotime($notification_date));
    // dd($noti_date);
    $product_amount=$price_per_item*$quantity;
    if($apikey==$api_key){
    DB::update("UPDATE route_planning SET status=5,paid_unpaid='$payment',remark='$remark',notification_date='$noti_date' where plan_id='$route_plan_id' AND delivery_postman_id='$postman_id'
            ");
      DB::update("UPDATE route_plan SET status=5,customer_confirm_status=2,parcel_status=0 where id='$route_plan_id'");
      DB::update("UPDATE postman_route SET status=5 where p_id='$route_plan_id'");
      DB::insert("INSERT INTO stock_in_out_return (product_id,verified_date,product_price_per_item,remark_quantity,product_amount,stock_in,reason_in_out_return,created_at,postman_id) VALUES(?,?,?,?,?,?,?,?,?)",[$item_code,$created_at,$price_per_item,$quantity,$product_amount,$quantity,$remark,$created_at,$postman_id]);
      DB::insert("INSERT INTO stock_in (product_id,in_qty,price_per_item,postman_id,created_at) VALUES(?,?,?,?,?)",[$item_code,$quantity,$price_per_item,$postman_id,$created_at]);
      // DB::insert("INSERT INTO product_return (product_id,route_plan_id,product_price_per_item,quantity,product_amount,stock_in,reason_in_out_return,created_at,postman_id) VALUES(?,?,?,?,?,?,?,?,?)",[$item_code,$route_plan_id,$price_per_item,$quantity,$product_amount,$quantity,$remark,$created_at,$postman_id]);
      DB::delete("DELETE FROM stock_out where plan_id='$route_plan_id'");
      return response()->json(['status'=>true]);
      }else{
        return response()->json(['status'=>false]);
      };
  }
   public function drop_list(Request $request)
    {
        $api_key="04f38d5f332a9410d3aa737eff3b2698";
        $apikey=$request->input('api_key');
        $postman_id=$request->input('postman_id');

        if($apikey==$api_key){
            $result=DB::select("SELECT rp.address as address,ts.name as t_name,s.name as s_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,p.product_name as product_name,dp.user_name as postman_name,dp.delivery_name as delivery_name,rp.id as route_plan_id
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
                            WHERE pr.postman_id='$postman_id' AND r_p.status=3 
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
    public function return_list(Request $request)
    {
        $api_key="04f38d5f332a9410d3aa737eff3b2698";
        $apikey=$request->input('api_key');
        $postman_id=$request->input('postman_id');

        if($apikey==$api_key){
            $result=DB::select("SELECT rp.address as address,ts.name as t_name,s.name as s_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,p.product_name as product_name,dp.user_name as postman_name,dp.delivery_name as delivery_name,rp.id as route_plan_id,r_p.remark
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
                            WHERE pr.postman_id='$postman_id' AND r_p.status=5 
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
 public function take_out_list()
 {
  
 }
}
