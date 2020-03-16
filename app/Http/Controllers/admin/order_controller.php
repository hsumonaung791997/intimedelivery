<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
class order_controller extends Controller
{
      public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function order_list()
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 50;
        $response=DB::select("SELECT o_id from order_detail GROUP BY o_id ORDER BY id DESC");
        $data=DB::select("SELECT * FROM order_detail");
        // dd($result);
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
