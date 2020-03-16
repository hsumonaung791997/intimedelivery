<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use DB;
use Excel;
class warehouse_stock_controller extends Controller
{
    
      public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function stock_ledger()
    {
        // $result=DB::select("SELECT p.p_id as product_id,p.product_name as product_name,si.in_qty as in_qty,si.out_qty as out_qty,si.created_at as in_out_date,p.product_type as proudct_type,p.product_size as product_size,si.price_per_item as price_per_item FROM stock_in as si JOIN product as p ON p.p_id=si.product_id UNION SELECT p.p_id as product_id,p.product_name as product_name,si.in_qty as in_qty,si.out_qty as out_qty,si.created_at as in_out_date,p.product_type as proudct_type,p.product_size as product_size,si.price_per_item as price_per_item FROM stock_out as si JOIN product as p ON p.p_id=si.product_id");
        // dd($result);
         $response=DB::select("SELECT p.product_id,p.product_name,p.product_type,sio.stock_in,sio.stock_out,sio.product_price_per_item,dp.user_name,sio.reason_in_out_return,sio.created_at as verified_date,p.product_size,p.p_id as product_id,sio.order_id 
            FROM stock_in_out_return as sio
             LEFT JOIN  delivery_postman as dp
            ON dp.id=sio.postman_id
              JOIN product as p
            ON sio.product_id=p.p_id
            ORDER BY sio.stock_id DESC
            ");
        
                $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize =50;
         $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        // dd($result);
    	return view("warehouse/stock/stock_ledger",['result'=>$result]);
    }
    public function stock_ledger_search(Request $request)
    {
         $name_date=date("Y/m/d H:i:sa");
        $name=$request->input('name');
        $date=$request->input('date');
         $query="SELECT p.product_id,p.product_name,p.product_type,sio.stock_in,sio.stock_out,sio.product_price_per_item,dp.user_name,sio.reason_in_out_return,sio.created_at as verified_date,p.product_size,p.p_id as product_id,sio.order_id 
            FROM stock_in_out_return as sio
            LEFT JOIN  delivery_postman as dp
            ON dp.id=sio.postman_id
          JOIN product as p
            ON sio.product_id=p.p_id
            ";
            if($name==null && $date==null ){
                $query=$query;
            }
            if($name!=null && $date==null){
                $query=$query.(" where p.product_name LIKE '%$name%' OR p.product_type LIKE '%$name%' OR p.product_size LIKE '%$name%' OR p.product_id LIKE '%$name%' OR p.p_id LIKE '%$name%'");
            }
            if($date!=null && $name==null){
                $query=$query.(" where sio.created_at LIKE '%$date%'");
            }
            if($date!=null && $name!=null){
                $query=$query.(" where p.product_name LIKE '%$name%' OR p.product_type LIKE '%$name%' OR p.product_size LIKE '%$name%' OR p.product_id LIKE '%$name%' AND sio.created_at LIKE '%$date%' OR p.p_id LIKE '%$name%'");
            }
            $response=DB::select($query.(" ORDER BY sio.stock_id DESC"));
          
      if(Input::get('filter')){
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize =50;
         $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("warehouse/stock/stock_ledger",['result_data'=>$result_data]);
    }
      if(Input::get('print')){
       $data= json_decode( json_encode($response), true);
        
        //==============================================
            return Excel::create('stock_ledger'.$name_date, function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
           $sheet->cell('A1', function($cell) {$cell->setValue('no');});
          $sheet->cell('B1', function($cell) {$cell->setValue('Product ID');});
          $sheet->cell('C1', function($cell) {$cell->setValue('Product Name');});
          $sheet->cell('D1', function($cell) {$cell->setValue('Product Type');});
         $sheet->cell('E1', function($cell) {$cell->setValue('Product Size');});
         $sheet->cell('F1', function($cell) {$cell->setValue('Price Per Item');});
         $sheet->cell('G1', function($cell) {$cell->setValue('In/Out Date');});
         $sheet->cell('H1', function($cell) {$cell->setValue('In');});
         $sheet->cell('I1', function($cell) {$cell->setValue('Out');});



                    $j=1;
                    
                  if (!empty($data)) {
                      foreach ($data as $key => $value) {
                          $i= $key+2;

                          $sheet->cell('A'.$i, $j++);
                          $sheet->cell('B'.$i, $value['product_id']);
                          $sheet->cell('C'.$i, $value['product_name']);
                          $sheet->cell('D'.$i, $value['product_type']);
                          $sheet->cell('E'.$i, $value['product_size']);
                          $sheet->cell('F'.$i, $value['product_price_per_item']);
                          $sheet->cell('G'.$i, $value['verified_date']);
                          $sheet->cell('H'.$i, $value['stock_in']);
                          $sheet->cell('I'.$i, $value['stock_out']);
                  }
              }
        });
       })->download("csv");
        //==============================================
        }
        // dd($result_data);

    }
    public function stock_list()
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize =50;
        $response=DB::select("SELECT p.product_size as product_size,p.product_type as product_type,p.p_id as product_id,s.product_price_per_item as price_per_item,s.created_at as incoming_date,p.product_name,sum(s.stock_in) as total_stock_in,sum(s.stock_out) as total_stock_out,p.product_id as p_id
            FROM  stock_in_out_return as s
             JOIN product as p
            ON p.p_id=s.product_id
            GROUP BY s.product_id
            ");
        // dd($result);
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
    
    	return view("warehouse/stock/stock_list",['result'=>$result]);
    }
   
    public function stock_return()
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize =50;
        $response=DB::select("SELECT dp.user_name,p.p_id,p.product_name,p.product_type,p.product_size,sio.product_price_per_item as price_per_item,sio.created_at as incoming_date,sio.stock_in as in_qty,sio.reason_in_out_return as reason,p.p_id as product_id 
            FROM stock_in_out_return as sio 
            JOIN product as p
            ON p.p_id=sio.product_id
            JOIN delivery_postman as dp
            ON dp.id=sio.postman_id
            WHERE sio.reason_in_out_return IS NOT NULL
            ");
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("warehouse/stock/stock_return",['result'=>$result]);
    }
    public function stock_return_search(Request $request)
    {
        $name=$request->input('search');
        $date=$request->input('date');
         $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize =50;
        $query="SELECT dp.user_name,p.p_id,p.product_name,p.product_type,p.product_size,sio.product_price_per_item as price_per_item,sio.created_at as incoming_date,sio.stock_in as in_qty,sio.reason_in_out_return as reason,p.p_id as product_id 
            FROM stock_in_out_return as sio 
            JOIN product as p
            ON p.p_id=sio.product_id
            JOIN delivery_postman as dp
            ON dp.id=sio.postman_id
            ";
            if($date==null && $name!=null){
                $query=$query.(" where dp.user_name LIKE '%$name%' OR p.product_name LIKE '%$name%' OR p.p_id LIKE '%name%' OR p.product_size LIKE '%$name%' OR p.product_type LIKE '%$name%' OR sio.reason_in_out_return LIKE '%$name%' OR p.p_id LIKE '%$name%'");
            }
            if($date!=null && $name==null){
                $query=$query.(" where sio.created_at LIKE '%$date%'");
            }
            if($date==null && $name==null){
                $query=$query;
            }
            if($date!=null && $name!=null){
                $query=$query.(" where dp.user_name LIKE '%$name%' OR p.product_name LIKE '%$name%' OR p.p_id LIKE '%name%' OR p.product_size LIKE '%$name%' OR p.product_type LIKE '%$name%' OR sio.reason_in_out_return LIKE '%$name%' OR p.p_id LIKE '%$name%' OR sio.created_at LIKE '%$date%'");
            }
        $data=$query.(" AND  sio.reason_in_out_return IS NOT NULL");
        $response=DB::select($data);
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("warehouse/stock/stock_return",['result_data'=>$result_data]);
        // dd($data);
    }
    public function stock_in()
    {
       $response=DB::select("SELECT si.product_id as product_id,p.product_name as product_name,p.product_type as product_type,p.product_size as product_size,si.price_per_item as price_per_item,si.created_at as incoming_date,si.in_qty as in_qty,si.postman_id,si.o_id
            FROM stock_in as si 
            JOIN product as p
            ON p.p_id=si.product_id
            ORDER BY si.id DESC

            ");
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize =50;
             $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("warehouse/stock/stock_in",['result'=>$result]);
    }
      public function stock_out()
    {
         $response=DB::select("SELECT si.product_id as product_id,p.product_name as product_name,p.product_type as product_type,p.product_size as product_size,si.price_per_item as price_per_item,si.created_at as incoming_date,si.out_qty as in_qty,dp.user_name
            FROM stock_out as si 
            JOIN product as p
            ON p.p_id=si.product_id
            JOIN delivery_postman as dp
            ON dp.id=si.postman_id
            ORDER BY si.id DESC
            ");
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize =50;
             $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("warehouse/stock/stock_out",['result'=>$result]);
    }
    public function stock_list_search(Request $request)
    {
         $search=$request->input('search');
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize =50;
      $name_date=date("Y/m/d H:i:sa");

        $query="SELECT p.product_size as product_size,p.product_type as product_type,p.p_id as product_id,s.product_price_per_item as price_per_item,s.created_at as incoming_date,p.product_name,sum(s.stock_in) as total_stock_in,sum(s.stock_out) as total_stock_out
            FROM  stock_in_out_return as s
            JOIN product as p
            ON p.p_id=s.product_id
            ";

            if($search==null){
                $query=$query.("WHERE s.created_at LIKE '%$search%' GROUP BY s.product_id");
              }elseif($search!=null){
                $query=$query.("WHERE (p.product_name LIKE '%$search%' OR p.product_size LIKE '%$search%' OR p.product_type LIKE '%$search%' OR p.p_id LIKE '%$search%' OR p.p_id LIKE '%$search%') GROUP BY p.p_id");
              }
             
              $response=DB::select($query);
              if(Input::get('filter')){
            $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
            $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
            return view("warehouse/stock/stock_list",['result_data'=>$result_data]);
            }
            if(Input::get('print')){
                $data= json_decode( json_encode($response), true);
        
        //==============================================
            return Excel::create('stock_list'.$name_date, function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
           $sheet->cell('A1', function($cell) {$cell->setValue('no');});
          $sheet->cell('B1', function($cell) {$cell->setValue('Product ID');});
          $sheet->cell('C1', function($cell) {$cell->setValue('Product Name');});
          $sheet->cell('D1', function($cell) {$cell->setValue('Product Type');});
         $sheet->cell('E1', function($cell) {$cell->setValue('Product Size');});
         $sheet->cell('F1', function($cell) {$cell->setValue('Price Per Item');});
         $sheet->cell('G1', function($cell) {$cell->setValue('In Qty');});
         $sheet->cell('H1', function($cell) {$cell->setValue('Out Qty');});
         $sheet->cell('I1', function($cell) {$cell->setValue('Balance');});

                    $j=1;
                    
                  if (!empty($data)) {
                      foreach ($data as $key => $value) {
                          $i= $key+2;

                          $sheet->cell('A'.$i, $j++);
                          $sheet->cell('B'.$i, $value['product_id']);
                          $sheet->cell('C'.$i, $value['product_name']);
                          $sheet->cell('D'.$i, $value['product_type']);
                          $sheet->cell('E'.$i, $value['product_size']);
                          $sheet->cell('F'.$i, $value['price_per_item']);
                          $sheet->cell('G'.$i, $value['total_stock_in']);
                          $sheet->cell('H'.$i, $value['total_stock_out']);
                          $sheet->cell('I'.$i, $value['total_stock_in'] - $value['total_stock_out']);
                  }
              }
        });
       })->download("csv");
            }
        

    }
    public function parcel_drop()
    {
         $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 50;
        $response=DB::select("SELECT r_p.division as division,r_p.township as township,r_p.address as address,r_p.assign_date as assign_date,r_p.delivery_charges as delivery_charges,r_p.over_tender_charges,r_p.notification_date as notification_date,rp.status as status,r_p.extra_charges as extra_charges,r_p.paid_unpaid as paid_unpaid,rp.amount as price_per_item,r_p.quantity as quantity,r_p.registration_date as registration_date,r_p.target_date as target_date,r_p.assign_date as assign_date,r_p.registration_date as registration_date,r_p.plan_id as route_plan_id,dp.user_name as user_name,p.product_name as product_name,p.p_id as product_id,rp.updated_at
            FROM route_planning as r_p
            LEFT JOIN route_plan as rp
            ON rp.id=r_p.plan_id
            JOIN product as p
            ON p.p_id=r_p.product_id
            
            JOIN delivery_postman as dp
            ON dp.id=r_p.delivery_postman_id
            where  rp.status=3
            ");
         $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("warehouse/stock/stock_drop",['result'=>$result]);
// dd()
    }
    public function stock_outgoing()
    {
        $postman=DB::select("SELECT * FROM delivery_postman where role_id=0");
        return view("warehouse/stock/stock_outgoing",['postman'=>$postman]);
    }
     public function choose_postman(Request $request)
    {
        $postman_id=$request->input("postman");
        $postman=DB::select("SELECT * FROM delivery_postman where role_id=0");
        $choose_postman=DB::select("SELECT * FROM delivery_postman where id='$postman_id'");
            // $product_list=DB::select("SELECT p.product_name,p.p_id,p.product_size,p.product_type,p.product_vendor_name,so.id as so_id,so.out_qty,so.plan_id
            //             FROM postman_route as pr
            //             JOIN route_plan as rp
            //             ON rp.id=pr.p_id
            //             JOIN route_planning as r_p
            //             ON r_p.plan_id=pr.p_id
            //             JOIN product as p
            //             ON r_p.product_id=p.p_id
            //             JOIN  stock_out as so
            //             ON so.product_id=p.p_id
            //             WHERE pr.postman_id='$postman_id' AND so.postman_id='$postman_id' AND rp.status=2 ORDER BY so.id DESC
            // ");
        // dd($product_list);
        $product_list=DB::select("
          SELECT p.product_name,p.p_id,p.product_size,p.product_type,p.product_vendor_name,so.id as so_id,so.out_qty,so.plan_id
                        FROM stock_out as so
                        JOIN route_plan as rp
                        ON rp.id=so.plan_id
                        JOIN product as p
                        ON so.product_id=p.p_id
                        WHERE so.postman_id='$postman_id' AND rp.status=2 AND rp.parcel_status=1 GROUP BY rp.id ORDER BY so.id DESC
          ");
          return view("warehouse/stock/stock_outgoing",['postman'=>$postman,'choose_postman'=>$choose_postman,'product_list'=>$product_list]);
    }
    public function postman_receive(Request $request)
    {
                $postman_id=$request->input('postman_id');
                $plan_id=$request->input("plan_id");
                $created_at=date("Y-m-d H:i:s");
                $select=DB::select("SELECT p.product_name,p.p_id,p.product_size,p.product_type,p.product_vendor_name,rp.id as plan_id,rp.quantity,rp.amount as price_per_item,rp.target_date,rp.reg_date,rp.created_at as verified_date
                    FROM postman_route as pr
                    JOIN route_plan as rp
                    ON rp.id=pr.p_id
                    JOIN product as p
                    ON p.product_id=rp.product_id
                    JOIN delivery_postman as dp
                    ON dp.id=pr.postman_id
                    JOIN route_planning as r_p
                    ON r_p.plan_id=rp.id
                    WHERE r_p.plan_id='$plan_id' AND r_p.delivery_postman_id='$postman_id' AND rp.customer_confirm_status=0 AND rp.parcel_status=0 GROUP BY rp.id
                    ");
                // dd($select);
                foreach($select as $row) {
                $product_id=$row->p_id;
                $price_per_item=$row->price_per_item;
                $quantity=$row->quantity;
                $total=$price_per_item*$quantity;
                DB::update("UPDATE route_plan set parcel_status=1 where id='$plan_id'");
                  DB::insert("INSERT INTO stock_out  (product_id,price_per_item,out_qty,postman_id,created_at,plan_id) VALUES(?,?,?,?,?,?)",[$product_id,$price_per_item,$quantity,$postman_id,$created_at,$plan_id]);
                  DB::insert("INSERT INTO stock_in_out_return(product_id,verified_date,remark_quantity,product_price_per_item,stock_out,created_at,product_amount,postman_id,plan_id) VALUES(?,?,?,?,?,?,?,?,?)",[$product_id,$created_at,$quantity,$price_per_item,$quantity,$created_at,$total,$postman_id,$plan_id]);
                }
                return Redirect::back();  

    }
    public function postman_receive_cancel($postman_id,$id,$plan_id)
    {
        $result=DB::select("SELECT * FROM stock_out where id='$id'");
       foreach ($result as $row) {
           $product_id=$row->product_id;
           $price_per_item=$row->price_per_item;
           $postman_id=$row->postman_id;
           $date=$row->created_at;
           $qty=$row->out_qty;
           $dates=date("Y-m-d H:i", strtotime($date));
           DB::delete("DELETE FROM stock_in_out_return where product_id='$product_id' AND product_price_per_item='$price_per_item' AND remark_quantity='$qty' AND plan_id='$plan_id'");
           DB::update("UPDATE route_plan SET parcel_status=0 where id='$plan_id'");
       }

           DB::delete("DELETE FROM stock_out where plan_id='$plan_id'");
                return Redirect::back();

    }
    public function stock_in_search(Request $request)
    {
        $name_date=date("Y/m/d H:i:sa");

        $search=$request->input('search');
        $date=$request->input('date');
         $query="SELECT si.product_id as product_id,p.product_name as product_name,p.product_type as product_type,p.product_size as product_size,si.price_per_item as price_per_item,si.created_at as incoming_date,si.in_qty as in_qty,si.postman_id,si.o_id
            FROM stock_in as si 
            JOIN product as p
            ON p.p_id=si.product_id";
            // -- ORDER BY si.id DESC";
            if($search!=null && $date==null){
                $query=$query.(" WHERE si.product_id LIKE '%$search%' OR p.product_name LIKE '%$search%' OR p.product_type LIKE '%$search%' OR p.product_size LIKE '%$search%' OR p.p_id LIKE '%$search%' OR  si.o_id LIKE '%$search%'");
            }
            if($search==null && $date!=null){
                $query=$query.(" WHERE si.created_at LIKE '%$date%'");
            }
            if($search==null && $date==null){
                $query=$query;
            }
            if($search!=null && $date!=null){
                $query=$query.(" WHERE si.product_id LIKE '%$search%' OR p.product_name LIKE '%$search%' OR p.product_type LIKE '%$search%' OR p.product_size LIKE '%$search%' OR p.p_id LIKE '%$search%' OR  si.o_id LIKE '%$search%' AND si.created_at LIKE '%$date%'");
            }
            $result=$query.(" ORDER BY si.id DESC");
            $response=DB::select($result);
            if(Input::get('filter')){
             $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize =50;
             $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("warehouse/stock/stock_in",['result_data'=>$result_data]);
            }
            if(Input::get('print')){
       $data= json_decode( json_encode($response), true);

                 //==============================================
            return Excel::create('stock_in'.$name_date, function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
           $sheet->cell('A1', function($cell) {$cell->setValue('no');});
          $sheet->cell('B1', function($cell) {$cell->setValue('Order ID');});
          $sheet->cell('C1', function($cell) {$cell->setValue('Product ID');});
          $sheet->cell('D1', function($cell) {$cell->setValue('Product Name');});
         $sheet->cell('E1', function($cell) {$cell->setValue('Product Type');});
         $sheet->cell('F1', function($cell) {$cell->setValue('Product Size');});
         $sheet->cell('G1', function($cell) {$cell->setValue('Price Per Item');});
         $sheet->cell('H1', function($cell) {$cell->setValue('Date');});
         $sheet->cell('I1', function($cell) {$cell->setValue('In Qty');});
                    $j=1;
                  if (!empty($data)) {
                      foreach ($data as $key => $value) {
                          $i= $key+2;

                          $sheet->cell('A'.$i, $j++);
                          $sheet->cell('B'.$i, $value['o_id']);
                          $sheet->cell('C'.$i, $value['product_id']);
                          $sheet->cell('D'.$i, $value['product_name']);
                          $sheet->cell('E'.$i, $value['product_type']);
                          $sheet->cell('F'.$i, $value['product_size']);
                          $sheet->cell('G'.$i, $value['price_per_item']);
                          $sheet->cell('H'.$i, $value['incoming_date']);
                          $sheet->cell('I'.$i, $value['in_qty']);
                  }
              }
        });
       })->download("csv");
        //==============================================
            }

    }
    public function stock_outgoing_search(Request $request)
    {
        
      $name_date=date("Y/m/d H:i:sa");

        $search=$request->input('search');
        $date=$request->input('date');
         $query="SELECT si.product_id as product_id,p.product_name as product_name,p.product_type as product_type,p.product_size as product_size,si.price_per_item as price_per_item,si.created_at as incoming_date,si.out_qty as in_qty,dp.user_name
            FROM stock_out as si 
            JOIN product as p
            ON p.p_id=si.product_id
            JOIN delivery_postman as dp
            ON dp.id=si.postman_id";
            // -- ORDER BY si.id DESC";
            if($search!=null && $date==null){
                $query=$query.(" WHERE si.product_id LIKE '%$search%' OR p.product_name LIKE '%$search%' OR p.product_type LIKE '%$search%' OR p.product_size LIKE '%$search%' OR dp.user_name  LIKE '%$search%' OR p.p_id LIKE '%$search%' OR  si.o_id LIKE '%$search%'");
            }
            if($search==null && $date!=null){
                $query=$query.(" WHERE si.created_at LIKE '%$date%'");
            }
            if($search==null && $date==null){
                $query=$query;
            }
            if($search!=null && $date!=null){
                $query=$query.(" WHERE si.product_id LIKE '%$search%' OR p.product_name LIKE '%$search%' OR p.product_type LIKE '%$search%' OR p.product_size LIKE '%$search%' OR dp.user_name  LIKE '%$search%' OR p.p_id LIKE '%$search%' OR  si.o_id LIKE '%$search%' AND si.created_at LIKE '%$date%'");
            }
            $result=$query.(" ORDER BY si.id DESC");
            $response=DB::select($result);
            if(Input::get('filter')){
             $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize =50;
             $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("warehouse/stock/stock_out",['result_data'=>$result_data]);
            }
            if(Input::get('print')){
       $data= json_decode( json_encode($response), true);

                 //==============================================
            return Excel::create('stock_out'.$name_date, function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
           $sheet->cell('A1', function($cell) {$cell->setValue('No');});
          $sheet->cell('B1', function($cell) {$cell->setValue('Delivery Name');});
          $sheet->cell('C1', function($cell) {$cell->setValue('Product ID');});
          $sheet->cell('D1', function($cell) {$cell->setValue('Product Name');});
         $sheet->cell('E1', function($cell) {$cell->setValue('Product Type');});
         $sheet->cell('F1', function($cell) {$cell->setValue('Product Size');});
         $sheet->cell('G1', function($cell) {$cell->setValue('Price Per Item');});
         $sheet->cell('H1', function($cell) {$cell->setValue('Date');});
         $sheet->cell('I1', function($cell) {$cell->setValue('Out Qty');});
                    $j=1;
                  if (!empty($data)) {
                      foreach ($data as $key => $value) {
                          $i= $key+2;

                          $sheet->cell('A'.$i, $j++);
                          $sheet->cell('B'.$i, $value['user_name']);
                          $sheet->cell('C'.$i, $value['product_id']);
                          $sheet->cell('D'.$i, $value['product_name']);
                          $sheet->cell('E'.$i, $value['product_type']);
                          $sheet->cell('F'.$i, $value['product_size']);
                          $sheet->cell('G'.$i, $value['price_per_item']);
                          $sheet->cell('H'.$i, $value['incoming_date']);
                          $sheet->cell('I'.$i, $value['in_qty']);
                  }
              }
        });
       })->download("csv");
        //==============================================
            }

    }
}
