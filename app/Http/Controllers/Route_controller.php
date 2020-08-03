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
use Excel;
class Route_controller extends Controller
{
   
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
    	$user_id = Auth::user()->id;
    	$state=DB::select("SELECT * FROM state ORDER BY id desc");
    	$product=DB::select("SELECT * FROM product where user_id='$user_id' order by product_id DESC");
        $select=DB::select("SELECT p.p_id,p.product_name,t.name as t_name,s.name as s_name,rp.reg_date,rp.target_date,rp.target_time,rp.amount,rp.quantity,rp.address,rp.target_time,rp.id as id,rp.phone as phone,rp.status,rp.r_name
                            FROM route_plan as rp
                            JOIN state  as s
                            ON rp.division=s.id
                            JOIN township as t
                            ON t.id=rp.township
                            JOIN product as p
                            ON p.product_id=rp.product_id 
                            where rp.user_id='$user_id' AND (rp.status=0 OR rp.status=1)
                            GROUP BY rp.id
                            ORDER BY rp.id DESC 
                            ");

       // dd($select);
    	return view("route/create",['state'=>$state,'product'=>$product,'select'=>$select]);
    }
    public function multi_create()
    {
        $user_id = Auth::user()->id;
        $state=DB::select("SELECT * FROM state ORDER BY id desc");
        $product=DB::select("SELECT * FROM product where user_id='$user_id' order by product_id DESC");
        $select=DB::select("SELECT p.p_id,p.product_name,t.name as t_name,s.name as s_name,rp.reg_date,rp.target_date,rp.target_time,rp.amount,rp.quantity,rp.address,rp.target_time,rp.id as id,rp.phone as phone,rp.status,rp.r_name
                            FROM route_plan as rp
                            JOIN state  as s
                            ON rp.division=s.id
                            JOIN township as t
                            ON t.id=rp.township
                            JOIN product as p
                            ON p.product_id=rp.product_id 
                            where rp.user_id='$user_id' AND (rp.status=0 OR rp.status=1)
                            GROUP BY rp.id
                            ORDER BY rp.id DESC 
                            ");

       // dd($select);
        return view("route/multi_create",['state'=>$state,'product'=>$product,'select'=>$select]);
    }
    public function store(Request $request)
    {
        $r_name=$request->input('r_name');
    	$created_at=date("Y-m-d H:i:s");
    	$user_id = Auth::user()->id;
    	$state=$request->input('state');
    	$address=$request->input('address');
    	$township=$request->input('township');
    	$quantity=$request->input('quantity');
    	$amount=$request->input('amount');
        $total_amount= $quantity*$amount;
    	$reg_date=date("Y-m-d H:i:s");
        $phone=$request->input('phone');
    	$target_date=$request->input('target_date');
    	$target_time=$request->input('target_time');
    	$product_id=$request->input('product_id');
        $foc_amount=$request->input('foc');
        $remark=$request->input('remark');
    	if(!isset($product_id)){
    		return Redirect::back()->withErrors(['You must select Your Product']);
    	}else{
    	DB::insert("INSERT INTO route_plan(r_name,foc,phone,division,township,address,quantity,amount,total_amount,product_id,reg_date,target_date,target_time,user_id,created_at,remark) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[$r_name,$foc_amount,$phone,$state,$township,$address,$quantity,$amount,$total_amount,$product_id,$reg_date,$target_date,$target_time,$user_id,$created_at,$remark]);
    	return Redirect::back()->withErrors(['Success Create Route Plan']);	
    	}
    }
    public function multi_store(Request $request)
    {
        $r_name=$request->input('r_name');
        $created_at=date("Y-m-d H:i:s");
        $user_id = Auth::user()->id;
        $state=$request->input('state');
        $address=$request->input('address');
        $township=$request->input('township');
        $quantity=$request->input('quantity');
        $amount=$request->input('amount');
        $reg_date=date("Y-m-d H:i:s");
        $phone=$request->input('phone');
        $target_date=$request->input('target_date');
        $target_time=$request->input('target_time');
        $product_id=$request->input('product_id');
        $foc_amount=$request->input('foc');
        $count_amount=count($amount);
        $remark=$request->input('remark');
        // dd($count_amount);
        $count_product_id=count($product_id);
        if($count_amount!=$count_product_id){
         return Redirect::back()->withErrors(['Did not match with item and price']); 
        }else{

        $i=-1;
        if(!isset($product_id)){
            return Redirect::back()->withErrors(['You muse select Your Product']);
        }else{
            foreach ($amount as $row) {
                $i++;
                DB::insert("INSERT INTO route_plan(r_name,foc,phone,division,township,address,quantity,amount,product_id,reg_date,target_date,target_time,user_id,created_at,remark) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[$r_name,$foc_amount[$i],$phone,$state,$township,$address,$quantity[$i],$amount[$i],$product_id[$i],$reg_date,$target_date,$target_time,$user_id,$created_at,$remark]);
            }
                
         return Redirect::back()->withErrors(['Success Create Route Plan']); 
      
            }
        }
    }
    public function verify_route()
    {
        $user_id = Auth::user()->id;

        $response=DB::select("SELECT rp.address as address,ts.name as t_name,s.name as s_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,p.product_name as product_name,dp.user_name as postman_name,dp.user_name as delivery_name,p.p_id as product_id,rp.created_at as route_register_date,r_p.assign_date as assign_date,rp.status,r_p.remark,rp.id as rp_id,r_p.id as r_pid,rp.phone as phone,rp.r_name
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
                            JOIN route_planning as r_p
                            ON r_p.plan_id=rp.id
                            where rp.user_id='$user_id' GROUP BY rp.id
                            ");
        // dd($select);
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 100;
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $select = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
            return view("route/route_list",['select'=>$select]);
    }
    public function route_list_search(Request $request)
    {


        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 100;
        $user_id = Auth::user()->id;
        $name=$request->input('name');
        $date=$request->input('date');
        $status=$request->input('status');
        $query="SELECT rp.address as address,ts.name as t_name,s.name as s_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,p.product_name as product_name,dp.user_name as postman_name,dp.user_name as delivery_name,p.p_id as product_id,rp.created_at as route_register_date,r_p.assign_date as assign_date,rp.status,r_p.remark,rp.id as rp_id,r_p.id as r_pid,rp.phone as phone
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
                            JOIN route_planning as r_p
                            ON r_p.plan_id=rp.id";

        if($name!=null && $date==null){
            $query=$query.(" where (ts.name LIKE '%$name%' OR p.product_name LIKE '%$name%' OR p.product_id LIKE '%$name%' OR p.p_id LIKE '%$name%' OR s.name LIKE '%$name%' OR rp.reg_date LIKE '%$name%' OR rp.quantity LIKE '%$name%' OR rp.amount LIKE '%$name%' OR dp.user_name LIKE '%$name%' OR rp.address LIKE '%$name%')");
        }
        if($date!=null && $name==null){
            $query=$query.(" where (r_p.assign_date  LIKE '%$date%' OR rp.created_at LIKE '%$date%')");
        }
       if($date!=null && $name!=null){
            $query=$query.(" where (ts.name LIKE '%$name%' OR p.product_name LIKE '%$name%' OR p.product_id LIKE '%$name%' OR p.p_id LIKE '%$name%' OR s.name LIKE '%$name%' OR rp.reg_date LIKE '%$name%' OR rp.quantity LIKE '%$name%' OR rp.amount LIKE '%$name%' OR dp.user_name LIKE '%$name%' OR rp.address LIKE '%$name%') AND (r_p.assign_date  LIKE '%$date%' OR rp.created_at LIKE '%$date%') ");
        }
        if($date==null && $name==null){
            $query=$query;
        }
        if($status!=null){
        if($date==null && $name==null){
            $query=$query.(" where (rp.status='$status')");
            }else{
                $query=$query.(" AND (rp.status='$status')");
            }
        }
        $result=$query.(" AND (rp.user_id='$user_id') ORDER BY rp.id DESC");
        $response=DB::select($result);

// dd($result);
         

        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $select_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
    
            return view("route/route_list",['select_data'=>$select_data]);

    
}
    public function delete($id)
    {
       DB::delete("DELETE FROM route_plan WHERE id='$id'");
       return Redirect::back();
    }
    public function re_scheldue($rp_id,$r_p_id)
    {
     $result=DB::select("SELECT * FROM route_planning where id='$r_p_id'");
     foreach ($result as $row) {
        $notification_date=$row->notification_date;
        $address=$row->address;
     }
     $address_res="(Rescheldue)".$address;
     DB::update("UPDATE route_plan SET address='$address_res',target_date='$notification_date',status=0 where id='$rp_id'");
     DB::delete("DELETE FROM route_planning where id='$r_p_id'");
     DB::delete("DELETE FROM account_ledger where route_plan_id='$rp_id'");
     DB::delete("DELETE FROM postman_route where id='$rp_id'");
       return Redirect::back();
    }
     public function contact_issue()
    {
        $user_id = Auth::user()->id;
        $result=DB::select("SELECT rp.r_name,rp.phone,rp.address,rp.quantity,rp.amount,rp.target_date,rp.reg_date,rp.remark,u.name,t.name as t_name,s.name as s_name,p.product_id,p.product_size,p.p_id,p.product_name,p.product_size,p.product_type
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
            WHERE rp.customer_confirm_status=1 AND rp.user_id='$user_id' AND rp.remark IS NOT NULL GROUP BY rp.id
            "
        );
        // dd($result);
        return view("contact_issue_vendor",['result'=>$result]);
    }
    public function contact_issue_export()
    {
        $name_date=date("Y-m-d H:i:s");
        $user_id = Auth::user()->id;
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
            WHERE rp.customer_confirm_status=1 AND rp.user_id='$user_id' AND rp.remark IS NOT NULL GROUP BY rp.id
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
    function import_route(Request $request)
    {
        $this->validate($request, [
            'file'=> 'required'
        ]);
        $user_id=Auth::user()->id;
        $date=date("Y-m-d H:i:s");
        $path = $request->file('file')->getRealPath();

        $data = Excel::load($path)->get();

        if($data->count()>0)
        {
            foreach($data->toArray() as $key => $value)
            {
                // foreach($values as $row)
                // {

                    $insert_data[] = array(
                        'division' => $value['state'],
                        'township' => $value['township'],
                        'address'  => $value['address'],
                        'product_id' => $value['product_id'],
                        'target_date' => $value['target_date'],
                        'user_id'=> $user_id,
                        'created_at'=>$date,
                        'phone' => $value['phone'],
                        'r_name'=> $value['customer_name'],
                        'remark'=> $value['remark'],
                        'foc'=> $value['foc_discount'],
                        'amount'=>$value['amount'],
                        'quantity'=>$value['quantity']

                    );
                // }

            }
                    // dd($insert_data);

            if(!empty($insert_data))
            {
                DB::table('route_plan')->insert($insert_data);
            }
        }
        return back()->with('success', 'Excel Data Imported successfully.');


    }
    public function convert_route(Request $request)
    {
        $this->validate($request, [
            'file'=> 'required'
        ]);
        $user_id=Auth::user()->id;
        $date=date("Y-m-d H:i:s");
        $path = $request->file('file')->getRealPath();

        $data = Excel::load($path)->get();

        if($data->count()>0)
        {
            foreach($data->toArray() as $key => $value)
            {
                // foreach($values as $row)
                // {

                    $insert_data[] = array(
                        'division' => $value['state'],
                        'township' => $value['township'],
                        'address'  => $value['address'],
                        'product_id' => $value['product_id'],
                        'target_date' => $value['target_date'],
                        'user_id'=> $user_id,
                        'created_at'=>$date,
                        'phone' => $value['phone'],
                        'r_name'=> $value['customer_name'],
                        'remark'=> $value['remark'],
                        'foc'=> $value['foc_discount'],
                        'amount'=>$value['amount'],
                        'quantity'=>$value['quantity']

                    );
                // }

            }
                    // dd($insert_data);

            if(!empty($insert_data))
            {
                DB::table('convert_route')->insert($insert_data);
            }
        }
       $data=DB::select("SELECT rp.r_name,rp.phone as phone,p.p_id,p.product_name,p.product_type,p.product_size,rp.address,t.name as t_name,s.name as s_name,rp.target_date,rp.amount,rp.quantity,rp.foc
                            FROM convert_route as rp
                            JOIN state  as s
                            ON rp.division=s.id
                            JOIN township as t
                            ON t.id=rp.township
                            JOIN product as p
                            ON p.product_id=rp.product_id 
                            where rp.user_id='$user_id' AND (rp.status=0 OR rp.status=1)
                            GROUP BY rp.id
                            ORDER BY rp.id DESC 
                            ");
          $data= json_decode( json_encode($data), true);
          Excel::create('Filename', function($excel) use($data) {

            $excel->sheet('Sheetname', function($sheet) use($data) {

                $sheet->fromArray($data);

            });
          DB::delete("DELETE FROM convert_route");

        })->export('xlsx');

    }
}
