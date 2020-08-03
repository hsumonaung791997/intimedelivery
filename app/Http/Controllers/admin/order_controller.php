<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Auth;
class order_controller extends Controller
{
	  public function __construct()
	{
		$this->middleware('auth:admin');
	}



	public function order_create()
   {
		$user_id = Auth::user()->id; 
		$state=DB::select("SELECT * FROM state ORDER BY id desc");
		$result=DB::select("SELECT * FROM order_temp where user_id='$user_id' AND status=0 ORDER  BY id desc" );
		$postmans = DB::select("SELECT * FROM delivery_postman where role_id = 0");
	 
	    $products =DB::select("SELECT * FROM product where user_id='$user_id'");
	    
		 
		if(count($result)<0){
		return view("admin/order/create");
		}else{
		return view("admin/order/create",['result'=>$result,'state'=>$state,'products'=>$products,'postmans'=>$postmans]);
		}
    }


    public function order_store(Request $request)
    {
	   	//add
	    $last_id=DB::select("SELECT o_id FROM order_table ORDER BY id DESC LIMIT 1");
	     
	    if($last_id==null){
	      $order_id=1;	
	    }
	    else{
	        $orderid=$last_id[0]->o_id;
	    	$order_id=$orderid+1;
	    }

	   	$order_date=$request->input('order_date');
	   	$description=$request->input('description');
	   	$phone = $request->input('phone');
	   	$r_name = $request->input('r_name');
	   	$address = $request->input('address');
	   	$state = $request->input('state');
	   	$township = $request->input('township');
	   	$postman = $request->input('postman');
	   	$delivery_charges = $request->input('delivery_charges');
	   	$extra_charges = $request->input('extra_charges');
	   	$payment_status = $request->input('payment_status');
	   	$vouchor_no = $request->input('vouchor_no');
	   	$charges = $extra_charges+$delivery_charges;
	   	$product_id=$request->input('product_id');
	   	$weight=$request->input('weight');
	   	$product_expire_date=$request->input('product_expire_date');
	   	$qty=$request->input('qty');
	   	$price_per_item=$request->input('price_per_item');
	   	$total_amount=$request->input('total_amount');
	   	$target_date = $request->input('target_date');
	   	$created_at=date("Y-m-d H:i:s");
   	
	    $l=-1;
	    $currenly_total=0;
	    foreach ($total_amount  as $keys) {
	        $l++;
	        $currenly_total+=$total_amount[$l]; 
	    }

	    $q=-1;
	    $current_qty=0;
	    foreach($qty as $qtys)
	    {
	    	$q++;
	    	$current_qty+=$qty[$q];
	    }

	    $user_id = Auth::user()->id;  
	    $created_at=date("Y-m-d H:i:s");

	   	if($request->input('add')){

   		   	$request->validate([
            	'description' => 'required'
        	]);

			if($product_id[0]==null && $qty[0]==null && $price_per_item[0]==null){
	   
	    		return redirect('admin/order/create');

			}
			else{
				 DB::insert("INSERT INTO order_temp (description,reg,total_amount,qty,o_id,p_id,p_weight,p_expire_date,price_per_item,created_at,user_id) VALUES(?,?,?,?,?,?,?,?,?,?,?)",[$description,$order_date,$total_amount[0],$qty[0],$order_id,$product_id[0],$weight[0],$product_expire_date[0],$price_per_item[0],$created_at,$user_id]);

				return redirect('admin/order/create');
			}
		}

	   	if($request->input('save')){

	   	 	$request->validate([
	   	 		'description' => 'required',
	            'phone' => 'required',
	            'r_name' => 'required',
	            'address' => 'required',
	            'state' => 'required',
	            'township' => 'required',
	            'postman' => 'required',
	            'delivery_charges' => 'required',
	            'vouchor_no'=> 'required',
	            'extra_charges' => 'required',
	            'payment_status' => 'required',

	        ]);	

			// if($product_id[0]==null && $qty[0]==null && $price_per_item[0]==null){

				//order_detail table create
				$order_temps = DB::select("SELECT * FROM order_temp");

				if(!empty($order_temps)){

			   		$order_temp_counts = count($order_temps);

			   		for($i=0; $i<$order_temp_counts; $i++){

			   			DB::insert("INSERT INTO order_detail(o_id,p_id,p_weight,p_expired_date,p_quantity,p_price_per_item,p_amount,user_id)VALUES(?,?,?,?,?,?,?,?)",[$order_temps[$i]->o_id,$order_temps[$i]->p_id,$order_temps[$i]->p_weight,$order_temps[$i]->p_expire_date,$order_temps[$i]->qty,$order_temps[$i]->price_per_item,$order_temps[$i]->total_amount,$order_temps[$i]->user_id]);
			   		}


					DB::insert("INSERT INTO order_table(o_id,o_description,o_register_date,o_amount_total,created_at,user_id,status,vouchor_no)VALUES(?,?,?,?,?,?,?,?)",[$order_id,$description,$order_date,$currenly_total,$created_at,$user_id,1,$vouchor_no]);


					//route_plan table create
				    $order_details = DB::select("SELECT * FROM order_detail WHERE o_id='$order_id' AND user_id='$user_id'");

				    $order_details_counts = count($order_details);

				    for($i=0; $i<$order_details_counts; $i++){
				    	 
				    	DB::insert("INSERT INTO route_plan(o_id,division,township,address,quantity,amount,
				    		total_amount,product_id,target_date,reg_date,user_id,status,phone,r_name,customer_confirm_status,parcel_status)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[$order_id,$state,
				    			$township,$address,$order_details[$i]->p_quantity,$order_details[$i]->p_price_per_item,$order_details[$i]->p_amount,$order_details[$i]->p_id,$order_details[$i]->p_expired_date,$order_date,$order_details[$i]->user_id,2,$phone,$r_name,2,0]);

				    }

				    /*DB::insert("INSERT INTO route_plan(o_id,division,township,address,quantity,
				    		total_amount,target_date,reg_date,user_id,status,phone,r_name,customer_confirm_status,parcel_status)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[$order_id,$state,
				    			$township,$address,$current_qty,$currenly_total,$target_date,$order_date,$user_id,2,$phone,$r_name,2,0]);
*/


				    //route_planning table create
				    $route_plans = DB::select("SELECT * FROM route_plan WHERE o_id='$order_id'");

				    $route_plan_counts = count($route_plans);

				    for($i=0; $i<$route_plan_counts; $i++){

				    	DB::insert("INSERT INTO route_planning(plan_id,o_id,product_id,delivery_postman_id,delivery_charges,status,extra_charges,paid_unpaid,division,township,address,quantity,amount,registration_date,target_date,customer_confirm_status)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[$route_plans[$i]->id,$route_plans[$i]->o_id,$route_plans[$i]->product_id,$postman,$delivery_charges,1,$extra_charges,$payment_status,$route_plans[$i]->division,$route_plans[$i]->township,$route_plans[$i]->address,$route_plans[$i]->quantity,$route_plans[$i]->total_amount,$route_plans[$i]->target_date,$route_plans[$i]->reg_date,2]);
				    }

				    //postman_route table create
				    $route_plannings = DB::select("SELECT * FROM route_planning where o_id= '$order_id'");

				    $route_planning_counts = count($route_plannings);

				    for($i=0; $i<$route_planning_counts; $i++){
				     	
				     	  DB::insert("INSERT INTO postman_route(township_id,status,postman_id,p_id)VALUES(?,?,?,?)",[$route_plannings[$i]->township,0,$route_plannings[$i]->delivery_postman_id,$route_plannings[$i]->plan_id]);
				     }


				     for($i=0; $i<$route_planning_counts; $i++){
				     	
				     	  DB::insert("INSERT INTO account_ledger(route_plan_id,quantity,amount,paid_unpaid,charges,route_status)VALUES(?,?,?,?,?,?)",[$route_plannings[$i]->plan_id,$route_plannings[$i]->quantity,$route_plannings[$i]->amount,$route_plannings[$i]->paid_unpaid,$charges,0]);
				     }

				  

				    DB::delete("DELETE FROM order_temp WHERE o_id='$order_id' AND user_id='$user_id'");
					
					return redirect('admin/order/list');
				}
				else{
					return redirect('admin/order/create');
				}

			// }
			// else{

			// 	$i=-1;
		 //        DB::delete("DELETE FROM order_detail where user_id='$user_id' AND o_id='$order_id' AND status=3");
			// 	foreach ($product_id as $row) {
			// 		$i++;
			// 		DB::insert("INSERT INTO order_detail(o_id,p_id,p_weight,p_expired_date,p_quantity,p_price_per_item,p_amount,created_at,user_id) VALUES(?,?,?,?,?,?,?,?,?)",[$order_id,$product_id[$i],$weight[$i],$product_expire_date[$i],$qty[$i],$price_per_item[$i],$total_amount[$i],$created_at,$user_id]);
			// 	}
	  //       	DB::insert("INSERT INTO order_table(o_id,o_description,o_register_date,o_amount_total,created_at,user_id)VALUES(?,?,?,?,?,?)",[$order_id,$description,$order_date,$currenly_total,$created_at,$user_id]);
			// 	// DB::delete("DELETE FROM order_temp WHERE o_id='$order_id' AND user_id='$user_id'");
	        	
			// 	return redirect('admin/order/list');
	  //  		}
	   }
    }


     public function order_delete($id,$order_id)
   {
        DB::delete("DELETE FROM order_table where id='$id'");
        DB::delete("DELETE FROM order_detail where o_id='$order_id'");
        DB::delete("DELETE FROM order_temp where o_id='$order_id' AND id='$id'");
        return Redirect::back();
   }
     

	public function order_list()
	{
		$page = LengthAwarePaginator::resolveCurrentPage();
		$pageSize = 50;
		$response=DB::select("SELECT o_id from order_table GROUP BY o_id ORDER BY id DESC");
		//dd($response);
		$data=DB::select("SELECT * FROM order_table");
		//dd($data);
		$res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
		$result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
		return view("admin/order/order_list",['result'=>$result,'data'=>$data]);
	}
	
	public function order_verfied()
	{   
		$page = LengthAwarePaginator::resolveCurrentPage();
		$pageSize = 50;
		$response=DB::select("SELECT   ot.o_id as o_id
					FROM order_detail as od
					JOIN order_table as ot
					ON od.o_id=ot.o_id
					where  ot.status=1
					GROUP BY od.o_id
					ORDER BY ot.id DESC
			");
		$res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
		$result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
		return view("admin/order/order_verified",['result'=>$result]);
	}

	public function order_reject()
	{
		$page = LengthAwarePaginator::resolveCurrentPage();
		$pageSize = 50;
		$response=DB::select("SELECT   ot.o_id as o_id
					FROM order_detail as od
					JOIN order_table as ot
					ON od.o_id=ot.o_id
					where  ot.status=2
					GROUP BY od.o_id
					ORDER BY ot.id DESC
			");
		$res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
		$result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
		return view("admin/order/reject_list",['result'=>$result]);
	}

	public function order_verify($id)
	{
		$updated_at=date("Y-m-d H:i:s");

		DB::update("UPDATE order_table set status=1,updated_at='$updated_at' where o_id='$id'");
		DB::update("UPDATE order_detail set updated_at='$updated_at' where o_id='$id'");
		DB::insert("INSERT INTO stock_in_out_return (product_id,order_id,verified_date,order_registration_date,remark_quantity,product_price_per_item,product_amount,stock_in) SELECT p_id,o_id,updated_at,created_at,p_quantity,p_price_per_item,p_amount,p_quantity FROM order_detail where o_id=
			'$id'");
		DB::insert("INSERT INTO stock_in (product_id,in_qty,created_at,price_per_item,o_id) SELECT p_id,p_quantity,created_at,p_price_per_item,o_id FROM order_detail where o_id='$id'");
		DB::update("UPDATE stock_in_out_return SET created_at='$updated_at' WHERE order_id='$id'");

		return Redirect::back();
	}

	public function order_search(Request $request)
	{
		$name=$request->input('name');
		$date=$request->input('date');
		$page = LengthAwarePaginator::resolveCurrentPage();
		$pageSize = 50;
		if($name!=null && $date==null){
			$response_data = DB::select("SELECT vouchor_no from order_table WHERE vouchor_no LIKE '%$name%'ORDER BY id DESC");
		}
		if($name==null && $date!=null){
		$response_data=DB::select("SELECT o_id from order_detail where created_at LIKE '%$date%'   GROUP BY o_id ORDER BY id DESC");
		}
		if($date==null && $name!=null){
			$response_data=DB::select("SELECT o_id from order_detail where o_id LIKE '%$name%'   GROUP BY o_id ORDER BY id DESC");
		}
		if($date!=null && $name!=null){
			$response_data=DB::select("SELECT o_id from order_detail where o_id LIKE '%$name%' OR created_at LIKE '%date%'  GROUP BY o_id ORDER BY id DESC");
		}
		if($date==null && $name==null){
		   $response_data=DB::select("SELECT o_id from order_detail  GROUP BY o_id ORDER BY id DESC"); 
		}


		$data=DB::select("SELECT * FROM order_detail");
		// dd($date);
		$res = array_slice($response_data, $pageSize * ($page - 1), $pageSize, true);
		$result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response_data), $pageSize, $page);
		return view("admin/order/order_list",['result_data'=>$result_data,'data'=>$data]);
	}

	public function order_verifed_list(Request $request)
	{
		$name=$request->input('name');
		$date=$request->input('date');
		$page = LengthAwarePaginator::resolveCurrentPage();
		$pageSize = 50;
		$data=DB::select("SELECT * FROM order_detail");

		$quer=DB::select("SELECT   ot.o_id as o_id
					FROM order_detail as od
					JOIN order_table as ot
					ON od.o_id=ot.o_id
					where od.created_at LIKE '%$date%' AND  ot.status=1
					GROUP BY od.o_id
					ORDER BY ot.id DESC
			");
		$query="SELECT   ot.o_id as o_id
					FROM order_detail as od
					JOIN order_table as ot
					ON od.o_id=ot.o_id";

		if($name==null && $date!=null){
		$response_data=$query.(" where od.created_at LIKE '%$date%' ");
		}
		if($date==null && $name!=null){
			$response_data=$query.(" where od.o_id LIKE '%$name%'");
		}
		if($date!=null && $name!=null){
			$response_data=$query.(" where od.created_at LIKE '%$date%' OR  od.o_id LIKE '%$name%'");
		}
		if($date==null && $name==null){
			$response_data=$query;
		}
		$result=$response_data.(" AND ot.status=1 GROUP BY od.o_id ORDER BY ot.id DESC");
		$response=DB::select($result);
		$res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
		$result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
		return view("admin/order/order_verified",['result_data'=>$result_data,'data'=>$data]);
		// dd($result_data);
	}
  
	public function order_reject_list(Request $request)
    {
		$name=$request->input('name');
		$date=$request->input('date');
		$page = LengthAwarePaginator::resolveCurrentPage();
		$pageSize = 50;
		$data=DB::select("SELECT * FROM order_detail");

		$quer=DB::select("SELECT   ot.o_id as o_id
					FROM order_detail as od
					JOIN order_table as ot
					ON od.o_id=ot.o_id
					where od.created_at LIKE '%$date%' AND  ot.status=2
					GROUP BY od.o_id
					ORDER BY ot.id DESC
			");
		$query="SELECT   ot.o_id as o_id
					FROM order_detail as od
					JOIN order_table as ot
					ON od.o_id=ot.o_id";

		if($name==null && $date!=null){
		$response_data=$query.(" where od.created_at LIKE '%$date%' ");
		}
		if($date==null && $name!=null){
			$response_data=$query.(" where od.o_id LIKE '%$name%'");
		}
		if($date!=null && $name!=null){
			$response_data=$query.(" where od.created_at LIKE '%$date%' OR  od.o_id LIKE '%$name%'");
		}
		if($date==null && $name==null){
			$response_data=$query;
		}
		$result=$response_data.(" AND ot.status=1 GROUP BY od.o_id ORDER BY ot.id DESC");
		$response=DB::select($result);
		$res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
		$result= new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
		return view("admin/order/reject_list",['result'=>$result]);
	}

	public function order_decline($id)
	{
		DB::update("UPDATE order_table SET status=2 where o_id='$id'");
		return Redirect::back();

	}

	public function stock_receive()
	{
		$response=DB::select("SELECT  p.p_id,p.product_id,p.product_name,p.product_size,p.product_size,p.product_vendor_name,rp.amount,rp.quantity,si.created_at,p.product_type,rp.id as  route_plan_id
			FROM stock_in as si
			JOIN route_plan as rp
			ON rp.id=si.route_plan_id
			JOIN township as t
			ON t.id=rp.township
			JOIN state as s
			ON s.id=rp.division
			JOIN product as p
			ON si.product_id=p.p_id
			GROUP BY rp.id
			ORDER BY si.id DESC
			");
		// dd($result);
		  $page = LengthAwarePaginator::resolveCurrentPage();
		$pageSize =100;
		 $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
		$result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
		return view('warehouse/stock/stock_receive',['result'=>$result]);
	}

	public function stock_received_delete($id)
	{
		DB::delete("DELETE FROM stock_in where route_plan_id='$id'");
		DB::delete("DELETE FROM stock_in_out_return where plan_id='$id'");
		return Redirect::back();

	}

	public function stock_received(Request $request)
	{
		$date=date("Y-m-d H:i:s");
		
		$route_plan_id=$request->input('route_plan_id');
		$route_result=DB::select("SELECT * FROM stock_in where route_plan_id='$route_plan_id'");
		 $result=DB::select("
			SELECT p.product_id,p.product_name,p.product_size,p.product_type,p.product_vendor_name,p.p_id,p.created_at,rp.quantity,rp.amount,rp.id 
			FROM route_plan as rp
			JOIN product as p
			ON p.product_id=rp.product_id
			WHERE rp.id='$route_plan_id'
			");
		if(count($route_result)>0){
		return redirect()->back()->with('error', 'This route is already exist in stock receive');   
	  
		}else{
			  foreach($result as $row) {
			$p_id=$row->p_id;
			$product_name=$row->product_name;
			$product_id=$row->product_id;
			$product_size=$row->product_size;
			$product_vendor_name=$row->product_vendor_name;
			$amount=$row->amount;
			$quantity=$row->quantity;
			DB::insert("INSERT INTO stock_in (product_id,in_qty,price_per_item,created_at,route_plan_id) VALUES(?,?,?,?,?)",[
				$p_id,$quantity,$amount,$date,$route_plan_id
			]);
			DB::insert("Insert into stock_in_out_return(product_id,stock_in,product_price_per_item,created_at,plan_id) VALUES(?,?,?,?,?)",[$p_id,$quantity,$amount,$date,$route_plan_id]);
			}
		}
		return Redirect::back();
	}
}
