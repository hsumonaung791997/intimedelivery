<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class warehouse_controller extends Controller
{
      public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function stock_list()
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize =50;
    	$response=DB::select("SELECT p.product_size as product_size,p.product_type as product_type,p.p_id as product_id,s.product_price_per_item as price_per_item,s.created_at as incoming_date,p.product_name,sum(s.stock_in) as total_stock_in,sum(s.stock_out) as total_stock_out
    		FROM  stock_in_out_return as s
    		 JOIN product as p
    		ON p.p_id=s.product_id
    		GROUP BY s.product_id
    		");
        // dd($result);
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
    
    	return view('warehouse/stock_list',['result'=>$result]);
    }
    public function stock_list_search(Request $request)
    {
        $date=$request->input('date');
        $search=$request->input('search');
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize =50;

        $query="SELECT p.product_size as product_size,p.product_type as product_type,p.p_id as product_id,s.product_price_per_item as price_per_item,s.created_at as incoming_date,p.product_name,sum(s.stock_in) as total_stock_in,sum(s.stock_out) as total_stock_out
            FROM  stock_in_out_return as s
            JOIN product as p
            ON p.p_id=s.product_id
            ";

            if($search==null && $date!=null){
                $query=$query.("WHERE s.created_at LIKE '%$date%' GROUP BY s.product_id");
                $response=DB::select($query);
              }elseif($search!=null && $date==null){
                $query=$query.("WHERE (p.product_name LIKE '%$search%' OR p.product_size LIKE '%$search%' OR p.product_type LIKE '%$search%' OR p.p_id LIKE '%$search%' OR p.p_id LIKE '%$search%') GROUP BY p.p_id");
                $response=DB::select($query);
              }elseif($search==null && $date==null){
                return Redirect::back();
              }else{
                $query=$query.("WHERE (p.product_name LIKE '%$search%' OR p.product_size LIKE '%$search%' OR p.product_type LIKE '%$search%' OR p.product_id LIKE '%$search%' OR p.p_id LIKE '%$search%') AND (s.created_at LIKE '%$date%') GROUP BY p.p_id");
                $response=DB::select($query);
              }
              // dd($response);
        $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result_data = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view('warehouse/stock_list',['result_data'=>$result_data]);

    }
}
