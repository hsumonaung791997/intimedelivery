<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
class staff_controller extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {   
       $data=DB::table('office_staff')->where('role_id','=',0)->paginate(50);
       return view('admin/staff/index',['data'=>$data]);
    }
    public function edit($id)
    {
       $edit=DB::select("SELECT * FROM office_staff where  id='$id'");
       return view('admin/staff/edit',['edit'=>$edit]);

    }
    public function update(Request $request,$id)
    {
        // if($request->input('password')!=null){
        // $this->validate($request, [
        // 'password' => 'min:6|same:confirm_password',
        // 'confirm_password' => 'min:6'
        // ]);
        // }
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
            DB::update("UPDATE office_staff SET user_name='$user_name',delivery_name='$delivery_name',delivery_nrc='$delivery_nrc',registration_date='$registration_date',register_date='$register_date',date_of_birth='$date_of_birth',ph_one='$ph_one',ph_two='$ph_two',address='$address',employment_date='$employment_date',photo='$photo_name' where id='$id'");
        }else{

            DB::update("UPDATE office_staff SET user_name='$user_name',delivery_name='$delivery_name',delivery_nrc='$delivery_nrc',registration_date='$registration_date',register_date='$register_date',date_of_birth='$date_of_birth',ph_one='$ph_one',ph_two='$ph_two',address='$address',employment_date='$employment_date',password='$password',photo='$photo_name' where id='$id'");
            }
            return redirect('admin/staff/index');
        }
        
    
        public function create()
    {   
       return view('admin/staff/create');
    }
    public function store(Request $request)
    {

        // $this->validate($request, [
        // 'password' => 'min:6|required_with:confirm_password|same:confirm_password',
        // 'confirm_password' => 'min:6'
        // ]);
        // dd($request->all());
        
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
            $photo_name=$images;
         }
        
    
        DB::insert("INSERT INTO office_staff(user_name,delivery_name,delivery_nrc,registration_date,register_date,date_of_birth,ph_one,ph_two,address,employment_date,password,photo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)" ,[$user_name,$delivery_name,$delivery_nrc,$registration_date,$register_date,$date_of_birth,$ph_one,$ph_two,$address,$employment_date,$password,$photo_name]);
        return redirect('admin/staff/index');
    }
        public function destory($id)
    {
         DB::delete('delete from office_staff where id = ?',[$id]);
        echo "Record deleted successfully.<br/>";
        return redirect('admin/staff/index');
    }
     public function search(Request $request)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 50;
        $search=$request->input('search');
        $result=DB::select("SELECT  * FROM office_staff where user_name LIKE '%$search%'  OR delivery_name LIKE '%$search%' OR delivery_nrc LIKE '%$search%' OR ph_one LIKE '%$search%' OR ph_two LIKE '%$search%' OR address LIKE '%$search%' AND role_id=0");
        $res = array_slice($result, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($result), $pageSize, $page);
       return view('admin/staff/index',['result'=>$result]);


    }
}
