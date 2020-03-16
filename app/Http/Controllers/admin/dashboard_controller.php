<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use DB;
use Excel;
class dashboard_controller extends Controller
{
    public function dashboard()
    {
    	$date=date("Y-m-d");
    	$order=DB::select("SELECT count(id) as order_count FROM order_table where status=0");
    	$stock_in=DB::select("SELECT sum(in_qty) as stock_in_count FROM stock_in where created_at LIKE '%$date%'");
    	$stock_out=DB::select("SELECT sum(out_qty) as stock_out_count FROM stock_out where created_at LIKE '%$date%'");
    	$route_list=DB::select("SELECT count(id) as route_count FROM route_plan where status=0");
    	$postman=DB::select("SELECT * FROM delivery_postman where role_id=0");
    	$noti_date=DB::select("SELECT p.product_name,p.p_id,rp.quantity,rp.amount,t.name as t_name,s.name as s_name,r_p.address,p.product_vendor_name
    		FROM route_plan as rp 
    		JOIN route_planning as r_p
    		ON  rp.id=r_p.plan_id
    		JOIN product as p
    		ON r_p.product_id=p.p_id
    		JOIN state as s
    		ON rp.division=s.id
    		JOIN township as t
    		ON t.id=rp.township
    		WHERE r_p.status=0 AND rp.status=1 AND rp.target_date LIKE '%$date%'
    		");
    	// dd($noti_date);
    	return view("admin/dashboard",['order'=>$order,'stock_in'=>$stock_in,'stock_out'=>$stock_out,'route_list'=>$route_list,'postman'=>$postman,'noti_date'=>$noti_date]);
    }
    public function noti_export()
    {
    	 $name_date=date("Y/m/d H:i:sa");
    	 $date=date("Y-m-d");
    	$result=DB::select("SELECT p.product_name,p.p_id,rp.quantity,rp.amount,t.name as t_name,s.name as s_name,r_p.address,p.product_vendor_name
    		FROM route_plan as rp 
    		JOIN route_planning as r_p
    		ON  rp.id=r_p.plan_id
    		JOIN product as p
    		ON r_p.product_id=p.p_id
    		JOIN state as s
    		ON rp.division=s.id
    		JOIN township as t
    		ON t.id=rp.township
    		WHERE r_p.status=0 AND rp.status=1 AND r_p.notification_date LIKE '%$date%'
    		");
    	$data= json_decode(json_encode($result), true);
    	// dd($data);
    	//==============================================
    		return Excel::create('Notification_Date'.$name_date, function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
           $sheet->cell('A1', function($cell) {$cell->setValue('no');});
          $sheet->cell('B1', function($cell) {$cell->setValue('product_id');});
          $sheet->cell('C1', function($cell) {$cell->setValue('product_name');});
          $sheet->cell('D1', function($cell) {$cell->setValue('quantity');});
         $sheet->cell('E1', function($cell) {$cell->setValue('amount');});
         $sheet->cell('F1', function($cell) {$cell->setValue('total');});
         $sheet->cell('G1', function($cell) {$cell->setValue('address');});
         $sheet->cell('H1', function($cell) {$cell->setValue('vendor');});


          			$j=1;
          			
                  if (!empty($data)) {
                      foreach ($data as $key => $value) {
                          $i= $key+2;

                          $sheet->cell('A'.$i, $j++);
                          $sheet->cell('B'.$i, $value['p_id']);
                          $sheet->cell('C'.$i, $value['product_name']);
                          $sheet->cell('D'.$i, $value['quantity']);
                          $sheet->cell('E'.$i, $value['amount']);
                          $sheet->cell('F'.$i, $value['quantity']*$value['amount']);
                          $sheet->cell('G'.$i, $value['address'].','.$value['t_name'].','.$value['s_name']);
                          $sheet->cell('H'.$i, $value['product_vendor_name']);
                  }
              }
        });
       })->download("csv");
    	//==============================================
    }
    public function stock_in()
    {
      $date=date("Y-m-d");
      $result=DB::select("SELECT si.product_id as product_id,p.product_name as product_name,p.product_type as product_type,p.product_size as product_size,si.price_per_item as price_per_item,si.created_at as incoming_date,si.in_qty as in_qty,si.postman_id,si.o_id
            FROM stock_in as si 
            JOIN product as p
            ON p.p_id=si.product_id
            WHERE si.created_at LIKE '%$date%'
            ORDER BY si.id DESC
            ");
        return view("admin/dashboard/stock_in",['result'=>$result]);
    }
    public function stock_in_export()
    {
      $name_date=date("Y/m/d H:i:sa");

     $date=date("Y-m-d");
      $response=DB::select("SELECT si.product_id as product_id,p.product_name as product_name,p.product_type as product_type,p.product_size as product_size,si.price_per_item as price_per_item,si.created_at as incoming_date,si.in_qty as in_qty,si.postman_id,si.o_id
            FROM stock_in as si 
            JOIN product as p
            ON p.p_id=si.product_id
            WHERE si.created_at LIKE '%$date%'
            ORDER BY si.id DESC
            ");
      $data= json_decode(json_encode($response), true);
      // dd($data);
      //==============================================
        return Excel::create('Notification_Date'.$name_date, function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
           $sheet->cell('A1', function($cell) {$cell->setValue('no');});
          $sheet->cell('B1', function($cell) {$cell->setValue('order_id');});
          $sheet->cell('C1', function($cell) {$cell->setValue('product_id');});
          $sheet->cell('D1', function($cell) {$cell->setValue('product_name');});
         $sheet->cell('E1', function($cell) {$cell->setValue('product_type');});
         $sheet->cell('F1', function($cell) {$cell->setValue('product_size');});
         $sheet->cell('G1', function($cell) {$cell->setValue('price_per_item');});
         $sheet->cell('H1', function($cell) {$cell->setValue('date');});
         $sheet->cell('I1', function($cell) {$cell->setValue('in_qty');});
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
    public function stock_out()
    {
        $result=DB::select("SELECT si.product_id as product_id,p.product_name as product_name,p.product_type as product_type,p.product_size as product_size,si.price_per_item as price_per_item,si.created_at as incoming_date,si.out_qty as in_qty,dp.user_name
            FROM stock_out as si 
            JOIN product as p
            ON p.p_id=si.product_id
            JOIN delivery_postman as dp
            ON dp.id=si.postman_id
            ORDER BY si.id DESC
            ");
        return view("admin/dashboard/stock_out",['result'=>$result]);
    }
    public function stock_out_export()
    {
      $name_date=date("Y/m/d H:i:sa");

     $date=date("Y-m-d");
      $response=DB::select("SELECT si.product_id as product_id,p.product_name as product_name,p.product_type as product_type,p.product_size as product_size,si.price_per_item as price_per_item,si.created_at as incoming_date,si.out_qty as in_qty,si.postman_id,si.o_id
            FROM stock_in as si 
            JOIN product as p
            ON p.p_id=si.product_id
            WHERE si.created_at LIKE '%$date%'
            ORDER BY si.id DESC
            ");
      $data= json_decode(json_encode($response), true);
      // dd($data);
      //==============================================
        return Excel::create('stock_outgoing_product'.$name_date, function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
           $sheet->cell('A1', function($cell) {$cell->setValue('no');});
          $sheet->cell('B1', function($cell) {$cell->setValue('order_id');});
          $sheet->cell('C1', function($cell) {$cell->setValue('product_id');});
          $sheet->cell('D1', function($cell) {$cell->setValue('product_name');});
         $sheet->cell('E1', function($cell) {$cell->setValue('product_type');});
         $sheet->cell('F1', function($cell) {$cell->setValue('product_size');});
         $sheet->cell('G1', function($cell) {$cell->setValue('price_per_item');});
         $sheet->cell('H1', function($cell) {$cell->setValue('date');});
         $sheet->cell('I1', function($cell) {$cell->setValue('in_qty');});
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
    public function drop($pr_id,$rp_id)
    {
    $updated_at=date("Y-m-d H:i:s");
    $payment=0;
      DB::update("UPDATE route_planning SET status=3,paid_unpaid='$payment' where plan_id='$rp_id'");
      DB::update("UPDATE route_plan SET status=3,updated_at='$updated_at' where id='$rp_id'");
      DB::update("UPDATE postman_route SET status=3 where p_id='$rp_id'");
    return Redirect::back();
    }
}