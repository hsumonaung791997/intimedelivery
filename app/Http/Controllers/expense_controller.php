<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Input;
class expense_controller extends Controller
{
    public function purchase_create()
    {
    	$created_at=date("Y-m-d");
    	$con=DB::select("SELECT * FROM budget WHERE budget_date LIKE '%$created_at%'");
    	if(count($con)<=0){
    		DB::insert("INSERT INTO budget (amount,budget_date,created_at) VALUES(?,?,?)",[0,$created_at,$created_at]);
    	}
    	$data=DB::select("SELECT * FROM online_shop");
    	$budget=DB::select("SELECT amount,id as b_id FROM budget WHERE budget_date LIKE '%$created_at%'");
    	$today_use=DB::select("SELECT * FROM daily_gross where use_date='$created_at'");
    	$today_purchase=DB::select("SELECT sum(amount) as today_purchase FROM daily_gross where use_date LIKE '%$created_at%' AND type=1");
    	$total_usage=DB::select("SELECT sum(amount) as total FROM daily_gross WHERE use_date LIKE '%$created_at%'");
    	$today_expense=DB::select("SELECT sum(amount) as today_expense FROM daily_gross where use_date LIKE '%$created_at%' AND type=0");
    	return view('admin/expense/purchase',['data'=>$data,'budget'=>$budget,'today_use'=>$today_use,'today_purchase'=>$today_purchase,'today_expense'=>$today_expense,'total_usage'=>$total_usage]);
    }
    public function purchase_store(Request $request)
    {
    	$date=date("Y-m-d");
    	$online_shop=$request->input('online_shop');
    	$remark=$request->input('remark');
    	$purchase_date=$request->input('purchase_date');
    	$amount=$request->input('amount');
    	$b_id=$request->input('b_id');
    	DB::insert("INSERT INTO daily_gross(b_id,title,type,amount,remark,use_date,created_at) VALUES(?,?,?,?,?,?,?)",[$b_id,$online_shop,1,$amount,$remark,$purchase_date,$date]);

        return Redirect::back();
    }
    public function expense_store(Request $request)
    {
    	$date=date("Y-m-d");
    	$purchase_date=date("Y-m-d");
    	$expense_date=$request->input('expense_date');
    	$under_20_k=$request->input('under_20_k');
    	$b_id=$request->input('b_id');

    	if($under_20_k!=0 || $under_20_k==null){
    		$title="Below 20 K";
    		DB::insert("INSERT INTO daily_gross(b_id,title,type,amount,use_date,created_at) VALUES(?,?,?,?,?,?)",[$b_id,$title,0,$under_20_k,$expense_date,$date]);
    	}
    	$above_20_k=$request->input('above_20_k');
    	if($above_20_k!=0 || $above_20_k==null){
    		$title="Above 20 K";
    		$remark=$request->input('remark');
    		DB::insert("INSERT INTO daily_gross(b_id,title,type,amount,remark,use_date,created_at) VALUES(?,?,?,?,?,?,?)",[$b_id,$title,0,$above_20_k,$remark,$expense_date,$date]);
    	}
    	$advance=$request->input('advance');
    	if($advance!=0 || $advance==null){
    		$title="Advance Pay";
    		DB::insert("INSERT INTO daily_gross(b_id,title,type,amount,use_date,created_at) VALUES(?,?,?,?,?,?)",[$b_id,$title,0,$advance,$expense_date,$date]);
    	}
    
    	$salary=$request->input('salary');
    	if($salary!=0 || $salary==null){
    		$title="Salary";
    		DB::insert("INSERT INTO daily_gross(b_id,title,type,amount,use_date,created_at) VALUES(?,?,?,?,?,?)",[$b_id,$title,0,$salary,$expense_date,$date]);
    	}	
    	$rent=$request->input('rent');
    	if($rent!=0 || $rent==null){
    		$title="Rent";
    		DB::insert("INSERT INTO daily_gross(b_id,title,type,amount,use_date,created_at) VALUES(?,?,?,?,?,?)",[$b_id,$title,0,$rent,$expense_date,$date]);
    	}	
    	$meter_bill=$request->input('meter_bill');
    	if($meter_bill!=0 || $meter_bill==null){
    		$title="Meter Bill";
    		DB::insert("INSERT INTO daily_gross(b_id,title,type,amount,use_date,created_at) VALUES(?,?,?,?,?,?)",[$b_id,$title,0,$meter_bill,$expense_date,$date]);
    	}	
    	return redirect('/admin/purchase/create');
    }
	    public function useage_delete($id)
	    {
	    DB::delete("DELETE FROM daily_gross WHERE id='$id'");
        return Redirect::back();
	    }
	    public function purchase_list()
	    {
	    	$result=DB::select("
	    		SELECT sum(dg.amount) as expense,dg.type,b.amount as budget,b.budget_date,b.id as b_id 
	    		FROM daily_gross as dg 
	    		JOIN budget as b
	    		ON b.id=dg.b_id GROUP BY dg.b_id ORDER BY b.id DESC
	    		");
	    	// dd($result);
	    	return view("admin/expense/list",['result'=>$result]);
	    }
	    public function set_budget(Request $request)
	    {
	    	$date=date("Y-m-d");
	    	$budget=$request->input('budget');
	    	DB::update("UPDATE budget SET amount='$budget' WHERE created_at LIKE '%$date%'");
       		return Redirect::back();
	    }
	    public function expense_detail(Request $request)
	    {

	    $b_id=$request->input('b_id');
	    $purchase=DB::select("SELECT * FROM daily_gross where type=1 AND b_id='$b_id'");
	    $expense=DB::select("SELECT * FROM daily_gross where type=0 AND b_id='$b_id'");
	    $total_expenses=DB::select("SELECT sum(amount) as total_expenses FROM daily_gross where type=0 AND b_id='$b_id'");
	    $total_purchases=DB::select("SELECT sum(amount) as total_purchases FROM daily_gross where type=1 AND b_id='$b_id'");

	    return response()->json(['purchase'=>$purchase,'expense'=>$expense,'total_expenses'=>$total_expenses,'total_purchases'=>$total_purchases]);
	    // return $purchase;

	    }
	    public function budget_search(Request $request)
	    {
	    	$to_date=$request->input('to_date');
	    	$from_date=$request->input('from_date');
	    	if($to_date==null){
	    		$to_date="3000-01-01";
	    	}
	    	if($from_date==null){
	    		$from_date="2000-01-01";
	    	}
	    	$response=DB::select("
	    		SELECT sum(dg.amount) as expense,dg.type,b.amount as budget,b.budget_date,b.id as b_id 
	    		FROM daily_gross as dg 
	    		JOIN budget as b
	    		ON b.id=dg.b_id WHERE b.budget_date between   '$from_date' AND  '$to_date' GROUP BY dg.b_id ORDER BY b.id DESC
	    		");
	    	return view("admin/expense/list",['response'=>$response]);
	    	// dd($result);
	    }
}
