<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();

class CategoryProduct extends Controller
{
    public function add_category() {
        return view('admin.add_category_product');
    }

    public function all_category() {
        $all_category = DB::table('tbl_category_product')->get();
        return view('admin.all_category_product')->with('all_category',$all_category);
    }

    public function save_category_product(Request $request) {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_description;
        $data['category_status'] = $request->category_product_status;
        
        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm Danh Mục Thành Công'); 
        return Redirect::to('all-category');
    }

    public function unActive_category($category_product_id) {
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Đã cập nhật hiển thị');
        return Redirect::to('all-category');
    }

    public function active_category($category_product_id) {
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Đã cập nhật hiển thị');
        return Redirect::to('all-category');
    }

    public function edit_category($category_product_id) {
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        Session::put('message','Đã cập nhật thành công');
        return view('admin.edit_category_product')->with('edit_category',$edit_category_product);
    }

    public function delete_category($category_product_id) {
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Đã xóa thành công');
        return Redirect::to('all-category');
    }

    public function update_category(Request $request, $category_product_id) {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_description;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        return Redirect::to('all-category');
    }

    // end admin


    // category
    public function homeCategory($category_id) {
        $category_product = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id')->get();
        $category_brand = DB::table('tbl_brands')->where('brand_status',1)->orderby('brand_id')->get();

        $category_by_id = DB::table('tbl_category_product')
        ->join('tbl_products','tbl_products.category_id','=','tbl_category_product.category_id')
        ->join('tbl_images_product','tbl_images_product.product_id','=','tbl_products.product_id')
        ->where('tbl_category_product.category_id',$category_id)->get();

        $category_name = DB::table('tbl_category_product')->where('category_id',$category_id)->limit(1)->get();
        return view('pages.category.home_category')->with('category_product',$category_product)->with('category_brand',$category_brand)
        ->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }


    public function homeBrand($brand_id) {
        $category_product = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id')->get();
        $category_brand = DB::table('tbl_brands')->where('brand_status',1)->orderby('brand_id')->get();

        $brand_by_id = DB::table('tbl_brands')
        ->join('tbl_products','tbl_products.brand_id','=','tbl_brands.brand_id')
        ->join('tbl_images_product','tbl_images_product.product_id','=','tbl_products.product_id')
        ->where('tbl_brands.brand_id',$brand_id)->get();

        $brand_name = DB::table('tbl_brands')->where('brand_id',$brand_id)->limit(1)->get();
        return view('pages.brand.home_brand')->with('category_brand',$category_brand)->with('category_product',$category_product)
        ->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }


   
}
