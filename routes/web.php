<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Http\Controllers\SalesForecast;
use App\Http\Controllers\DelPickForms;

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
    return view('welcome');
});

Auth::routes();
Route::get('/', function() {
    return redirect('login');
})->name('login')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');



Route::get('/in_consignment', function() {
    return view('in_consignment');
})->name('in_consignment')->middleware('auth');


Route::get('/current_stock', 'OdooController@fetch_current_stock')->name('current_stock')->middleware('auth');
Route::get('/non_deliverable_stock', 'OdooController@non_deliverable_stock')->name('non_deliverable_stock')->middleware('auth');
Route::get('/current_stock_model2', 'OdooController@fetch_current_stock_model_nd')->name('fetch_current_stock_model_nd')->middleware('auth');


Route::get('/aged_consignments_model', 'OdooController@fetch_aged_consignments_model')->name('aged_consignments_model')->middleware('auth');
Route::get('/delivery_ready', 'OdooController@fetch_delivery_ready')->name('delivery_ready')->middleware('auth');
Route::get('/quotations_pending', 'OdooController@fetch_quotations_pending')->name('quotations_pending')->middleware('auth');
Route::get('/speedversion_change', 'OdooController@fetch_speedversion_change')->name('speedversion_change')->middleware('auth');
Route::get('/simple_preparation', 'OdooController@fetch_simple_preparation')->name('simple_preparation')->middleware('auth');
Route::get('/sold', 'OdooController@fetch_sold_ytd')->name('sold')->middleware('auth');
Route::get('/who_reserved_what', 'OdooController@fetch_who_reserved_what')->name('who_reserved_what')->middleware('auth');
Route::get('/who_demands_what', 'OdooController@fetch_who_demands_what')->name('who_demands_what')->middleware('auth');
//Route::get('/statnl', function() { return view('statnl');})->name('statnl')->middleware('auth');
//Route::get('/statnl','StatDataController@index')->name('statnl')->middleware('auth');
Route::get('/statnl',function() { return view('statnl');})->name('statnl')->middleware('auth');
Route::get('/statbe', function() { return view('statbe');})->name('statbe')->middleware('auth');
Route::get('aged_consign_models_cust', 'OdooController@fetch_aged_consign_model_cust');
Route::get('current_stock_model', 'OdooController@fetch_current_stock_model');

Route::get('/dealer_list', 'OdooController@fetch_dealer_list')->name('dealer_list')->middleware('auth');
Route::get('/bulk_contact', 'OdooController@fetch_bulk_dealer_mail_list')->name('bulk_contact')->middleware('auth');



Route::get('current_dealer', 'OdooController@fetch_current_dealer')->middleware('auth');
Route::get('/current_dealer_recalculate', 'OdooController@fetch_current_dealer_refresh')->middleware('auth');
Route::get('/snelstart_invoices', 'OdooController@fetch_current_dealer_snelstart')->name('snelstart_invoices')->middleware('auth');
Route::get('/tracking_all', 'Molcontroller@list_all')->name('tracking_all')->middleware('auth');
Route::get('/to_inv_val', 'Molcontroller@to_inv_val')->name('to_inv_val')->middleware('auth');
Route::get('/update_moltranfers', 'Molcontroller@update_moltranfers')->name('update_moltranfers')->middleware('auth');
Route::get('/update_moltranfers2', 'Molcontroller@update_moltranfers2')->name('update_moltranfers2')->middleware('auth');//apla gia to redirection


Route::get('/user_list', function() {return view('user_list');})->name('user_list')->middleware('auth');
Route::get('/user_edit_form', [App\Http\Controllers\HomeController::class, 'fetch_user_info'])->name('user_edit_form')->middleware('auth');

Route::get('/user_password_reset', [App\Http\Controllers\HomeController::class,'fetch_user_info_password'])->name('user_password_reset')->middleware('auth');

Route::get('/user_create_form', function() {return view('user_create_form');})->name('user_create_form')->middleware('auth');
Route::post('/create_new_user', [App\Http\Controllers\HomeController::class,'create_user'])->name('create_new_user')->middleware('auth');
//Route::post('/create_new', [App\Http\Controllers\SpartsController::class,'create'])->name('create_new')->middleware('auth');

Route::post('/reset_user_password', [App\Http\Controllers\HomeController::class, 'reset_user_password'])->name('reset_user_password')->middleware('auth');
Route::get('/user_delete', [App\Http\Controllers\HomeController::class,'user_delete'])->name('user_delete')->middleware('auth');
Route::post('/update_user_details', [App\Http\Controllers\HomeController::class,'update_user'])->name('update_user_details')->middleware('auth');
Route::get('/revenue_target', 'OdooController@revenue_target')->name('revenue_target')->middleware('auth');
Route::get('/units_target', 'OdooController@units_target')->name('units_target')->middleware('auth');



Route::get('/transfer_edit_form', [App\Http\Controllers\Molcontroller::class,'fetch_transfer_info'])->name('transfer_edit_form')->middleware('auth');
Route::post('/update_transfer_details', [App\Http\Controllers\Molcontroller::class, 'update_transfer'])->name('update_transfer_details')->middleware('auth');




Route::get('/fetch_product_image', 'OdooController@fetch_product_image')->name('fetch_product_image');




Route::get('/models_showcase', 'OdooController@models_showcase_no_auth')->name('models_showcase');
Route::get('/odoo_stock', 'OdooController@fetch_current_stock_no_auth')->name('odoo_stock');


Route::get('/odoo_test', 'OdooController@fetch_custom_odoo_model')->name('odoo_partssnel');

//Helper
Route::get('/sp/prepareimports', 'HelperController@prepare_is_spare_part_for_show')->name('prepare_is_spare_part_for_show')->middleware('auth');
Route::post('/sp/prepareimports', 'HelperController@prepare_is_spare_part_for_export')->middleware('auth');
//Helper

Route::get('/avail_per_catalog', 'OdooSparePartsController@avail_per_catalog_show')->name('avail_per_catalog_show')->middleware('auth');
Route::post('/avail_per_catalog', 'OdooSparePartsController@avail_per_catalog')->name('avail_per_catalog')->middleware('auth');



//SalesForecast
Route::get('/bi/sales_targets_input', 'SalesForecast@sales_targets_show')->name('sales_targets_show')->middleware('auth');
Route::post('/bi/sales_targets_input', 'SalesForecast@sales_targets_edit')->name('sales_targets_update')->middleware('auth');
//SalesForecast



//ajax routes
Route::get('/current_stock/get_cost_per_cat', 'OdooController@fetch_cost_per_cat')->name('fetch_cost_per_cat')->middleware('auth');
//ajax routes

//Forms
Route::get('/del_pick', 'DelPickForms@del_pick_show')->name('del_pick_show')->middleware('auth');
Route::post('/del_pick', 'DelPickForms@del_pick_create')->name('del_pick_create')->middleware('auth');
Route::get('/forms/del_pick/pdf', 'DelPickForms@del_pick_create_pdf')->name('del_pick_create_pdf')->middleware('auth');
Route::get('/del_pick_list', 'DelPickForms@del_pick_list_show')->name('del_pick_list_show')->middleware('auth');
Route::get('/del_pick_finished_list', 'DelPickForms@del_pick_show_finished')->name('del_pick_finished_list')->middleware('auth');
Route::get('/del_pick_edit', 'DelPickForms@del_pick_edit_show')->name('del_pick_edit_show')->middleware('auth');
Route::post('/del_pick_edit', 'DelPickForms@del_pick_update')->name('del_pick_update')->middleware('auth');


//Forms

//ajax routes Forms
Route::get('/forms/del_pick/dealers_address', 'DelPickForms@fetch_dealers_address')->name('fetch_dealers_address')->middleware('auth');
Route::get('/forms/del_pick/dealers_locations', 'DelPickForms@fetch_dealers_locations')->name('fetch_dealers_locations')->middleware('auth');
Route::get('/forms/del_pick/details_vin', 'DelPickForms@fetch_details_vin')->name('fetch_details_vin')->middleware('auth');
Route::get('/forms/del_pick/upload_sign', 'DelPickForms@upload_sign')->name('upload_sign')->middleware('auth');
//ajax routes Forms /forms/del_pick/details_vin?vin=XF1WV05AEKX000334



Route::get('/signaturepad', [DelPickForms::class, 'show_sign2']);
Route::post('/signaturepad', [DelPickForms::class, 'upload_sign2'])->name('signaturepad.upload');

//mail urls
Route::get('/sendemail/finalize', 'DelPickForms@mail_finalize')->name('mail_finalize');
//mail urls


//urls cancel refused
Route::get('/sendemail/cancel', 'DelPickForms@pd_cancel')->name('pd_cancel');
Route::get('/sendemail/refused', 'DelPickForms@pd_refused')->name('pd_refused');
//urls cancel refused
