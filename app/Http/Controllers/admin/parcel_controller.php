<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class parcel_controller extends Controller
{
	  public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function create()
    {
    	return view('admin/parcel/create');
    }
    public function index()
    {
    	return view("admin/parcel/index");
    }
    public function issue_create(Request $request)
    {
        $result=DB::select("SELECT * FROM issue");
        return view("admin/issue",['result'=>$result]);
    }
    public function issue_store(Request $request)
    {
        $name=$request->input('name');
        DB::insert("INSERT INTO issue (name) VALUES('$name')");
        return redirect("admin/issue/create");
    }
    public function issue_delete($id)
    {
        DB::delete("DELETE FROM issue WHERE id='$id'");
        return redirect("admin/issue/create");
    }
    public function issue_edit($id)
    {
        $result=DB::select("SELECT * FROM issue");
        $edit=DB::select("SELECT * FROM issue WHERE id='$id'");
        return view("admin/issue",['edit'=>$edit,'result'=>$result]);
    }
    public function issue_update(Request $request)
    {
        $id=$request->input('id');
        $name=$request->input('name');
        DB::update("UPDATE issue SET name='$name' WHERE id='$id'");
        return redirect("admin/issue/create");
    }
    
}
