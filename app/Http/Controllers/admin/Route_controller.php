<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Excel;
class Route_controller extends Controller
{
      public function __construct()
    {
        $this->middleware('auth:admin');
    }
	  public function assign_postman()
    {
        $state=DB::select("SELECT * FROM state");
        $postman=DB::select("SELECT * FROM delivery_postman where role_id=0");
        $data=DB::select("SELECT rp.address,t.name as t_name,s.name as s_name,p.product_name as product_name,p.product_vendor_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,rp.target_time as target_time,rp.id as r_id,rp.id as route_plan_id,rp.phone as phone,rp.r_name  
                    FROM route_plan as rp
                    JOIN users as u
                    ON u.id=user_id
                    JOIN product as p
                    ON p.product_id=rp.product_id
                    JOIN state as s 
                    ON s.id=rp.division
                    JOIN township as t
                    ON t.id=rp.township
                    WHERE rp.status=1 GROUP BY rp.id
            ");
        return view('admin/route/assign',['postman'=>$postman,'data'=>$data,'state'=>$state]);
    }
     
     public function route_list_request()
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 50;
        $response=DB::select("SELECT rp.address,t.name as t_name,s.name as s_name,p.product_name as product_name,p.product_vendor_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,rp.target_time as target_time,rp.id as r_id,rp.id as route_plan_id,p.p_id,rp.phone as phone  
                    FROM route_plan as rp
                    JOIN users as u
                    ON u.id=user_id
                   LEFT JOIN product as p
                    ON p.product_id=rp.product_id
                    JOIN state as s 
                    ON s.id=rp.division
                    JOIN township as t
                    ON t.id=rp.township
                    WHERE rp.status=0
                    GROUP BY rp.id
                    ORDER BY rp.id DESC
            ");
      
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/route/route_list_request",['data'=>$data]);
    }
    public function route_list_request_search(Request $request)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 50;
        $name=$request->input('search');
        $date=$request->input('date');
        $state=$request->input('state');
        $query="SELECT rp.address,t.name as t_name,s.name as s_name,p.product_name as product_name,p.product_vendor_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,rp.target_time as target_time,rp.id as r_id,rp.id as route_plan_id,p.p_id,rp.phone as phone  
                    FROM route_plan as rp
                    JOIN users as u
                    ON u.id=user_id
                    JOIN product as p
                    ON p.product_id=rp.product_id
                    JOIN state as s 
                    ON s.id=rp.division
                    JOIN township as t
                    ON t.id=rp.township";
            if($name!=null && $date!=null){
                $query=$query.(" where (t.name LIKE '%$name%' OR s.name LIKE '%$name%' OR p.product_name LIKE '%$name%' OR p.product_vendor_name LIKE '%$name%' OR rp.reg_date LIKE '%$name%' OR rp.target_date LIKE '%$name%' OR p.p_id LIKE '%$name%')");
            }
            if($name==null && $date!=null){
                $query=$query.(" Where  (rp.reg_date LIKE '%$name%' OR rp.target_date LIKE '%$name%')");
            }
            if($name==null && $date==null){
                $query=$query;
            }
            if($name!=null && $date==null){
                $query=$query.(" where (t.name LIKE '%$name%' OR s.name LIKE '%$name%' OR p.product_name LIKE '%$name%' OR p.product_vendor_name LIKE '%$name%' OR p.p_id LIKE '%$name%')");
            }
            if($state!=null){
                if($date==null && $name==null){
                $query=$query.(" where t.state_id='$state'");
                }elseif($state==null){
                    $query=$query.(" where t.state_id='$state'");
                }
            }
            $query_data=$query.(" AND (rp.status=0) GROUP BY rp.id ORDER BY rp.id DESC");
            $response=DB::select($query_data);

         $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $select = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/route/route_list_request",['select'=>$select]);
        // dd($select);

    }
     public function assigned_route()
    {

        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 50;
        $response=DB::select("SELECT rp.address as address,ts.name as t_name,s.name as s_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,p.product_name as product_name,dp.user_name as postman_name,dp.delivery_name as delivery_name,p.product_vendor_name as vendor_name,rp.id as route_plan_id,rp.phone as phone
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
                            ORDER BY pr.id DESC
                            ");
        
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $select = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
    return view("admin/route/route_plan_list",['select'=>$select]); 

    }
    public function assigned_route_search(Request $request)
    {
        $date=$request->input('date');
        $search=$request->input('search');
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize =50;

        $query="SELECT rp.address as address,ts.name as t_name,s.name as s_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,p.product_name as product_name,dp.user_name as postman_name,dp.delivery_name as delivery_name,p.product_vendor_name as vendor_name,rp.id as route_plan_id,rp.phone as phone
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
            ";

            if($search==null && $date!=null){
                $query=$query.("WHERE rp.reg_date LIKE '%$date%' ORDER BY pr.id DESC");
                $response=DB::select($query);
              }elseif($search!=null && $date==null){
                $query=$query.("WHERE (ts.name LIKE '%$search%' OR s.name LIKE '%$search%' OR p.product_name LIKE '%$search%' OR p.p_id LIKE '%$search%' OR p.p_id LIKE '%$search%' OR dp.user_name LIKE '%$search%' OR dp.delivery_name LIKE '%$search%' OR rp.amount LIKE '%$search%') ORDER BY pr.id DESC");
                $response=DB::select($query);
              }elseif($search==null && $date==null){
                return Redirect::back();
              }else{
                $query=$query.("WHERE (ts.name LIKE '%$search%' OR s.name LIKE '%$search%' OR p.product_name LIKE '%$search%' OR p.p_id LIKE '%$search%' OR p.p_id LIKE '%$search%' OR dp.user_name LIKE '%$search%' OR dp.delivery_name LIKE '%$search%' OR rp.amount LIKE '%$search%') AND (rp.reg_date LIKE '%$date%') ORDER BY pr.id DESC");
                $response=DB::select($query);
              }
              // dd($response);
     
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $select_result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
    return view("admin/route/route_plan_list",['select_result'=>$select_result]); 
    }
    public function route_verify($id)
    {
     DB::update("UPDATE route_plan SET status=1 where id='$id'");
    return Redirect::back();
    }
    public function verify_route(Request $request)
    {
        $product_id=$request->input('product_id');
        $i=-1;
        foreach ($product_id as $row) {
            $i++;
            DB::update("UPDATE route_plan SET status=1 where id=?",[$product_id[$i]]);
        }
        return Redirect::back();
    }
  
   
   public function route_plan_edit($id)
   {
       $result=DB::select("SELECT rp.address as address,ts.name as t_name,s.name as s_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,p.product_name as product_name,dp.user_name as postman_name,dp.delivery_name as delivery_name,rp.id as route_plan_id,p.product_id as product_id,p.product_name as product_name,p.p_id as p_id,rp.amount as amount,pr.created_at as assign_date,rp.id as route_plan_id,pr.postman_id as postman_id,rp.product_id as product_id,r_p.paid_unpaid as paid_unpaid,rp.phone as phone
                            FROM postman_route as pr
                            JOIN township as ts
                            ON pr.township_id=ts.id
                            JOIN route_plan as rp
                            ON rp.id=pr.p_id
                            LEFT JOIN route_planning as r_p
                            ON r_p.plan_id=rp.id
                            JOIN delivery_postman as dp
                            ON dp.id=pr.postman_id
                            JOIN state as s
                            ON ts.state_id=s.id
                            JOIN product as p
                            ON p.product_id=rp.product_id WHERE rp.id='$id'");
       return view('admin/route/route_plan_edit',['result'=>$result]);
       // dd($result);
   }
   public function route_plan_update(Request $request)
   {
        $plan_id=$request->input('plan_id');
        $product_id=$request->input('product_id');
        $product_name=$request->input('product_name');
        $qty=$request->input('qty');
        $target_date=$request->input('target_date');
        $price_per_item=$request->input('price_per_item');
        $total_amount=$request->input('total_amount');
        $postman_id=$request->input('postman_id');  
        $postman_name=$request->input('postman_name');
        $assign_date=$request->input('assign_date');
        $reg_date=$request->input('reg_date');
        $address=$request->input('address');
        $s_name=$request->input('s_name');
        $t_name=$request->input('t_name');
        $remark=$request->input('remark');
        $delivery_charges=$request->input('delivery_charges');
        $over_tender_charges=$request->input('over_tender_charges');
        $notification_date=$request->input('notification_date');
        $extra_charges=$request->input('extra_charges');
        $payment_status=$request->input('payment_status');
        $total=$qty*$price_per_item;
        $total_charges=$delivery_charges+$over_tender_charges+$extra_charges;
        DB::insert("INSERT INTO route_planning (plan_id,product_id,delivery_postman_id,assign_date,delivery_charges,over_tender_charges,notification_date,extra_charges,paid_unpaid,remark,division,township,address,quantity,amount,registration_date,target_date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[$plan_id,$product_id,$postman_id,$assign_date,$delivery_charges,$over_tender_charges,$notification_date,$extra_charges,$payment_status,$remark,$s_name,$t_name,$address,$qty,$total_amount,$reg_date,$target_date]);
        DB::insert("INSERT INTO account_ledger(route_plan_id,price,quantity,amount,paid_unpaid,charges) VALUES(?,?,?,?,?,?)",[$plan_id,$price_per_item,$qty,$total,$payment_status,$total_charges]);
        DB::update("UPDATE postman_route set status=1 where p_id='$plan_id'");
        return redirect('/admin/route/assigned');
   }
   public function route_list_edit($id)
   {
       $result=DB::select("SELECT p.p_id as p_id,rp.id as id,p.product_name,rp.quantity as qty,rp.amount as amount,rp.reg_date as reg_date,rp.target_date,s.name as s_name,t.name as t_name,rp.address,rp.phone as phone,rp.id as route_plan_id,rp.r_name,rp.phone,rp.foc,rp.remark
        FROM route_plan as rp 
        join product as  p
        on p.product_id=rp.product_id
        JOIN state as s
        ON s.id=rp.division
        JOIN township as t
        ON t.id=rp.township

        where rp.id='$id' GROUP BY rp.id


       ");
       return view('admin/route/edit',['result'=>$result]);
   }
   public function high_way_drop_list()
   {
    $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 50;
        $response=DB::select("SELECT rp.address,t.name as t_name,s.name as s_name,p.product_name as product_name,p.product_vendor_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,rp.target_time as target_time,rp.id as r_id,rp.id as route_plan_id,p.p_id,rp.phone as phone,rp.r_name  
                    FROM route_plan as rp
                    JOIN users as u
                    ON u.id=user_id
                   LEFT JOIN product as p
                    ON p.product_id=rp.product_id
                    JOIN state as s 
                    ON s.id=rp.division
                    JOIN township as t
                    ON t.id=rp.township
                    JOIN route_planning as r_p
                    ON r_p.plan_id=rp.id
                    WHERE rp.status=3 AND rp.division!=13 AND r_p.high_way=0
                    GROUP BY rp.id
                    ORDER BY rp.id DESC
            ");
      
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/highway/list",['data'=>$data]);
   }
   public function route_list_update(Request $request)
   {
    $plan_id=$request->input('plan_id');
        $product_id=$request->input('product_id');
        $product_name=$request->input('product_name');
        $qty=$request->input('qty');
        $target_date=$request->input('target_date');
        $price_per_item=$request->input('price_per_item');
        $total_amount=$request->input('total_amount');
        $postman_id=$request->input('postman_id');  
        $postman_name=$request->input('postman_name');
        $assign_date=$request->input('assign_date');
        $reg_date=$request->input('reg_date');
        $address=$request->input('address');
        $s_name=$request->input('s_name');
        $t_name=$request->input('t_name');
        $remark=$request->input('remark');
        $delivery_charges=$request->input('delivery_charges');
        $over_tender_charges=$request->input('over_tender_charges');
        $notification_date=$request->input('notification_date');
        $extra_charges=$request->input('extra_charges');
        $payment_status=$request->input('payment_status');
        $total=$qty*$price_per_item;
        $date=date("Y-m-d H:i:s");
        $total_charges=$delivery_charges+$over_tender_charges+$extra_charges;
        DB::insert("INSERT INTO route_planning (plan_id,product_id,delivery_postman_id,assign_date,delivery_charges,over_tender_charges,notification_date,extra_charges,paid_unpaid,remark,division,township,address,quantity,amount,registration_date,target_date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[$plan_id,$product_id,$postman_id,$assign_date,$delivery_charges,$over_tender_charges,$notification_date,$extra_charges,$payment_status,$remark,$s_name,$t_name,$address,$qty,$total_amount,$reg_date,$target_date]);
        DB::insert("INSERT INTO account_ledger(route_plan_id,price,quantity,amount,paid_unpaid,charges) VALUES(?,?,?,?,?,?)",[$plan_id,$price_per_item,$qty,$total,$payment_status,$total_charges]);
        DB::update("UPDATE postman_route set status=1 where p_id='$plan_id'");
        DB::update("UPDATE route_plan set status=1,remark='-' where id='$plan_id' ");
        $route_plan_id=$request->input('plan_id');
        $route_result=DB::select("SELECT * FROM stock_in where route_plan_id='$route_plan_id'");
         $result=DB::select("
            SELECT p.product_id,p.product_name,p.product_size,p.product_type,p.product_vendor_name,p.p_id,p.created_at,rp.quantity,rp.amount,rp.id 
            FROM route_plan as rp
            JOIN product as p
            ON p.product_id=rp.product_id
            WHERE rp.id='$route_plan_id'
            ");
        if(count($route_result)>0){
        return redirect('admin/route/list/request');
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
        return redirect('admin/route/list/request');
   }
   public function route_list_verified()
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 50;
        $response=DB::select("SELECT rp.address,t.name as t_name,s.name as s_name,p.product_name as product_name,p.product_vendor_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,rp.target_time as target_time,rp.id as r_id,rp.id as route_plan_id,p.p_id,rp.phone as phone  
                    FROM route_plan as rp
                    JOIN users as u
                    ON u.id=user_id
                    JOIN product as p
                    ON p.product_id=rp.product_id
                    JOIN state as s 
                    ON s.id=rp.division
                    JOIN township as t
                    ON t.id=rp.township
                    JOIN route_planning as r_p
                    ON r_p.plan_id=rp.id
                    WHERE rp.status=1
            ");
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/route/route_list",['data'=>$data]);
    }
   public function route_verify_search(Request $request)
   {
       $page = LengthAwarePaginator::resolveCurrentPage();
       $pageSize = 50;
       $search=$request->input('search');
       $date=$request->input('date');
       $state=$request->input('state');
       $query="SELECT rp.address,t.name as t_name,s.name as s_name,p.product_name as product_name,p.product_vendor_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,rp.target_time as target_time,rp.id as r_id,rp.id as route_plan_id,p.p_id,rp.phone as phone  
                    FROM route_plan as rp
                    JOIN users as u
                    ON u.id=user_id
                    JOIN product as p
                    ON p.product_id=rp.product_id
                    JOIN state as s 
                    ON s.id=rp.division
                    JOIN township as t
                    ON t.id=rp.township
                    JOIN route_planning as r_p
                    ON r_p.plan_id=rp.id
                ";

        if($search!=null && $date==null){
            $query=$query.(" WHERE (rp.address LIKE '%$search%' OR t.name LIKE '%$search%' OR s.name LIKE '%$search%' OR p.product_name LIKE '%$search%' OR p.product_vendor_name LIKE '%$search%' OR p.p_id LIKE '%%$search')");
        }
        if($search==null && $date!=null){
            $query=$query.(" WHERE (rp.target_date LIKE '%$search%' OR rp.target_time LIKE '%$search%')");
        }
        if($search!=null && $date!=null){
            $query=$query.(" WHERE (rp.address LIKE '%$search%' OR t.name LIKE '%$search%' OR s.name LIKE '%$search%' OR p.product_name LIKE '%$search%' OR p.product_vendor_name LIKE '%$search%' OR p.p_id LIKE '%$search' OR rp.target_date LIKE '%$search%' OR rp.target_time LIKE '%$search%')");
        }
        if($search==null && $date==null){
            $query=$query;
        }
        if($state!=null){
            if($search!=null || $date!=null){
                $query=$query.(" AND (rp.division='$state' AND rp.status=1)");
            }else{
                $query=$query.(" Where ( rp.division='$state' AND rp.status=1)");
            }
            
        }else{
            if($search!=null || $date!=null){
                $query=$query.(" AND ( rp.status=1)");
            }else{
                $query=$query.(" Where ( rp.status=1)");
            }
        }
        $response=DB::select($query);
        // dd($query);
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $select_date = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/route/route_list",['select_date'=>$select_date]);
    // dd($select_date);
   }
   public function route_print($postman_route,$route_plan)
   {
    $result=DB::select("SELECT rp.address,t.name as t_name,s.name as s_name,p.product_name as product_name,p.product_vendor_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,rp.target_time as target_time,rp.id as r_id,rp.id as route_plan_id,rp.phone,rp.r_name,p.product_id,p.p_id as productid,p.product_type,p.product_size,p.product_vendor_name,rp.id as route_plan_id,r_p.delivery_charges,rp.foc,r_p.remark  
                    FROM route_plan as rp
                    JOIN users as u
                    ON u.id=user_id
                    JOIN product as p
                    ON p.product_id=rp.product_id
                    JOIN state as s 
                    ON s.id=rp.division
                    JOIN township as t
                    ON t.id=rp.township
                    JOIN route_planning as r_p
                    ON r_p.plan_id=rp.id
                    WHERE rp.id=$route_plan GROUP BY rp.id
        ");
    // dd($result);
    return view("admin/voucher/print",['result'=>$result]);
   }
   public function route_modify($id)
   {
   $result= DB::select("SELECT rp.phone,rp.r_name,rp.address,s.name as s_name,t.name as t_name,s.id as s_id,t.id as t_id,rp.quantity,rp.amount,rp.target_date,rp.target_time,p.product_id,p.p_id,p.product_name,p.product_size,p.product_type,p.product_vendor_name,rp.user_id,rp.id as route_plan_id,rp.remark
        FROM route_plan as rp 
        JOIN users as u
        ON u.id=rp.user_id
        JOIN product as p
        ON p.product_id=rp.product_id
        JOIN state as s
        ON rp.division=s.id
        JOIN township as t
        ON t.id=rp.township
        where rp.id='$id'
     ");
   $user_id=$result[0]->user_id;
   $state=DB::select("SELECT * FROM state ORDER BY id desc");
   $product=DB::select("SELECT * FROM product where user_id='$user_id' order by product_id DESC");
    // dd($result);
   return view("admin/route/edit_route",['result'=>$result,'state'=>$state,'product'=>$product]);

   }
   public function route_modified(Request $request)
   {
       // $route_plan_id=$request->input('route_plan_id');
       // dd($request->all());
    $data=$request->all();
    $route_plan_id=$data['route_plan_id'];
    $phone=$data['phone'];
    $r_name=$data['r_name'];
    $address=$data['address'];
    $state=$data['state'];
    $township=$data['township'];
    $quantity=$data['quantity'];
    $amount=$data['amount'];
    $target_date=$data['target_date'];
    $target_time=$data['target_time'];
    $product_id=$data['product_id'];
    $remark=$data['remark'];
    $user_id=$data['user_id'];
    $date=date("Y-m-d H:i:s");
    DB::update("UPDATE route_plan SET division='$state',township='$township',address='$address',quantity='$quantity',amount='$amount',product_id='$product_id',target_date='$target_date',target_time='$target_time',user_id='$user_id',phone='$phone',r_name='$r_name',updated_at='$date',remark='$remark' WHERE id='$route_plan_id'");
    return redirect()->action(
    'admin\Route_controller@route_list_edit', ['id' => $route_plan_id]
        );
   }
    public function contact_issue_export()
    {
        $name_date=date("Y-m-d H:i:s");
        $result=DB::select("SELECT rp.r_name,rp.phone,rp.address,rp.quantity,rp.amount,rp.target_date,rp.reg_date,rp.remark,u.name,t.name as t_name,s.name as s_name,p.product_id,p.product_size,p.p_id,p.product_name,p.product_size,p.product_type,rp.foc,rp.target_date,rp.remark
            FROM route_plan as rp
            JOIN route_planning as r_p
            ON rp.id=r_p.plan_id
            JOIN product as p
            ON p.product_id=rp.product_id
            JOIN township as t
            ON t.id=rp.township
            JOIN state as s
            ON s.id=rp.division
            JOIN users as u
            ON rp.user_id=u.id
            WHERE rp.customer_confirm_status=1  AND rp.remark IS NOT NULL GROUP BY rp.id
            "
        );
          $data= json_decode( json_encode($result), true);
        
        //==============================================
            return Excel::create('contact_issue'.$name_date, function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
           $sheet->cell('A1', function($cell) {$cell->setValue('no');});
          $sheet->cell('B1', function($cell) {$cell->setValue('Customer_Name');});
          $sheet->cell('C1', function($cell) {$cell->setValue('Phone No.');});
          $sheet->cell('D1', function($cell) {$cell->setValue('Address');});
         $sheet->cell('E1', function($cell) {$cell->setValue('Product ID');});
         $sheet->cell('F1', function($cell) {$cell->setValue('Product Name');});
         $sheet->cell('G1', function($cell) {$cell->setValue('Product Type');});
         $sheet->cell('H1', function($cell) {$cell->setValue('Product Size');});
         $sheet->cell('I1', function($cell) {$cell->setValue('Qty');});
         $sheet->cell('J1', function($cell) {$cell->setValue('Amount');});
         $sheet->cell('K1', function($cell) {$cell->setValue('Target Date');});
         $sheet->cell('L1', function($cell) {$cell->setValue('Remark');});
         $sheet->cell('M1', function($cell) {$cell->setValue('F.O.C/Discount');});

                    $j=1;
                    // SELECT rp.r_name,rp.phone,rp.address,rp.quantity,rp.amount,rp.target_date,rp.reg_date,rp.remark,u.name,t.name as t_name,s.name as s_name,p.product_id,p.product_size,p.p_id,p.product_name,p.product_size,p.product_type
                  if (!empty($data)) {
                      foreach ($data as $key => $value) {
                          $i= $key+2;

                          $sheet->cell('A'.$i, $j++);
                          $sheet->cell('B'.$i, $value['r_name']);
                          $sheet->cell('C'.$i, $value['phone']);
                          $sheet->cell('D'.$i, $value['address'].','.$value['t_name'].','.$value['s_name']);
                          $sheet->cell('E'.$i, $value['p_id']);
                          $sheet->cell('F'.$i, $value['product_name']);
                          $sheet->cell('G'.$i, $value['product_type']);
                          $sheet->cell('H'.$i, $value['product_size']);
                          $sheet->cell('I'.$i, $value['quantity']);
                          $sheet->cell('J'.$i, $value['amount']);
                          $sheet->cell('K'.$i, $value['target_date']);
                          $sheet->cell('L'.$i, $value['remark']);
                          $sheet->cell('M'.$i, $value['foc']);


                  }
              }
        });
       })->download("xlsx");
        //==============================================
    }
    public function high_way_edit($id)
    {
        $result=DB::select("SELECT p.p_id as p_id,rp.id as id,p.product_name,rp.quantity as qty,rp.amount as amount,rp.reg_date as reg_date,rp.target_date,s.name as s_name,t.name as t_name,rp.address,rp.phone as phone,rp.id as route_plan_id,rp.r_name,rp.phone,rp.foc,rp.remark,rp.user_id as user_id
        FROM route_plan as rp 
        join product as  p
        on p.product_id=rp.product_id
        JOIN state as s
        ON s.id=rp.division
        JOIN township as t
        ON t.id=rp.township
        where rp.id='$id' GROUP BY rp.id");
        return view("admin/highway/highway_edit",['result'=>$result]);
    }
     public function highway_update(Request $request)
   {
        $plan_id=$request->input('plan_id');
        $transport_charges=$request->input('transport_charges');
        $product_id=$request->input('product_id');
        $product_name=$request->input('product_name');
        $qty=$request->input('qty');
        $target_date=$request->input('target_date');
        $price_per_item=$request->input('price_per_item');
        $total_amount=$request->input('total_amount');
        $postman_id=$request->input('postman_id');  
        $postman_name=$request->input('postman_name');
        $assign_date=$request->input('assign_date');
        $reg_date=$request->input('reg_date');
        $address=$request->input('address');
        $s_name=$request->input('s_name');
        $t_name=$request->input('t_name');
        $remark=$request->input('remark');
        $delivery_charges=$request->input('delivery_charges');
        $over_tender_charges=$request->input('over_tender_charges');
        $notification_date=$request->input('notification_date');
        $extra_charges=$request->input('extra_charges');
        $payment_status=$request->input('payment_status');
        $total=$qty*$price_per_item;
        $date=date("Y-m-d H:i:s");
        $total_charges=$delivery_charges+$over_tender_charges+$extra_charges;
        DB::insert("INSERT INTO highway (plan_id,product_id,delivery_postman_id,assign_date,delivery_charges,over_tender_charges,notification_date,extra_charges,paid_unpaid,remark,division,township,address,quantity,amount,registration_date,target_date,transport_charge) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[$plan_id,$product_id,$postman_id,$assign_date,$delivery_charges,$over_tender_charges,$notification_date,$extra_charges,$payment_status,$remark,$s_name,$t_name,$address,$qty,$total_amount,$reg_date,$target_date,$transport_charges]);
        
        DB::update("UPDATE route_planning SET high_way=1 WHERE plan_id='$plan_id'");
        return redirect('admin/high/way/list');
    }
    public function route_manage(Request $request)
    {
        $updated_at=date("Y-m-d H:i:s");
        $postman_id=$request->input('postman_id');
        $route_plan_id=$request->input('route_plan_id');
        // dd($route_plan_id);
        $i=0;
        if(Input::get('accept')){
            foreach ($route_plan_id as $row) {
               DB::update("UPDATE route_plan SET customer_confirm_status=0 where id='$route_plan_id[$i]'");
               $i++;
            }
        }
        if(Input::get('cancel')){
        foreach ($route_plan_id as $row) {
        DB::update("UPDATE route_plan SET status=1 where id='$route_plan_id[$i]'");
        DB::delete("DELETE FROM postman_route where p_id='$route_plan_id[$i]'");
               $i++;
         }
        }
        if(Input::get('drop')){
        foreach ($route_plan_id as $row) {
          DB::update("UPDATE route_planning SET status=3 where plan_id='$route_plan_id[$i]'");
          DB::update("UPDATE route_plan SET status=3,updated_at='$updated_at' where id='$route_plan_id[$i]'");
          DB::update("UPDATE postman_route SET status=3 where p_id='$route_plan_id[$i]'");
               $i++;
         }
        }
          return Redirect::back();

    }
}