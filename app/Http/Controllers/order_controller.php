<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
class order_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   public function order_create()
   {
    $user_id = Auth::user()->id;
    $state=DB::select("SELECT * FROM state ORDER BY id desc");
    $township=DB::select("SELECT * FROM township ORDER BY id desc");
    $result=DB::select("SELECT * FROM order_temp where user_id='$user_id' AND status=0 ORDER  BY id desc" );
    // dd($result);
    if(count($result)<0){
    return view("order/create");
    }else{
    return view("order/create",['result'=>$result,'state'=>$state,'township'=>$township]);
    }
   }
   public function order_store(Request $request)
   {
    //add
    $last_id=DB::select("SELECT o_id FROM order_table ORDER BY id DESC LIMIT 1");
    if($last_id==null){
      $order_id=1;  
     }else{
      $orderid=$last_id[0]->o_id;
    $order_id=$orderid+1;
     }
    $order_date=$request->input('order_date');
    $description=$request->input('description');
    $product_id=$request->input('product_id');
    $weight=$request->input('weight');
    $product_expire_date=$request->input('product_expire_date');
    $sqty=$request->input('qty');
    // $qty+=$sqty;
    $price_per_item=$request->input('price_per_item');
    $total_amount=$request->input('total_amount');
    $created_at=date("Y-m-d H:i:s");
      $l=-1;
      $currenly_total=0;
      foreach ($total_amount  as $keys) {
         $l++;
        $currenly_total+=$total_amount[$l]; 
      }
      $a=-1;
      $qty=0;
      foreach ($sqty as $keys) {
        $a++;
        $qty+=$sqty[$a];
      }
    $user_id = Auth::user()->id;  
    $created_at=date("Y-m-d H:i:s");
    
    $r_name=$request->input('r_name');
    $state=$request->input('state');
    $address=$request->input('address');
    $township=$request->input('township');
    $phone=$request->input('phone');
    $target_date=$request->input('target_date');
      // $target_time=$request->input('target_time');
      //   $remark=$request->input('remark');
      // $reg_date=date("Y-m-d H:i:s");


        //foc,quantity,amount,total_amount,$product_id,target_date,$target_time,$user_id,$created_at,$remark

    
    if($request->input('add')){
      // dd($request->all());
    if($product_id[0]==null && $sqty[0]==null && $price_per_item[0]==null){
   
        return redirect('order/create');

  }else{
 DB::insert("INSERT INTO order_temp (description,reg,total_amount,qty,o_id,p_id,p_weight,p_expire_date,price_per_item,created_at,user_id) VALUES(?,?,?,?,?,?,?,?,?,?,?)",[$description,$order_date,$total_amount[0],$sqty[0],$order_id,$product_id[0],$weight[0],$product_expire_date[0],$price_per_item[0],$created_at,$user_id]);
        return redirect('order/create');
    
  }
    
    }
    if($request->input('save')){  
    if($product_id[0]==null && $sqty[0]==null && $price_per_item[0]==null){

  DB::insert("INSERT INTO order_detail(o_id,p_id,p_weight,p_expired_date,p_quantity,p_price_per_item,p_amount,created_at,user_id)
    SELECT o_id,p_id,p_weight,p_expire_date,qty,price_per_item,total_amount,created_at,user_id FROM order_temp where o_id='$order_id' AND user_id='$user_id'");
         DB::insert("INSERT INTO order_table(o_id,o_description,o_register_date,o_amount_total,created_at,user_id)VALUES(?,?,?,?,?,?)",[$order_id,$description,$order_date,$currenly_total,$created_at,$user_id]);
          DB::insert("INSERT INTO route_plan(o_id,r_name,phone,division,township,target_date,address,quantity,amount,user_id,created_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)",[$order_id,$r_name,$phone,$state,$township,$target_date,$address,$qty,$currenly_total,$user_id,$created_at]);
        
      DB::delete("DELETE FROM order_temp WHERE o_id='$order_id' AND user_id='$user_id'");
    return redirect('order/list');
    }else{
      $i=-1;
      DB::delete("DELETE FROM order_detail where user_id='$user_id' AND o_id='$order_id' AND status=3");
    foreach ($product_id as $row) {
      $i++;
      DB::insert("INSERT INTO order_detail(o_id,p_id,p_weight,p_expired_date,p_quantity,p_price_per_item,p_amount,created_at,user_id) VALUES(?,?,?,?,?,?,?,?,?)",[$order_id,$product_id[$i],$weight[$i],$product_expire_date[$i],$sqty[$i],$price_per_item[$i],$total_amount[$i],$created_at,$user_id]);
    }
        DB::insert("INSERT INTO order_table(o_id,o_description,o_register_date,o_amount_total,created_at,user_id)VALUES(?,?,?,?,?,?)",[$order_id,$description,$order_date,$currenly_total,$created_at,$user_id]);
       
      DB::insert("INSERT INTO route_plan(o_id,r_name,phone,division,township,target_date,address,quantity,amount,user_id,created_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)",[$order_id,$r_name,$phone,$state,$township,$target_date,$address,$qty,$currenly_total,$user_id,$created_at]);
        
       DB::delete("DELETE FROM order_temp WHERE o_id='$order_id' AND user_id='$user_id'");
          
    return redirect('order/list');
    }
   }
   }
   public function order_delete($id)
   {
    DB::delete("DELETE FROM order_temp where id='$id'");
    return redirect('order/create');
   }
      public function order_list()
   {
        $user_id=Auth::user()->id;
        $response=DB::select("SELECT o_id from order_detail where user_id='$user_id'  GROUP BY o_id ORDER BY o_id DESC");
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 50;
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
      return view("order/order_list",['result'=>$result]);
   }
   public function order_list_search(Request $request)
   {
        $page = LengthAwarePaginator::resolveCurrentPage();
    
        $user_id=Auth::user()->id;
        $name=$request->input('name');
        $date=$request->input('date');
        $status=$request->input('status');
        $query="SELECT o_id from order_table"; 
        // $query=" where user_id='$user_id' AND  o_id LIKE '%$name%' OR o_description LIKE '%$name%'   GROUP BY o_id ORDER BY o_id DESC";
        if($name==null && $date!=null){
          $query=$query.(" where o_register_date LIKE '%$date%'");
        }
        if($name!=null && $date==null){
          $query=$query.(" where  AND  o_id LIKE '%$name%' OR o_description LIKE '%$name%'");
        }
        if($name==null && $date==null){
          $query=$query;
        }
        if($name!=null && $date!=null){
          $query=$query.(" where   o_id LIKE '%$name%' OR o_description LIKE '%$name%' AND o_register_date LIKE '%$date%'");
        }
          if($status!=null){
            if($name==null || $date==null){
              $query=$query.(" AND status='$status'");
              }else{
                $query=$query.(" WHERE status='$status'");
              }

          }
          if($status==null && $date==null && $name==null ){
            $query=$query.(" WHERE user_id='$user_id'");
          }
          $result=$query.("  GROUP BY o_id ORDER BY o_id DESC");
          $response=DB::select($result);
        // dd($response);


        // $result=DB::select("SELECT o_id from order_detail where user_id='$user_id'  GROUP BY o_id ORDER BY o_id DESC");
        $pageSize = 50;
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $select_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
      return view("order/order_list",['select_data'=>$select_data]);
        
   }
   public function order_deletes($id,$order_id)
   {
      DB::delete("DELETE  FROM order_table where id='$id'");
      DB::delete("DELETE FROM order_detail where o_id='$order_id'");
      DB::delete("DELETE FROM order_temp where o_id='$order_id' AND id='$id'");
      return Redirect::back();
   }
   public function order_edit($id,$order_id)
   {
    DB::update("UPDATE order_detail set status=3 where o_id='$order_id'");
    DB::update("UPDATE order_table set status=3 where o_id='$order_id'");
    $o_table=DB::select("SELECT * FROM order_table where id='$id'");
    $o_temp=DB::select("SELECT * FROM order_detail where o_id='$order_id'");
     $state=DB::select("SELECT * FROM state ORDER BY id desc");
    $township=DB::select("SELECT * FROM township ORDER BY id desc");
    return view("order/order_edit",['o_table'=>$o_table,'o_temp'=>$o_temp,'state'=>$state,'township'=>$township]);
   }
   public function edit_delete($id,$order_id)
   {
    DB::delete("DELETE FROM order_detail where o_id='$order_id' AND id='$id'");
      return Redirect::back();

   }
     public function order_update(Request $request)
   {
    // dd($request->all());
    //add
    $primary_id=$request->input('primary_id');
    $order_id=$request->input('order_id');
    $order_date=$request->input('order_date');
    $description=$request->input('description');
    $product_id=$request->input('product_id');
    $weight=$request->input('weight');
    $product_expire_date=$request->input('product_expire_date');
    $qty=$request->input('qty');
    $price_per_item=$request->input('price_per_item');
    $total_amount=$request->input('total_amount');
    $created_at=date("Y-m-d H:i:s");
      $l=-1;
      $currenly_total=0;
      foreach ($total_amount  as $keys) {
         $l++;
        $currenly_total+=$total_amount[$l]; 
      }
    $user_id = Auth::user()->id;  
    $created_at=date("Y-m-d H:i:s");
    if($request->input('adds')){
    if($product_id[0]==null && $qty[0]==null && $price_per_item[0]==null){
   
        return Redirect::back();

  }else{

      $status=3;
    DB::insert("INSERT INTO order_detail(o_id,p_id,p_weight,p_expired_date,p_quantity,p_price_per_item,p_amount,updated_at,status,user_id)
     values(?,?,?,?,?,?,?,?,?,?)",[$order_id,$product_id[0],$weight[0],$product_expire_date[0],$qty[0],$price_per_item[0],$total_amount[0],$created_at,$status,$user_id]);
        return Redirect::back();
  }
    
    }
    if($request->input('saves')){ 
    if($product_id[0]==null && $qty[0]==null && $price_per_item[0]==null){
      DB::update("UPDATE order_detail set status=0 where o_id='$order_id'");
      DB::update("UPDATE order_table set status=0 where o_id='$order_id'");
    return redirect('order/list');
    }else{
      DB::delete("DELETE FROM order_detail where o_id='$order_id' AND status=3");
      $i=-1;
    foreach ($product_id as $row) {
      $i++;
      DB::insert("INSERT INTO order_detail(o_id,p_id,p_weight,p_expired_date,p_quantity,p_price_per_item,p_amount,created_at,user_id) VALUES(?,?,?,?,?,?,?,?,?)",[$order_id,$product_id[$i],$weight[$i],$product_expire_date[$i],$qty[$i],$price_per_item[$i],$total_amount[$i],$created_at,$user_id]);
    }

        DB::update("UPDATE order_table SET o_description=?,o_register_date=?,o_amount_total=?,created_at=?,user_id=?,status=0 where id='$primary_id' and o_id='$order_id'",[$description,$order_date,$currenly_total,$created_at,$user_id]);
          // dd($request->all());
    return redirect('order/list');
    }
   }
   }
   public function order_preview($id,$order_id)
   {
    $result=DB::select("SELECT * FROM order_detail where o_id='$order_id'");
    return view("order/order_preview",['result'=>$result]);
   }
   public function make_order()
   {
     
   }
}
