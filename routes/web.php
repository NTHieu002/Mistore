<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandsProductController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CouponControler;
use App\Http\Controllers\SocialateController;


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
// Frontend
Route::get('/', [HomeController::class ,'index']);
Route::get('/home', [HomeController::class ,'index']);
Route::post('/search', [HomeController::class ,'search']);



// category home page
Route::get('/brand-product/{brand_id}', [CategoryProduct::class ,'homeBrand']);
Route::get('/category-product/{category_id}', [CategoryProduct::class ,'homeCategory']);





// Backend
Route::get('/admin', [AdminController::class ,'index']);
Route::get('/dashboard', [AdminController::class ,'showDashBoard']);
Route::post('/admin-dashboard', [AdminController::class ,'dashBoard']);
Route::get('/logOut', [AdminController::class ,'logOut']);
Route::get('/manage-order', [AdminController::class ,'manage_order']);
Route::get('/view-order/{order_id}', [AdminController::class ,'view_order']);
Route::get('/del-order/{order_id}', [AdminController::class ,'del_order']);
Route::get('/update-order/{order_id}', [AdminController::class ,'update_order']);
Route::get('/all-staff', [AdminController::class ,'all_staff']);
Route::get('/update-staff/{staff_id}', [AdminController::class ,'update_staff']);
Route::get('/del-staff/{staff_id}', [AdminController::class ,'del_staff']);
Route::get('/add-staff', [AdminController::class ,'add_staff']);
Route::post('/save-staff', [AdminController::class ,'save_staff']);
Route::get('/print-pdf/{order_id}', [AdminController::class ,'print_pdf']);
// Route::get('/print-order/{order_id}', [AdminController::class ,'print_order']);

//Coupon
Route::get('/all-coupon', [CouponControler::class ,'all_coupon']);
Route::get('/add-coupon', [CouponControler::class ,'add_coupon']);
Route::post('/save-coupon', [CouponControler::class ,'save_coupon']);
Route::get('/unActive-coupon/{coupon_id}', [CouponControler::class ,'unActive_coupon']);
Route::get('/Active-coupon/{coupon_id}', [CouponControler::class ,'Active_coupon']);
Route::get('/delete-coupon/{coupon_id}', [CouponControler::class ,'delete_coupon']);





//Category
Route::get('/add-category',[CategoryProduct::class,'add_category']);
Route::get('/all-category',[CategoryProduct::class,'all_category']);
Route::get('/edit-category/{category_product_id}',[CategoryProduct::class,'edit_category']);
Route::get('/delete-category/{category_product_id}',[CategoryProduct::class,'delete_category']);
Route::post('/save-category-product',[CategoryProduct::class,'save_category_product']);
Route::get('/unActive-category/{category_product_id}',[CategoryProduct::class,'unActive_category']);
Route::get('/active-category/{category_product_id}',[CategoryProduct::class,'active_category']);
Route::get('/update-category-product/{category_product_id}',[CategoryProduct::class,'update_category']);



//Brand
Route::get('/add-brand',[BrandsProductController::class,'add_brand']);
Route::get('/all-brand',[BrandsProductController::class,'all_brand']);
Route::get('/edit-brand/{brand_product_id}',[BrandsProductController::class,'edit_brand']);
Route::get('/delete-brand/{brand_product_id}',[BrandsProductController::class,'delete_brand']);
Route::post('/save-brand-product',[BrandsProductController::class,'save_brand_product']);
Route::get('/unActive-brand/{brand_product_id}',[BrandsProductController::class,'unActive_brand']);
Route::get('/active-brand/{brand_product_id}',[BrandsProductController::class,'active_brand']);
Route::get('/update-brand-product/{brand_product_id}',[BrandsProductController::class,'update_brand']);


// Product
Route::get('/add-product',[ProductsController::class,'add_product']);
Route::get('/all-product',[ProductsController::class,'all_product']);
Route::get('/edit-product/{product_id}',[ProductsController::class,'edit_product']);
Route::get('/delete-product/{product_id}',[ProductsController::class,'delete_product']);
Route::post('/save-product',[ProductsController::class,'save_product']);
Route::get('/unActive-product/{product_id}',[ProductsController::class,'unActive_product']);
Route::get('/active-product/{product_id}',[ProductsController::class,'active_product']);
Route::get('/update-product/{product_id}',[ProductsController::class,'update_product']);
Route::get('/product-detail/{product_id}', [ProductsController::class ,'product_detail']);


// Cart
Route::post('/save-cart/{product_id}',[CartController::class,'save_cart']);
Route::get('/cart',[CartController::class,'show_cart']);
Route::get('/delete-to-cart/{product_id}',[CartController::class,'delete_to_cart']);
Route::get('/update-qnt-sub/{product_id}',[CartController::class,'update_qnt_sub']);
Route::get('update-qnt-plus/{product_id}',[CartController::class,'update_qnt_plus']);
Route::get('/delete-cart',[CartController::class,'delete_cart']);
Route::get('/add-cart/{product_id}',[CartController::class,'add_cart']);
//Cart -> Coupon
Route::post('/check-coupon',[CartController::class,'check_coupon']);



// checkout
Route::get('/login-checkout',[CheckOutController::class,'login_checkout']);
Route::post('/resister-account',[CheckOutController::class,'resister_account']);
Route::get('/index',[CheckOutController::class,'index']);
Route::get('/log-out',[CheckOutController::class,'log_out']);
Route::get('/save-order',[CheckOutController::class,'save_order']);
Route::get('/save-order-user',[CheckOutController::class,'save_order_user']);

//customer
Route::get('/history-order',[CustomerController::class,'history_order']);
Route::get('/history-details/{order_id}',[CustomerController::class,'history_details']);
Route::get('/history-del/{order_id}',[CustomerController::class,'history_del']);


//social login
Route::get('/login-social/{social}',[SocialateController::class,'login_fb']);
Route::get('/check-info/{social}',[SocialateController::class,'check_info']);

Route::get('/login-social/{social}',[SocialateController::class,'login_gg']);
Route::get('/auth/google/callback',[SocialateController::class,'call_back_gg']);