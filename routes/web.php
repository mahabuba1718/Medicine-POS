<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('backend.layout.home');
// });

// master
Route::get('/',[AdminController::class,'master'])->name('master');

// registration
Route::get('/registration',[AdminController::class,'registration'])->name('registration');
Route::post('/create/user',[AdminController::class,'register'])->name('register');

// login_post
Route::post('/login/post',[AdminController::class,'login_post'])->name('login_post');

Route::prefix('/')->middleware(['auth'])->group(function () {

    // dashboard
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');

    // profile
    Route::get('/profile',[AdminController::class,'profile'])->name('profile');
    Route::post('/update/profile',[AdminController::class,'update_profile'])->name('update_profile');
    Route::post('/update/change_password',[AdminController::class,'change_password'])->name('change_password');

    // contact=pharmacist
    Route::get('/pharmacist',[AdminController::class,'contact_pharmacist'])->name('contact_pharmacist');
    Route::post('/create/contact',[AdminController::class,'pharma'])->name('pharma');
    Route::get('/editpharma/{pharm_id}',[AdminController::class,'editpharma'])->name('editpharma');
    Route::put('/update/pharmacist',[AdminController::class,'updatepharm'])->name('updatepharm');
    Route::delete('/deletepharma',[AdminController::class,'deletepharma'])->name('deletepharma');
    Route::get('/status/{id}',[AdminController::class,'status'])->name('status');

    // contact=customer
    Route::get('/customer',[AdminController::class,'contact_customer'])->name('contact_customer');
    Route::post('/create/cutomer',[AdminController::class,'cus'])->name('cus');
    Route::get('/editcus/{cus_id}',[AdminController::class,'editcus'])->name('editcus');
    Route::put('/update/customer',[AdminController::class,'updatecus'])->name('updatecus');
    Route::delete('/deletecus',[AdminController::class,'deletecus'])->name('deletecus');
    Route::get('/cus_status/{id}',[AdminController::class,'cus_status'])->name('cus_status');

    // supplier
    Route::get('/supplier',[AdminController::class,'contact_supplier'])->name('contact_supplier');
    Route::post('/create/supplier',[AdminController::class,'supplier'])->name('supplier');
    Route::get('/editsup/{sup_id}',[AdminController::class,'editsup'])->name('editsup');
    Route::put('/update/supplier',[AdminController::class,'updatesup'])->name('updatesup');
    Route::delete('/deletesup',[AdminController::class,'deletesup'])->name('deletesup');
    Route::get('/sup_status/{id}',[AdminController::class,'sup_status'])->name('sup_status');

    // category
    Route::get('/category',[AdminController::class,'category'])->name('category');
    Route::post('/create/category',[AdminController::class,'categories'])->name('categories');
    Route::get('/editcat/{cat_id}',[AdminController::class,'editcat'])->name('editcat');
    Route::put('/update/category',[AdminController::class,'updatecat'])->name('updatecat');
    Route::post('/deletecat',[AdminController::class,'deletecat'])->name('deletecat');
    Route::get('/cat_status/{id}',[AdminController::class,'cat_status'])->name('cat_status');

    // UNIT
    Route::get('/unit',[AdminController::class,'unit'])->name('unit');
    Route::post('/create/unit',[AdminController::class,'units'])->name('units');
    Route::get('/editunit/{unit_id}',[AdminController::class,'editunit'])->name('editunit');
    Route::put('/update/unit',[AdminController::class,'updateunit'])->name('updateunit');
    Route::post('/deleteunit',[AdminController::class,'deleteunit'])->name('deleteunit');
    Route::get('/unit_status/{id}',[AdminController::class,'unit_status'])->name('unit_status');

    // type
    Route::get('/type',[AdminController::class,'type'])->name('type');
    Route::post('/create/type',[AdminController::class,'types'])->name('types');
    Route::get('/edittype/{type_id}',[AdminController::class,'edittype'])->name('edittype');
    Route::put('/update/type',[AdminController::class,'updatetype'])->name('updatetype');
    Route::post('/deletetype',[AdminController::class,'deletetype'])->name('deletetype');
    Route::get('/type_status/{id}',[AdminController::class,'type_status'])->name('type_status');

    // medicine
    Route::get('/medicine',[AdminController::class,'medicine'])->name('medicine');
    Route::post('/create/medicine',[AdminController::class,'admedicine'])->name('admedicine');
    Route::get('/editmedicine/{med_id}',[AdminController::class,'editmedicine'])->name('editmedicine');
    Route::get('/viewmed/{med_id}',[AdminController::class,'viewmed'])->name('viewmed');
    Route::put('/update/medicine',[AdminController::class,'updatemedicine'])->name('updatemedicine');
    Route::post('/deletemedicine',[AdminController::class,'deletemedicine'])->name('deletemedicine');
    Route::get('/med_status/{id}',[AdminController::class,'med_status'])->name('med_status');

    // purchase
    Route::get('/purchase',[AdminController::class,'purchase'])->name('purchase');
    Route::post('/purchase-approve', [AdminController::class,'approve'])->name('purchase_approve');
    Route::put('/due_purchase',[AdminController::class,'due_purchase'])->name('due_purchase');
    Route::post('/deletepurch',[AdminController::class,'deletepurch'])->name('deletepurch');
    Route::get('/viewpurch/{purch_id}',[AdminController::class,'viewpurch'])->name('viewpurch');

    // add-purchase
    Route::get('/add_purchase',[AdminController::class,'addpurchase'])->name('add_purchase');
    Route::get('/purchase/find_med/{id}',[AdminController::class,'purchase_find_med'])->name('purchase_find_med');
    Route::post('/create/purchase',[AdminController::class,'adpurchase'])->name('adpurchase');

    // purchase invoice
    Route::get('/purchase_invoice/{id}',[AdminController::class,'purchase_invoice'])->name('purchase_invoice');

    // pos
    Route::get('/pos',[AdminController::class,'pos'])->name('pos');
    Route::get('/pos-add/{id}',[AdminController::class,'addtocart'])->name('addtocart');
    Route::post('/cart_increment',[AdminController::class,'cart_increment'])->name('cart_increment');
    Route::get('/pos-delete/{id}',[AdminController::class,'deletecart'])->name('deletecart');
    Route::get('/pos-clear',[AdminController::class,'pos_clear'])->name('pos_clear');
    Route::post('/create/possale',[AdminController::class,'pos_sale'])->name('pos_sale');

    // sale invoice
    Route::get('/invoice/{id}',[AdminController::class,'invoice'])->name('invoice');

    // pos sale list
    Route::get('/possale',[AdminController::class,'possale'])->name('possale');
    Route::put('/due_pos',[AdminController::class,'due_pos'])->name('due_pos');
    Route::post('/deletepos',[AdminController::class,'deletepos'])->name('deletepos');

    Route::prefix('/')->middleware(['admin'])->group(function () {
        // account
        Route::get('/expense',[AdminController::class,'account_expense'])->name('account_expense');
        Route::get('/income',[AdminController::class,'account_income'])->name('account_income');

        // setting
        Route::get('/setting',[AdminController::class,'setting'])->name('setting');
        Route::post('/create/setting/{id}',[AdminController::class,'change'])->name('change');
    });

    // stock
    Route::get('/stock_report',[AdminController::class,'stock_report'])->name('stock_report');
    Route::get('/expiry_report',[AdminController::class,'expiry_report'])->name('expiry_report');

    // logout
    Route::get('/logout',[AdminController::class,'logout'])->name('logout');

});