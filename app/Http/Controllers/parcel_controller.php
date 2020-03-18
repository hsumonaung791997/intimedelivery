<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class parcel_controller extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $user_id = Auth::user()->id;  
        DB::delete("DELETE FROM convert_route");
          
        $data=DB::table('product')->where('user_id','=',$user_id)->orderBy('product_id','desc')->get();
    	return view('/parcel/create',['data'=>$data]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'p_id'=>'unique:product,p_id'
        ],[
            'p_id.unique'=>'This Product ID Is Already Taken. Please make new Item Code'
        ]);
    	$p_id=$request->input("p_id");
    	$p_name=$request->input("p_name");
    	$p_size=$request->input("p_size");
    	$p_type=$request->input("p_type");
    	$p_vendor_name=$request->input("p_vendor_name");
    	$created_at=date("Y-m-d H:i:s");
    	$user_id = Auth::user()->id;
    		DB::insert("INSERT INTO product(p_id,product_name,product_size,product_type,product_vendor_name,created_at,user_id) VALUES(?,?,?,?,?,?,?)",[$p_id,$p_name,$p_size,$p_type,$p_vendor_name,$created_at,$user_id]);
    	return redirect('parcel/create');
    }
    public function update(Request $request)
    {   $id=$request->input("product_id");
        $p_id=$request->input("p_id");
        $p_name=$request->input("p_name");
        $p_size=$request->input("p_size");
        $p_type=$request->input("p_type");
        $p_vendor_name=$request->input("p_vendor_name");
        $updated_at=date("Y-m-d H:i:s");
        $user_id = Auth::user()->id;
            DB::insert("UPDATE product SET p_id=?,product_name=?,product_size=?,product_type=?,product_vendor_name=?,updated_at=? where product_id=?",[$p_id,$p_name,$p_size,$p_type,$p_vendor_name,$updated_at,$id]);
        return redirect('parcel/create');
    }
    public function edit($id)
    {
        $user_id = Auth::user()->id;    
        $data=DB::table('product')->where('user_id','=',$user_id)->paginate(30);
        $result=DB::table('product')->where('product_id','=',$id)->get();
        return view('/parcel/create',['data'=>$data,'result'=>$result]);
    }
    public function delete($id)
    {
    	DB::delete("DELETE FROM product where product_id='$id'");
    	return redirect("parcel/create");
    }
}