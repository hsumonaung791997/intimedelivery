<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Input;
class account_controller extends Controller
{
    public function income_create()
    {
    	$created_at=date("Y-m-d");
    	$data=DB::select("SELECT * FROM online_shop");
    	$staff=DB::select("SELECT * FROM office_staff");
    	$response=DB::select("SELECT os.name as os_name,of.user_name	 as of_name,a.income_date,a.amount,a.created_at,a.id,a.remark
    				FROM account as a 
    				JOIN online_shop as os
    				ON os.id=a.vendor_id
    				JOIN office_staff as of
    				ON of.id=a.staff_id
    				 ORDER BY a.id DESC
    	 ");
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 150;
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
    	return view('admin/account/income',['data'=>$data,'staff'=>$staff,'result'=>$result]);
    }
    public function income_store(Request $request)
    {
    	$data=DB::select("SELECT * FROM online_shop");
    	$staff=DB::select("SELECT * FROM office_staff");
    	// $result=DB::select("SELECT * FROM s")
    	$staff_id=$request->input('staff_id');
    	$income_date=$request->input('income_date');
    	$remark=$request->input('remark');
    	$vendor_id=$request->input('vendor_id');
    	$amount=$request->input('amount');
    	$created_at=date("Y-m-d H:i:s");
    	$create=date("Y-m-d");
    	$reload=$request->input('reload');
    	$re=DB::select("SELECT * FROM account where auto_gen='$reload'");
    	if(count($re)>0){
    		return redirect('account/income')->withErrors(['You cannot type multiple time']);
    	}else{

    	if($vendor_id==null){
    		return Redirect::back()->withErrors(['You muse select Online Shop']);
    	}else{
    	DB::insert("INSERT INTO account (staff_id,income_date,remark,vendor_id,amount,created_at,auto_gen) VALUES(?,?,?,?,?,?,?)",[$staff_id,$income_date,$remark,$vendor_id,$amount,$created_at,$reload]);
    	
    	}

    	$response=DB::select("SELECT os.name as os_name,of.user_name	 as of_name,a.income_date,a.amount,a.created_at,a.id,a.remark
    				FROM account as a 
    				JOIN online_shop as os
    				ON os.id=a.vendor_id
    				JOIN office_staff as of
    				ON of.id=a.staff_id
    				ORDER BY a.id DESC
    	 ");
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 150;
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
    	return view('admin/account/income',['data'=>$data,'staff'=>$staff,'result'=>$result]);
    			}
    	}
    	public function income_delete($id)
    	{
    		DB::delete("DELETE FROM account where id='$id'");
    		return Redirect::back()->withErrors(['Delete Success']);
    	}
    	public function expense()
    	{
    		$created_at=date("Y-m-d");
	$staff=DB::select("SELECT * FROM office_staff");
	$result=DB::select("SELECT of.user_name	 as of_name,a.expense_date,a.amount,a.created_at,a.id,a.reason,a.remark
	    				FROM expense as a 
	    				JOIN office_staff as of
	    				ON of.id=a.staff_id
	    				 ORDER BY a.id DESC
    	 ");
			return view("admin/account/expense",['staff'=>$staff,'result'=>$result]);
    	}
    	public function expense_store(Request $request)
    	{
    	$data=DB::select("SELECT * FROM online_shop");
    	$staff=DB::select("SELECT * FROM office_staff");
    	$created=date("Y-m-d");
    	$created_at=date("Y-m-d");
    	// $result=DB::select("SELECT * FROM s")
    	$staff_id=$request->input('staff_id');
    	$income_date=$request->input('income_date');
    	$remark=$request->input('remark');
    	$amount=$request->input('amount');
    	$created_at=date("Y-m-d H:i:s");
    	$create=date("Y-m-d");
    	$reload=$request->input('reload');
    	$reason=$request->input('reason');
    	$re=DB::select("SELECT * FROM expense where auto_gen='$reload'");
    	if(count($re)>0){
    		return redirect('account/expense')->withErrors(['You cannot type multiple time']);
    	}else{

    	DB::insert("INSERT INTO expense (staff_id,expense_date,reason,remark,amount,created_at,auto_gen) VALUES(?,?,?,?,?,?,?)",[$staff_id,$income_date,$reason,$remark,$amount,$created_at,$reload]);

    	$result=DB::select("SELECT of.user_name	 as of_name,a.expense_date,a.amount,a.created_at,a.id,a.reason,a.remark
	    				FROM expense as a 
	    				JOIN office_staff as of
	    				ON of.id=a.staff_id
	    				ORDER BY a.id DESC
    	 ");
    	return view('admin/account/expense',['data'=>$data,'staff'=>$staff,'result'=>$result]);
    			}
    	}
    	public function expense_delete($id)
    	{
    		DB::delete("DELETE FROM expense WHERE id='$id'");
    		return Redirect::back()->withErrors(['Delete Success']);
    	}
    	public function report()
    	{
    		$staff=DB::select("SELECT * FROM office_staff");
    		return view("admin/account/report",['staff'=>$staff]);
    	}
    	public function report_show(Request $request)
    	{
    		$staff=DB::select("SELECT * FROM office_staff");

    		$staff_id=$request->input('staff_id');
    		$date=$request->input('date');
    		$response=DB::select("SELECT of.user_name	 as of_name,a.expense_date,a.amount,a.created_at,a.id,a.reason,a.remark
	    				FROM expense as a 
	    				JOIN office_staff as of
	    				ON of.id=a.staff_id
	    				WHERE a.expense_date LIKE '%$date%' AND a.staff_id='$staff_id' ORDER BY a.id DESC");
    		$result=DB::select("SELECT os.name as os_name,of.user_name	 as of_name,a.income_date,a.amount,a.created_at,a.id,a.remark
    				FROM account as a 
    				JOIN online_shop as os
    				ON os.id=a.vendor_id
    				JOIN office_staff as of
    				ON of.id=a.staff_id
    				WHERE a.income_date LIKE '%$date%' AND a.staff_id='$staff_id' ORDER BY a.id DESC
    	 ");
            if(Input::get('submit')){
            return view("admin/account/report",['staff'=>$staff,'result'=>$result,'response'=>$response]);
            }
            if(Input::get('export')){
                return view("admin/account/report_voucher",['staff'=>$staff,'result'=>$result,'response'=>$response]);
            }

    	}

}
