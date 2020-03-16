<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class postmanController extends Controller
{
 	// public function index()
 	// {
 	// 	$postman= DB::table('postman')->orderby('id','ASC')->paginate(30);
 	// 	return view('admin/postman/index',['postman'=>$postman]);
 	// }
 	// public function store(Request $request)
 	// {
 	// 	$name=$request->input('name');
 	// 	$ph_number=$request->input('ph_number');
 	// 	$password=md5('password');
 	// 	DB::insert("INSERT INTO postman (name,ph_number,password) VALUES(?,?,?)",[$name,$ph_number,$password]);
 	// 	return redirect('admin/postman/index');
 	// }
 	// public function delete()
 	// {
 	// 	DB::delete("DELETE FORM postman where id='$id'");
 	// 	return redirect('admin/postman/index');
 	// }
  //   public function edit($id)
  //   {
  //   	$postman = DB::select("SELECT * FROM postman where id='$id'")	;
  //   	return view('admin/Pedit',['postman'=>$postman]);
  //   }
  //   public function update(Request $request,$id)
  //   {
  //   	$name=$request->input('name');
  //   	$ph_number=$request->input('ph_number');
  //   	$password=md5('password');
  //   	DB::update("UPDATE postman SET name='$name',$ph_number='$ph_number',password='password' where id='$id'");
  //   	return redirect('admin/postman/index');
  //   }
  //   public function create()
  //   {

  //   	//
  //   }
  public function index()
  {
    return view("admin/postman/index");
  }
  public function create()
  {
    return view("admin/postman/create");
  }

}
