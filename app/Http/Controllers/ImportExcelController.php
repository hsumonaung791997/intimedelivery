<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use Auth;
class ImportExcelController extends Controller
{
    function index()
    {
    	$data = DB::table('townships')->orderBy('id','DESC')->get();
    	$data = DB::table('state')->orderBy('id','DESC')->get();
    	return view('import_excel',compact('data'));
    }
    function import(Request $request)
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
    			foreach($value as $row)
    			{
    				$insert_data[] = array(
    					'division' => $row['state'],
                        'township' => $row['township'],
                        'address'  => $row['address'],
                        'product_id' => $row['product_id'],
                        'target_date' => $row['target_date'],
                        'user_id'=> $user_id,
                        'created_at'=>$date,
                        'phone' => $row['phone'],
                        'r_name'=> $row['customer_name'],
                        'remark'=> $row['remark'],
                        'foc'=> $row['foc_discount']

    				);
    			}
    		}
    		if(!empty($insert_data))
    		{
    			DB::table('townships')->insert($insert_data);
    			DB::table('state')->insert($insert_data);
    		}
    	}
    	return back()->with('success', 'Excel Data Imported successfully.');


    }
    public function export_all()
    {
        $user_id=Auth::user()->id;
        $result=DB::select("SELECT * FROM product where user_id='$user_id'");
        $data=json_decode(json_encode($result),true);
        return Excel::create('product_list', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }
    public function test()
    {
        
    }
}

