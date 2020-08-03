<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\AccountHead;
class ajax_controller extends Controller
{
    public function township(Request $request)
    {
    	$state=$request->input('state');
    	$output="";
    	$result=DB::select("SELECT * FROM township where state_id='$state'");
    	foreach ($result as $row) {
    		$output.='<option value="'.$row->id.'">'.$row->name.'</option>';
    	}
    	return Response($output);
    }


    /*public function account_code(Request $request){
        $account_head_id = $request->input('account_head_id');
        dd($account_head_id);
        $output="";
        $account_code = AccountHead::where('account_id',$account_head_id);
        $output = $account_code->account_id;
        return Response($output);

    }*/

    public function search_ledger(Request $request)
    {

    }
    
    public function township_route(Request $request)
    {
        $township=$request->input('township');
        $target_date=$request->input('target_date');
        $output="";
        if($target_date==null){
              $data=DB::select("SELECT rp.address,t.name as t_name,s.name as s_name,p.product_name as product_name,p.product_vendor_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,rp.target_time as target_time,rp.id as r_id,rp.id as route_plan_id,rp.r_name,rp.o_id as o_id  
                    FROM route_plan as rp
                    JOIN users as u
                    ON u.id=user_id
                    JOIN product as p
                    JOIN order_table as o
                    JOIN state as s 
                    ON s.id=rp.division
                    JOIN township as t
                    ON t.id=rp.township
                    WHERE rp.status=1 AND rp.township='$township'  GROUP BY rp.id
            ");
        }else{
             $data=DB::select("SELECT rp.address,t.name as t_name,s.name as s_name,p.product_name as product_name,p.product_vendor_name,rp.reg_date as reg_date,rp.target_date as target_date,rp.quantity as qty,rp.amount as amount,rp.total_amount as total_amount,rp.target_time as target_time,rp.id as r_id,rp.id as route_plan_id,rp.r_name,rp.o_id as o_id 
                    FROM route_plan as rp
                    JOIN users as u
                    ON u.id=user_id
                    JOIN product as p
                    JOIN order_table as o
                    JOIN state as s 
                    ON s.id=rp.division
                    JOIN township as t
                    ON t.id=rp.township
                    WHERE rp.status=1 AND rp.township='$township' AND rp.target_date LIKE '%$target_date%' GROUP BY rp.id
            ");
        }
       
        foreach ($data as $row) {
           $output.='<tr>'.
           '<td>'.$row->r_name.'</td>'.
            '<td>'.$row->address.','.$row->t_name.','.$row->s_name.'</td>'.
            '<td>'.$row->product_name.'</td>'.
            '<td>'.$row->reg_date.'</td>'.
            '<td>'.$row->target_date.'</td>'.
            '<td>'.$row->qty.'</td>'.
            '<td>'.$row->amount.'</td>'.
            '<td>'.$row->total_amount.'</td>'.
            '<th>'.
            '<input type="checkbox" name="route_plan_id[]" class="check" id="checkAll" value='.$row->route_plan_id.' />'.
            '</th>'.
            '</tr>';
        }
        return Response($output);
    }


  

    public function date_route(Request $request)
    {
        $postman_id=$request->input('post_id');

        $start_date=$request->input('start_date');
        $end_date=$request->input('end_date');

        $output="";
       
       $data=DB::select("
          SELECT p.product_name,p.p_id,p.product_size,p.product_type,p.product_vendor_name,rp.id as rp_id, rp.assign_date as assign_date, rp.quantity as qty
                        FROM route_planning as rp
                        JOIN product as p
                        ON rp.product_id=p.p_id
                        WHERE rp.delivery_postman_id='$postman_id' AND rp.assign_date BETWEEN '$start_date' AND '$end_date' GROUP BY rp.id ORDER BY rp.id DESC
          ");
        
      
       $i=1;

       foreach ($data as $row) {
           $output.='<tr>'.
           '<td>'.$i++.'</td>'.
           '<td>'.$row->p_id.'</td>'.
           '<td>'.$row->product_name.'</td>'.
            '<td>'.$row->product_size.'</td>'. 
            '<td>'.$row->product_type.'</td>'.
           '<td>'.$row->product_vendor_name.'</td>'.
           '<td>'.$row->qty.'</td>'.
           '<td>'.$row->assign_date.'</td>'.

           '</tr>';
       }
        return Response($output);
        // return Response($postman_id);
        // return Response($start_date);


    }


    
    public function qr()
    {
        // $result="";
        $output=QrCode::size(280)->generate('A basic example of QR code!');
        // $result.='<h5>'."Thanks".'</h5>';

        return Response($output);
    }
    public function order_detail($id)
    {
        $output="";
        $order_detail=DB::select("SELECT * FROM order_detail where o_id=1007");
         foreach ($order_detail as $row) {
           $output.='<tr>'.
            '<td>'.$row->p_id.'</td>'.
            '<td>'.$row->p_weight.'</td>'.
            '<td>'.$row->p_expired_date.'</td>'.
            '<td>'.$row->p_quantity.'</td>'.
            '<td>'.$row->p_price_per_item.'</td>'.
            '<td>'.$row->p_amount.'</td>'.
            '</tr>';

        }
        return Response($output);
    }
    public function qr_print(Request $request)
    {
        return view('qr_code');
    }
    public function auto(Request $request)
    {
        $name=$request->input('p_id');
        $output="";
        $result=DB::select("SELECT p_id FROM product  WHERE p_id LIKE '%$name%' ");
        // where created_at LIKE '%$date%'
        if(count($result)>0){
        foreach ($result as $row) {
            $output.=
            $row->p_id.',';
            }
            $not="Not Availables";
            $result=$output.$not;
            return Response($result);
       }else{
            return Response($output);

       }
    }
}

