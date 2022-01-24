<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
class BrandsProductController extends Controller
{
    public function add_brand() {
        return view('admin.add_brand_product');
    }

    public function all_brand() {
        $all_brand = DB::table('tbl_brands')->get();
        return view('admin.all_brand_product')->with('all_brand',$all_brand);
    }

    public function save_brand_product(Request $request) {
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_description;
        $data['brand_status'] = $request->brand_product_status;
        
        DB::table('tbl_brands')->insert($data);
        Session::put('message','Thêm Danh Mục Thành Công'); 
        return Redirect::to('all-brand');
    }

    public function unActive_brand($brand_product_id) {
        DB::table('tbl_brands')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Đã cập nhật hiển thị');
        return Redirect::to('all-brand');
    }

    public function active_brand($brand_product_id) {
        DB::table('tbl_brands')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Đã cập nhật hiển thị');
        return Redirect::to('all-brand');
    }

    public function edit_brand($brand_product_id) {
        $edit_brand_product = DB::table('tbl_brands')->where('brand_id',$brand_product_id)->get();
        Session::put('message','Đã cập nhật thành công');
        return view('admin.edit_brand_product')->with('edit_brand',$edit_brand_product);
    }

    public function delete_brand($brand_product_id) {
        DB::table('tbl_brands')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Đã xóa thành công');
        return Redirect::to('all-brand');
    }

    public function update_brand(Request $request, $brand_product_id) {
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_description;
        DB::table('tbl_brands')->where('brand_id',$brand_product_id)->update($data);
        return Redirect::to('all-brand');
    }
}
