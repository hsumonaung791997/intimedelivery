<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Postman Controller
Route::post('postman/login','api\postman_controller@login');
Route::get('postman/profile','api\postman_controller@profile');
// Route Controller
Route::get('postman/route','api\route_controller@route_list');
Route::get('postman/route/detail','api\route_controller@route_plan_detail');
// Product Controller
Route::get('product/drop','api\product_controller@product_drop');
Route::get('stock/list','api\product_controller@stock_list');
Route::get('product/return','api\product_controller@product_return');
// Warehouse Controller
Route::get('postman/route/list','api\warehouse_controller@route_list');

Route::post("admin/stock/out/{api_key}/{postman_id}","api\product_controller@stock_out");

Route::get("/postman/drop/list","api\product_controller@drop_list");

Route::get("/postman/return/list","api\product_controller@return_list");

// Location
Route::get("admin/postman/location","api\postman_controller@lat_long_insert");

// Status
Route::get('postman/online','api\postman_controller@online');
Route::get('postman/offline','api\postman_controller@offline');

//customer confirm
Route::get('customer/confirm','api\route_controller@customer_confirm');
// Delivery List
Route::get('delivery/list','api\route_controller@delivery_list');
// Issue List
Route::get('issue/list','api\route_controller@issue_list');