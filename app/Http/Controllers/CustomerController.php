<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Arr;

session_start();

class CustomerController extends Controller
{
    public function history_order() {
        $category_product = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id')->get();
        $category_brand = DB::table('tbl_brands')->where('brand_status',1)->orderby('brand_id')->get();
        $user_id = session('user_id');
        if($user_id) {
            $all_order = DB::table('tbl_orders')->where('user_id',$user_id)->get();
            return view('pages.customer.history')->with('category_product',$category_product)->with('category_brand',$category_brand)
            ->with('all_order',$all_order);
        } else {
            return Redirect::to('/');
        }

    }

    public function history_details($order_id) {
        $category_product = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id')->get();
        $category_brand = DB::table('tbl_brands')->where('brand_status',1)->orderby('brand_id')->get();

        $order_details = DB::table('tbl_order_details')->join('tbl_products','tbl_products.product_id','=','tbl_order_details.product_id')
        ->join('tbl_images_product','tbl_images_product.product_id','=','tbl_products.product_id')
        ->where('tbl_order_details.order_id',$order_id)->get();

        return view('pages.customer.history_details')->with('category_product',$category_product)->with('category_brand',$category_brand)
        ->with('order_details',$order_details);
    }

    public function history_del($order_id) {
        DB::table('tbl_orders')->where('order_id',$order_id)->update(['order_status'=>-1]);
        return Redirect::to('history-order');
    }
}
