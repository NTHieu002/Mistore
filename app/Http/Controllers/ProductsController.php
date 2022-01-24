<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
class ProductsController extends Controller
{
    public function add_product() {
        $category_product = DB::table('tbl_category_product')->orderby('category_id')->get();
        $category_brand = DB::table('tbl_brands')->orderby('brand_id')->get();
        return view('admin.add_product')->with('category_product',$category_product)->with('category_brand',$category_brand);
    }

    public function all_product() {
        $all_product = DB::table('tbl_products')->join('tbl_images_product','tbl_products.product_id','=','tbl_images_product.product_id')->get();
        return view('admin.all_product')->with('all_product',$all_product);
    }

    public function save_product(Request $request) {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        DB::table('tbl_products')->insert($data);
        Session::put('message','Thêm Sản Phẩm Thành Công'); 


        $data_img = array();
        $get_image = $request->file('product_img');
        $product_id = DB::table('tbl_products')->where('product_name',$request->product_name)->value('product_id');
        $file = $get_image->getClientOriginalName();
        $file_name = pathinfo($file,PATHINFO_FILENAME);
        $extension = pathinfo($file,PATHINFO_EXTENSION);
        $product_img = $file_name.'.'.$extension;
        
        $get_image->move('public/uploads/products',$product_img);
        $data_img['product_id'] = $product_id;
        $data_img['img_name'] = $product_img;
        DB::table('tbl_images_product')->insert($data_img);
        
        return Redirect::to('all-product');
    }

    public function unActive_product($product_id) {
        DB::table('tbl_products')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Đã cập nhật hiển thị');
        return Redirect::to('all-product');
    }

    public function active_product($product_id) {
        DB::table('tbl_products')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Đã cập nhật hiển thị');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id) {
        $category_product = DB::table('tbl_category_product')->orderby('category_id')->get();
        $category_brand = DB::table('tbl_brands')->orderby('brand_id')->get();
        $edit_product = DB::table('tbl_products')->where('product_id',$product_id)->get();
        Session::put('message','Đã cập nhật thành công');
        return view('admin.edit_product')->with('edit_product',$edit_product)->with('category_product',$category_product)->with('category_brand',$category_brand);
    }

    public function delete_product($product_id) {
        DB::table('tbl_products')->where('product_id',$product_id)->delete();
        Session::put('message','Đã xóa thành công');
        return Redirect::to('all-product');
    }

    public function update_product(Request $request, $product_id) {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        DB::table('tbl_products')->where('product_id',$product_id)->update($data);
        Session::put('message','Thêm Sản Phẩm Thành Công'); 
        return Redirect::to('all-product');
    }
    // end admin


    // home product
    public function product_detail($product_id) { 
        $category_product = DB::table('tbl_category_product')->orderby('category_id')->get();
        $category_brand = DB::table('tbl_brands')->orderby('brand_id')->get();
        $product = DB::table('tbl_products')->join('tbl_images_product','tbl_products.product_id','=','tbl_images_product.product_id')
        ->join('tbl_brands','tbl_brands.brand_id','=','tbl_products.brand_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_products.category_id')
        ->where('tbl_products.product_id',$product_id)->get(); 

        foreach($product as $value) {
            $cate_id = $value->category_id;
        }

        $relate_product = DB::table('tbl_products')->join('tbl_images_product','tbl_products.product_id','=','tbl_images_product.product_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_products.category_id')
        ->where('tbl_products.category_id',$cate_id)->limit(3)->get(); 
        
        $tag_product = DB::table('tbl_products')->join('tbl_images_product','tbl_products.product_id','=','tbl_images_product.product_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_products.category_id')
        ->where('tbl_products.category_id',3)->limit(4)->get(); 


        return view('pages.product.product_detail')->with('category_product',$category_product)->with('category_brand',$category_brand)
        ->with('product',$product)->with('relate_product',$relate_product)->with('tag_product',$tag_product);
    }

}
