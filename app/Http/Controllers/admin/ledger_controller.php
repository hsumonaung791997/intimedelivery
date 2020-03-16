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

class ledger_controller extends Controller
{
      public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function settlement()
    {
    	return view("admin/ledger/settlement");
    }
    public function settlement_create()
    {
    	return view("admin/ledger/settlement_create");
    }
    public function account_ledger_edit($id,$route_id)
    {

        $result=DB::select("
            SELECT r_p.division as division,r_p.township as township,r_p.address as address,r_p.assign_date as assign_date,r_p.delivery_charges as delivery_charges,r_p.over_tender_charges,r_p.notification_date as notification_date,rp.status as status,r_p.extra_charges as extra_charges,r_p.paid_unpaid as paid_unpaid,rp.amount as price_per_item,r_p.quantity as quantity,r_p.registration_date as registration_date,r_p.target_date as target_date,al.acc_transction_id as acc_transction_id,r_p.assign_date as assign_date,r_p.registration_date as registration_date,r_p.plan_id as route_plan_id,dp.user_name as user_name,p.product_name as product_name,p.p_id as product_id,al.id as alid,rp.phone
            FROM route_planning as r_p
            JOIN route_plan as rp
            ON rp.id=r_p.plan_id
            JOIN product as p
            ON p.p_id=r_p.product_id
            JOIN account_ledger as al
            ON al.route_plan_id=r_p.plan_id
            JOIN delivery_postman as dp
            ON dp.id=r_p.delivery_postman_id
            WHERE al.id='$id'
            ");
        return view("admin/ledger/account_ledger_edit",['result'=>$result]);
    }
    public function account_ledger_update(Request $request)
    {
        $payment_status=$request->input('payment_status');
        $extra_charges=$request->input('extra_charges');
        $route_plan_id=$request->input('route_plan_id');
        $alid=$request->input('alid');
        $acc_t_id=$request->input('acc_t_id');
        $price_per_item=$request->input('price_per_item');
        $qty=$request->input('qty');
        $total_amount=$request->input('total_amount');
        $delivery_charges=$request->input('delivery_charges');
        $over_tender_charges=$request->input('over_tender_charges');
        $notification_date=$request->input('notification_date');
        $charges=$extra_charges+$delivery_charges+$over_tender_charges;
        $status=$request->input('status');
        DB::update("UPDATE account_ledger set acc_transction_id='$acc_t_id',route_plan_id='$route_plan_id',price='$price_per_item',quantity='$qty',amount='$total_amount',paid_unpaid='$payment_status',charges='$charges',notification_date='$notification_date',route_status='$status' where id='$alid'");
        return redirect('admin/ledger/list');
    }
    public function ledger_list()
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 50;
        $response=DB::select("SELECT r_p.division as division,r_p.township as township,r_p.address as address,r_p.assign_date as assign_date,r_p.delivery_charges as delivery_charges,r_p.over_tender_charges,r_p.notification_date as notification_date,rp.status as status,r_p.extra_charges as extra_charges,r_p.paid_unpaid as paid_unpaid,rp.amount as price_per_item,r_p.quantity as quantity,r_p.registration_date as registration_date,rp.target_date as target_date,al.acc_transction_id as acc_transction_id,r_p.assign_date as assign_date,r_p.registration_date as registration_date,r_p.plan_id as route_plan_id,dp.user_name as user_name,p.product_name as product_name,p.p_id as product_id,al.id as alid,r_p.remark,p.product_vendor_name,rp.phone,t.name as t_name,s.name as s_name
            FROM route_planning as r_p
            JOIN route_plan as rp
            ON rp.id=r_p.plan_id
            JOIN product as p
            ON p.p_id=r_p.product_id
            JOIN account_ledger as al
            ON al.route_plan_id=r_p.plan_id
            JOIN township as t
            ON t.id=r_p.township
            JOIN state as s
            ON s.id=r_p.division
            JOIN delivery_postman as dp
            ON dp.id=r_p.delivery_postman_id
            ORDER BY al.id DESC
            ");

         // al,dp,r_p,rp,p
         $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view("admin/ledger/ledger_list",['result'=>$result]);
    }
    public function ledger_list_search(Request $request)
    {
      $name_date=date("Y/m/d H:i:sa");

        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 50;
        $search=$request->input('search');
        $date=$request->input('date');
     
        $payment_status=$request->input('payment_status');
        $route_status=$request->input('route_status');
        $query="SELECT s.name as division,t.name as township,r_p.address as address,r_p.delivery_charges as delivery_charges,r_p.over_tender_charges,r_p.notification_date as notification_date,rp.status as status,r_p.extra_charges as extra_charges,r_p.paid_unpaid as paid_unpaid,rp.amount as price_per_item,r_p.quantity as quantity,r_p.registration_date as registration_date,rp.target_date as target_date,al.acc_transction_id as acc_transction_id,r_p.assign_date as assign_date,r_p.plan_id as route_plan_id,dp.user_name as user_name,p.product_name as product_name,p.p_id as product_id,al.id as alid,r_p.remark,p.product_vendor_name,rp.phone,t.name as t_name,s.name as s_name
            FROM route_planning as r_p
            JOIN route_plan as rp
            ON rp.id=r_p.plan_id
            JOIN product as p
            ON p.p_id=r_p.product_id
            JOIN account_ledger as al
            ON al.route_plan_id=r_p.plan_id
            JOIN township as t
            ON t.id=r_p.township
            JOIN state as s
            ON s.id=r_p.division
            JOIN delivery_postman as dp
            ON dp.id=r_p.delivery_postman_id
            JOIN township as t
            ON rp.township=t.id
            JOIN state as s
            ON rp.division=s.id

            ";
            if($search!=null){
                $query=$query.(" where (s.name LIKE '%$search' OR t.name LIKE '%$search%' OR r_p.address LIKE '%$search%' OR r_p.delivery_charges LIKE '%$search%' OR r_p.over_tender_charges LIKE '%$search%' OR r_p.notification_date LIKE '%$search%' OR rp.status LIKE '%$search%' OR r_p.extra_charges LIKE '%$search%' OR al.acc_transction_id LIKE '%$search%' OR dp.user_name LIKE '%$search%' OR p.product_name LIKE '%$search%' OR p.p_id LIKE '%$search%' OR r_p.remark LIKE '%$search%' OR p.product_vendor_name LIKE '%$search%')");
            }else{
                $query=$query;
            }
            if($date!=null){
                if($search==null){
                $query=$query.(" WHERE (r_p.registration_date LIKE '%$date%')");
                }elseif($search!=null){
                 $query=$query.(" AND (r_p.registration_date LIKE '%$date%')");   
                }
            }elseif ($date==null) {
                $query=$query;
            }
            if($payment_status!=null){
                if($date!=null || $search!=null){
                    $query=$query.(" AND (r_p.paid_unpaid='$payment_status')");
                }else{
                    $query=$query.(" WHERE (r_p.paid_unpaid='$payment_status')");
                }
            }else{
                $query=$query;
            }
            if($route_status!=null){
                if($date!=null || $search!=null || $payment_status!=null){
                    $query=$query.(" AND  (rp.status='$route_status')");
                }else{
                    $query=$query.(" WHERE (rp.status='$route_status')");
                }
            }else{
                $query=$query;
            }
            // dd($query);
            $response=DB::select($query.(" ORDER BY al.id DESC"));
            if(Input::get("filter")){
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        // dd($result_data);
        return view("admin/ledger/ledger_list",['result_data'=>$result_data]);
        }
        if(Input::get("print")){
                $data= json_decode( json_encode($response), true);

                return Excel::create('Account_Ledger'.$name_date, function($excel) use ($data) {
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
           $sheet->cell('A1', function($cell) {$cell->setValue('No');});
          $sheet->cell('B1', function($cell) {$cell->setValue('Acc T ID');});
          $sheet->cell('C1', function($cell) {$cell->setValue('Product ID');});
          $sheet->cell('D1', function($cell) {$cell->setValue('Product Name');});
         $sheet->cell('E1', function($cell) {$cell->setValue('Price Per Item');});
         $sheet->cell('F1', function($cell) {$cell->setValue('Quantity');});
         $sheet->cell('G1', function($cell) {$cell->setValue('Total Amount');});
          $sheet->cell('H1', function($cell) {$cell->setValue('Address');});
          $sheet->cell('I1', function($cell) {$cell->setValue('Delivery Name');});
          $sheet->cell('J1', function($cell) {$cell->setValue('Route Status');});
           $sheet->cell('K1', function($cell) {$cell->setValue('Extra Charges');});
          $sheet->cell('L1', function($cell) {$cell->setValue('Over Charges');});
          $sheet->cell('M1', function($cell) {$cell->setValue('Delivery Charges');});
          $sheet->cell('N1', function($cell) {$cell->setValue('Payment Status');});
         $sheet->cell('O1', function($cell) {$cell->setValue('Registration Date');});
         $sheet->cell('P1', function($cell) {$cell->setValue('Target Date');});
          $sheet->cell('Q1', function($cell) {$cell->setValue('Total Charges');});

            $j=1;
                  if (!empty($data)) {
                      foreach ($data as $key => $value) {

                          $i= $key+2;
                          if($value['status']==2){
                            $status='Assign';
                          }
                          elseif($value['status']==3){
                            $status='Drop';
                          }elseif ($value['status']==5) {
                            $status='Return';
                          }

                          if($value['paid_unpaid']==0){
                            $payment_status='Unpaid';
                          }elseif ($value['paid_unpaid']==1) {
                            $payment_status='Paid';
                          }

                          $total_amount=$value['extra_charges']+$value['over_tender_charges']+$value['delivery_charges'];
                          $p_total=$value['quantity']*$value['price_per_item'];
                          $total_charges=$total_amount+$p_total;
                          $sheet->cell('A'.$i, $j++);
                          $sheet->cell('B'.$i, $value['acc_transction_id']);
                          $sheet->cell('C'.$i, $value['product_id']);
                          $sheet->cell('D'.$i, $value['product_name']);
                          $sheet->cell('E'.$i, $value['price_per_item']);
                          $sheet->cell('F'.$i, $value['quantity']);
                          $sheet->cell('G'.$i, $value['price_per_item']*$value['quantity']);
                          $sheet->cell('H'.$i, $value['address'].','.$value['township'].','.$value['division']);
                          $sheet->cell('I'.$i, $value['user_name']);
                          $sheet->cell('J'.$i, $status);
                          $sheet->cell('K'.$i, $value['extra_charges']);
                          $sheet->cell('L'.$i, $value['over_tender_charges']);
                          $sheet->cell('M'.$i, $value['delivery_charges']);
                          $sheet->cell('N'.$i, $payment_status);
                          $sheet->cell('O'.$i, $value['registration_date']);
                          $sheet->cell('P'.$i, $value['target_date']);
                          $sheet->cell('Q'.$i, $total_charges);

                  }
              }
        });
       })->download("csv");

        }

    }
    public function foc_list(Request $request)
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
            where  rp.status=3 AND rp.foc>0 GROUP BY rp.id  ORDER BY rp.updated_at DESC
            ");
         $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
      return view('admin/online_shop/foc',['result'=>$result]);
    }
    public function foc_search(Request $request)
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
              $query=$query.(" where (p.product_id LIKE '%$name%' OR p.p_id LIKE '%$name%' OR p.product_name LIKE '%$name%' OR dp.user_name LIKE '%$name%') AND rp.foc>0");
            }
            if($name==null && $date!=null){
              $query=$query.(" where (r_p.registration_date LIKE '%$date%' OR rp.updated_at LIKE '%$date%') AND rp.foc>0");
            }
            if($name!=null && $date!=null){
              $query=$query.(" where (p.product_id LIKE '%$name%' OR p.p_id LIKE '%$name%' OR p.product_name LIKE '%$name%' OR dp.user_name LIKE '%$name%') AND (r_p.registration_date LIKE '%$date%' OR rp.updated_at LIKE '%$date%') AND rp.foc>0");
            }
            if($name==null && $date==null){
              $query;
            }
            if($name!=null || $date!=null){
              $result=$query.(" AND (rp.status=3) AND rp.foc>0 ORDER BY rp.id DESC");
            }else{
              $result=$query.(" where (rp.status=3) AND rp.foc>0 ORDER BY rp.id DESC");
            }
            // dd($result);
            $response=DB::select($result);
            if(Input::get('filter')){
            $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
            $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
            return view("admin/online_shop/foc",['result_data'=>$result_data]);     
            }
            if(Input::get('print')){
                $data= json_decode( json_encode($response), true);

                return Excel::create('Foc_list'.$name_date, function($excel) use ($data) {
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
}
