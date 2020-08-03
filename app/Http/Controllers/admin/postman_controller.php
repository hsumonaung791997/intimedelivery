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

class postman_controller extends Controller
{
      public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {   
       $data=DB::table('delivery_postman')->where('role_id','=',0)->paginate(50);
       return view('admin/postman/index',['data'=>$data]);
    }
    public function edit($id)
    {
       $edit=DB::select("SELECT * FROM delivery_postman where  id='$id'");
       return view('admin/postman/edit',['edit'=>$edit]);

    }
    public function update(Request $request,$id)
    {
        if($request->input('password')!=null){
        $this->validate($request, [
        'password' => 'min:6|same:confirm_password',
        'confirm_password' => 'min:6'
        ]);
        }
        $user_name=$request->input('username');
        $delivery_name=$request->input('delivery_name');
        $delivery_nrc=$request->input('delivery_nrc');
        $registration_date=$request->input('registration_date');
        $register_date=$request->input('register_date');
        $date_of_birth=$request->input('date_of_birth');
        $ph_one=$request->input('ph_one');
        $ph_two=$request->input('ph_two');
        $address=$request->input('address');
        $employment_date=$request->input('employment_date');
         $pass=$request->input('password');
        $password=md5($pass);

        // $datetime = date('Y-m-d H:i:s');

         $images=$request->input('images');

          if ($request->hasFile('front_image')) {
           $photo = $request->file('front_image');

        $input['front_image'] = time().'.'.$photo->getClientOriginalExtension();

        $destinationPath = public_path('/file/photo');

        $photo->move($destinationPath, $input['front_image']);
        $photo_name=$input['front_image'];
         }else{
            $photo_name=$images;
         }
    
    // dd($employment_date);
        if($password==null){
            DB::update("UPDATE delivery_postman SET user_name='$user_name',delivery_name='$delivery_name',delivery_nrc='$delivery_nrc',registration_date='$registration_date',register_date='$register_date',date_of_birth='$date_of_birth',ph_one='$ph_one',ph_two='$ph_two',address='$address',employment_date='$employment_date',photo='$photo_name' where id='$id'");
        }else{

            DB::update("UPDATE delivery_postman SET user_name='$user_name',delivery_name='$delivery_name',delivery_nrc='$delivery_nrc',registration_date='$registration_date',register_date='$register_date',date_of_birth='$date_of_birth',ph_one='$ph_one',ph_two='$ph_two',address='$address',employment_date='$employment_date',password='$password',photo='$photo_name' where id='$id'");
            }
            return redirect('admin/postman/index');
        }
        
    
        public function create()
    {   
       return view('admin/postman/create');
    }
    public function store(Request $request)
    {

        $this->validate($request, [
        'password' => 'min:6|required_with:confirm_password|same:confirm_password',
        'confirm_password' => 'min:6'
        ]);
        
        $user_name=$request->input('username');
        $delivery_name=$request->input('delivery_name');
        $delivery_nrc=$request->input('delivery_nrc');
        $registration_date=$request->input('registration_date');
        $register_date=$request->input('register_date');
        $date_of_birth=$request->input('date_of_birth');
        $ph_one=$request->input('ph_one');
        $ph_two=$request->input('ph_two');
        $address=$request->input('address');
        $employment_date=$request->input('employment_date');
        $pass=$request->input('password');
        $password=md5($pass);
        $images=$request->input('images');

          if ($request->hasFile('front_image')) {
           $photo = $request->file('front_image');

        $input['front_image'] = time().'.'.$photo->getClientOriginalExtension();

        $destinationPath = public_path('/file/photo');

        $photo->move($destinationPath, $input['front_image']);
        $photo_name=$input['front_image'];
         }else{
            $photo_name='images.png';
         }
        
    
        DB::insert("INSERT INTO delivery_postman(user_name,delivery_name,delivery_nrc,registration_date,register_date,date_of_birth,ph_one,ph_two,address,employment_date,password,photo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)" ,[$user_name,$delivery_name,$delivery_nrc,$registration_date,$register_date,$date_of_birth,$ph_one,$ph_two,$address,$employment_date,$password,$photo_name]);
        return redirect('admin/postman/index');
    }
        public function destory($id)
    {
         DB::delete('delete from delivery_postman where id = ?',[$id]);
        echo "Record deleted successfully.<br/>";
        return redirect('admin/postman/index');
    }
      public function choose_postman(Request $request)
    {
        $postman_id=$request->input("postman");
        $state=DB::select("SELECT * FROM state");
        $date=date("Y-m-d");
        $postman=DB::select("SELECT * FROM delivery_postman where role_id=0");
        $choose_postman=DB::select("SELECT * FROM delivery_postman where id='$postman_id'");
        $data=DB::select("SELECT rp.address,t.name as t_name,s.name as s_name,p.product_name as product_name,p.product_vendor_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,rp.target_time as target_time,rp.id as r_id,rp.id as route_plan_id,rp.r_name, rp.o_id as o_id  
                    FROM route_plan as rp
                    JOIN users as u
                    ON u.id=user_id
                    JOIN product as p
                  
                    JOIN order_table as o
                    JOIN state as s 
                    ON s.id=rp.division
                    JOIN township as t
                    ON t.id=rp.township
                    WHERE rp.status=1 GROUP BY rp.id
            ");
        $result=DB::select("SELECT rp.address as address,ts.name as t_name,s.name as s_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,p.product_name as product_name,pr.id as pr_id,rp.id as rp_id,pr.created_at,pr.deliver_date,rp.customer_confirm_status,rp.remark,rp.r_name,rp.o_id as o_id 
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
                            JOIN order_table as o
                            where pr.postman_id='$postman_id' AND pr.status=0
                            GROUP BY rp.id

            ");
        return view('admin/route/assign',['postman'=>$postman,'data'=>$data,'state'=>$state,'choose_postman'=>$choose_postman,'result'=>$result]);
        // dd($result);
    }
     public function route_assign(Request $request)
    {
        // dd($request->all());
        $postman_id=$request->input("postman_id");
        $state=$request->input('state');
        $township=$request->input('township');
        $deliver_date=$request->input('deliver_date');
        $created_at=date("Y-m-d H:i:s");
        $i=-1;
        if ($request->has('route_plan_id')) {
            
                 $route_plan_id=$request->input('route_plan_id');
                 foreach ($route_plan_id as $row) {
                    $i++;
                DB::insert("INSERT INTO postman_route (township_id,postman_id,p_id,deliver_date,created_at) VALUES(?,?,?,?,?)",[
                    $township,$postman_id,$route_plan_id[$i],$deliver_date,$created_at]);
                DB::update("UPDATE route_plan SET status=2 where id=?",[$route_plan_id[$i]]);   
                DB::update("UPDATE route_planning SET status=1,delivery_postman_id=?,division=?,township=?,assign_date=? where plan_id=?",[$postman_id,$state,$township,$created_at,$route_plan_id[$i]]);
            }
            return redirect("admin/choose/postman?postman=".$postman_id);  
        }else{
            return redirect()->back();
        }

    }
     public function cancel_route($pr_id,$rp_id)
    {
        DB::update("UPDATE route_plan SET status=1 where id='$rp_id'");
        DB::delete("DELETE FROM postman_route where id='$pr_id'");
        return redirect()->back();
    }
    public function accept_route($pr_id,$rp_id)
    {
        DB::update("UPDATE route_plan SET customer_confirm_status=0 where id='$rp_id'");
        return redirect()->back();
    }
    public function delete_route_plan($id)
    {
        DB::delete("DELETE FROM route_plan WHERE id='$id'");
        DB::delete("DELETE FROM postman_route WHERE p_id='$id'");
        DB::delete("DELETE FROM route_planning where plan_id='$id'");
        return redirect()->back();
    }
    public function search(Request $request)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 50;
        $search=$request->input('search');
        $result=DB::select("SELECT  * FROM delivery_postman where user_name LIKE '%$search%'  OR delivery_name LIKE '%$search%' OR delivery_nrc LIKE '%$search%' OR ph_one LIKE '%$search%' OR ph_two LIKE '%$search%' OR address LIKE '%$search%' AND role_id=0");
        $res = array_slice($result, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($result), $pageSize, $page);
       return view('admin/postman/index',['result'=>$result]);


    }
    public function contact_issue()
    {
        $response=DB::select("SELECT rp.r_name,rp.phone,rp.address,rp.quantity,rp.amount,rp.target_date,rp.reg_date,rp.remark,u.name,t.name as t_name,s.name as s_name,p.product_id,p.product_size,p.p_id,p.product_name,p.product_size,p.product_type,rp.id as rp_id
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
            WHERE rp.customer_confirm_status=1 AND rp.remark IS NOT NULL GROUP BY rp.id
            "
        );
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 50;
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        // dd($result);
        return view("admin/contact_issue",['result'=>$result]);

    }
    public function issue_search(Request $request)
    {
        $issue_type=$request->input('issue_type');
        $date=$request->input('date');

        $response="SELECT rp.r_name,rp.phone,rp.address,rp.quantity,rp.amount,rp.target_date,rp.reg_date,rp.remark,u.name,t.name as t_name,s.name as s_name,p.product_id,p.product_size,p.p_id,p.product_name,p.product_size,p.product_type,rp.id as rp_id,rp.foc
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
            ON rp.user_id=u.id";
            if($issue_type!=null || $date==null){
                $query=$response.(" WHERE  (rp.issue_type='$issue_type' AND  rp.customer_confirm_status=1) AND (rp.remark IS NOT NULL) GROUP BY rp.id");
            }
            elseif ($issue_type==null || $date==null) {
                $query=$response.(" WHERE rp.customer_confirm_status=1 AND rp.remark IS NOT NULL  GROUP BY rp.id");
            }
            elseif ($issue_type!=null || $date!=null) {
               $query=$response.(" WHERE  (rp.issue_type='$issue_type' AND rp.customer_confirm_status=1) AND (rp.remark IS NOT NULL AND rp.updated_at LIKE '%$date%') GROUP BY rp.id");
            }elseif ($issue_type==null || $date!=null) {
                $query=$response.(" WHERE (rp.customer_confirm_status=1 AND  rp.updated_at LIKE '%$date%') AND (rp.remark IS NOT NULL) GROUP BY rp.id");
            }
             $res=DB::select($query);
            if(Input::get('filter')){
             return view("admin/contact_issue",['res'=>$res]);
             }
             if(Input::get('print')){
                 $data= json_decode( json_encode($res), true);
                 // dd($data);
        //==============================================
        return Excel::create('contact_issue', function($excel) use ($data) {
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
             }
    }   
   
}