<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});
Route::get('/map', function () {
    return view('map');
});
// Route::get('/postman/list', function () {
//     return view('admin/postman_list');
// });
// Route::get('/vendor', function () {
//     return view('admin/vendor');
// });
Route::get('/Pedit', function () {
    return view('admin/pEdit');
});
Route::get('/OSedit', function () {
    return view('admin/OSedit');
});
Route::get('/Pclist', function () {
    return view('admin/PcList');
});
Route::get('/PcEdit', function () {
    return view('admin/parcel/PcList');
});
Route::get('Register', function(){
	return view('admin/Register');
});

Route::get('/clear', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//admin route for our multi-auth system

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
});
Route::get("admin/dashboard","admin\dashboard_controller@dashboard");
Route::get("admin/postman/index","admin\postman_controller@index");
Route::get('admin/postman/edit/{id}','admin\postman_controller@edit');
Route::get('admin/postman/update/{id}','admin\postman_controller@update');
Route::get("admin/postman/create","admin\postman_controller@create");
Route::post("admin/postman/store","admin\postman_controller@store");
Route::get("admin/postman/delete/{id}","admin\postman_controller@destory");
Route::get("admin/choose/postman","admin\postman_controller@choose_postman");
Route::get("admin/online/shop/","admin\online_shop_controller@index");
Route::post("admin/online_shop/save","admin\online_shop_controller@store");
Route::get("/admin/online_shop/edit/{id}","admin\online_shop_controller@edit");
Route::post("admin/online_shop/update","admin\online_shop_controller@update");
Route::get("admin/online_shop/delete/{id}","admin\online_shop_controller@delete");
Route::get("account/income","admin\account_controller@income_create");
Route::get("/parcel/create","parcel_controller@create");
Route::get("admin/assigned/route/search","admin\Route_controller@assigned_route_search");
Route::POST("/parcel/update","parcel_controller@update");
Route::get("/parcel/delete/{id}","parcel_controller@delete");
Route::get("/parcel/edit/{id}","parcel_controller@edit");
Route::get("route/plan","Route_controller@create");
Route::post("convert/route","Route_controller@convert_route");
Route::get("multi/route/plan","Route_controller@multi_create");
Route::get("admin/route/plan/edit/{id}","admin\Route_controller@route_plan_edit");
Route::get("warehouse/stock/list","admin\warehouse_controller@stock_list");
Route::get("warehouse/stock/list/search","admin\warehouse_controller@stock_list_search");
Route::get("admin/stock/list/search","admin\stock_controller@stock_list_search");
Route::post("route/plan/store","Route_controller@store");
Route::post("multi/route/plan/store","Route_controller@multi_store");
Route::get("order/create","order_controller@order_create");
Route::get("order/delete/{id}/{order_id}","order_controller@order_deletes");
Route::post("order/store","order_controller@order_store");
Route::get("order/list","order_controller@order_list");
Route::get("order/edit/{id}/{order_id}","order_controller@order_edit");
Route::get("admin/order/list","admin\order_controller@order_list");
Route::get("admin/order/list/search","admin\order_controller@order_search");
Route::get("admin/order/reject","admin\order_controller@order_reject");
Route::get("admin/order/reject/search","admin\order_controller@order_reject_list");
Route::get("admin/order/verified/search","admin\order_controller@order_verifed_list");
Route::get("admin/order/verified","admin\order_controller@order_verfied");
Route::get("admin/order/verify/{id}","admin\order_controller@order_verify");
Route::post("admin/route/plan/update","admin\Route_controller@route_plan_update");
Route::post("admin/account/ledger/update","admin\ledger_controller@account_ledger_update");
Route::get("admin/order/reject/{id}","admin\order_controller@order_reject");
Route::get("admin/stock/ledger","admin\stock_controller@stock_ledger");
Route::get("admin/stock/list","admin\stock_controller@stock_list");
Route::get("admin/stock/in","admin\stock_controller@stock_in");
Route::get("admin/stock/out","admin\stock_controller@stock_out");
Route::get("admin/stock/return","admin\stock_controller@stock_return");
Route::get("admin/route/assign","admin\Route_controller@assign_postman");
Route::get("admin/route/list","admin\Route_controller@route_list_verified");
Route::get("admin/route/edit/{id}","admin\Route_controller@route_list_edit");
Route::get("admin/route/list/request","admin\Route_controller@route_list_request");
Route::get("admin/ledger/list","admin\ledger_controller@ledger_list");
Route::get("admin/account/ledger/edit/{id}/{route_id}","admin\ledger_controller@account_ledger_edit");
Route::get("admin/ledger/settlement","admin\ledger_controller@settlement");
Route::get("admin/ledger/settlement","admin\ledger_controller@settlement_create");
Route::get("admin/route/verify/{id}","admin\Route_controller@route_verify");
Route::get("admin/verify/route","admin\Route_controller@verify_route");
Route::get("admin/assign/route","admin\Route_controller@assign_route");
Route::get("admin/route/assigned","admin\Route_controller@assigned_route");
Route::post("admin/route/list/update","admin\Route_controller@route_list_update");
Route::get("admin/parcel/drop","admin\stock_controller@parcel_drop");
Route::get("cancel/route/{pr_id}/{rp_id}","admin\postman_controller@cancel_route");
Route::get("accept/route/{pr_id}/{rp_id}","admin\postman_controller@accept_route");
Route::get("admin/delete/route/plan/{id}","admin\postman_controller@delete_route_plan");
Route::get("route/list","Route_controller@verify_route");
Route::get("re/scheldue/{rp_id}/{r_pid}","Route_controller@re_scheldue");
Route::post("product/save","parcel_controller@store");
Route::post("admin/route/assign","admin\postman_controller@route_assign");
Route::get("order/edit/delete/{id}/{order_id}","order_controller@edit_delete");
Route::post("order/update","order_controller@order_update");
Route::get("route/delete/{id}",'Route_controller@delete');
Route::get("order/preview/{id}/{order_id}","order_controller@order_preview");
Route::get("admin/order/decline/{id}","admin\order_controller@order_decline");
Route::get("admin/stock/ledger/search","admin\stock_controller@stock_ledger_search");
Route::get("admin/map/overview","admin\map_controller@index");
Route::get("admin/target/date/route/export","admin\dashboard_controller@noti_export");
Route::get("admin/dashboard/stock_in","admin\dashboard_controller@stock_in");
Route::get("admin/dashboard/stock_in/export","admin\dashboard_controller@stock_in_export");
Route::get("admin/dashboard/stock_out","admin\dashboard_controller@stock_out");
Route::get("admin/dashboard/stock_out/export","admin\dashboard_controller@stock_out_export");
Route::get("make/order","make_order_controller@make_order");
Route::get("order/list/search","order_controller@order_list_search");
Route::get("admin/parcel/drop/search","admin\stock_controller@parcel_drop_search");
Route::get("admin/route/print/{postman_route}/{route_plan}","admin\Route_controller@route_print");
Route::get("admin/contact/issue","admin\postman_controller@contact_issue");
Route::get("contact/issue","Route_controller@contact_issue");
Route::get("admin/route/plan/modify/{id}","admin\Route_controller@route_modify");
Route::post("admin/route/plan/edit/store","admin\Route_controller@route_modified");
Route::get("admin/route/drop/{pr_id}/{rp_id}","admin\dashboard_controller@drop");
Route::get("contact/issue/export","Route_controller@contact_issue_export");
Route::get("admin/contact/issue/export","admin\Route_controller@contact_issue_export");
Route::post("import/route","Route_controller@import_route");
Route::get("admin/high/way/drop","admin\Route_controller@high_way_drop_list");
Route::get('admin/high/way/edit/{id}',"admin\Route_controller@high_way_edit");
Route::post("admin/highway/update","admin\Route_controller@highway_update");
Route::get('admin/high/way/list',"admin\stock_controller@highway_drop_list");
Route::get('account/income/store',"admin\account_controller@income_store");
Route::get('account/income/delete/{id}',"admin\account_controller@income_delete");
Route::get('account/expense',"admin\account_controller@expense");
Route::get('admin/contact/issue/search','admin\postman_controller@issue_search');
Route::get('admin/foc/list','admin\ledger_controller@foc_list');
Route::get('admin/foc/search','admin\ledger_controller@foc_search');
Route::get('admin/purchase/create','expense_controller@purchase_create');
Route::get('admin/purchase/store','expense_controller@purchase_store');
Route::get("admin/expense/store","expense_controller@expense_store");
Route::get("useage/delete/{id}","expense_controller@useage_delete");
Route::get("admin/purchase/list","expense_controller@purchase_list");
// Staff Controller
Route::get("admin/staff/index","admin\staff_controller@index");
Route::get('admin/staff/edit/{id}','admin\staff_controller@edit');
Route::get('admin/staff/update/{id}','admin\staff_controller@update');
Route::get("admin/staff/create","admin\staff_controller@create");
Route::post("admin/staff/store","admin\staff_controller@store");
Route::get("admin/staff/delete/{id}","admin\staff_controller@destory");
Route::get("admin/staff/search","admin\staff_controller@search");
Route::get("account/expense/store","admin\account_controller@expense_store");
Route::get("account/expense/delete/{id}","admin\account_controller@expense_delete");
Route::get("account/report","admin\account_controller@report");
Route::get("account/report/show","admin\account_controller@report_show");
Route::get("export/all","ImportExcelController@export_all");
Route::get("admin/issue/create","admin\parcel_controller@issue_create");
Route::get("admin/issue/edit/{id}","admin\parcel_controller@issue_edit");
Route::get('admin/issue/delete/{id}',"admin\parcel_controller@issue_delete");
Route::post("admin/issue/store",'admin\parcel_controller@issue_store');
Route::post('admin/issue/update/','admin\parcel_controller@issue_update');
Route::post('admin/assign/manage','admin\Route_controller@route_manage');

// Route::get('admin/high/way/verif,y/list',"admin\Route_controller@")
// Route::get("admin/parcel/return","admin\");
// Route::get("product/");
Route::get('locale/{locale}', function($locale){
	Session::put('locale','$locale');
	return redirect()->back();
});
Route::get('warehouse/stock/receive','admin\order_controller@stock_receive');
Route::post('warehouse/stock/received','admin\order_controller@stock_received');
Route::get("warehouse/stock/received/delete/{id}","admin\order_controller@stock_received_delete");
// AJAX
Route::get("order/entry/state","ajax_controller@township");
Route::get("admin/township/route","ajax_controller@township_route");
Route::get("test","admin\Route_controller@test");
Route::get("preview/order/list/{id}","ajax_controller@order_detail");
Route::get("show/qr","ajax_controller@qr");
Route::get('/import_excel', 'ImportExcelController@index');
Route::post('/import_excel/import', 'ImportExcelController@import');
Route::get('qr/print/','ajax_controller@qr_print');
Route::get('auto/suggest','ajax_controller@auto');
//warehouse
Route::get("warehouse/stock/ledger","warehouse_stock_controller@stock_ledger");
Route::get("warehouse/stock/list","warehouse_stock_controller@stock_list");
Route::get("warehouse/stock/in","warehouse_stock_controller@stock_in");
Route::get("warehouse/stock/out","warehouse_stock_controller@stock_out");
Route::get("warehouse/stock/return","warehouse_stock_controller@stock_return");
Route::get("warehouse/stock/pay","warehouse_stock_controller@stock_outgoing");
Route::get("warehouse/choose/postman","warehouse_stock_controller@choose_postman");
Route::post("warehouse/postman/receive","warehouse_stock_controller@postman_receive");
Route::get("warehouse/postman/receive/cancel/{postman_id}/{id}/{plan_id}","warehouse_stock_controller@postman_receive_cancel");

// Search
Route::get("route/list/search","Route_controller@route_list_search");
Route::get("admin/postman/search","admin\postman_controller@search");
Route::get("admin/stock/incoming/search","admin\stock_controller@stock_in_search");
Route::get("admin/stock/outgoing/search","admin\stock_controller@stock_out_search");
Route::get("admin/stock/return/search","admin\stock_controller@stock_return_search");
Route::get("admin/route/list/request/search","admin\Route_controller@route_list_request_search");
Route::get("admin/realtime/map/{id}","admin\map_controller@map_realtime");
Route::get("admin/route/list/table/search","admin\Route_controller@route_verify_search");
Route::get("admin/ledger/list/search","admin\ledger_controller@ledger_list_search");
Route::get("admin/map/search","admin\map_controller@search");
// Warehouse search
Route::get("warehouse/stock/ledger/search","warehouse_stock_controller@stock_ledger_search");
Route::get("warehouse/stock/list/search","warehouse_stock_controller@stock_list_search");
Route::get("warehouse/stock/incoming/search","warehouse_stock_controller@stock_in_search");
Route::get("warehouse/stock/outgoing/search","warehouse_stock_controller@stock_outgoing_search");
Route::get('warehouse/stock/return/search',"warehouse_stock_controller@stock_return_search");


