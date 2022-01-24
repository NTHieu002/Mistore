<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Arr;

session_start();
class CartController extends Controller
{
    public function show_cart() {
        $category_product = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id')->get();
        $category_brand = DB::table('tbl_brands')->where('brand_status',1)->orderby('brand_id')->get();
        return view('pages.cart.show_cart')->with('category_product',$category_product)->with('category_brand',$category_brand);
    }

    public function save_cart(Request $request, $product_id) {
        $product_quantity = $request->product_qnt;

        $category_product = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id')->get();
        $category_brand = DB::table('tbl_brands')->where('brand_status',1)->orderby('brand_id')->get();

        
        $data = array();
        $data['id'] = $product_id;
        $data['name'] = $request->product_name_hidden;
        $data['price'] = $request->product_price_hidden;
        $data['quantity'] = $product_quantity;
        $data['attributes']['image'] = $request->product_img_hidden;

        Cart::add($data);
        
        //Cart::clear();
        return Redirect::to('cart');

    }

    public function add_cart($product_id) {
        $product_info = DB::table('tbl_products')->join('tbl_images_product','tbl_images_product.product_id','=','tbl_products.product_id')
        ->where('tbl_products.product_id',$product_id)->first();
        $data = array();
        $data['id'] = $product_id;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['quantity'] = 1;
        $data['attributes']['image'] = $product_info->img_name;
        Cart::add($data);
        return Redirect::to('cart');
    }

    public function delete_to_cart($product_id) {
        Cart::remove($product_id);
        return Redirect::to('/cart');
    }

    public function update_qnt_sub($product_id) {
        Cart::update($product_id, array(
            'quantity' => -1, 
        ));
        return Redirect::to('cart');
    }

    public function update_qnt_plus($product_id) {
        Cart::update($product_id, array(
            'quantity' => +1, 
        ));
        return Redirect::to('cart');
    }

    public function delete_cart() {
        Cart::Clear();
        return Redirect::to('cart');
    }
}
