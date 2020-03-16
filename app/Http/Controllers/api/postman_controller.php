<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Response;

class postman_controller extends Controller
{
 	public function login(Request $request)
 	{
 		$api_key="04f38d5f332a9410d3aa737eff3b2698";
 		$apikey=$request->input('api_key');
 		$phone_one=$request->input('phone_no');
 		$passowrd=$request->input('password');

 		if($api_key==$apikey){
 			$result=DB::select("SELECT id,delivery_name,user_name,role_id FROM delivery_postman where ph_one=? AND password=?",[$phone_one,$passowrd]);
 				if(count($result)>0){
 					return response()->json(['status'=>true,'data'=>$result]);
 				}else{
 					return response()->json(['status'=>false,'data'=>'incorrect phone number or email']);
 				}

 		}else{
 			return response()->json(['status'=>false]);
 		}
 	}
 	public function profile(Request $request)
 	{
 		$postman=$request->input('postman_id');
 		$api_key="04f38d5f332a9410d3aa737eff3b2698";
 		$apikey=$request->input('api_key');
 		$phone_one=$request->input('phone_no');
 		$passowrd=$request->input('password');
 		if($api_key==$apikey){
 			$result=DB::select("SELECT * FROM delivery_postman where id='$postman'");
 				if(count($result)>0){
 					return response()->json(['status'=>true,'data'=>$result]);
 				}else{
 					return response()->json(['status'=>false,'data'=>'No Data']);
 				}

 		}else{
 			return response()->json(['status'=>false]);
 		}
 	}
 	 public function lat_long_insert(Request $request)
        {
         $apikey=$request->input('apikey');
         $driverid=$request->input('postman_id');
         $api_key="04f38d5f332a9410d3aa737eff3b2698";
 		$apikey=$request->input('api_key');
         $lat=$request->input('lat');
         $long=$request->input('long');
         $updated_at=date("Y-m-d H:i:s");
         $date=date("Y-m-d");  
         if($api_key!=$apikey){
            return response()->json(['error'=>500]);
        }else{
          $driverid=$request->input('postman_id');
          $data=DB::select("SELECT * FROM postman_location where postman_id='$driverid'");

          if(count($data)<=0){
             $driverid=$request->input('postman_id');
         DB::insert("INSERT INTO postman_location(postman_id,lat,lon,created_at) VALUES('$driverid','$lat','$long','$updated_at')");
          
          }else{ 
           $driverid=$request->input('postman_id');
            $date=date("Y-m-d");
            DB::table('postman_location')
            ->where('postman_id', $driverid)
            ->update(['lat' => $lat,'lon'=>$long,'updated_at'=>$updated_at]);
            }
            $result=DB::select("SELECT * FROM postman_location where postman_id='$driverid'
          ");
            if(count($result)<=0){
              return Response::json(['noti'=>'false']);
            }else{
              return Response::json(['noti'=>'true']);
            }
            
          }
        }
    public function online(Request $request)
    {
        $postman_id=$request->input('postman_id');
        DB::update("UPDATE delivery_postman set status=1 where id='$postman_id'");
        return response()->json(['status'=>true]);
    }
    public function offline(Request $request)
    {
        $postman_id=$request->input('postman_id');
        DB::update("UPDATE delivery_postman set status=0 where id='$postman_id'");
        DB::delete("DELETE FROM postman_location where postman_id='$postman_id'");
        return response()->json(['status'=>true]);
    }
}
