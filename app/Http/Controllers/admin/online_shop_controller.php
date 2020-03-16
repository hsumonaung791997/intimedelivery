<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class online_shop_controller extends Controller
{
	  public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$data=DB::select("SELECT * FROM online_shop");
    	return view("admin/online_shop/index",['data'=>$data]);
    }
    public function store(Request $request)
    {
    	$name=$request->input('online_shop_name');
    	$address=$request->input('address');
    	$phone_one=$request->input('phone_one');
    	$phone_two=$request->input('phone_two');
    	$created_at=date("Y-m-d H:i:s");
    	DB::insert("INSERT INTO online_shop (name,address,ph_one,ph_two,created_at) VALUES(?,?,?,?,?)",[$name,$address,$phone_one,$phone_two,$created_at]);
    	return redirect('admin/online/shop');
    }
    public function edit($id)
    {	
    	$data=DB::select("SELECT * FROM online_shop");

    	$edit=DB::select("SELECT * FROM online_shop WHERE id='$id'");
    	return view("admin/online_shop/index",['edit'=>$edit,'data'=>$data]);

    }
    public function update(Request $request)
    {
    	$name=$request->input('online_shop_name');
    	$address=$request->input('address');
    	$phone_one=$request->input('phone_one');
    	$phone_two=$request->input('phone_two');
    	$created_at=date("Y-m-d H:i:s");
    	$id=$request->input('id');
    	DB::insert("UPDATE online_shop SET name=?,address=?,ph_one=?,ph_two=?,updated_at=?  where id=?",[$name,$address,$phone_one,$phone_two,$created_at,$id]);
    	return redirect('admin/online/shop');
    }
    public function delete($id)
    {
    	DB::delete("DELETE FROM online_shop WHERE id='$id'");
    	return redirect('admin/online/shop');
    }
}
