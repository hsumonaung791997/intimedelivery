<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Excel;
class stock_controller extends Controller
{
      public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function stock_ledger()
    {

        $response=DB::select("SELECT p.product_id,p.product_name,p.product_type,sio.stock_in,sio.stock_out,sio.product_price_per_item,dp.user_name,sio.reason_in_out_return,sio.created_at as verified_date,p.product_size,p.p_id as product_id,sio.order_id 
            FROM stock_in_out_return as sio
             LEFT JOIN  delivery_postman as dp
            ON dp.id=sio.postman_id
              JOIN product as p
            ON sio.product_id=p.p_id
            ORDER BY sio.stock_id DESC
            ");
        
                $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 100;
         $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        // dd($result);
    	return view("admin/stock/stock_ledger",['result'=>$result]);
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
        $pageSize = 100;
         $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/stock/stock_ledger",['result_data'=>$result_data]);
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
        $pageSize = 100;
        $response=DB::select("SELECT p.product_size as product_size,p.product_type as product_type,p.p_id as product_id,s.product_price_per_item as price_per_item,s.created_at as incoming_date,p.product_name,sum(s.stock_in) as total_stock_in,sum(s.stock_out) as total_stock_out,p.product_id as p_id
            FROM  stock_in_out_return as s
             JOIN product as p
            ON p.p_id=s.product_id
            GROUP BY s.product_id
            ");
        // dd($result);
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
    
    	return view("admin/stock/stock_list",['result'=>$result]);
    }
   
    public function stock_return()
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 100;
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
    	return view("admin/stock/stock_return",['result'=>$result]);
    }
    public function stock_return_search(Request $request)
    {
      $name_date=date("Y/m/d H:i:sa");
      
        $name=$request->input('search');
        $date=$request->input('date');
         $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 100;
        $query="SELECT dp.user_name,p.p_id,p.product_name,p.product_type,p.product_size,sio.product_price_per_item as price_per_item,sio.created_at as incoming_date,sio.stock_in as in_qty,sio.reason_in_out_return as reason,p.p_id as product_id 
            FROM stock_in_out_return as sio 
            JOIN product as p
            ON p.p_id=sio.product_id
            JOIN delivery_postman as dp
            ON dp.id=sio.postman_id
            ";
            if($date==null && $name!=null){
                $query=$query.(" where (dp.user_name LIKE '%$name%' OR p.product_name LIKE '%$name%' OR p.p_id LIKE '%name%' OR p.product_size LIKE '%$name%' OR p.product_type LIKE '%$name%' OR sio.reason_in_out_return LIKE '%$name%' OR p.p_id LIKE '%$name%')");
            }
            if($date!=null && $name==null){
                $query=$query.(" where (sio.created_at LIKE '%$date%')");
            }
            if($date==null && $name==null){
                $query=$query;
            }
            if($date!=null && $name!=null){
                $query=$query.(" where (dp.user_name LIKE '%$name%' OR p.product_name LIKE '%$name%' OR p.p_id LIKE '%name%' OR p.product_size LIKE '%$name%' OR p.product_type LIKE '%$name%' OR sio.reason_in_out_return LIKE '%$name%' OR p.p_id LIKE '%$name%') AND (sio.created_at LIKE '%$date%')");
            }
        $data=$query.(" AND  sio.reason_in_out_return IS NOT NULL");
        $response=DB::select($data);
        if(Input::get('filter')){

        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/stock/stock_return",['result_data'=>$result_data]);
        // dd($data);
        }
        if(Input::get('print')){
            $data= json_decode( json_encode($response), true);
        
        //==============================================
            return Excel::create('stock_return'.$name_date, function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
           $sheet->cell('A1', function($cell) {$cell->setValue('no');});
          $sheet->cell('B1', function($cell) {$cell->setValue('Postman');});
          $sheet->cell('C1', function($cell) {$cell->setValue('Product ID');});
          $sheet->cell('D1', function($cell) {$cell->setValue('Product Name');});
         $sheet->cell('E1', function($cell) {$cell->setValue('Product Type');});
         $sheet->cell('F1', function($cell) {$cell->setValue('Product Size');});
         $sheet->cell('G1', function($cell) {$cell->setValue('Price Per Item');});
         $sheet->cell('H1', function($cell) {$cell->setValue('Date');});
         $sheet->cell('I1', function($cell) {$cell->setValue('In Qty');});
         $sheet->cell('J1', function($cell) {$cell->setValue('Remark');});

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
                          $sheet->cell('J'.$i, $value['reason']);

                  }
              }
        });
       })->download("csv");
        //==============================================
        }
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
        $pageSize = 100;
             $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/stock/stock_in",['result'=>$result]);
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
        $pageSize = 100;
             $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/stock/stock_in",['result_data'=>$result_data]);
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
        $pageSize = 100;
             $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/stock/stock_out",['result'=>$result]);
    }
     public function stock_out_search(Request $request)
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
        $pageSize = 100;
             $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/stock/stock_out",['result_data'=>$result_data]);
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
    public function stock_list_search(Request $request)
    {
        $search=$request->input('search');
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 100;
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
            return view("admin/stock/stock_list",['result_data'=>$result_data]);
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
        $pageSize = 100;
        $response=DB::select("SELECT r_p.division as division,r_p.township as township,r_p.address as address,r_p.assign_date as assign_date,r_p.delivery_charges as delivery_charges,r_p.over_tender_charges,r_p.notification_date as notification_date,rp.status as status,r_p.extra_charges as extra_charges,r_p.paid_unpaid as paid_unpaid,rp.amount as price_per_item,r_p.quantity as quantity,r_p.registration_date as registration_date,r_p.target_date as target_date,r_p.assign_date as assign_date,r_p.registration_date as registration_date,r_p.plan_id as route_plan_id,dp.user_name as user_name,p.product_name as product_name,p.p_id as product_id,rp.updated_at,t.name as t_name,s.name as s_name,rp.phone,rp.foc,r_p.remark,rp.r_name,p.product_type
            FROM route_planning as r_p
            LEFT JOIN route_plan as rp
            ON rp.id=r_p.plan_id
            JOIN product as p
            ON p.p_id=r_p.product_id
            JOIN township as t
            ON t.id=r_p.township
            JOIN state as s
            ON s.id=r_p.division
            JOIN delivery_postman as dp
            ON dp.id=r_p.delivery_postman_id
            where  rp.status=3 GROUP BY rp.id  ORDER BY rp.updated_at DESC
            ");
         $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/stock/stock_drop",['result'=>$result]);
    }
    public function parcel_drop_search(Request $request)
    {

      $name_date=date("Y/m/d H:i:sa");
      $name=$request->input('search');
      $date=$request->input('date');
         $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 100;
        $query="SELECT r_p.division as division,r_p.township as township,r_p.address as address,r_p.assign_date as assign_date,r_p.delivery_charges as delivery_charges,r_p.over_tender_charges,r_p.notification_date as notification_date,rp.status as status,r_p.extra_charges as extra_charges,r_p.paid_unpaid as paid_unpaid,rp.amount as price_per_item,r_p.quantity as quantity,r_p.registration_date as registration_date,r_p.target_date as target_date,r_p.assign_date as assign_date,r_p.registration_date as registration_date,r_p.plan_id as route_plan_id,dp.user_name as user_name,p.product_name as product_name,p.p_id as product_id,rp.updated_at,t.name as t_name,s.name as s_name,rp.phone,rp.foc,rp.foc,r_p.remark,rp.r_name,p.product_type
            FROM route_planning as r_p
            LEFT JOIN route_plan as rp
            ON rp.id=r_p.plan_id
            JOIN township as t
            ON t.id=r_p.township
            JOIN state as s
            ON s.id=r_p.division
            JOIN product as p
            ON p.p_id=r_p.product_id
            
            JOIN delivery_postman as dp
            ON dp.id=r_p.delivery_postman_id
            ";
            if($name!=null && $date==null){
              $query=$query.(" where (p.product_id LIKE '%$name%' OR p.p_id LIKE '%$name%' OR p.product_name LIKE '%$name%' OR dp.user_name LIKE '%$name%')");
            }
            if($name==null && $date!=null){
              $query=$query.(" where (r_p.registration_date LIKE '%$date%' OR rp.updated_at LIKE '%$date%')");
            }
            if($name!=null && $date!=null){
              $query=$query.(" where (p.product_id LIKE '%$name%' OR p.p_id LIKE '%$name%' OR p.product_name LIKE '%$name%' OR dp.user_name LIKE '%$name%') AND (r_p.registration_date LIKE '%$date%' OR rp.updated_at LIKE '%$date%')");
            }
            if($name==null && $date==null){
              $query;
            }
            if($name!=null || $date!=null){
              $result=$query.(" AND (rp.status=3) ORDER BY rp.id DESC");
            }else{
              $result=$query.(" where (rp.status=3) ORDER BY rp.id DESC");
            }
            // dd($result);
            $response=DB::select($result);
            if(Input::get('filter')){
            $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
            $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
            return view("admin/stock/stock_drop",['result_data'=>$result_data]);     
            }
            if(Input::get('print')){
                $data= json_decode( json_encode($response), true);

                return Excel::create('Parcel_Drop_List'.$name_date, function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
           $sheet->cell('A1', function($cell) {$cell->setValue('id');});
           $sheet->cell('B1', function($cell) {$cell->setValue('Customer Name');});
          $sheet->cell('C1', function($cell) {$cell->setValue('Product ID');});
          $sheet->cell('D1', function($cell) {$cell->setValue('Product Name');});
          $sheet->cell('E1', function($cell) {$cell->setValue('Quantity');});
         $sheet->cell('F1', function($cell) {$cell->setValue('Price Per Item');});
         $sheet->cell('G1', function($cell) {$cell->setValue('Total Amount');});
          $sheet->cell('H1', function($cell) {$cell->setValue('Address');});
          $sheet->cell('I1', function($cell) {$cell->setValue('Delivery Name');});
           $sheet->cell('J1', function($cell) {$cell->setValue('Extra Charge');});
          $sheet->cell('K1', function($cell) {$cell->setValue('Over Charge');});
          $sheet->cell('L1', function($cell) {$cell->setValue('Delivery Charge');});
          $sheet->cell('M1', function($cell) {$cell->setValue('Payment Status');});
         $sheet->cell('N1', function($cell) {$cell->setValue('Registration Date');});
         $sheet->cell('O1', function($cell) {$cell->setValue('F.O.C');});
          $sheet->cell('P1', function($cell) {$cell->setValue('Total Charges');});

          
                  if (!empty($data)) {
                    $ids=1;
                      foreach ($data as $key => $value) {
                          $i= $key+2;
                          if($value['paid_unpaid']==0){
                            $paymennt='Unpaid';
                          }else{
                            $paymennt='Paid';
                          }
                         $total_amount=$value['extra_charges']+$value['over_tender_charges']+$value['delivery_charges'];
                           $total_price= $value['quantity']*$value['price_per_item'];
                          $sheet->cell('A'.$i, $ids++);
                          $sheet->cell('B'.$i, $value['r_name']);
                          $sheet->cell('C'.$i, $value['product_id']);
                          $sheet->cell('D'.$i, $value['product_type']);
                          $sheet->cell('E'.$i, $value['quantity']);
                          $sheet->cell('F'.$i, $value['price_per_item']);
                          $sheet->cell('G'.$i, $total_price);
                          $sheet->cell('H'.$i, $value['address'].','.$value['township'].','.$value['division']);
                          $sheet->cell('I'.$i, $value['user_name']);
                          $sheet->cell('J'.$i, $value['extra_charges']);
                          $sheet->cell('K'.$i, $value['over_tender_charges']);
                          $sheet->cell('L'.$i, $value['delivery_charges']);
                          $sheet->cell('M'.$i, $paymennt);
                          $sheet->cell('N'.$i, $value['registration_date']);
                          $sheet->cell('O'.$i, $value['foc']);
                          $sheet->cell('P'.$i, $total_price+$total_amount);
                      
                  }
              }
        });
       })->download("xlsx");

            }
      }
   public function parcel_return()
    {
         $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 100;
        $response=DB::select("SELECT r_p.division as division,r_p.township as township,r_p.address as address,r_p.assign_date as assign_date,r_p.delivery_charges as delivery_charges,r_p.over_tender_charges,r_p.notification_date as notification_date,rp.status as status,r_p.extra_charges as extra_charges,r_p.paid_unpaid as paid_unpaid,rp.amount as price_per_item,r_p.quantity as quantity,r_p.registration_date as registration_date,r_p.target_date as target_date,r_p.assign_date as assign_date,r_p.registration_date as registration_date,r_p.plan_id as route_plan_id,dp.user_name as user_name,p.product_name as product_name,p.p_id as product_id,rp.updated_at,t.name as t_name,s.name as s_name,rp.phone
            FROM route_planning as r_p
            LEFT JOIN route_plan as rp
            ON rp.id=r_p.plan_id
            JOIN product as p
            ON p.p_id=r_p.product_id
            JOIN township as t
            ON t.id=r_p.township
            JOIN state as s
            ON s.id=r_p.division
            JOIN delivery_postman as dp
            ON dp.id=r_p.delivery_postman_id
            where  rp.status=3 ORDER BY rp.id DESC
            ");
         $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/stock/stock_drop",['result'=>$result]);
    }
    public function parcel_return_search(Request $request)
    {

      $name_date=date("Y/m/d H:i:sa");
      $name=$request->input('search');
      $date=$request->input('date');
         $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 100;
        $query="SELECT r_p.division as division,r_p.township as township,r_p.address as address,r_p.assign_date as assign_date,r_p.delivery_charges as delivery_charges,r_p.over_tender_charges,r_p.notification_date as notification_date,rp.status as status,r_p.extra_charges as extra_charges,r_p.paid_unpaid as paid_unpaid,rp.amount as price_per_item,r_p.quantity as quantity,r_p.registration_date as registration_date,r_p.target_date as target_date,r_p.assign_date as assign_date,r_p.registration_date as registration_date,r_p.plan_id as route_plan_id,dp.user_name as user_name,p.product_name as product_name,p.p_id as product_id,rp.updated_at,t.name as t_name,s.name as s_name,rp.phone
            FROM route_planning as r_p
            LEFT JOIN route_plan as rp
            ON rp.id=r_p.plan_id
            JOIN township as t
            ON t.id=r_p.township
            JOIN state as s
            ON s.id=r_p.division
            JOIN product as p
            ON p.p_id=r_p.product_id
            
            JOIN delivery_postman as dp
            ON dp.id=r_p.delivery_postman_id
            ";
            if($name!=null && $date==null){
              $query=$query.(" where (p.product_id LIKE '%$name%' OR p.p_id LIKE '%$name%' OR p.product_name LIKE '%$name%' OR dp.user_name LIKE '%$name%')");
            }
            if($name==null && $date!=null){
              $query=$query.(" where (r_p.registration_date LIKE '%$date%' OR rp.updated_at LIKE '%$date%')");
            }
            if($name!=null && $date!=null){
              $query=$query.(" where (p.product_id LIKE '%$name%' OR p.p_id LIKE '%$name%' OR p.product_name LIKE '%$name%' OR dp.user_name LIKE '%$name%') AND (r_p.registration_date LIKE '%$date%' OR rp.updated_at LIKE '%$date%')");
            }
            if($name==null && $date==null){
              $query;
            }
            if($name!=null || $date!=null){
              $result=$query.(" AND (rp.status=3) ORDER BY rp.id DESC");
            }else{
              $result=$query.(" where (rp.status=3) ORDER BY rp.id DESC");
            }
            // dd($result);
            $response=DB::select($result);
            if(Input::get('filter')){
            $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
            $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
            return view("admin/stock/stock_drop",['result_data'=>$result_data]);     
            }
            if(Input::get('print')){
                $data= json_decode( json_encode($response), true);

                return Excel::create('Parcel_Drop_List'.$name_date, function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
           $sheet->cell('A1', function($cell) {$cell->setValue('id');});
          $sheet->cell('B1', function($cell) {$cell->setValue('Product ID');});
          $sheet->cell('C1', function($cell) {$cell->setValue('Product Name');});
          $sheet->cell('D1', function($cell) {$cell->setValue('Quantity');});
         $sheet->cell('E1', function($cell) {$cell->setValue('Price Per Item');});
         $sheet->cell('F1', function($cell) {$cell->setValue('Total Amount');});
          $sheet->cell('G1', function($cell) {$cell->setValue('Address');});
          $sheet->cell('H1', function($cell) {$cell->setValue('Delivery Name');});
           $sheet->cell('I1', function($cell) {$cell->setValue('Extra Charge');});
          $sheet->cell('J1', function($cell) {$cell->setValue('Over Charge');});
          $sheet->cell('K1', function($cell) {$cell->setValue('Delivery Charge');});
          $sheet->cell('L1', function($cell) {$cell->setValue('Payment Status');});
         $sheet->cell('M1', function($cell) {$cell->setValue('Registration Date');});
         $sheet->cell('N1', function($cell) {$cell->setValue('Target Date');});
          $sheet->cell('O1', function($cell) {$cell->setValue('Total Charges');});

          
                  if (!empty($data)) {
                    $ids=1;
                      foreach ($data as $key => $value) {
                          $i= $key+2;
                          if($value['paid_unpaid']==0){
                            $paymennt='Unpaid';
                          }else{
                            $paymennt='Paid';
                          }
                         $total_amount=$value['extra_charges']+$value['over_tender_charges']+$value['delivery_charges'];
                           $total_price= $value['quantity']*$value['price_per_item'];
                          $sheet->cell('A'.$i, $ids++);
                          $sheet->cell('B'.$i, $value['product_id']);
                          $sheet->cell('C'.$i, $value['product_name']);
                          $sheet->cell('D'.$i, $value['quantity']);
                          $sheet->cell('E'.$i, $value['price_per_item']);
                          $sheet->cell('F'.$i, $total_price);
                          $sheet->cell('G'.$i, $value['address'].','.$value['township'].','.$value['division']);
                          $sheet->cell('H'.$i, $value['user_name']);
                          $sheet->cell('I'.$i, $value['extra_charges']);
                          $sheet->cell('J'.$i, $value['over_tender_charges']);
                          $sheet->cell('K'.$i, $value['delivery_charges']);
                          $sheet->cell('L'.$i, $paymennt);
                          $sheet->cell('M'.$i, $value['registration_date']);
                          $sheet->cell('N'.$i, $value['target_date']);
                          $sheet->cell('O'.$i, $total_price+$total_amount);
                      
                  }
              }
        });
       })->download("csv");

            }
      }
      public function highway_drop_list()
      {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 100;
        $response=DB::select("SELECT r_p.division as division,r_p.township as township,r_p.address as address,r_p.assign_date as assign_date,r_p.delivery_charges as delivery_charges,r_p.over_tender_charges,r_p.notification_date as notification_date,rp.status as status,r_p.extra_charges as extra_charges,r_p.paid_unpaid as paid_unpaid,rp.amount as price_per_item,r_p.quantity as quantity,r_p.registration_date as registration_date,r_p.target_date as target_date,r_p.assign_date as assign_date,r_p.registration_date as registration_date,r_p.plan_id as route_plan_id,dp.user_name as user_name,p.product_name as product_name,p.p_id as product_id,rp.updated_at,t.name as t_name,s.name as s_name,rp.phone,rp.foc,r_p.remark,rp.r_name,p.product_type
            FROM route_planning as r_p
            LEFT JOIN route_plan as rp
            ON rp.id=r_p.plan_id
            JOIN product as p
            ON p.p_id=r_p.product_id
            JOIN township as t
            ON t.id=r_p.township
            JOIN state as s
            ON s.id=r_p.division
            JOIN highway as h
            ON rp.id=h.plan_id
            JOIN delivery_postman as dp
            ON dp.id=r_p.delivery_postman_id
            where  rp.status=3 AND r_p.high_way=1 GROUP BY rp.id  ORDER BY rp.updated_at DESC
            ");
         $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/highway/drop_list",['result'=>$result]);
      }
  
}
