<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
class HomeController extends Controller
{
    public function index() {
        $category_product = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id')->get();
        $category_brand = DB::table('tbl_brands')->where('brand_status',1)->orderby('brand_id')->get();

        $future_product =DB::table('tbl_products')->join('tbl_images_product','tbl_products.product_id','=','tbl_images_product.product_id')
        ->where('tbl_products.product_status',1)->limit(3)->get();
        

        $recommend_product = DB::table('tbl_products')->join('tbl_images_product','tbl_products.product_id','=','tbl_images_product.product_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_products.category_id')
        ->skip(3)->take(3)->get(); 


        return view('pages.home')->with('category_product',$category_product)->with('category_brand',$category_brand)
        ->with('future_product',$future_product)->with('rec_product',$recommend_product);
    }

    public function search (Request $request) {
        $category_product = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id')->get();
        $category_brand = DB::table('tbl_brands')->where('brand_status',1)->orderby('brand_id')->get();


        $product_key_word = $request->search_key;
        $search_product = DB::table('tbl_products')->join('tbl_images_product','tbl_products.product_id','=','tbl_images_product.product_id')
        ->where('product_name','like','%'.$product_key_word.'%')->get();
        return view('pages.product.search')->with('category_product',$category_product)->with('category_brand',$category_brand)
        ->with('search_product',$search_product);
    }
}
